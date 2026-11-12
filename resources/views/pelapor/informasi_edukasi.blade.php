
@extends('layouts.app')

@section('title', 'Informasi dan Edukasi - Satgas PPKS FSH UINSA')

@section('content')

<style>
    .education-page {
        --edu-ink: #344B50;
        --edu-muted: #71838A;
        --edu-blue: #DCE8F4;
        --edu-sage: #DCE9E2;
        --edu-lavender: #E9E2F2;
        --edu-cream: #F5EFE8;
        --edu-teal: #416C72;
        background: #F8FAF9;
        color: var(--edu-ink);
        padding: 55px 0 80px;
        min-height: 80vh;
    }

    .education-page .container {
        max-width: 1120px;
    }

    .edu-hero {
        background: linear-gradient(120deg, #DCE8F4, #E9E2F2, #DCE9E2);
        border-radius: 28px;
        padding: 55px 50px;
        position: relative;
        overflow: hidden;
        margin-bottom: 48px;
    }

    .edu-hero::after {
        content: "";
        position: absolute;
        width: 240px;
        height: 240px;
        border-radius: 50%;
        background: rgba(255,255,255,.28);
        right: -55px;
        top: -80px;
    }

    .edu-label {
        display: inline-block;
        background: rgba(255,255,255,.65);
        color: var(--edu-teal);
        padding: 8px 15px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: .7px;
        margin-bottom: 18px;
    }

    .edu-hero h1 {
        font-size: clamp(30px, 4vw, 43px);
        font-weight: 750;
        line-height: 1.2;
        max-width: 650px;
        margin-bottom: 18px;
    }

    .edu-hero p {
        max-width: 650px;
        color: #53686D;
        line-height: 1.8;
        margin-bottom: 25px;
    }

    .edu-hero-btn {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 12px 21px;
        background: var(--edu-teal);
        color: white;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        transition: .2s;
    }

    .edu-hero-btn:hover {
        background: #34585D;
        color: white;
        transform: translateY(-2px);
    }

    .edu-section {
        margin-bottom: 55px;
        scroll-margin-top: 100px;
    }

    .edu-section-heading {
        margin-bottom: 25px;
    }

    .edu-section-heading small {
        color: var(--edu-teal);
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .edu-section-heading h2 {
        font-size: 27px;
        font-weight: 750;
        margin: 8px 0;
    }

    .edu-section-heading p {
        color: var(--edu-muted);
        max-width: 700px;
        line-height: 1.7;
        margin: 0;
    }

    .edu-card {
        height: 100%;
        background: white;
        border: 1px solid #E9EEEE;
        border-radius: 19px;
        padding: 25px;
        transition: .25s;
    }

    .edu-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(52,75,80,.07);
    }

    .edu-icon {
        width: 49px;
        height: 49px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 15px;
        font-size: 21px;
        margin-bottom: 18px;
    }

    .edu-icon.blue { background: var(--edu-blue); }
    .edu-icon.sage { background: var(--edu-sage); }
    .edu-icon.lavender { background: var(--edu-lavender); }
    .edu-icon.cream { background: var(--edu-cream); }

    .edu-card h3 {
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .edu-card p {
        font-size: 13px;
        line-height: 1.7;
        color: var(--edu-muted);
        margin-bottom: 0;
    }

    .edu-card-link {
        display: inline-block;
        margin-top: 17px;
        color: var(--edu-teal);
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
    }

    .edu-card-link:hover {
        color: #294D52;
    }

    .legal-panel {
        background: white;
        border: 1px solid #E9EEEE;
        border-radius: 20px;
        padding: 25px;
        height: 100%;
    }

    .legal-panel h3 {
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .legal-panel p {
        color: var(--edu-muted);
        font-size: 13px;
        line-height: 1.7;
    }

    .legal-tag {
        display: inline-block;
        background: #EAF1F3;
        color: var(--edu-teal);
        padding: 6px 10px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 13px;
    }

    .edu-note {
        background: #F0F4F2;
        border-radius: 16px;
        padding: 20px 23px;
        color: #52676B;
        font-size: 13px;
        line-height: 1.7;
    }

    .edu-note i {
        color: var(--edu-teal);
        margin-right: 8px;
    }

    @media(max-width: 768px) {
        .education-page {
            padding: 30px 0 55px;
        }

        .edu-hero {
            padding: 35px 25px;
        }

        .edu-section-heading h2 {
            font-size: 23px;
        }
    }
</style>

<div class="education-page">
    <div class="container">

        {{-- HERO --}}
        <section class="edu-hero">
            <span class="edu-label">
                <i class="bi bi-book-half me-1"></i>
                PUSAT INFORMASI PPKS
            </span>

            <h1>Kenali, Pahami, dan Cegah Kekerasan di Lingkungan Kampus</h1>

            <p>
                Temukan informasi mengenai bentuk kekerasan, landasan hukum,
                serta panduan penanganan melalui pusat edukasi Satgas PPKS
                Fakultas Syariah dan Hukum UIN Sunan Ampel Surabaya.
            </p>

            <a href="#katalog-kekerasan" class="edu-hero-btn">
                Mulai Membaca
                <i class="bi bi-arrow-down"></i>
            </a>
        </section>

        {{-- KATALOG KEKERASAN --}}
        <section class="edu-section" id="katalog-kekerasan">
            <div class="edu-section-heading">
                <small>01 — Katalog Edukasi</small>
                <h2>Mengenali Bentuk Kekerasan</h2>
                <p>
                    Kenali berbagai bentuk tindakan kekerasan dan pelecehan
                    agar kita dapat memahami batasan perilaku yang tidak
                    dapat dibenarkan di lingkungan kampus.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <article class="edu-card">
                        <div class="edu-icon blue">
                            <i class="bi bi-person-arms-up"></i>
                        </div>
                        <h3>Kekerasan Fisik</h3>
                        <p>
                            Mengenali tindakan yang melibatkan kontak atau
                            serangan fisik terhadap seseorang.
                        </p>
                        <a href="{{ url('/informasi-edukasi/kekerasan-fisik') }}" class="edu-card-link">
                            Pelajari lebih lanjut
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </article>
                </div>

                <div class="col-md-6 col-lg-4">
                    <article class="edu-card">
                        <div class="edu-icon lavender">
                            <i class="bi bi-chat-square-text"></i>
                        </div>
                        <h3>Kekerasan Verbal dan Nonfisik</h3>
                        <p>
                            Memahami tindakan melalui ucapan, ancaman,
                            intimidasi, atau perilaku yang merendahkan.
                        </p>
                        <a href="{{ url('/informasi-edukasi/kekerasan-verbal-nonfisik') }}" class="edu-card-link">
                            Pelajari lebih lanjut
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </article>
                </div>

                <div class="col-md-6 col-lg-4">
                    <article class="edu-card">
                        <div class="edu-icon sage">
                            <i class="bi bi-phone"></i>
                        </div>
                        <h3>Kekerasan Berbasis Elektronik</h3>
                        <p>
                            Mengenali tindakan kekerasan atau pelecehan
                            yang dilakukan melalui media digital dan daring.
                        </p>
                        <a href="{{ url('/informasi-edukasi/kekerasan-elektronik') }}" class="edu-card-link">
                            Pelajari lebih lanjut
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </article>
                </div>

                <div class="col-md-6 col-lg-4">
                    <article class="edu-card">
                        <div class="edu-icon cream">
                            <i class="bi bi-people"></i>
                        </div>
                        <h3>Perundungan</h3>
                        <p>
                            Memahami perilaku merendahkan, mengintimidasi,
                            atau menyakiti orang lain dalam lingkungan sosial.
                        </p>
                        <a href="{{ url('/informasi-edukasi/perundungan') }}" class="edu-card-link">
                            Pelajari lebih lanjut
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </article>
                </div>

                <div class="col-md-6 col-lg-4">
                    <article class="edu-card">
                        <div class="edu-icon lavender">
                            <i class="bi bi-shield-exclamation"></i>
                        </div>
                        <h3>Pemerasan</h3>
                        <p>
                            Mengenali tindakan pemaksaan dengan ancaman
                            atau tekanan untuk memperoleh sesuatu.
                        </p>
                        <a href="{{ url('/informasi-edukasi/pemerasan') }}" class="edu-card-link">
                            Pelajari lebih lanjut
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </article>
                </div>
            </div>
        </section>

        {{-- LANDASAN HUKUM --}}
        <section class="edu-section" id="landasan-hukum">
            <div class="edu-section-heading">
                <small>02 — Pustaka Hukum</small>
                <h2>Landasan Hukum dan Perlindungan</h2>
                <p>
                    Referensi peraturan yang menjadi dasar pemahaman
                    mengenai kekerasan seksual, perlindungan korban,
                    dan penanganan di lingkungan perguruan tinggi.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <article class="legal-panel">
                        <span class="legal-tag">Undang-Undang</span>
                        <h3>UU Nomor 12 Tahun 2022</h3>
                        <p>
                            Undang-Undang tentang Tindak Pidana Kekerasan
                            Seksual (TPKS), sebagai salah satu landasan
                            hukum penting dalam penanganan kekerasan seksual.
                        </p>
                    </article>
                </div>

                <div class="col-md-6">
                    <article class="legal-panel">
                        <span class="legal-tag">Peraturan Pemerintah</span>
                        <h3>Peraturan terkait pelaksanaan UU TPKS</h3>
                        <p>
                            Referensi peraturan pelaksanaan yang berkaitan
                            dengan pencegahan, penanganan, perlindungan,
                            dan pemulihan korban.
                        </p>
                    </article>
                </div>

                <div class="col-md-6">
                    <article class="legal-panel">
                        <span class="legal-tag">Peraturan Perguruan Tinggi</span>
                        <h3>Regulasi PPKS di Perguruan Tinggi</h3>
                        <p>
                            Referensi regulasi pendidikan tinggi mengenai
                            pencegahan dan penanganan kekerasan di lingkungan
                            perguruan tinggi.
                        </p>
                    </article>
                </div>

                <div class="col-md-6">
                    <article class="legal-panel">
                        <span class="legal-tag">Peraturan Internal</span>
                        <h3>Kode Etik dan Ketentuan UINSA</h3>
                        <p>
                            Rujukan terhadap ketentuan dan kebijakan internal
                            universitas yang berlaku di lingkungan UIN
                            Sunan Ampel Surabaya.
                        </p>
                    </article>
                </div>
            </div>
        </section>

        {{-- CATATAN --}}
        <div class="edu-note">
            <i class="bi bi-info-circle-fill"></i>
            Informasi pada halaman ini ditujukan sebagai sarana edukasi.
            Penjelasan dan rujukan hukum akan disesuaikan dengan peraturan
            yang berlaku serta kebijakan resmi UIN Sunan Ampel Surabaya.
        </div>

    </div>
</div>

@endsection
