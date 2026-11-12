
@extends('layouts.app')

@section('title', 'Beranda & Edukasi - Satgas PPKS FSH UINSA')

@section('content')

<style>
:root {
    --blue: #DCE8F4;
    --sage: #DCE9E2;
    --lavender: #E9E2F2;
    --cream: #F5EFE8;
    --teal: #416C72;
    --dark: #344B50;
    --muted: #71838A;
    --glass: rgba(255,255,255,.68);
    --glass-border: rgba(255,255,255,.85);
}

body {
    background: #F7F9FA;
    color: var(--dark);
    font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
}

.ppks-page {
    overflow: hidden;
    background:
        radial-gradient(ellipse at 5% 5%, rgba(220,232,244,.7), transparent 35%),
        radial-gradient(ellipse at 95% 30%, rgba(233,226,242,.55), transparent 35%),
        #F8FAFB;
}

.ppks-page h1,
.ppks-page h2,
.ppks-page h3,
.ppks-page h4,
.ppks-page h5,
.ppks-page h6 {
    color: var(--dark);
    letter-spacing: -.5px;
}

.ppks-muted { color: var(--muted); }

.ppks-gradient-text {
    background: linear-gradient(110deg, #416C72, #718AA4, #8B7A9F);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* HERO */

.ppks-hero {
    position: relative;
    overflow: hidden;
    padding: 85px 0;
    border-radius: 0 0 45px 45px;
    background:
        radial-gradient(circle at 85% 15%, rgba(255,255,255,.8), transparent 28%),
        linear-gradient(125deg, #DCE8F4 0%, #E9E2F2 50%, #DCE9E2 100%);
}

.ppks-hero::before,
.ppks-hero::after {
    content: "";
    position: absolute;
    border-radius: 50%;
    background: rgba(255,255,255,.25);
    filter: blur(2px);
}

.ppks-hero::before {
    width: 300px;
    height: 300px;
    top: -130px;
    right: 10%;
}

.ppks-hero::after {
    width: 200px;
    height: 200px;
    bottom: -100px;
    left: 30%;
}

.hero-content {
    position: relative;
    z-index: 2;
}

.hero-label {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 9px 17px;
    background: rgba(255,255,255,.6);
    border: 1px solid rgba(255,255,255,.8);
    border-radius: 50px;
    color: var(--teal);
    font-size: .8rem;
    font-weight: 700;
    backdrop-filter: blur(12px);
}

.hero-title {
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 800;
    line-height: 1.15;
    letter-spacing: -2px;
}

.hero-description {
    max-width: 590px;
    color: #52696F;
    font-size: 1.05rem;
    line-height: 1.9;
}

.hero-visual {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 290px;
}

.hero-shield {
    width: 210px;
    height: 210px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: rgba(255,255,255,.42);
    border: 1px solid rgba(255,255,255,.8);
    box-shadow: 0 25px 65px rgba(65,108,114,.13);
    backdrop-filter: blur(20px);
}

.hero-shield i {
    font-size: 105px;
    color: var(--teal);
}

.floating-note {
    position: absolute;
    background: rgba(255,255,255,.8);
    border: 1px solid white;
    padding: 14px 19px;
    border-radius: 18px;
    box-shadow: 0 12px 35px rgba(65,108,114,.1);
    backdrop-filter: blur(15px);
    color: var(--teal);
    font-size: .85rem;
    font-weight: 700;
}

.note-one { top: 25px; right: 0; }
.note-two { bottom: 25px; left: 0; }

/* BUTTONS */

.btn-ppks {
    background: var(--teal);
    color: white;
    border: 1px solid var(--teal);
    border-radius: 14px;
    padding: 14px 24px;
    font-weight: 700;
    transition: .3s ease;
    box-shadow: 0 8px 22px rgba(65,108,114,.17);
}

.btn-ppks:hover {
    background: #345A60;
    color: white;
    transform: translateY(-3px);
}

.btn-glass {
    background: rgba(255,255,255,.5);
    color: var(--teal);
    border: 1px solid rgba(65,108,114,.2);
    border-radius: 14px;
    padding: 14px 24px;
    font-weight: 700;
    transition: .3s ease;
}

.btn-glass:hover {
    background: white;
    color: var(--teal);
    transform: translateY(-3px);
}

/* SECTION */

.ppks-section {
    padding: 75px 0;
}

.section-label {
    color: var(--teal);
    text-transform: uppercase;
    font-weight: 800;
    font-size: .72rem;
    letter-spacing: 2px;
}

.section-title {
    font-size: clamp(1.8rem, 3vw, 2.5rem);
    font-weight: 800;
}

.section-description {
    color: var(--muted);
    line-height: 1.8;
    max-width: 650px;
}

/* GLASS CARDS */

.glass-card {
    height: 100%;
    background: var(--glass);
    border: 1px solid var(--glass-border);
    border-radius: 24px;
    padding: 30px;
    box-shadow: 0 12px 40px rgba(65,108,114,.055);
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);
    transition: transform .35s ease, box-shadow .35s ease;
}

.glass-card:hover {
    transform: translateY(-7px);
    box-shadow: 0 20px 45px rgba(65,108,114,.12);
}

.icon-box {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 19px;
    margin-bottom: 22px;
    font-size: 1.7rem;
}

.icon-blue { background: #E5EDF7; color: #537A9A; }
.icon-green { background: #E3EEE7; color: #507D69; }
.icon-purple { background: #EEE8F5; color: #84729C; }
.icon-cream { background: #F5EEE4; color: #9A8061; }

.glass-card h5 {
    font-weight: 800;
    margin-bottom: 12px;
}

.glass-card p {
    color: var(--muted);
    font-size: .9rem;
    line-height: 1.8;
}

.card-link {
    color: var(--teal);
    font-weight: 700;
    font-size: .85rem;
    text-decoration: none;
}

.card-link:hover { color: #8B7A9F; }

/* PRIVACY BANNER */

.privacy-banner {
    padding: 38px;
    border-radius: 28px;
    background: linear-gradient(120deg, #E5EDF6, #EDE8F4, #E2EEE8);
    border: 1px solid rgba(255,255,255,.8);
}

.privacy-icon {
    width: 75px;
    height: 75px;
    border-radius: 23px;
    background: rgba(255,255,255,.6);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: var(--teal);
}

/* EDUKASI */

.education-card {
    background: rgba(255,255,255,.8);
    border: 1px solid #EDF0F2;
    border-radius: 20px;
    padding: 25px;
    height: 100%;
    transition: .3s ease;
}

.education-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(65,108,114,.09);
}

.education-card h6 {
    font-weight: 800;
    margin: 15px 0 10px;
}

.edu-tag {
    display: inline-block;
    border-radius: 30px;
    padding: 6px 12px;
    font-size: .72rem;
    font-weight: 700;
}

.tag-blue { background: #E5EDF7; color: #537A9A; }
.tag-green { background: #E3EEE7; color: #507D69; }
.tag-purple { background: #EEE8F5; color: #84729C; }
.tag-cream { background: #F5EEE4; color: #92734F; }

/* TIMELINE */

.timeline-card {
    background: rgba(255,255,255,.7);
    border: 1px solid white;
    border-radius: 25px;
    padding: 40px 30px;
    box-shadow: 0 15px 40px rgba(65,108,114,.06);
    backdrop-filter: blur(15px);
}

.timeline-number {
    width: 52px;
    height: 52px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #DCE8F4, #DCE9E2);
    border-radius: 17px;
    color: var(--teal);
    font-size: 1.15rem;
    font-weight: 800;
    margin: 0 auto 18px;
}

.timeline-step h6 {
    font-weight: 800;
    margin-bottom: 10px;
}

/* ANIMATION */

@keyframes gentleFloat {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.hero-shield { animation: gentleFloat 5s ease-in-out infinite; }

@media (max-width: 768px) {
    .ppks-hero { padding: 60px 0; border-radius: 0 0 30px 30px; }
    .hero-title { font-size: 2.5rem; }
    .hero-visual { min-height: 250px; margin-top: 25px; }
    .hero-shield { width: 170px; height: 170px; }
    .hero-shield i { font-size: 80px; }
    .note-one { right: 0; }
    .note-two { left: 0; }
    .ppks-section { padding: 50px 0; }
    .privacy-banner { padding: 25px; }
    .timeline-card { padding: 25px 18px; }
}

@media (prefers-reduced-motion: reduce) {
    .hero-shield { animation: none; }
    .glass-card, .education-card, .btn-ppks, .btn-glass {
        transition: none;
    }
}
</style>

<div class="ppks-page">

    <!-- HERO SECTION -->

    <section class="ppks-hero">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-7 hero-content">

                    <span class="hero-label mb-4">
                        <i class="bi bi-shield-check"></i>
                        Ruang Aman & Terpercaya
                    </span>

                    <h1 class="hero-title mb-4">
                        Kamu Berhak
                        <span class="ppks-gradient-text">Merasa Aman.</span>
                    </h1>

                    <p class="hero-description mb-4">
                        Kami hadir untuk mendengarkan, mendampingi,
                        dan melindungi. Setiap cerita berarti,
                        setiap suara berhak didengar.
                    </p>

                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ url('/lapor') }}" class="btn btn-ppks">
                            <i class="bi bi-pencil-square me-2"></i>
                            Buat Pengaduan
                        </a>

                        <a href="{{ url('/layanan') }}" class="btn btn-glass">
                            Kenali Layanan Kami
                            <i class="bi bi-arrow-down ms-2"></i>
                        </a>
                    </div>

                    <div class="mt-4 small ppks-muted">
                        <i class="bi bi-heart-fill me-2"></i>
                        Kamu berhak mendapatkan dukungan tanpa dihakimi.
                    </div>

                </div>

                <div class="col-lg-5 hero-content">
                    <div class="hero-visual">

                        <div class="hero-shield">
                            <i class="bi bi-shield-check"></i>
                        </div>

                        <div class="floating-note note-one">
                            <i class="bi bi-heart me-2"></i>
                            Kami Mendengarkan
                        </div>

                        <div class="floating-note note-two">
                            <i class="bi bi-lock me-2"></i>
                            Privasi & Perlindungan
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- KOMITMEN SATGAS -->

    <section class="ppks-section">
        <div class="container">

            <div class="mb-5">
                <span class="section-label">Our Commitment</span>

                <h2 class="section-title mt-2">
                    Ruang Aman Dimulai dari Kepedulian
                </h2>

                <p class="section-description">
                    Satgas PPKS hadir untuk memberikan informasi,
                    pendampingan, serta penanganan pengaduan
                    dengan mengutamakan keamanan dan martabat setiap individu.
                </p>
            </div>

            <div class="row g-4">

                <div class="col-md-4">
                    <div class="glass-card">

                        <div class="icon-box icon-blue">
                            <i class="bi bi-incognito"></i>
                        </div>

                        <h5>Kerahasiaan Identitas</h5>

                        <p>
                            Identitas pelapor dan korban perlu dilindungi
                            dalam setiap tahapan penanganan. Pengelolaan
                            dan akses data dilakukan sesuai kewenangan
                            serta prosedur perlindungan yang berlaku.
                        </p>

                        <a href="#edukasi" class="card-link">
                            Pelajari Kebijakan
                            <i class="bi bi-arrow-right ms-1"></i>
                        </a>

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="glass-card">

                        <div class="icon-box icon-purple">
                            <i class="bi bi-clipboard-check"></i>
                        </div>

                        <h5>Penanganan Terstruktur</h5>

                        <p>
                            Setiap pengaduan ditangani melalui tahapan
                            yang terarah, mulai dari penerimaan laporan,
                            verifikasi, pendampingan, hingga tindak lanjut
                            sesuai prosedur Satgas.
                        </p>

                        <a href="#alur-penanganan" class="card-link">
                            Lihat Alur Penanganan
                            <i class="bi bi-arrow-right ms-1"></i>
                        </a>

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="glass-card">

                        <div class="icon-box icon-green">
                            <i class="bi bi-heart-pulse"></i>
                        </div>

                        <h5>Pendampingan Psikologis & Hukum</h5>

                        <p>
                            Korban dapat memperoleh informasi dan
                            pendampingan sesuai kebutuhan, termasuk
                            rujukan ke layanan konseling psikologi
                            dan bantuan hukum.
                        </p>

                        <a href="{{ url('/rujukan') }}" class="card-link">
                            Layanan Pendampingan
                            <i class="bi bi-arrow-right ms-1"></i>
                        </a>

                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- PRIVACY BANNER -->

    <section class="container mb-5">
        <div class="privacy-banner">

            <div class="row align-items-center g-4">

                <div class="col-md-2 text-center">
                    <div class="privacy-icon mx-auto">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>

                <div class="col-md-10">

                    <span class="section-label">
                        Your Safety Matters
                    </span>

                    <h3 class="fw-bold mt-2">
                        Privasi dan Keamananmu Adalah Prioritas
                    </h3>

                    <p class="ppks-muted mb-0">
                        Informasi mengenai pengaduan dan identitas
                        pelapor ditangani sesuai kebijakan perlindungan
                        data dan prosedur Satgas PPKS. Ketahui bagaimana
                        informasi pribadimu dikelola sebelum membuat laporan.
                    </p>

                </div>

            </div>

        </div>
    </section>


    <!-- EDUKASI -->

    <section id="edukasi" class="ppks-section">
        <div class="container">

            <div class="text-center mb-5">
                <span class="section-label">Knowledge & Awareness</span>

                <h2 class="section-title mt-2">
                    Kenali Bentuk Kekerasan Seksual
                </h2>

                <p class="section-description mx-auto">
                    Mengenali berbagai bentuk kekerasan seksual
                    merupakan langkah awal untuk menciptakan
                    lingkungan kampus yang aman dan saling menghargai.
                </p>
            </div>

            <div class="row g-4">

                <div class="col-md-3 col-sm-6">
                    <div class="education-card">

                        <span class="edu-tag tag-blue">Verbal</span>

                        <div class="icon-box icon-blue mt-3">
                            <i class="bi bi-chat-square-text"></i>
                        </div>

                        <h6>Pelecehan Lisan / Pesan</h6>

                        <p class="small ppks-muted mb-0">
                            Siulan, komentar bernada seksual,
                            lelucon tidak senonoh, atau pesan
                            bernuansa seksual tanpa persetujuan.
                        </p>

                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="education-card">

                        <span class="edu-tag tag-purple">Non-Fisik</span>

                        <div class="icon-box icon-purple mt-3">
                            <i class="bi bi-eye"></i>
                        </div>

                        <h6>Isyarat & Tatapan</h6>

                        <p class="small ppks-muted mb-0">
                            Tatapan bernuansa seksual, memperlihatkan
                            alat kelamin, atau gerakan isyarat tubuh
                            yang melanggar batas pribadi.
                        </p>

                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="education-card">

                        <span class="edu-tag tag-cream">Fisik</span>

                        <div class="icon-box icon-cream mt-3">
                            <i class="bi bi-person-raised-hand"></i>
                        </div>

                        <h6>Sentuhan Fisik Paksa</h6>

                        <p class="small ppks-muted mb-0">
                            Memegang, menyentuh, merangkul,
                            atau melakukan kontak fisik tanpa
                            persetujuan.
                        </p>

                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="education-card">

                        <span class="edu-tag tag-green">Daring / Cyber</span>

                        <div class="icon-box icon-green mt-3">
                            <i class="bi bi-phone"></i>
                        </div>

                        <h6>Kekerasan Berbasis Siber</h6>

                        <p class="small ppks-muted mb-0">
                            Mengambil atau menyebarkan foto/video
                            bernuansa seksual tanpa izin atau
                            melakukan intimidasi seksual secara daring.
                        </p>

                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- ALUR PENANGANAN -->

    <section id="alur-penanganan" class="ppks-section pt-0">
        <div class="container">

            <div class="timeline-card">

                <div class="text-center mb-5">
                    <span class="section-label">Reporting Process</span>

                    <h2 class="section-title mt-2">
                        Bagaimana Proses Pengaduan?
                    </h2>

                    <p class="section-description mx-auto">
                        Setiap tahap dirancang agar proses pengaduan
                        dapat dipahami dengan jelas.
                    </p>
                </div>

                <div class="row g-4 text-center">

                    <div class="col-md-3">
                        <div class="timeline-step">

                            <div class="timeline-number">01</div>

                            <h6>Pengisian Pengaduan</h6>

                            <p class="small ppks-muted">
                                Pelapor menyampaikan pengaduan
                                dan informasi yang diperlukan
                                melalui formulir.
                            </p>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="timeline-step">

                            <div class="timeline-number">02</div>

                            <h6>Verifikasi Satgas</h6>

                            <p class="small ppks-muted">
                                Tim Satgas memeriksa laporan
                                dan melakukan tindak lanjut
                                sesuai prosedur.
                            </p>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="timeline-step">

                            <div class="timeline-number">03</div>

                            <h6>Pendampingan & Investigasi</h6>

                            <p class="small ppks-muted">
                                Pemberian pendampingan psikologis
                                atau hukum serta proses pemeriksaan
                                sesuai ketentuan.
                            </p>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="timeline-step">

                            <div class="timeline-number">04</div>

                            <h6>Rekomendasi Pimpinan</h6>

                            <p class="small ppks-muted">
                                Penyusunan hasil pemeriksaan
                                dan rekomendasi tindak lanjut
                                sesuai kewenangan.
                            </p>

                        </div>
                    </div>

                </div>

                <div class="text-center mt-5">

                    <a href="{{ url('/lapor') }}" class="btn btn-ppks">
                        Mulai Buat Pengaduan
                        <i class="bi bi-arrow-right ms-2"></i>
                    </a>

                </div>

            </div>

        </div>
    </section>


    <!-- CLOSING SECTION -->

    <section class="container pb-5">
        <div class="text-center py-5 px-3"
             style="background:linear-gradient(120deg,#E5EDF6,#EDE8F4,#E2EEE8);border-radius:28px;">

            <div class="icon-box icon-green mx-auto">
                <i class="bi bi-heart"></i>
            </div>

            <h2 class="section-title">
                Kamu Tidak Harus Menghadapinya Sendirian.
            </h2>

            <p class="ppks-muted mx-auto my-3" style="max-width:550px;">
                Jika kamu membutuhkan bantuan atau ingin menyampaikan
                pengaduan, Satgas PPKS siap menjadi salah satu tempat
                untuk mencari dukungan.
            </p>

            <a href="{{ url('/lapor') }}" class="btn btn-ppks">
                Hubungi Satgas PPKS
                <i class="bi bi-arrow-right ms-2"></i>
            </a>

        </div>
    </section>

</div>

@endsection
