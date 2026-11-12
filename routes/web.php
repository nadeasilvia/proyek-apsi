<?php

use App\Http\Controllers\CounselingSessionController;
use App\Http\Controllers\InternalAuthController;
use App\Http\Controllers\InternalDashboardController;
use App\Http\Controllers\PublicReportController;
use App\Http\Controllers\StaffManagementController;
use App\Models\AuditLog;
use App\Models\CaseAssignment;
use App\Models\Evidence;
use App\Models\Report;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

// 1. Halaman Utamanya (memanggil file views/dashboard.blade.php yang ada di luar)
Route::get('/', function () {
    return view('dashboard');
});

// 2. Sub-Sistem Pengaduan (memanggil views/pelapor/buat_laporan.blade.php)
Route::get('/lapor', function () {
    return view('pelapor.buat_laporan');
});

// Legacy prototype pages remain available only to signed-in operational staff.
Route::get('/rujukan', function () {
    return redirect()->route('internal.dashboard');
})->middleware(['auth', 'role:tim_satgas,ketua_satgas']);
Route::get('/satgas/verifikasi', function () {
    return redirect()->route('internal.dashboard');
})->middleware(['auth', 'role:tim_satgas,ketua_satgas']);

Route::get('/pengaduan/konfirmasi', [PublicReportController::class, 'confirmation'])->name('report.confirmation');
Route::post('/pengaduan', [PublicReportController::class, 'store'])->middleware('throttle:5,1')->name('report.store');
Route::post('/lacak', [PublicReportController::class, 'track'])->middleware('throttle:10,1')->name('report.track');

Route::prefix('internal')->name('internal.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [InternalAuthController::class, 'create'])->name('login');
        Route::post('/login', [InternalAuthController::class, 'store'])->middleware('throttle:5,1')->name('login.store');
    });
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [InternalAuthController::class, 'destroy'])->name('logout');
        Route::get('/petugas', [StaffManagementController::class, 'index'])->middleware('role:ketua_satgas')->name('staff');
        Route::post('/petugas', [StaffManagementController::class, 'store'])->middleware('role:ketua_satgas')->name('staff.store');
        Route::patch('/petugas/{managedUser}', [StaffManagementController::class, 'update'])->middleware('role:ketua_satgas')->name('staff.update');
        Route::get('/jadwal-pendampingan', [CounselingSessionController::class, 'index'])->middleware('role:psikolog')->name('sessions');
        Route::post('/pengaduan/{reportId}/sesi', [CounselingSessionController::class, 'store'])->middleware('role:psikolog')->whereNumber('reportId')->name('sessions.store');
        Route::put('/sesi/{sessionId}', [CounselingSessionController::class, 'update'])->middleware('role:psikolog')->whereNumber('sessionId')->name('sessions.update');
        Route::get('/profil', [InternalDashboardController::class, 'profile'])->middleware('role:tim_satgas,ketua_satgas,psikolog,pimpinan')->name('profile');
        Route::get('/', [InternalDashboardController::class, 'index'])->middleware('role:tim_satgas,ketua_satgas,psikolog,pimpinan')->name('dashboard');
        Route::get('/monitoring', [InternalDashboardController::class, 'monitoring'])->middleware('role:ketua_satgas,pimpinan')->name('monitoring');
        Route::get('/statistik', [InternalDashboardController::class, 'analytics'])->middleware('role:ketua_satgas,pimpinan')->name('analytics');
        Route::get('/laporan', [InternalDashboardController::class, 'reports'])->middleware('role:ketua_satgas,pimpinan')->name('reports');
        Route::get('/penugasan-rujukan', [InternalDashboardController::class, 'assignments'])->middleware('role:ketua_satgas')->name('assignments');
        Route::get('/unmasking', [InternalDashboardController::class, 'unmasking'])->middleware('role:ketua_satgas')->name('unmasking');
        Route::get('/pemanggilan', [InternalDashboardController::class, 'summons'])->middleware('role:ketua_satgas')->name('summons');
        Route::get('/eskalasi', [InternalDashboardController::class, 'escalations'])->middleware('role:ketua_satgas,pimpinan')->name('escalations');
        Route::post('/pengaduan/{report}/pemanggilan', [InternalDashboardController::class, 'storeSummons'])->middleware('role:ketua_satgas')->name('summons.store');
        Route::patch('/pemanggilan/{summons}/status', [InternalDashboardController::class, 'updateSummons'])->middleware('role:ketua_satgas')->name('summons.update');
        Route::get('/pemanggilan/{summons}/cetak', [InternalDashboardController::class, 'printSummons'])->middleware('role:ketua_satgas')->name('summons.print');
        Route::get('/riwayat-monitoring', [InternalDashboardController::class, 'history'])->middleware('role:ketua_satgas,pimpinan')->name('history');
        Route::get('/audit-log', [InternalDashboardController::class, 'audit'])->middleware('role:ketua_satgas')->name('audit');
        Route::get('/laporan/ekspor', [InternalDashboardController::class, 'export'])->middleware('role:ketua_satgas,pimpinan')->name('export');
        Route::patch('/pengaduan/{report}/status', [InternalDashboardController::class, 'updateStatus'])->middleware('role:tim_satgas,ketua_satgas')->name('status.update');
        Route::post('/pengaduan/{report}/rujuk-psikolog', [InternalDashboardController::class, 'assignPsychologist'])->middleware('role:ketua_satgas')->name('referral.assign');
        Route::post('/pengaduan/{report}/petugas', [InternalDashboardController::class, 'assignStaff'])->middleware('role:ketua_satgas')->name('staff.assign-case');
        Route::post('/pengaduan/{report}/unmask', [InternalDashboardController::class, 'unmask'])->middleware('role:ketua_satgas')->name('unmask');
        Route::get('/pengaduan/{reportId}', [InternalDashboardController::class, 'showCase'])->middleware('role:tim_satgas,ketua_satgas,psikolog')->whereNumber('reportId')->name('case.show');
        Route::get('/bukti/{evidence}', function (Evidence $evidence) {
            $user = request()->user();
            abort_unless($user->hasRole('tim_satgas', 'ketua_satgas', 'psikolog'), 403);
            if ($user->role === 'tim_satgas') {
                $assignedUser = Report::whereKey($evidence->report_id)->value('assigned_user_id');
                abort_unless($assignedUser === null || $assignedUser === $user->id, 403);
            }
            if ($user->role === 'psikolog') {
                abort_unless(CaseAssignment::where('report_id', $evidence->report_id)->where('user_id', $user->id)->where('kind', 'psikolog')->exists(), 403);
            }
            abort_unless(Storage::disk($evidence->disk)->exists($evidence->path), 404);
            AuditLog::create([
                'user_id' => $user->id,
                'report_id' => $evidence->report_id,
                'action' => 'evidence_downloaded',
                'ip_address' => request()->ip(),
                'created_at' => now(),
            ]);

            return Storage::disk($evidence->disk)->download($evidence->path, basename($evidence->original_name));
        })->name('evidence.download');
    });
});

Route::get('/konfirmasi-pengaduan', function () {
    return redirect()->route('report.confirmation');
});

Route::get('/layanan', function () {
    return view('pelapor.layanan');
});

Route::get('/lacak', function () {
    return view('pelapor.lacak', ['trackedReport' => null]);
});

Route::get('/informasi-edukasi', function () {
    return view('pelapor.informasi_edukasi');
});

Route::get('/informasi-edukasi/kekerasan-fisik', function () {
    return view('pelapor.edukasi.kekerasan_fisik');
});

Route::get('/informasi-edukasi/kekerasan-verbal-nonfisik', function () {
    return view('pelapor.edukasi.kekerasan_verbal_nonfisik');
});

Route::get('/informasi-edukasi/perundungan', function () {
    return view('pelapor.edukasi.perundungan');
});

Route::get('/informasi-edukasi/kekerasan-elektronik', function () {
    return view('pelapor.edukasi.kekerasan_elektronik');
});

Route::get('/informasi-edukasi/pemerasan', function () {
    return view('pelapor.edukasi.pemerasan');
});
