
@extends('layouts.app')

@section('title', 'Kekerasan Fisik - Edukasi PPKS FSH UINSA')

@section('content')

<style>
    .physical-detail-page {
        --pd-ink: #344b50;
        --pd-muted: #71838a;
        --pd-teal: #416c72;
        --pd-blue: #dce8f4;
        --pd-sage: #dce9e2;
        --pd-lavender: #e9e2f2;
        --pd-cream: #f5efe8;

        color: var(--pd-ink);
        padding-bottom: 75px;
    }

    .physical-detail-page .container {
        max-width: 1100px;
    }

    .pd-breadcrumb {
        padding: 28px 0 20px;
        font-size: 13px;
        color: var(--pd-muted);
    }

    .pd-breadcrumb a {
        color: var(--pd-teal);
        text-decoration: none;
    }

    .pd-breadcrumb a:hover {
        text-decoration: underline;
    }

    .pd-hero {
        position: relative;
        overflow: hidden;
        padding: 55px;
        border-radius: 28px;
        background: linear-gradient(
            125deg,
            #dce8f4 0%,
            #e9e2f2 55%,
            #dce9e2 100%
        );
        margin-bottom: 45px;
    }

    .pd-hero::after {
        content: '';
        position: absolute;
        width: 250px;
        height: 250px;
        right: -65px;
        top: -90px;
        border-radius: 50%;
        background: rgba(255,255,255,.25);
    }

    .pd-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 15px;
        border-radius: 30px;
        background: rgba(255,255,255,.65);
        color: var(--pd-teal);
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .pd-hero h1 {
        max-width: 650px;
        font-size: clamp(30px, 4vw, 43px);
        font-weight: 750;
        line-height: 1.2;
        margin-bottom: 18px;
    }

    .pd-hero p {
        max-width: 670px;
        color: #5d7177;
        line-height: 1.8;
        margin-bottom: 0;
        font-size: 15px;
    }

    .pd-section {
        margin-bottom: 42px;
    }

    .pd-section-heading {
        margin-bottom: 20px;
    }

    .pd-section-heading h2 {
        font-size: 24px;
        font-weight: 750;
        margin-bottom: 9px;
    }

    .pd-section-heading p {
        color: var(--pd-muted);
        font-size: 14px;
        line-height: 1.7;
        margin-bottom: 0;
    }

    .pd-content-card {
        height: 100%;
        padding: 27px;
        border: 1px solid #e8eeee;
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 8px 25px rgba(52,75,80,.045);
    }

    .pd-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 15px;
        background: var(--pd-blue);
        color: var(--pd-teal);
        font-size: 22px;
        margin-bottom: 17px;
    }

    .pd-content-card h3 {
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 11px;
    }

    .pd-content-card p,
    .pd-content-card li {
        font-size: 14px;
        color: #71838a;
        line-height: 1.8;
    }

    .pd-content-card ul {
        padding-left: 19px;
        margin-bottom: 0;
    }

    .pd-example {
        display: flex;
        gap: 15px;
        align-items: flex-start;
        padding: 17px 0;
        border-bottom: 1px solid #edf0f0;
    }

    .pd-example:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .pd-example i {
        color: var(--pd-teal);
        font-size: 18px;
        margin-top: 2px;
    }

    .pd-example p {
        margin: 0;
        font-size: 14px;
        line-height: 1.75;
    }

    .pd-note {
        padding: 24px;
        border-radius: 18px;
        background: #f3f6f8;
        border-left: 4px solid var(--pd-teal);
    }

    .pd-note h3 {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 9px;
    }

    .pd-note p {
        color: var(--pd-muted);
        font-size: 14px;
        line-height: 1.8;
        margin-bottom: 0;
    }

    .pd-help-box {
        padding: 32px;
        border-radius: 22px;
        background: linear-gradient(120deg, #dce9e2, #e9e2f2);
        margin-top: 45px;
    }

    .pd-help-box h2 {
        font-size: 23px;
        font-weight: 750;
        margin-bottom: 12px;
    }

    .pd-help-box p {
        color: #62777b;
        font-size: 14px;
        line-height: 1.8;
        max-width: 700px;
    }

    .pd-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        padding: 12px 20px;
        border-radius: 12px;
        background: var(--pd-teal);
        color: #fff;
        text-decoration: none;
        font-size: 14px;
        font-weight: 650;
        transition: .2s;
    }

    .pd-btn:hover {
        background: #31565c;
        color: #fff;
        transform: translateY(-2px);
    }

    .pd-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--pd-teal);
        font-size: 14px;
        font-weight: 650;
        text-decoration: none;
        margin-top: 30px;
    }

    .pd-back:hover {
        color: #31565c;
    }

    @media (max-width: 768px) {
        .pd-hero {
            padding: 32px 25px;
        }

        .pd-content-card {
            padding: 22px;
        }

        .pd-help-box {
            padding: 25px;
        }
    }
</style>

<div class="physical-detail-page">
    <div class="container">

        {{-- Breadcrumb --}}
        <div class="pd-breadcrumb">
            <a href="{{ url('/') }}">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ url('/informasi-edukasi') }}">Edukasi & SOP</a>
            <span class="mx-2">/</span>
            <span>Kekerasan Fisik</span>
        </div>

        {{-- Hero --}}
        <section class="pd-hero">
            <div class="pd-label">
                <i class="bi bi-book"></i>
                MATERI EDUKASI
            </div>

            <h1>Mengenal Kekerasan Fisik</h1>

            <p>
                Memahami bentuk-bentuk kekerasan fisik merupakan langkah
                awal untuk mengenali tindakan yang tidak dapat dibenarkan,
                membangun lingkungan kampus yang aman, serta mengetahui
                hak untuk memperoleh perlindungan dan bantuan.
            </p>
        </section>

        {{-- Pengertian --}}
        <section class="pd-section">
            <div class="pd-section-heading">
                <h2>Apa yang Dimaksud dengan Kekerasan Fisik?</h2>
                <p>Memahami pengertian dan karakteristiknya.</p>
            </div>

            <div class="pd-content-card">
                <p>
                    Kekerasan fisik adalah tindakan yang menggunakan
                    kekuatan fisik terhadap tubuh seseorang dan dapat
                    menyebabkan rasa sakit, penderitaan, atau cedera.
                </p>

                <p class="mb-0">
                    Dalam lingkungan perguruan tinggi, tindakan ini dapat
                    terjadi dalam interaksi antar mahasiswa maupun dalam
                    hubungan antara mahasiswa dengan warga kampus lainnya.
                    Setiap kejadian perlu dipahami berdasarkan konteks,
                    dampak, dan ketentuan yang berlaku.
                </p>
            </div>
        </section>

        {{-- Bentuk tindakan --}}
        <section class="pd-section">
            <div class="pd-section-heading">
                <h2>Bentuk-Bentuk Kekerasan Fisik</h2>
                <p>
                    Berikut beberapa contoh tindakan yang dapat termasuk
                    dalam kekerasan fisik.
                </p>
            </div>

            <div class="row g-3">

                <div class="col-md-6">
                    <div class="pd-content-card">
                        <div class="pd-icon">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <h3>Penggunaan Kekuatan Fisik</h3>
                        <p>
                            Tindakan seperti memukul, menampar, menendang,
                            atau mendorong seseorang dengan sengaja.
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="pd-content-card">
                        <div class="pd-icon">
                            <i class="bi bi-hand-index-thumb"></i>
                        </div>
                        <h3>Tindakan Fisik yang Menyakiti</h3>
                        <p>
                            Tindakan mencubit, menarik, atau melakukan
                            kontak fisik secara paksa yang menyebabkan
                            rasa sakit atau ketidaknyamanan.
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="pd-content-card">
                        <div class="pd-icon">
                            <i class="bi bi-shield-exclamation"></i>
                        </div>
                        <h3>Pemaksaan Melalui Kontak Fisik</h3>
                        <p>
                            Menggunakan kekuatan fisik untuk memaksa
                            seseorang melakukan sesuatu yang tidak
                            dikehendakinya.
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="pd-content-card">
                        <div class="pd-icon">
                            <i class="bi bi-exclamation-circle"></i>
                        </div>
                        <h3>Tindakan Fisik dalam Perundungan</h3>
                        <p>
                            Melakukan tindakan fisik untuk merendahkan,
                            mengintimidasi, atau menyakiti seseorang
                            secara berulang.
                        </p>
                    </div>
                </div>

            </div>
        </section>

        {{-- Contoh lingkungan kampus --}}
        <section class="pd-section">
            <div class="pd-section-heading">
                <h2>Contoh Situasi di Lingkungan Kampus</h2>
                <p>
                    Beberapa ilustrasi sederhana untuk membantu mengenali
                    tindakan kekerasan fisik.
                </p>
            </div>

            <div class="pd-content-card">

                <div class="pd-example">
                    <i class="bi bi-check-circle-fill"></i>
                    <p>
                        Seorang mahasiswa sengaja mendorong mahasiswa lain
                        ketika terjadi perbedaan pendapat.
                    </p>
                </div>

                <div class="pd-example">
                    <i class="bi bi-check-circle-fill"></i>
                    <p>
                        Seorang mahasiswa menggunakan kekuatan fisik untuk
                        memaksa temannya mengikuti suatu kegiatan.
                    </p>
                </div>

                <div class="pd-example">
                    <i class="bi bi-check-circle-fill"></i>
                    <p>
                        Sekelompok mahasiswa melakukan tindakan fisik
                        terhadap mahasiswa lain sebagai bagian dari
                        perundungan.
                    </p>
                </div>

            </div>
        </section>

        {{-- Hal penting --}}
        <section class="pd-section">
            <div class="pd-section-heading">
                <h2>Hal yang Perlu Dipahami</h2>
            </div>

            <div class="pd-note">
                <h3>
                    <i class="bi bi-info-circle me-2"></i>
                    Tidak semua bentuk kekerasan memiliki klasifikasi hukum yang sama
                </h3>

                <p>
                    Kekerasan fisik secara umum perlu dibedakan dari
                    pelecehan seksual fisik. Apabila suatu tindakan
                    mengandung unsur seksual, penanganan dan dasar
                    hukumnya dapat berbeda. Penentuan klasifikasi hukum
                    harus dilakukan berdasarkan fakta dan ketentuan
                    peraturan yang berlaku, bukan hanya berdasarkan
                    nama kategorinya.
                </p>
            </div>
        </section>

        {{-- Hak dan bantuan --}}
        <section class="pd-section">
            <div class="pd-section-heading">
                <h2>Jika Mengalami atau Mengetahui Kejadian Kekerasan</h2>
                <p>
                    Setiap orang berhak memperoleh lingkungan kampus
                    yang aman dan mendapatkan bantuan.
                </p>
            </div>

            <div class="pd-content-card">
                <ul>
                    <li>
                        Utamakan keselamatan diri dan cari tempat yang aman.
                    </li>
                    <li>
                        Ceritakan kejadian kepada pihak yang dipercaya
                        atau petugas layanan yang berwenang.
                    </li>
                    <li>
                        Hubungi Satgas PPKS untuk memperoleh informasi
                        mengenai layanan pengaduan dan pendampingan.
                    </li>
                    <li>
                        Simpan informasi atau bukti yang tersedia jika
                        aman untuk dilakukan.
                    </li>
                    <li>
                        Hindari menyebarkan identitas dan informasi pribadi
                        pihak yang terlibat kepada publik.
                    </li>
                </ul>
            </div>
        </section>

        {{-- Dasar hukum --}}
        <section class="pd-section">
            <div class="pd-section-heading">
                <h2>Landasan Hukum Terkait</h2>
                <p>
                    Beberapa peraturan yang dapat menjadi rujukan.
                    Penerapannya bergantung pada karakteristik kejadian.
                </p>
            </div>

            <div class="pd-content-card">
                <h3>Undang-Undang Nomor 1 Tahun 2023</h3>
                <p>
                    Kitab Undang-Undang Hukum Pidana (KUHP), yang mulai
                    berlaku pada 2 Januari 2026, menjadi salah satu
                    rujukan dalam pengaturan tindak pidana terhadap tubuh.
                </p>
                <a href="https://peraturan.bpk.go.id/Details/234935/uu-no-1-tahun-2023"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="pd-back">
                    Lihat peraturan
                    <i class="bi bi-box-arrow-up-right"></i>
                </a>

                <hr class="my-4">

                <h3>Undang-Undang Nomor 12 Tahun 2022</h3>
                <p>
                    Undang-Undang tentang Tindak Pidana Kekerasan Seksual
                    mengatur berbagai bentuk tindak pidana kekerasan
                    seksual, termasuk pelecehan seksual fisik.
                </p>
                <a href="https://peraturan.bpk.go.id/Details/207944/uu-no-12-tahun-2022"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="pd-back">
                    Lihat peraturan
                    <i class="bi bi-box-arrow-up-right"></i>
                </a>
            </div>
        </section>

        {{-- CTA --}}
        <section class="pd-help-box">
            <h2>Kamu Tidak Harus Menghadapinya Sendirian</h2>

            <p>
                Jika kamu membutuhkan informasi, ingin berkonsultasi,
                atau ingin menyampaikan pengaduan, Satgas PPKS FSH UINSA
                menyediakan layanan yang dapat membantu.
            </p>

            <a href="{{ url('/lapor') }}" class="pd-btn">
                Buat Pengaduan
                <i class="bi bi-arrow-right"></i>
            </a>
        </section>

        <a href="{{ url('/informasi-edukasi') }}" class="pd-back">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Informasi dan Edukasi
        </a>

    </div>
</div>

@endsection
