@extends('layouts.app')

@section('title', 'Layanan - Satgas PPKS FSH UINSA')

@section('content')

<style>
    .service-page {
        --sp-blue: #DCE8F4;
        --sp-sage: #DCE9E2;
        --sp-lavender: #E9E2F2;
        --sp-cream: #F5EFE8;
        --sp-teal: #416C72;
        --sp-dark: #344B50;
        --sp-muted: #71838A;
        background:
            radial-gradient(ellipse at 5% 10%, rgba(220,232,244,.55), transparent 35%),
            radial-gradient(ellipse at 95% 35%, rgba(233,226,242,.45), transparent 35%),
            #F8FAFB;
        color: var(--sp-dark);
        overflow: hidden;
    }

    .service-page h1,
    .service-page h2,
    .service-page h3,
    .service-page h4,
    .service-page h5 {
        color: var(--sp-dark);
        letter-spacing: -.5px;
    }

    .sp-muted {
        color: var(--sp-muted);
    }

    /* HERO - DISESUAIKAN DENGAN HALAMAN EDUKASI */

    .sp-hero {
        position: relative;
        overflow: hidden;
        padding: 55px 50px;
        margin: 55px auto 48px;
        max-width: 1120px;
        border-radius: 28px;
        background:
            radial-gradient(circle at 90% 10%, rgba(255,255,255,.8), transparent 30%),
            linear-gradient(120deg, #DCE8F4, #E9E2F2 55%, #DCE9E2);
    }

    .sp-hero::before,
    .sp-hero::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        background: rgba(255,255,255,.3);
        filter: blur(2px);
        pointer-events: none;
    }

    .sp-hero::before {
        width: 250px;
        height: 250px;
        top: -120px;
        right: 8%;
    }

    .sp-hero::after {
        width: 180px;
        height: 180px;
        bottom: -100px;
        left: 35%;
    }

    .sp-hero-content {
        position: relative;
        z-index: 2;
    }

    .sp-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 50px;
        background: rgba(255,255,255,.65);
        border: 1px solid rgba(255,255,255,.85);
        color: var(--sp-teal);
        font-size: .75rem;
        font-weight: 800;
        letter-spacing: .5px;
    }

    .sp-hero h1 {
        font-size: clamp(2rem, 4vw, 2.8rem);
        line-height: 1.2;
        font-weight: 800;
        letter-spacing: -1.5px;
    }

    .sp-gradient-text {
        background: linear-gradient(110deg, #416C72, #718AA4, #8B7A9F);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .sp-hero-description {
        max-width: 590px;
        color: #52696F;
        font-size: .94rem;
        line-height: 1.9;
    }

    /* GENERAL SECTION */

    .sp-section {
        padding: 75px 0;
    }

    .sp-section-label {
        color: var(--sp-teal);
        text-transform: uppercase;
        font-size: .72rem;
        font-weight: 800;
        letter-spacing: 2px;
    }

    .sp-section-title {
        font-size: clamp(1.8rem, 3vw, 2.5rem);
        font-weight: 800;
    }

    .sp-section-description {
        max-width: 680px;
        margin: 0 auto;
        color: var(--sp-muted);
        line-height: 1.9;
        font-size: .94rem;
    }

    /* SERVICE CARDS */

    .sp-service-card {
        height: 100%;
        padding: 30px;
        border-radius: 24px;
        background: rgba(255,255,255,.78);
        border: 1px solid rgba(255,255,255,.95);
        box-shadow: 0 12px 40px rgba(65,108,114,.055);
        backdrop-filter: blur(15px);
        transition: .3s ease;
    }

    .sp-service-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 20px 45px rgba(65,108,114,.12);
    }

    .sp-icon-box {
        width: 62px;
        height: 62px;
        border-radius: 19px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.7rem;
        margin-bottom: 22px;
    }

    .sp-icon-blue {
        background: #E5EDF7;
        color: #537A9A;
    }

    .sp-icon-green {
        background: #E3EEE7;
        color: #507D69;
    }

    .sp-icon-purple {
        background: #EEE8F5;
        color: #84729C;
    }

    .sp-icon-cream {
        background: #F5EEE4;
        color: #9A8061;
    }

    .sp-service-card h4 {
        font-size: 1.12rem;
        font-weight: 800;
        margin-bottom: 13px;
    }

    .sp-service-card p {
        color: var(--sp-muted);
        font-size: .88rem;
        line-height: 1.85;
        margin-bottom: 18px;
    }

    .sp-service-list {
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .sp-service-list li {
        display: flex;
        gap: 10px;
        align-items: flex-start;
        margin-bottom: 10px;
        color: #5F747A;
        font-size: .84rem;
        line-height: 1.7;
    }

    .sp-service-list i {
        color: var(--sp-teal);
        margin-top: 3px;
    }

    /* DETAIL PANELS */

    .sp-detail-panel {
        background: rgba(255,255,255,.76);
        border: 1px solid white;
        border-radius: 27px;
        padding: 35px;
        box-shadow: 0 15px 40px rgba(65,108,114,.055);
        margin-bottom: 25px;
    }

    .sp-detail-icon {
        width: 58px;
        height: 58px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 18px;
        background: linear-gradient(135deg, #DCE8F4, #E9E2F2);
        color: var(--sp-teal);
        font-size: 1.6rem;
        flex-shrink: 0;
    }

    .sp-detail-panel h3 {
        font-size: 1.25rem;
        font-weight: 800;
    }

    .sp-detail-panel p {
        color: var(--sp-muted);
        font-size: .9rem;
        line-height: 1.9;
    }

    .sp-detail-note {
        padding: 17px 20px;
        border-radius: 16px;
        background: linear-gradient(120deg, #EAF1F8, #F0ECF5);
        color: #536D73;
        font-size: .84rem;
        line-height: 1.8;
    }

    /* PRIVACY */

    .sp-privacy {
        padding: 38px;
        border-radius: 27px;
        background: linear-gradient(120deg, #E5EDF6, #EDE8F4, #E2EEE8);
        border: 1px solid rgba(255,255,255,.9);
    }

    .sp-privacy-icon {
        width: 72px;
        height: 72px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 22px;
        background: rgba(255,255,255,.65);
        color: var(--sp-teal);
        font-size: 2rem;
    }

    /* FLOW */

    .sp-flow-card {
        height: 100%;
        text-align: center;
        padding: 27px 20px;
        border-radius: 22px;
        background: rgba(255,255,255,.72);
        border: 1px solid white;
    }

    .sp-flow-number {
        width: 49px;
        height: 49px;
        margin: 0 auto 17px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 16px;
        background: linear-gradient(135deg, #DCE8F4, #DCE9E2);
        color: var(--sp-teal);
        font-weight: 800;
        font-size: 1.05rem;
    }

    .sp-flow-card h5 {
        font-size: .95rem;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .sp-flow-card p {
        color: var(--sp-muted);
        font-size: .82rem;
        line-height: 1.8;
        margin: 0;
    }

    /* BUTTONS */

    .sp-btn-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        padding: 13px 23px;
        border-radius: 13px;
        background: var(--sp-teal);
        border: 1px solid var(--sp-teal);
        color: white;
        text-decoration: none;
        font-size: .88rem;
        font-weight: 700;
        transition: .3s ease;
        box-shadow: 0 8px 22px rgba(65,108,114,.15);
    }

    .sp-btn-primary:hover {
        background: #345A60;
        color: white;
        transform: translateY(-3px);
    }

    .sp-btn-secondary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 13px 22px;
        border-radius: 13px;
        background: rgba(255,255,255,.65);
        border: 1px solid rgba(65,108,114,.2);
        color: var(--sp-teal);
        text-decoration: none;
        font-size: .88rem;
        font-weight: 700;
        transition: .3s ease;
    }

    .sp-btn-secondary:hover {
        background: white;
        color: var(--sp-teal);
        transform: translateY(-3px);
    }

    .sp-bottom {
        padding: 42px 30px;
        border-radius: 28px;
        background: linear-gradient(120deg, #E5EDF6, #EDE8F4, #E2EEE8);
    }

    @media (max-width: 768px) {
        .sp-hero {
            padding: 40px 25px;
            margin: 30px 15px 40px;
            border-radius: 25px;
        }

        .sp-hero-visual {
            min-height: 200px;
            margin-top: 20px;
        }

        .sp-hero-icon {
            width: 155px;
            height: 155px;
        }

        .sp-hero-icon i {
            font-size: 75px;
        }

        .sp-section {
            padding: 50px 0;
        }

        .sp-detail-panel,
        .sp-privacy {
            padding: 25px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .sp-hero-icon {
            animation: none;
        }

        .sp-service-card,
        .sp-btn-primary,
        .sp-btn-secondary {
            transition: none;
        }
    }
</style>

<div class="service-page">

    {{-- HERO --}}
    <section class="sp-hero">
        <div class="row align-items-center">

            <div class="col-lg-7 sp-hero-content">

                <span class="sp-label mb-4">
                    <i class="bi bi-heart-pulse"></i>
                    Layanan Satgas PPKS
                </span>

                <h1 class="mb-4">
                    Kami Hadir untuk
                    <span class="sp-gradient-text">Mendukungmu.</span>
                </h1>

                <p class="sp-hero-description mb-4">
                    Satgas PPKS FSH UINSA menyediakan informasi,
                    penerimaan pengaduan, serta dukungan dan
                    pendampingan sesuai kebutuhan dan kewenangan.
                    Kamu berhak memperoleh ruang yang aman untuk
                    menyampaikan pengalaman dan mencari bantuan.
                </p>

                <a href="#daftar-layanan" class="sp-btn-primary">
                    Jelajahi Layanan
                    <i class="bi bi-arrow-down"></i>
                </a>

            </div>

            <div class="col-lg-5 sp-hero-content">
                <div class="sp-hero-visual">

                    <div class="sp-hero-icon">
                        <i class="bi bi-shield-heart"></i>
                    </div>

                </div>
            </div>

        </div>
    </section>


    {{-- INTRODUCTION --}}
    <section class="sp-section pb-4">
        <div class="container">

            <div class="text-center mb-5">
                <span class="sp-section-label">Our Services</span>

                <h2 class="sp-section-title mt-2">
                    Dukungan yang Dapat Kamu Akses
                </h2>

                <p class="sp-section-description">
                    Setiap individu memiliki kebutuhan yang berbeda.
                    Karena itu, Satgas PPKS berupaya memberikan informasi
                    dan mengoordinasikan dukungan berdasarkan kondisi,
                    kebutuhan, serta prosedur yang berlaku.
                </p>
            </div>

        </div>
    </section>


    {{-- SERVICE CARDS --}}
    <section id="daftar-layanan" class="pb-5">
        <div class="container">

            <div class="row g-4">

                {{-- PENGADUAN --}}
                <div class="col-lg-4 col-md-6">
                    <div class="sp-service-card">

                        <div class="sp-icon-box sp-icon-blue">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>

                        <h4>Layanan Pengaduan</h4>

                        <p>
                            Sarana bagi mahasiswa dan civitas akademika
                            untuk menyampaikan pengaduan terkait dugaan
                            kekerasan seksual atau permasalahan lain
                            yang termasuk dalam ruang lingkup Satgas.
                        </p>

                        <ul class="sp-service-list">
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Pengisian formulir pengaduan.</span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Penyampaian informasi awal kejadian.</span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Penerimaan dan pemeriksaan awal laporan.</span>
                            </li>
                        </ul>

                    </div>
                </div>


                {{-- KONSULTASI --}}
                <div class="col-lg-4 col-md-6">
                    <div class="sp-service-card">

                        <div class="sp-icon-box sp-icon-purple">
                            <i class="bi bi-chat-square-heart"></i>
                        </div>

                        <h4>Layanan Konsultasi</h4>

                        <p>
                            Kesempatan untuk memperoleh informasi dan
                            berdiskusi mengenai situasi yang dialami,
                            termasuk memahami pilihan dukungan dan
                            langkah yang dapat dipertimbangkan.
                        </p>

                        <ul class="sp-service-list">
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Konsultasi mengenai prosedur pengaduan.</span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Informasi mengenai hak dan perlindungan.</span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Informasi mengenai pilihan tindak lanjut.</span>
                            </li>
                        </ul>

                    </div>
                </div>


                {{-- PENDAMPINGAN --}}
                <div class="col-lg-4 col-md-6">
                    <div class="sp-service-card">

                        <div class="sp-icon-box sp-icon-green">
                            <i class="bi bi-people"></i>
                        </div>

                        <h4>Layanan Pendampingan</h4>

                        <p>
                            Dukungan selama proses penanganan pengaduan
                            agar pihak yang membutuhkan bantuan dapat
                            memahami tahapan dan memperoleh dukungan
                            sesuai kebutuhannya.
                        </p>

                        <ul class="sp-service-list">
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Informasi mengenai tahapan penanganan.</span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Koordinasi dukungan sesuai kebutuhan.</span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Pendampingan sesuai kewenangan dan prosedur.</span>
                            </li>
                        </ul>

                    </div>
                </div>


                {{-- PERLINDUNGAN --}}
                <div class="col-lg-4 col-md-6">
                    <div class="sp-service-card">

                        <div class="sp-icon-box sp-icon-cream">
                            <i class="bi bi-shield-lock"></i>
                        </div>

                        <h4>Layanan Perlindungan</h4>

                        <p>
                            Upaya menjaga keamanan, privasi, dan
                            kerahasiaan informasi pihak yang terlibat
                            selama proses penanganan sesuai ketentuan
                            yang berlaku.
                        </p>

                        <ul class="sp-service-list">
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Perlindungan informasi pribadi.</span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Pembatasan akses data berdasarkan kewenangan.</span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Pengelolaan informasi secara hati-hati.</span>
                            </li>
                        </ul>

                    </div>
                </div>


                {{-- RUJUKAN --}}
                <div class="col-lg-4 col-md-6">
                    <div class="sp-service-card">

                        <div class="sp-icon-box sp-icon-purple">
                            <i class="bi bi-heart-pulse"></i>
                        </div>

                        <h4>Layanan Rujukan</h4>

                        <p>
                            Koordinasi dengan layanan atau tenaga
                            profesional lain apabila dibutuhkan
                            dukungan tambahan di luar penanganan
                            langsung oleh Satgas.
                        </p>

                        <ul class="sp-service-list">
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Informasi rujukan psikologis.</span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Informasi bantuan hukum sesuai kebutuhan.</span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Koordinasi dengan layanan terkait.</span>
                            </li>
                        </ul>

                    </div>
                </div>


                {{-- EDUKASI --}}
                <div class="col-lg-4 col-md-6">
                    <div class="sp-service-card">

                        <div class="sp-icon-box sp-icon-blue">
                            <i class="bi bi-book-half"></i>
                        </div>

                        <h4>Layanan Edukasi</h4>

                        <p>
                            Penyediaan informasi untuk membantu
                            civitas akademika mengenali bentuk
                            kekerasan, memahami hak, dan mengetahui
                            prosedur pelaporan.
                        </p>

                        <ul class="sp-service-list">
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Informasi bentuk-bentuk kekerasan.</span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Informasi landasan hukum.</span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Panduan SOP dan alur pengaduan.</span>
                            </li>
                        </ul>

                        <a href="{{ url('/informasi-edukasi') }}"
                           class="sp-btn-secondary mt-3 w-100">
                            Buka Edukasi & SOP
                            <i class="bi bi-arrow-right"></i>
                        </a>

                    </div>
                </div>

            </div>

        </div>
    </section>


    {{-- DETAIL PENGADUAN --}}
    <section class="sp-section">
        <div class="container">

            <div class="text-center mb-5">
                <span class="sp-section-label">How We Help</span>

                <h2 class="sp-section-title mt-2">
                    Bagaimana Layanan Ini Berjalan?
                </h2>

                <p class="sp-section-description">
                    Pengaduan akan melalui tahapan penanganan yang
                    terstruktur. Setiap tahap dilakukan sesuai
                    prosedur dan kewenangan pihak terkait.
                </p>
            </div>


            <div class="sp-detail-panel">

                <div class="d-flex align-items-start gap-3 mb-4">

                    <div class="sp-detail-icon">
                        <i class="bi bi-clipboard-check"></i>
                    </div>

                    <div>
                        <h3>Proses Penerimaan dan Penanganan Pengaduan</h3>
                        <p class="mb-0">
                            Berikut gambaran umum tahapan yang dapat
                            dilalui setelah pengaduan disampaikan.
                        </p>
                    </div>

                </div>

                <div class="row g-3">

                    <div class="col-lg">
                        <div class="sp-flow-card">
                            <div class="sp-flow-number">01</div>
                            <h5>Penerimaan Pengaduan</h5>
                            <p>
                                Pelapor mengisi formulir dan
                                menyampaikan informasi awal.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg">
                        <div class="sp-flow-card">
                            <div class="sp-flow-number">02</div>
                            <h5>Verifikasi Awal</h5>
                            <p>
                                Satgas memeriksa kelengkapan dan
                                kesesuaian informasi laporan.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg">
                        <div class="sp-flow-card">
                            <div class="sp-flow-number">03</div>
                            <h5>Penanganan</h5>
                            <p>
                                Proses penanganan dan pendampingan
                                dilakukan sesuai kebutuhan.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg">
                        <div class="sp-flow-card">
                            <div class="sp-flow-number">04</div>
                            <h5>Tindak Lanjut</h5>
                            <p>
                                Hasil pemeriksaan dan rekomendasi
                                ditindaklanjuti sesuai kewenangan.
                            </p>
                        </div>
                    </div>

                </div>

                <div class="sp-detail-note mt-4">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    Tahapan dan durasi penanganan dapat berbeda
                    berdasarkan kondisi serta kebutuhan setiap kasus.
                    Informasi ini merupakan gambaran umum, bukan
                    jaminan bahwa seluruh kasus memiliki proses yang sama.
                </div>

            </div>


            {{-- RUJUKAN DETAIL --}}
            <div class="sp-detail-panel">

                <div class="d-flex align-items-start gap-3 mb-3">

                    <div class="sp-detail-icon">
                        <i class="bi bi-person-hearts"></i>
                    </div>

                    <div>
                        <h3>Dukungan Psikologis dan Bantuan Hukum</h3>

                        <p>
                            Dalam kondisi tertentu, pihak yang membutuhkan
                            dukungan dapat memperoleh informasi atau
                            difasilitasi untuk mengakses layanan profesional
                            sesuai kebutuhan dan ketersediaan layanan.
                        </p>
                    </div>

                </div>

                <div class="row g-4">

                    <div class="col-md-6">
                        <div class="p-3 rounded-4 h-100"
                             style="background:#EAF1F7;">

                            <h5 class="fw-bold">
                                <i class="bi bi-heart-pulse me-2"></i>
                                Dukungan Psikologis
                            </h5>

                            <p class="mb-0">
                                Informasi atau rujukan untuk memperoleh
                                dukungan psikologis dari tenaga profesional
                                sesuai kebutuhan pihak yang bersangkutan.
                            </p>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 rounded-4 h-100"
                             style="background:#F0ECF5;">

                            <h5 class="fw-bold">
                                <i class="bi bi-briefcase me-2"></i>
                                Bantuan Hukum
                            </h5>

                            <p class="mb-0">
                                Informasi atau rujukan mengenai akses
                                bantuan hukum dan layanan terkait
                                sesuai kebutuhan serta kewenangan.
                            </p>

                        </div>
                    </div>

                </div>

                <div class="mt-4">
                    <a href="{{ url('/rujukan') }}"
                       class="sp-btn-secondary">
                        Lihat Informasi Rujukan
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

            </div>

        </div>
    </section>


    {{-- PRIVACY BANNER --}}
    <section class="container mb-5">
        <div class="sp-privacy">

            <div class="row align-items-center g-4">

                <div class="col-md-2 text-center">
                    <div class="sp-privacy-icon mx-auto">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>

                <div class="col-md-10">

                    <span class="sp-section-label">
                        Privacy & Confidentiality
                    </span>

                    <h3 class="fw-bold mt-2">
                        Identitas dan Informasimu Perlu Dilindungi
                    </h3>

                    <p class="sp-muted mb-0"
                       style="line-height:1.9;">
                        Identitas pelapor dan korban merupakan informasi
                        yang perlu dijaga kerahasiaannya. Akses terhadap
                        informasi dibatasi berdasarkan kewenangan dan
                        prosedur yang berlaku. Pengelolaan data dilakukan
                        dengan memperhatikan privasi serta keamanan
                        pihak yang terlibat.
                    </p>

                </div>

            </div>

        </div>
    </section>


    {{-- CLOSING --}}
    <section class="container pb-5">

        <div class="sp-bottom text-center">

            <div class="sp-icon-box sp-icon-green mx-auto">
                <i class="bi bi-heart"></i>
            </div>

            <h2 class="sp-section-title">
                Kamu Tidak Harus Menghadapinya Sendirian.
            </h2>

            <p class="sp-muted mx-auto my-3"
               style="max-width:570px;line-height:1.9;">
                Jika kamu membutuhkan informasi atau ingin menyampaikan
                pengaduan, kamu dapat mempelajari prosedurnya dan
                menghubungi Satgas PPKS melalui layanan yang tersedia.
            </p>

            <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">

                <a href="{{ url('/lapor') }}" class="sp-btn-primary">
                    <i class="bi bi-pencil-square"></i>
                    Buat Pengaduan
                </a>

                <a href="{{ url('/informasi-edukasi') }}"
                   class="sp-btn-secondary">
                    <i class="bi bi-book"></i>
                    Pelajari Edukasi & SOP
                </a>

            </div>

        </div>

    </section>

</div>

@endsection
