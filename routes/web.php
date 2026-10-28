<?php

use Illuminate\Support\Facades\Route;

// 1. Halaman Utamanya (memanggil file views/dashboard.blade.php yang ada di luar)
Route::get('/', function () {
    return view('dashboard');
});

// 2. Sub-Sistem Pengaduan (memanggil views/pelapor/buat_laporan.blade.php)
Route::get('/lapor', function () {
    return view('pelapor.buat_laporan');
});

// 3. Sub-Sistem Rujukan (memanggil views/rujukan/index.blade.php)
Route::get('/rujukan', function () {
    return view('rujukan.index');
});

// 4. Sub-Sistem Verifikasi Satgas (memanggil views/satgas/verifikasi.blade.php)
Route::get('/satgas/verifikasi', function () {
    return view('satgas.verifikasi');
});