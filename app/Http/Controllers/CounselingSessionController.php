<?php

namespace App\Http\Controllers;

use App\Models\CaseAssignment;
use App\Models\CounselingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CounselingSessionController extends Controller
{
    public function index(Request $request)
    {
        $sessions = CounselingSession::where('psychologist_id', $request->user()->id)
            ->with('report:id,ticket_number,incident_type,status')->orderBy('scheduled_at')->paginate(20);

        return view('internal.sessions', compact('sessions'));
    }

    public function store(Request $request, int $reportId)
    {
        $psychologist = $request->user();
        abort_unless($psychologist->hasRole('psikolog'), 403);
        abort_unless(CaseAssignment::where('report_id', $reportId)->where('user_id', $psychologist->id)->where('kind', 'psikolog')->exists(), 403);
        $validator = Validator::make($request->all(), [
            'scheduled_at' => ['required', 'date'],
            'session_type' => ['required', 'in:konsultasi_awal,konseling,tindak_lanjut'],
            'status' => ['required', 'in:dijadwalkan,terlaksana,jadwal_ulang'],
            'private_note' => ['nullable', 'string', 'max:10000'],
            'follow_up' => ['nullable', 'string', 'max:3000'],
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $data = $validator->validated();
        $data['report_id'] = $reportId;
        $data['psychologist_id'] = $psychologist->id;
        DB::transaction(fn () => CounselingSession::create($data));

        return back()->with('success', 'Sesi pendampingan tersimpan secara privat.');
    }

    public function update(Request $request, int $sessionId)
    {
        $session = CounselingSession::where('psychologist_id', $request->user()->id)->findOrFail($sessionId);
        abort_unless(CaseAssignment::where('report_id', $session->report_id)->where('user_id', $request->user()->id)->where('kind', 'psikolog')->exists(), 403);
        $validator = Validator::make($request->all(), [
            'scheduled_at' => ['required', 'date'],
            'session_type' => ['required', 'in:konsultasi_awal,konseling,tindak_lanjut'],
            'status' => ['required', 'in:dijadwalkan,terlaksana,jadwal_ulang'],
            'private_note' => ['nullable', 'string', 'max:10000'],
            'follow_up' => ['nullable', 'string', 'max:3000'],
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $data = $validator->validated();
        $session->update($data);

        return back()->with('success', 'Sesi pendampingan diperbarui.');
    }
}
