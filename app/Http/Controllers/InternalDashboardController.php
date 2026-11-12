<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\CaseAssignment;
use App\Models\CaseSummons;
use App\Models\CounselingSession;
use App\Models\Report;
use App\Models\ReportStatusHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\StreamedResponse;

class InternalDashboardController extends Controller
{
    private const STATUSES = ['baru_diterima', 'menunggu_verifikasi', 'sedang_diverifikasi', 'perlu_informasi_tambahan', 'pemanggilan_saksi_pelaku', 'pemeriksaan', 'dalam_penanganan', 'menunggu_rujukan', 'ketidakhadiran_berlanjut', 'eskalasi_pimpinan', 'selesai'];

    public function index(Request $request)
    {
        $request->validate([
            'from' => ['nullable', 'date_format:Y-m-d'],
            'to' => ['nullable', 'date_format:Y-m-d', 'after_or_equal:from'],
            'category' => ['nullable', 'in:verbal,non_fisik,fisik,daring,lainnya'],
        ]);
        $user = $request->user();
        $role = $user->role;
        $query = Report::query();
        if ($role === 'psikolog') {
            $query->whereIn('id', CaseAssignment::where('user_id', $user->id)->where('kind', 'psikolog')->select('report_id'));
        } elseif ($role === 'tim_satgas') {
            $query->where(function ($q) use ($user) {
                $q->whereNull('assigned_user_id')->orWhere('assigned_user_id', $user->id);
            });
        }
        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->date('from'));
        }
        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->date('to'));
        }
        if ($request->filled('category')) {
            $query->where('incident_type', $request->string('category'));
        }
        $base = clone $query;
        $safeColumns = ['id', 'ticket_number', 'incident_type', 'status', 'created_at', 'updated_at', 'requires_follow_up', 'referred_at', 'resolved_at', 'assigned_user_id'];
        $reports = (clone $query)->select($safeColumns)->latest()->paginate(15)->withQueryString();
        $stats = [
            'total' => (clone $base)->count(),
            'verification' => (clone $base)->whereIn('status', ['baru_diterima', 'menunggu_verifikasi', 'sedang_diverifikasi', 'perlu_informasi_tambahan'])->count(),
            'handling' => (clone $base)->whereIn('status', ['pemanggilan_saksi_pelaku', 'pemeriksaan', 'dalam_penanganan', 'menunggu_rujukan', 'ketidakhadiran_berlanjut', 'eskalasi_pimpinan'])->count(),
            'finished' => (clone $base)->where('status', 'selesai')->count(),
            'follow_up' => (clone $base)->where('requires_follow_up', true)->count(),
            'referrals' => (clone $base)->whereNotNull('referred_at')->count(),
        ];
        if ($role === 'psikolog') {
            $assignedIds = CaseAssignment::where('user_id', $user->id)->where('kind', 'psikolog')->select('report_id');
            $stats['new'] = (clone $base)->whereIn('status', ['baru_diterima', 'menunggu_rujukan'])->count();
            $stats['upcoming'] = CounselingSession::where('psychologist_id', $user->id)->where('status', 'dijadwalkan')->where('scheduled_at', '>=', now())->count();
            $stats['finished'] = CounselingSession::where('psychologist_id', $user->id)->where('status', 'terlaksana')->count();
            $stats['referrals'] = (clone $base)->whereIn('id', $assignedIds)->count();
            $stats['handling'] = CounselingSession::where('psychologist_id', $user->id)->where('status', 'dijadwalkan')->count();
        }
        $categories = (clone $base)->select('incident_type', DB::raw('count(*) as total'))->groupBy('incident_type')->orderByDesc('total')->get();
        $statuses = (clone $base)->select('status', DB::raw('count(*) as total'))->groupBy('status')->orderByDesc('total')->get();
        $monthly = (clone $base)->selectRaw("strftime('%Y-%m', created_at) as period, count(*) as total")->groupBy('period')->orderBy('period')->get();
        if (config('database.default') !== 'sqlite') {
            $monthly = (clone $base)->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as period, count(*) as total")->groupBy('period')->orderBy('period')->get();
        }
        $averageDays = (clone $base)->whereNotNull('resolved_at')->selectRaw('AVG('.(config('database.default') === 'sqlite' ? 'julianday(resolved_at) - julianday(created_at)' : 'DATEDIFF(resolved_at, created_at)').') as average_days')->value('average_days');
        $activity = in_array($role, ['ketua_satgas', 'pimpinan'], true) ? ReportStatusHistory::with('user:id,name')->latest()->limit(8)->get() : collect();
        $psychologists = $role === 'ketua_satgas' ? User::where('role', 'psikolog')->where('is_active', true)->orderBy('name')->get(['id', 'name']) : collect();
        $upcomingSessions = $role === 'psikolog' ? CounselingSession::where('psychologist_id', $user->id)->where('status', 'dijadwalkan')->where('scheduled_at', '>=', now())->orderBy('scheduled_at')->limit(5)->with('report:id,ticket_number')->get() : collect();

        if ($role === 'ketua_satgas' && $request->routeIs('internal.dashboard')) {
            $priorityReports = Report::query()->select($safeColumns)->orderByDesc('requires_follow_up')->latest()->limit(6)->get();
            return view('internal.chair-dashboard', compact('role', 'reports', 'priorityReports', 'stats', 'activity', 'categories', 'statuses', 'monthly', 'averageDays'));
        }
        return view('internal.dashboard', compact('role', 'reports', 'stats', 'categories', 'statuses', 'monthly', 'averageDays', 'activity', 'psychologists', 'upcomingSessions'));
    }

    public function updateStatus(Request $request, Report $report)
    {
        $this->authorize('update', $report);
        $validator = Validator::make($request->all(), [
            'status' => ['required', 'in:'.implode(',', self::STATUSES)],
            'note' => ['nullable', 'string', 'max:2000'],
            'requires_follow_up' => ['nullable', 'boolean'],
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $data = $validator->validated();
        DB::transaction(function () use ($report, $data, $request) {
            $old = $report->status;
            $report->status = $data['status'];
            $report->requires_follow_up = (bool) ($data['requires_follow_up'] ?? false);
            if ($data['status'] === 'selesai') {
                $report->resolved_at = now();
            }
            $report->save();
            ReportStatusHistory::create(['report_id' => $report->id, 'user_id' => $request->user()->id, 'from_status' => $old, 'to_status' => $data['status'], 'note' => $data['note'] ?? null]);
            AuditLog::create(['user_id' => $request->user()->id, 'report_id' => $report->id, 'action' => 'report_status_updated', 'reason' => 'Status berubah dari '.$old.' menjadi '.$data['status'].'.', 'ip_address' => $request->ip(), 'created_at' => now()]);
        });

        return back()->with('success', 'Status pengaduan diperbarui.');
    }

    public function assignPsychologist(Request $request, Report $report)
    {
        abort_unless($request->user()->hasRole('ketua_satgas'), 403);
        $data = $request->validate(['user_id' => ['required', 'integer', 'exists:users,id']]);
        $psychologist = User::whereKey($data['user_id'])->where('role', 'psikolog')->where('is_active', true)->firstOrFail();
        DB::transaction(function () use ($report, $psychologist, $request) {
            CaseAssignment::firstOrCreate(['report_id' => $report->id, 'user_id' => $psychologist->id, 'kind' => 'psikolog'], ['assigned_by' => $request->user()->id]);
            $previousStatus = $report->status;
            $report->update(['referred_at' => $report->referred_at ?? now(), 'status' => 'menunggu_rujukan']);
            ReportStatusHistory::create(['report_id' => $report->id, 'user_id' => $request->user()->id, 'from_status' => $previousStatus, 'to_status' => 'menunggu_rujukan', 'note' => 'Kasus dirujuk kepada psikolog.']);
            AuditLog::create(['user_id' => $request->user()->id, 'report_id' => $report->id, 'action' => 'psychologist_referral_created', 'reason' => 'Rujukan dibuat kepada akun psikolog ID '.$psychologist->id, 'ip_address' => $request->ip(), 'created_at' => now()]);
        });

        return back()->with('success', 'Rujukan psikolog dicatat.');
    }

    public function assignStaff(Request $request, Report $report)
    {
        abort_unless($request->user()->hasRole('ketua_satgas'), 403);
        $data = $request->validate(['user_id' => ['required', 'integer', 'exists:users,id']]);
        $staff = User::whereKey($data['user_id'])->where('role', 'tim_satgas')->where('is_active', true)->firstOrFail();
        $victimGender = $report->reporter_data['victim_gender'] ?? null;
        abort_if(in_array($victimGender, ['perempuan', 'laki_laki'], true) && $staff->gender !== $victimGender, 422, 'Pilih petugas dengan gender yang sesuai dengan preferensi sensitivitas korban.');
        $old = $report->assigned_user_id;
        DB::transaction(function () use ($report, $staff, $request, $old) {
            $report->update(['assigned_user_id' => $staff->id]);
            CaseAssignment::updateOrCreate(['report_id' => $report->id, 'kind' => 'tim_satgas'], ['user_id' => $staff->id, 'assigned_by' => $request->user()->id]);
            AuditLog::create(['user_id' => $request->user()->id, 'report_id' => $report->id, 'action' => 'satgas_staff_assigned', 'reason' => 'Petugas Satgas ID '.$staff->id.' ditugaskan; penugasan sebelumnya: '.($old ?? 'belum ada').'.', 'ip_address' => $request->ip(), 'created_at' => now()]);
        });
        return back()->with('success', 'Petugas pemeriksa ditugaskan.');
    }

    public function export(Request $request): StreamedResponse
    {
        abort_unless($request->user()->hasRole('ketua_satgas', 'pimpinan'), 403);
        $filters = $request->validate([
            'from' => ['nullable', 'date_format:Y-m-d'],
            'to' => ['nullable', 'date_format:Y-m-d', 'after_or_equal:from'],
            'category' => ['nullable', 'in:verbal,non_fisik,fisik,daring,lainnya'],
        ]);
        $query = Report::query()->select(['ticket_number', 'incident_type', 'status', 'created_at', 'updated_at', 'referred_at', 'resolved_at']);
        if (! empty($filters['from'])) {
            $query->whereDate('created_at', '>=', $filters['from']);
        }
        if (! empty($filters['to'])) {
            $query->whereDate('created_at', '<=', $filters['to']);
        }
        if (! empty($filters['category'])) {
            $query->where('incident_type', $filters['category']);
        }
        $rows = $query->latest()->cursor();

        return response()->streamDownload(function () use ($rows) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Nomor tiket', 'Kategori', 'Status', 'Tanggal masuk', 'Terakhir diperbarui', 'Tanggal rujukan', 'Tanggal selesai']);
            foreach ($rows as $row) {
                $category = preg_match('/^[=+@\-]/', $row->incident_type) ? "'".$row->incident_type : $row->incident_type;
                fputcsv($out, [$row->ticket_number, $category, $row->status, $row->created_at, $row->updated_at, $row->referred_at, $row->resolved_at]);
            }
            fclose($out);
        }, 'laporan-penanganan.csv', ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    public function monitoring(Request $request)
    {
        abort_unless($request->user()->hasRole('ketua_satgas', 'pimpinan'), 403);

        return $this->index($request);
    }

    public function analytics(Request $request)
    {
        abort_unless($request->user()->hasRole('ketua_satgas', 'pimpinan'), 403);
        $query = Report::query();
        $statuses = (clone $query)->select('status', DB::raw('count(*) as total'))->groupBy('status')->orderByDesc('total')->get();
        $categories = (clone $query)->select('incident_type', DB::raw('count(*) as total'))->groupBy('incident_type')->orderByDesc('total')->get();
        $monthly = (clone $query)->selectRaw("strftime('%Y-%m', created_at) as period, count(*) as total")->groupBy('period')->orderBy('period')->get();
        if (config('database.default') !== 'sqlite') {
            $monthly = (clone $query)->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as period, count(*) as total")->groupBy('period')->orderBy('period')->get();
        }
        return view('internal.analytics', compact('statuses', 'categories', 'monthly'));
    }

    public function reports(Request $request)
    {
        abort_unless($request->user()->hasRole('ketua_satgas', 'pimpinan'), 403);
        $reports = Report::query()->select(['id', 'ticket_number', 'incident_type', 'status', 'created_at', 'updated_at', 'requires_follow_up', 'referred_at', 'resolved_at'])->latest()->paginate(20);
        return view('internal.reports', compact('reports'));
    }

    public function assignments(Request $request)
    {
        abort_unless($request->user()->hasRole('ketua_satgas'), 403);
        $reports = Report::query()->select(['id', 'ticket_number', 'incident_type', 'status', 'created_at', 'assigned_user_id', 'referred_at', 'reporter_data'])->with('assignedUser:id,name,gender')->latest()->paginate(20);
        $psychologists = User::where('role', 'psikolog')->where('is_active', true)->orderBy('name')->get(['id', 'name']);
        $staff = User::where('role', 'tim_satgas')->where('is_active', true)->orderBy('name')->get(['id', 'name', 'gender']);
        return view('internal.assignments', compact('reports', 'psychologists', 'staff'));
    }

    public function unmasking()
    {
        $reports = Report::query()->select(['id', 'ticket_number', 'incident_type', 'status', 'created_at'])->latest()->paginate(20);
        return view('internal.unmasking-list', compact('reports'));
    }

    public function escalations()
    {
        $reports = Report::query()->where(function ($query) {
            $query->whereIn('status', ['ketidakhadiran_berlanjut', 'eskalasi_pimpinan'])->orWhere('requires_follow_up', true);
        })->select(['id', 'ticket_number', 'incident_type', 'status', 'created_at', 'requires_follow_up'])->latest()->paginate(20);
        return view('internal.escalations', compact('reports'));
    }

    public function summons()
    {
        $reports = Report::query()->select(['id', 'ticket_number', 'incident_type', 'status'])->latest()->get();
        $summons = CaseSummons::with('report:id,ticket_number')->latest()->paginate(25);
        return view('internal.summons', compact('reports', 'summons'));
    }

    public function storeSummons(Request $request, Report $report)
    {
        $data = $request->validate([
            'target_name' => ['required', 'string', 'max:160'],
            'target_role' => ['nullable', 'string', 'max:100'],
            'scheduled_at' => ['required', 'date', 'after:now'],
            'location' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);
        $previous = CaseSummons::where('report_id', $report->id)->orderByDesc('sequence')->first();
        abort_if($previous && $previous->status !== 'tidak_hadir', 422, 'Tandai ketidakhadiran pada surat sebelumnya sebelum membuat surat berikutnya.');
        $sequence = ((int) ($previous?->sequence ?? 0)) + 1;
        abort_if($sequence > 3, 422, 'Batas maksimal tiga surat pemanggilan telah tercapai.');
        CaseSummons::create($data + ['report_id' => $report->id, 'created_by' => $request->user()->id, 'sequence' => $sequence]);
        AuditLog::create(['user_id' => $request->user()->id, 'report_id' => $report->id, 'action' => 'summons_issued', 'reason' => 'Surat pemanggilan SP-'.$sequence.' diterbitkan.', 'ip_address' => $request->ip(), 'created_at' => now()]);
        return back()->with('success', 'Draft pemanggilan SP-'.$sequence.' tercatat. Cetak surat dan perbarui status pengirimannya di halaman Pemanggilan.');
    }

    public function updateSummons(Request $request, CaseSummons $summons)
    {
        $data = $request->validate(['status' => ['required', 'in:surat_disampaikan,menunggu_konfirmasi,hadir,tidak_hadir'], 'notes' => ['nullable', 'string', 'max:2000']]);
        $status = $data['status'];
        $allowedTransitions = [
            'surat_diterbitkan' => ['surat_disampaikan'],
            'surat_disampaikan' => ['menunggu_konfirmasi'],
            'menunggu_konfirmasi' => ['hadir', 'tidak_hadir'],
            'hadir' => [],
            'tidak_hadir' => [],
        ];
        abort_unless(in_array($status, $allowedTransitions[$summons->status] ?? [], true), 422, 'Perubahan status pemanggilan tidak sesuai urutan proses.');
        $summons->update(['status' => $status, 'delivered_at' => $status === 'surat_disampaikan' ? now() : $summons->delivered_at, 'notes' => $data['notes'] ?? $summons->notes]);
        AuditLog::create(['user_id' => $request->user()->id, 'report_id' => $summons->report_id, 'action' => 'summons_status_updated', 'reason' => 'Status SP-'.$summons->sequence.' diperbarui menjadi '.$status.'.', 'ip_address' => $request->ip(), 'created_at' => now()]);
        if ($status === 'tidak_hadir' && $summons->sequence === 3) {
            $report = $summons->report;
            $old = $report->status;
            $report->update(['status' => 'ketidakhadiran_berlanjut', 'requires_follow_up' => true]);
            ReportStatusHistory::create(['report_id' => $report->id, 'user_id' => $request->user()->id, 'from_status' => $old, 'to_status' => 'ketidakhadiran_berlanjut', 'note' => 'Terlapor tidak hadir setelah pemanggilan SP-3; perlu eskalasi kepada pimpinan.']);
            AuditLog::create(['user_id' => $request->user()->id, 'report_id' => $report->id, 'action' => 'summons_escalated_after_sp3', 'reason' => 'Ketidakhadiran setelah SP-3 ditandai untuk eskalasi pimpinan.', 'ip_address' => $request->ip(), 'created_at' => now()]);
        }
        return back()->with('success', 'Status pemanggilan diperbarui.');
    }

    public function printSummons(Request $request, CaseSummons $summons)
    {
        $summons->load('report:id,ticket_number');
        AuditLog::create(['user_id' => $request->user()->id, 'report_id' => $summons->report_id, 'action' => 'summons_draft_printed', 'reason' => 'Draft surat pemanggilan SP-'.$summons->sequence.' dicetak.', 'ip_address' => $request->ip(), 'created_at' => now()]);
        return view('internal.summons-print', compact('summons'));
    }

    public function history(Request $request)
    {
        abort_unless($request->user()->hasRole('pimpinan', 'ketua_satgas'), 403);
        $events = ReportStatusHistory::query()->join('reports', 'reports.id', '=', 'report_status_histories.report_id')
            ->leftJoin('users', 'users.id', '=', 'report_status_histories.user_id')
            ->select(['report_status_histories.created_at', 'report_status_histories.to_status', 'reports.ticket_number', 'users.name as actor'])
            ->latest('report_status_histories.created_at')->paginate(25);

        return view('internal.history', compact('events'));
    }

    public function audit(Request $request)
    {
        abort_unless($request->user()->hasRole('ketua_satgas'), 403);
        $logs = AuditLog::with('user:id,name')->latest('created_at')->paginate(30);

        return view('internal.audit', compact('logs'));
    }

    public function profile(Request $request)
    {
        return view('internal.profile', ['user' => $request->user()]);
    }

    public function showCase(Request $request, int $reportId)
    {
        $user = $request->user();
        $accessReport = Report::query()->select(['id', 'assigned_user_id'])->findOrFail($reportId);
        $this->authorize('view', $accessReport);

        if ($user->role === 'psikolog') {
            $report = Report::query()->select(['id', 'ticket_number', 'incident_type', 'status', 'created_at', 'referred_at'])->findOrFail($reportId);
            $sessions = CounselingSession::where('report_id', $reportId)->where('psychologist_id', $user->id)->orderByDesc('scheduled_at')->get();

            return view('internal.case-psychologist', compact('report', 'sessions'));
        }

        $this->authorize('view', Report::findOrFail($reportId));

        $report = Report::with(['evidence:id,report_id,original_name,mime_type,size,created_at', 'statusHistories.user:id,name'])->findOrFail($reportId);
        $reporter = $report->reporter_data;
        $maskedReporter = [
            'name' => $this->maskName($reporter['reporter_name'] ?? ''),
            'phone' => $this->maskPhone($reporter['reporter_phone'] ?? ''),
            'identity' => 'Dilindungi',
        ];

        return view('internal.case-detail', compact('report', 'maskedReporter'));
    }

    private function maskName(string $name): string
    {
        return collect(preg_split('/\s+/', trim($name)))->filter()->map(function ($part) {
            return mb_substr($part, 0, 1).str_repeat('*', max(3, mb_strlen($part) - 1));
        })->implode(' ');
    }

    private function maskPhone(string $phone): string
    {
        $digits = preg_replace('/\D+/', '', $phone);

        return $digits ? str_repeat('*', max(4, strlen($digits) - 2)).substr($digits, -2) : 'Dilindungi';
    }

    public function unmask(Request $request, Report $report)
    {
        $this->authorize('unmask', $report);
        $validator = Validator::make($request->all(), ['reason' => ['required', 'string', 'min:12', 'max:1000']]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $data = $validator->validated();
        AuditLog::create(['user_id' => $request->user()->id, 'report_id' => $report->id, 'action' => 'report_identity_unmasked', 'reason' => $data['reason'], 'ip_address' => $request->ip(), 'created_at' => now()]);

        return response()->view('internal.unmasked', ['report' => $report], 200, ['Cache-Control' => 'no-store, private']);
    }
}
