@extends('layouts.app')

@section('title', 'Beranda & Edukasi - Satgas PPKS FSH UINSA')

@section('content')
<!-- Hero / Banner Utama -->
<div class="bg-uin text-white py-5 mb-5 rounded-3 shadow-sm">
    <div class="container py-3">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3">Sistem Resmi PPKS</span>
                <h1 class="display-5 fw-bold mb-3">Ruang Aman & Layanan Pengaduan PPKS</h1>
                <p class="lead mb-4">Pencegahan dan Penanganan Kekerasan Seksual di lingkungan Fakultas Syariah dan Hukum UIN Sunan Ampel Surabaya. Kami menjamin kerahasiaan identitas dan perlindungan penuh bagi pelapor.</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ url('/lapor') }}" class="btn btn-warning btn-lg fw-bold text-dark px-4 shadow">
                        <i class="bi bi-pencil-square me-2"></i>Buat Laporan Pengaduan
                    </a>
                    <a href="#edukasi" class="btn btn-outline-light btn-lg px-4">
                        <i class="bi bi-book me-2"></i>Edukasi & SOP
                    </a>
                </div>
            </div>
            <div class="col-lg-4 text-center mt-4 mt-lg-0">
                <i class="bi bi-shield-check text-warning" style="font-size: 8rem;"></i>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Ringkasan Fitur Utama -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 p-3 text-center rounded-4">
                <div class="card-body">
                    <div class="bg-success-subtle text-success rounded-circle d-inline-flex p-3 mb-3">
                        <i class="bi bi-incognito fs-2"></i>
                    </div>
                    <h5 class="fw-bold">Privasi Identitas (Masking)</h5>
                    <p class="text-secondary small">Identitas Pelapor dan Korban secara otomatis dikamuflasekan oleh sistem demi menjamin keamanan dan kerahasiaan total.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 p-3 text-center rounded-4">
                <div class="card-body">
                    <div class="bg-primary-subtle text-primary rounded-circle d-inline-flex p-3 mb-3">
                        <i class="bi bi-file-earmark-medical fs-2"></i>
                    </div>
                    <h5 class="fw-bold">Rujukan Psikologis & Hukum</h5>
                    <p class="text-secondary small">Pendampingan penuh terhubung dengan layanan konseling psikologi kampus serta advokasi Lembaga Bantuan Hukum (LBH).</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 p-3 text-center rounded-4">
                <div class="card-body">
                    <div class="bg-warning-subtle text-warning rounded-circle d-inline-flex p-3 mb-3">
                        <i class="bi bi-activity fs-2"></i>
                    </div>
                    <h5 class="fw-bold">Pemantauan Status Real-Time</h5>
                    <p class="text-secondary small">Pelapor dapat mengecek progres verifikasi, investigasi, dan penanganan kasus secara berkala menggunakan nomor tiket pengaduan.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bagian Edukasi Bentuk Kekerasan Seksual -->
    <div id="edukasi" class="pt-4 mb-5">
        <div class="text-center mb-4">
            <h3 class="fw-bold text-uin">Katalog Bentuk Kekerasan Seksual</h3>
            <p class="text-muted">Kenali dan laporkan segala bentuk tindakan kekerasan seksual sesuai Permendikbudristek No. 30 Tahun 2021 & UU TPKS.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <span class="badge bg-danger mb-2">Verbal</span>
                        <h6 class="fw-bold">Pelecehan Lisan / Pesan</h6>
                        <p class="text-muted small">Menyampaikan siulan, komentar bernada seksual, lelucon tidak senonoh, atau pesan singkat berbau seksual tanpa persetujuan.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <span class="badge bg-warning text-dark mb-2">Non-Fisik</span>
                        <h6 class="fw-bold">Isyarat & Tatapan</h6>
                        <p class="text-muted small">Menatap dengan nuansa seksual, memperlihatkan alat kelamin, atau membuat gerakan isyarat tubuh yang membuat tidak nyaman.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <span class="badge bg-danger mb-2">Fisik</span>
                        <h6 class="fw-bold">Sentuhan Fisik Paksa</h6>
                        <p class="text-muted small">Memegang, menyentuh, merangkul, atau melakukan kontak fisik tanpa persetujuan yang melanggar batas integritas tubuh.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <span class="badge bg-info text-white mb-2">Daring / Cyber</span>
                        <h6 class="fw-bold">Kekerasan Berbasis Siber</h6>
                        <p class="text-muted small">Mengambil atau menyebarkan foto/video bernada seksual tanpa izin, atau melakukan intimidasi seksual di media sosial.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alur Penanganan Kasus -->
    <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm my-5">
        <h3 class="fw-bold text-uin mb-4 text-center">Alur Penanganan Pengaduan</h3>
        <div class="row text-center g-4">
            <div class="col-md-3">
                <div class="p-3">
                    <div class="badge bg-uin rounded-circle mb-3 fs-5" style="width: 45px; height: 45px; line-height: 33px;">1</div>
                    <h6 class="fw-bold">Pengisian Pengaduan</h6>
                    <p class="small text-muted">Pelapor mengisi formulir kronologi dan mengunggah bukti pendukung.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3">
                    <div class="badge bg-uin rounded-circle mb-3 fs-5" style="width: 45px; height: 45px; line-height: 33px;">2</div>
                    <h6 class="fw-bold">Verifikasi Satgas</h6>
                    <p class="small text-muted">Tim Satgas memeriksa kelayakan laporan dan menjadwalkan pemeriksaan.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3">
                    <div class="badge bg-uin rounded-circle mb-3 fs-5" style="width: 45px; height: 45px; line-height: 33px;">3</div>
                    <h6 class="fw-bold">Rujukan & Investigasi</h6>
                    <p class="small text-muted">Pemberian pendampingan psikologis/hukum dan penggalian bukti saksi.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3">
                    <div class="badge bg-uin rounded-circle mb-3 fs-5" style="width: 45px; height: 45px; line-height: 33px;">4</div>
                    <h6 class="fw-bold">Rekomendasi Pimpinan</h6>
                    <p class="small text-muted">Penyusunan laporan hasil pemeriksaan untuk tindak lanjut sanksi oleh Dekan/Pimpinan.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection