<?php

namespace App\Http\Controllers;

use App\Models\Evidence;
use App\Models\Report;
use App\Models\ReportStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PublicReportController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reporter_type' => ['required', 'in:korban,saksi_perantara'],
            'reporter_name' => ['required', 'string', 'max:160'],
            'reporter_identity' => ['required', 'string', 'max:160'],
            'reporter_phone' => ['required', 'string', 'max:50'],
            'reporter_email' => ['nullable', 'email', 'max:190'],
            'victim_name' => ['nullable', 'string', 'max:160'],
            'victim_contact' => ['nullable', 'string', 'max:100'],
            'victim_gender' => ['nullable', 'in:perempuan,laki_laki,tidak_menyebutkan'],
            'reported_name' => ['nullable', 'string', 'max:160'],
            'reported_status' => ['nullable', 'string', 'max:100'],
            'incident_type' => ['required', 'in:verbal,non_fisik,fisik,daring,lainnya'],
            'incident_date' => ['nullable', 'date', 'before_or_equal:today'],
            'incident_time' => ['nullable', 'string', 'max:20'],
            'incident_location' => ['required', 'string', 'max:1000'],
            'incident_story' => ['required', 'string', 'max:20000'],
            'expectation' => ['nullable', 'string', 'max:3000'],
            'privacy_consent' => ['accepted'],
            'evidence' => ['nullable', 'array', 'max:5'],
            'evidence.*' => ['file', 'max:10240', 'mimes:jpg,jpeg,png,pdf,mp3,mp4,webm,doc,docx'],
        ], [
            'reporter_type.required' => 'Pilih apakah kamu korban atau saksi/perantara.',
            'reporter_type.in' => 'Pilihan peran pelapor tidak valid. Pilih korban atau saksi/perantara.',
            'reporter_name.required' => 'Nama lengkap pelapor wajib diisi.',
            'reporter_identity.required' => 'NIM wajib diisi.',
            'reporter_phone.required' => 'Nomor WhatsApp aktif wajib diisi.',
            'incident_type.required' => 'Pilih bentuk kejadian.',
            'incident_location.required' => 'Lokasi kejadian wajib diisi.',
            'incident_story.required' => 'Kronologi kejadian wajib diisi.',
            'privacy_consent.accepted' => 'Centang persetujuan sebelum mengirim pengaduan.',
            'incident_date.before_or_equal' => 'Tanggal kejadian tidak boleh melewati hari ini.',
            'evidence.max' => 'Lampirkan maksimal lima file.',
            'evidence.*.max' => 'Ukuran setiap file maksimal 10 MB.',
            'evidence.*.mimes' => 'Format file yang didukung: JPG, PNG, PDF, MP3, MP4, WEBM, DOC, dan DOCX.',
        ], [
            'reporter_email' => 'email pelapor',
            'incident_date' => 'tanggal kejadian',
            'incident_time' => 'waktu kejadian',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $data = $validator->validated();

        $ticket = 'PPKS-'.now()->format('Y').'-'.Str::upper(Str::random(14));
        $report = DB::transaction(function () use ($data, $request, $ticket) {
            $report = Report::create([
                'ticket_number' => $ticket,
                'reporter_type' => $data['reporter_type'],
                'reporter_data' => array_intersect_key($data, array_flip(['reporter_name', 'reporter_identity', 'reporter_phone', 'reporter_email', 'victim_name', 'victim_contact', 'victim_gender', 'reported_name', 'reported_status'])),
                'incident_type' => $data['incident_type'],
                'incident_date' => $data['incident_date'] ?? null,
                'incident_time' => $data['incident_time'] ?? null,
                'incident_location' => $data['incident_location'] ?? null,
                'incident_story' => $data['incident_story'],
                'expectation' => $data['expectation'] ?? null,
                'status' => 'baru_diterima',
            ]);
            if ($request->hasFile('evidence')) {
                foreach ($request->file('evidence') as $file) {
                    $path = $file->store('reports/'.$report->id, 'local');
                    Evidence::create([
                        'report_id' => $report->id,
                        'disk' => 'local',
                        'path' => $path,
                        'original_name' => $file->getClientOriginalName(),
                        'mime_type' => $file->getMimeType() ?: 'application/octet-stream',
                        'size' => $file->getSize(),
                    ]);
                }
            }
            ReportStatusHistory::create(['report_id' => $report->id, 'to_status' => 'baru_diterima', 'note' => 'Pengaduan diterima.']);

            return $report;
        });

        session()->put('ticket_number', $report->ticket_number);

        return redirect()->route('report.confirmation');
    }

    public function confirmation()
    {
        abort_unless(session()->has('ticket_number'), 404);

        return view('pelapor.konfirmasi', ['ticketNumber' => session('ticket_number')]);
    }

    public function track(Request $request)
    {
        $ticket = $request->validate(['ticket' => ['required', 'string', 'max:40']])['ticket'];
        $report = Report::query()->select(['id', 'ticket_number', 'status', 'created_at', 'updated_at'])->where('ticket_number', strtoupper($ticket))->first();
        if (! $report) {
            return back()->withErrors(['ticket' => 'Nomor tiket tidak ditemukan.'])->withInput();
        }

        return view('pelapor.lacak', ['trackedReport' => $report]);
    }
}
