<?php

namespace Tests\Feature;

use App\Models\AuditLog;
use App\Models\CaseAssignment;
use App\Models\CounselingSession;
use App\Models\Evidence;
use App\Models\Report;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InternalRoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_internal_dashboard_requires_authentication(): void
    {
        $this->get('/internal')->assertRedirect('/internal/login');
    }

    public function test_pimpinan_can_open_managers_dashboard_but_not_operational_endpoints(): void
    {
        $pimpinan = User::factory()->create(['role' => 'pimpinan', 'is_active' => true]);
        $this->actingAs($pimpinan)->get('/internal')->assertOk()->assertSee('Dashboard Pimpinan');
        $report = $this->makeReport();
        $this->actingAs($pimpinan)->patch("/internal/pengaduan/{$report->id}/status", ['status' => 'selesai'])->assertForbidden();
        $this->actingAs($pimpinan)->post("/internal/pengaduan/{$report->id}/unmask", ['reason' => 'Keperluan audit administratif'])->assertForbidden();
        $evidence = Evidence::create(['report_id' => $report->id, 'disk' => 'local', 'path' => 'not-present', 'original_name' => 'bukti.pdf', 'mime_type' => 'application/pdf', 'size' => 10]);
        $this->actingAs($pimpinan)->get("/internal/bukti/{$evidence->id}")->assertForbidden();
        $this->actingAs($pimpinan)->get("/internal/pengaduan/{$report->id}")->assertForbidden();
        $this->actingAs($pimpinan)->get('/internal/audit-log')->assertForbidden();
        $this->actingAs($pimpinan)->get('/internal/jadwal-pendampingan')->assertForbidden();
        $this->actingAs($pimpinan)->get('/internal/profil')->assertOk();
    }

    public function test_pimpinan_monitoring_shows_sanitized_report_metadata_only(): void
    {
        $pimpinan = User::factory()->create(['role' => 'pimpinan', 'is_active' => true]);
        Report::create([
            'ticket_number' => 'PPKS-2026-TEST0001', 'reporter_type' => 'mahasiswa',
            'reporter_data' => ['reporter_name' => 'Nama Rahasia'], 'incident_type' => 'Fisik',
            'incident_story' => 'Kronologi rahasia yang tidak boleh tampil', 'status' => 'dalam_penanganan',
        ]);
        $this->actingAs($pimpinan)->get('/internal/monitoring')->assertOk()
            ->assertSee('PPKS-2026-TEST0001')->assertDontSee('Nama Rahasia')->assertDontSee('Kronologi rahasia');
        $response = $this->actingAs($pimpinan)->get('/internal/laporan/ekspor')->assertOk();
        $csv = $response->streamedContent();
        $this->assertStringContainsString('PPKS-2026-TEST0001', $csv);
        $this->assertStringNotContainsString('Nama Rahasia', $csv);
        $this->assertStringNotContainsString('Kronologi rahasia', $csv);
    }

    public function test_staff_cannot_open_chair_or_psychologist_only_features(): void
    {
        $staff = User::factory()->create(['role' => 'tim_satgas', 'is_active' => true]);
        $this->actingAs($staff)->get('/internal/monitoring')->assertForbidden();
        $report = $this->makeReport();
        $this->actingAs($staff)->post("/internal/pengaduan/{$report->id}/unmask", ['reason' => 'Testing unauthorized access'])->assertForbidden();
    }

    public function test_psychologist_sees_only_assigned_cases(): void
    {
        $psychologist = User::factory()->create(['role' => 'psikolog', 'is_active' => true]);
        $assigned = $this->makeReport();
        $unassigned = $this->makeReport();
        CaseAssignment::create(['report_id' => $assigned->id, 'user_id' => $psychologist->id, 'kind' => 'psikolog']);

        $this->actingAs($psychologist)->get('/internal')->assertOk()
            ->assertSee($assigned->ticket_number)->assertDontSee($unassigned->ticket_number);
        $this->actingAs($psychologist)->get("/internal/pengaduan/{$assigned->id}")->assertOk()
            ->assertSee($assigned->ticket_number)->assertDontSee('Cerita rahasia');
        $this->actingAs($psychologist)->get("/internal/pengaduan/{$unassigned->id}")->assertForbidden();
    }

    public function test_staff_case_detail_masks_reporter_identity(): void
    {
        $staff = User::factory()->create(['role' => 'tim_satgas', 'is_active' => true]);
        $report = Report::create([
            'ticket_number' => 'PPKS-2026-MASK0001', 'reporter_type' => 'korban',
            'reporter_data' => ['reporter_name' => 'Nama Pelapor', 'reporter_phone' => '081234567890'],
            'incident_type' => 'fisik', 'incident_story' => 'Kronologi yang berwenang dilihat petugas.',
            'status' => 'baru_diterima',
        ]);

        $this->actingAs($staff)->get("/internal/pengaduan/{$report->id}")->assertOk()
            ->assertSee('N***')->assertDontSee('Nama Pelapor')->assertDontSee('081234567890');
    }

    public function test_only_chair_unmasks_and_reason_is_audited_encrypted(): void
    {
        $chair = User::factory()->create(['role' => 'ketua_satgas', 'is_active' => true]);
        $report = Report::create([
            'ticket_number' => 'PPKS-2026-UNMASK01', 'reporter_type' => 'korban',
            'reporter_data' => ['reporter_name' => 'Pelapor Terlindungi'], 'incident_type' => 'fisik',
            'incident_story' => 'Kronologi terbatas.', 'status' => 'dalam_penanganan',
        ]);

        $response = $this->actingAs($chair)->post("/internal/pengaduan/{$report->id}/unmask", ['reason' => 'Diperlukan untuk koordinasi pendampingan']);
        $response->assertOk()->assertSee('Pelapor Terlindungi');
        $log = AuditLog::where('action', 'report_identity_unmasked')->firstOrFail();
        $this->assertSame('Diperlukan untuk koordinasi pendampingan', $log->reason);
        $this->assertStringNotContainsString('Diperlukan untuk koordinasi pendampingan', $log->getRawOriginal('reason'));
    }

    public function test_counseling_notes_are_encrypted_and_psychologist_only(): void
    {
        $psychologist = User::factory()->create(['role' => 'psikolog', 'is_active' => true]);
        $report = $this->makeReport();
        CaseAssignment::create(['report_id' => $report->id, 'user_id' => $psychologist->id, 'kind' => 'psikolog']);

        $this->actingAs($psychologist)->post("/internal/pengaduan/{$report->id}/sesi", [
            'scheduled_at' => now()->addDay()->format('Y-m-d H:i:s'),
            'session_type' => 'konseling',
            'status' => 'terlaksana',
            'private_note' => 'Catatan konseling sangat sensitif',
            'follow_up' => 'Perlu sesi lanjutan',
        ])->assertRedirect();

        $session = CounselingSession::firstOrFail();
        $this->assertStringNotContainsString('Catatan konseling sangat sensitif', $session->getRawOriginal('private_note'));
        $this->actingAs($psychologist)->get("/internal/pengaduan/{$report->id}")->assertSee('Catatan konseling sangat sensitif');
        $staff = User::factory()->create(['role' => 'tim_satgas', 'is_active' => true]);
        $this->actingAs($staff)->get('/internal/jadwal-pendampingan')->assertForbidden();
    }

    public function test_pimpinan_account_can_authenticate(): void
    {
        $user = User::factory()->create(['role' => 'pimpinan', 'is_active' => true]);
        $this->post('/internal/login', ['email' => $user->email, 'password' => 'password'])
            ->assertRedirect('/internal');
        $this->assertAuthenticatedAs($user);
    }

    public function test_chair_can_create_separate_pimpinan_account_but_pimpinan_cannot_manage_staff(): void
    {
        $chair = User::factory()->create(['role' => 'ketua_satgas', 'is_active' => true]);
        $this->actingAs($chair)->post('/internal/petugas', [
            'name' => 'Pengawas Fakultas',
            'email' => 'pimpinan-fsh@example.test',
            'role' => 'pimpinan',
            'password' => 'StrongPassword-2026!',
            'password_confirmation' => 'StrongPassword-2026!',
        ])->assertRedirect();
        $this->assertDatabaseHas('users', ['email' => 'pimpinan-fsh@example.test', 'role' => 'pimpinan']);

        $pimpinan = User::where('email', 'pimpinan-fsh@example.test')->firstOrFail();
        $this->actingAs($pimpinan)->get('/internal/petugas')->assertForbidden();
    }

    public function test_public_report_submission_encrypts_identity_and_can_be_tracked(): void
    {
        $this->get('/lacak')->assertOk()->assertSee('Lacak Pengaduan');

        $response = $this->post('/pengaduan', [
            'reporter_type' => 'korban',
            'reporter_name' => 'Pelapor Sangat Rahasia',
            'reporter_identity' => 'NIM-RAHASIA-123',
            'reporter_phone' => '081234567890',
            'incident_type' => 'fisik',
            'incident_location' => 'Ruang yang dirahasiakan',
            'incident_story' => 'Kronologi yang hanya boleh dibuka sesuai kewenangan.',
            'privacy_consent' => '1',
        ]);

        $response->assertRedirect(route('report.confirmation'));
        $report = Report::firstOrFail();
        $this->assertStringNotContainsString('Pelapor Sangat Rahasia', $report->getRawOriginal('reporter_data'));
        $this->assertSame('Pelapor Sangat Rahasia', $report->reporter_data['reporter_name']);
        $this->get(route('report.confirmation'))->assertOk()->assertSee($report->ticket_number);

        $this->post('/lacak', ['ticket' => $report->ticket_number])
            ->assertOk()->assertSee($report->ticket_number);
    }

    public function test_invalid_report_data_is_not_flashed_into_the_session(): void
    {
        $response = $this->followingRedirects()->from('/lapor')->post('/pengaduan', [
            'reporter_type' => 'invalid',
            'reporter_name' => 'Data Identitas Tidak Boleh Disimpan Di Session',
            'reporter_identity' => 'NIM-SENSITIVE',
        ]);

        $response->assertOk()->assertSee('Pengaduan belum terkirim')
            ->assertSee('Pilihan peran pelapor tidak valid. Pilih korban atau saksi/perantara.');
        $response->assertSessionMissing('_old_input.reporter_name');
        $response->assertSessionMissing('_old_input.reporter_identity');
    }

    private function makeReport(): Report
    {
        return Report::create([
            'ticket_number' => 'PPKS-'.uniqid(), 'reporter_type' => 'mahasiswa',
            'reporter_data' => ['reporter_name' => 'Rahasia'], 'incident_type' => 'Fisik',
            'incident_story' => 'Cerita rahasia', 'status' => 'baru_diterima',
        ]);
    }
}
