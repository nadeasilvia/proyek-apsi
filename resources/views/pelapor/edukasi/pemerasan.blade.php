
@extends('layouts.app')

@section('title', 'Pemerasan - Edukasi PPKS FSH UINSA')

@section('content')

<style>
    .extortion-page {
        --ep-ink: #344B50;
        --ep-muted: #71838A;
        --ep-teal: #416C72;
        --ep-blue: #DCE8F4;
        --ep-sage: #DCE9E2;
        --ep-lavender: #E9E2F2;
        --ep-cream: #F5EFE8;

        color: var(--ep-ink);
        padding-bottom: 75px;
    }

    .ep-container {
        width: min(1080px, calc(100% - 40px));
        margin: auto;
    }

    .ep-breadcrumb {
        padding: 25px 0 18px;
        font-size: 13px;
        color: var(--ep-muted);
    }

    .ep-breadcrumb a {
        color: var(--ep-teal);
        text-decoration: none;
    }

    .ep-breadcrumb span {
        margin: 0 8px;
    }

    .ep-hero {
        background: linear-gradient(120deg, #DCE9E2, #E9E2F2);
        border-radius: 25px;
        padding: 55px 45px;
        position: relative;
        overflow: hidden;
        margin-bottom: 45px;
    }

    .ep-hero::after {
        content: "\f4ad";
        font-family: "bootstrap-icons";
        position: absolute;
        right: 55px;
        bottom: -35px;
        font-size: 190px;
        color: rgba(255,255,255,.45);
        transform: rotate(-12deg);
    }

    .ep-hero-content {
        position: relative;
        z-index: 1;
        max-width: 650px;
    }

    .ep-label {
        display: inline-block;
        padding: 8px 15px;
        border-radius: 30px;
        background: rgba(255,255,255,.65);
        color: var(--ep-teal);
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 18px;
    }

    .ep-hero h1 {
        font-size: clamp(28px, 4vw, 42px);
        line-height: 1.2;
        font-weight: 700;
        margin-bottom: 18px;
    }

    .ep-hero p {
        color: #596E74;
        line-height: 1.8;
        font-size: 15px;
        margin-bottom: 25px;
    }

    .ep-btn {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        background: var(--ep-teal);
        color: white;
        padding: 12px 21px;
        border-radius: 30px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        transition: .2s;
    }

    .ep-btn:hover {
        background: #31575D;
        color: white;
        transform: translateY(-2px);
    }

    .ep-section {
        margin-bottom: 42px;
    }

    .ep-section-heading {
        margin-bottom: 20px;
    }

    .ep-section-heading small {
        color: var(--ep-teal);
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .ep-section-heading h2 {
        font-size: 25px;
        font-weight: 700;
        margin: 8px 0;
    }

    .ep-section-heading p {
        color: var(--ep-muted);
        font-size: 14px;
        line-height: 1.8;
        max-width: 760px;
        margin: 0;
    }

    .ep-content-card {
        background: white;
        border: 1px solid #E8EDEF;
        border-radius: 18px;
        padding: 25px;
        margin-bottom: 16px;
    }

    .ep-content-card h3 {
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .ep-content-card p {
        color: var(--ep-muted);
        font-size: 14px;
        line-height: 1.85;
        margin-bottom: 0;
    }

    .ep-icon {
        width: 43px;
        height: 43px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        font-size: 20px;
        margin-bottom: 15px;
        background: var(--ep-blue);
        color: var(--ep-teal);
    }

    .ep-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .ep-example {
        background: #F8FAFB;
        border: 1px solid #E9EFF0;
        padding: 19px;
        border-radius: 15px;
    }

    .ep-example h4 {
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .ep-example p {
        color: var(--ep-muted);
        font-size: 13px;
        line-height: 1.75;
        margin: 0;
    }

    .ep-note {
        background: #F5F0F9;
        border-left: 4px solid #A99BC0;
        border-radius: 12px;
        padding: 20px 22px;
        margin-top: 20px;
    }

    .ep-note strong {
        display: block;
        margin-bottom: 7px;
        font-size: 14px;
    }

    .ep-note p {
        color: var(--ep-muted);
        font-size: 13px;
        line-height: 1.8;
        margin: 0;
    }

    .ep-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .ep-list li {
        display: flex;
        gap: 12px;
        margin-bottom: 15px;
        color: var(--ep-muted);
        font-size: 14px;
        line-height: 1.8;
    }

    .ep-list i {
        color: var(--ep-teal);
        margin-top: 3px;
        flex-shrink: 0;
    }

    .ep-highlight {
        background: linear-gradient(120deg, #E7F0F5, #E8EFE9);
        border-radius: 20px;
        padding: 28px;
    }

    .ep-highlight h3 {
        font-size: 19px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .ep-highlight p {
        color: var(--ep-muted);
        font-size: 14px;
        line-height: 1.85;
        margin: 0;
    }

    .ep-legal {
        background: var(--ep-cream);
        border-radius: 17px;
        padding: 23px;
        margin-bottom: 13px;
    }

    .ep-legal h4 {
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .ep-legal p {
        color: var(--ep-muted);
        font-size: 13px;
        line-height: 1.8;
        margin: 0;
    }

    /* CTA */
    .ep-bottom {
        background: linear-gradient(120deg, #DCE8F4, #E9E2F2);
        border-radius: 22px;
        padding: 32px;
        margin-top: 45px;
    }

    .ep-bottom-content {
        display: flex;
        align-items: center;
        gap: 22px;
    }

    .ep-bottom-icon {
        width: 60px;
        height: 60px;
        min-width: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255,255,255,.7);
        color: #416C72;
        border-radius: 18px;
        font-size: 27px;
    }

    .ep-bottom-text {
        flex: 1;
    }

    .ep-bottom h2 {
        font-size: 20px;
        font-weight: 700;
        color: #344B50;
        margin-bottom: 9px;
    }

    .ep-bottom p {
        color: #71838A;
        font-size: 13px;
        line-height: 1.8;
        margin: 0;
    }

    .ep-bottom .ep-btn {
        background: #416C72;
        color: white;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .ep-bottom .ep-btn:hover {
        background: #31575D;
        color: white;
    }

    .ep-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--ep-teal);
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        margin-top: 25px;
    }

    .ep-back:hover {
        color: #294E54;
    }

    @media (max-width: 768px) {
        .ep-container {
            width: min(100% - 28px, 1080px);
        }

        .ep-hero {
            padding: 38px 25px;
        }

        .ep-hero::after {
            right: 5px;
            font-size: 120px;
        }

        .ep-grid {
            grid-template-columns: 1fr;
        }

        .ep-content-card {
            padding: 21px;
        }

        .ep-bottom-content {
            flex-direction: column;
            align-items: flex-start;
        }

        .ep-bottom .ep-btn {
            align-self: flex-start;
        }
    }
</style>

<div class="extortion-page">
    <div class="ep-container">

        {{-- BREADCRUMB --}}
        <div class="ep-breadcrumb">
            <a href="{{ url('/') }}">Beranda</a>
            <span>/</span>
            <a href="{{ url('/informasi-edukasi') }}">Edukasi & SOP</a>
            <span>/</span>
            <span>Pemerasan</span>
        </div>

        {{-- HERO --}}
        <section class="ep-hero">
            <div class="ep-hero-content">
                <span class="ep-label">
                    <i class="bi bi-shield-lock me-1"></i>
                    Edukasi dan Pencegahan
                </span>

                <h1>Mengenal Pemerasan</h1>

                <p>
                    Setiap orang berhak mengambil keputusan tanpa tekanan
                    atau ancaman. Kenali tindakan pemerasan, bentuk-bentuknya,
                    serta langkah perlindungan yang dapat dilakukan ketika
                    mengalaminya.
                </p>

                <a href="#pengertian" class="ep-btn">
                    Mulai Membaca
                    <i class="bi bi-arrow-down"></i>
                </a>
            </div>
        </section>

        {{-- PENGERTIAN --}}
        <section class="ep-section" id="pengertian">
            <div class="ep-section-heading">
                <small>01 — Pengertian</small>
                <h2>Apa Itu Pemerasan?</h2>
                <p>
                    Memahami tindakan memaksa seseorang memberikan sesuatu
                    atau melakukan tindakan tertentu melalui ancaman maupun
                    tekanan.
                </p>
            </div>

            <div class="ep-content-card">
                <div class="ep-icon">
                    <i class="bi bi-exclamation-shield"></i>
                </div>

                <h3>Pengertian Umum</h3>

                <p>
                    Pemerasan merupakan tindakan memaksa seseorang untuk
                    memberikan barang, uang, keuntungan, atau melakukan
                    sesuatu dengan menggunakan ancaman atau tekanan.
                    Tindakan tersebut dapat terjadi secara langsung maupun
                    melalui komunikasi digital dan dapat menimbulkan kerugian
                    bagi orang yang menjadi sasaran.
                </p>
            </div>

            <div class="ep-note">
                <strong>
                    <i class="bi bi-info-circle me-1"></i>
                    Perlu dipahami
                </strong>
                <p>
                    Pemerasan merupakan istilah yang luas dan tidak semua
                    peristiwa pemerasan otomatis termasuk kekerasan seksual.
                    Dalam konteks UU TPKS, terdapat ketentuan khusus mengenai
                    ancaman atau pemerasan untuk melakukan atau membiarkan
                    perbuatan seksual. Penilaian harus memperhatikan fakta
                    dan unsur hukum yang berlaku.
                </p>
            </div>
        </section>

        {{-- BENTUK-BENTUK --}}
        <section class="ep-section">
            <div class="ep-section-heading">
                <small>02 — Bentuk Tindakan</small>
                <h2>Bentuk-Bentuk Pemerasan</h2>
                <p>
                    Pemerasan dapat muncul dalam berbagai situasi,
                    baik secara langsung maupun melalui media elektronik.
                </p>
            </div>

            <div class="ep-grid">

                <div class="ep-content-card">
                    <div class="ep-icon">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                    <h3>Pemerasan Finansial</h3>
                    <p>
                        Memaksa seseorang memberikan uang atau barang
                        berharga dengan menggunakan ancaman atau tekanan
                        yang merugikan.
                    </p>
                </div>

                <div class="ep-content-card">
                    <div class="ep-icon">
                        <i class="bi bi-person-lock"></i>
                    </div>
                    <h3>Pemerasan Menggunakan Informasi Pribadi</h3>
                    <p>
                        Mengancam akan mengungkapkan informasi pribadi
                        seseorang untuk memaksanya memberikan sesuatu
                        atau memenuhi tuntutan tertentu.
                    </p>
                </div>

                <div class="ep-content-card">
                    <div class="ep-icon">
                        <i class="bi bi-phone"></i>
                    </div>
                    <h3>Pemerasan Melalui Media Digital</h3>
                    <p>
                        Menggunakan pesan, media sosial, atau sarana
                        elektronik lainnya untuk mengancam dan memaksa
                        seseorang memenuhi tuntutan.
                    </p>
                </div>

                <div class="ep-content-card">
                    <div class="ep-icon">
                        <i class="bi bi-shield-exclamation"></i>
                    </div>
                    <h3>Pemerasan Seksual</h3>
                    <p>
                        Menggunakan ancaman atau tekanan yang berkaitan
                        dengan tindakan seksual untuk memaksa seseorang
                        melakukan atau membiarkan perbuatan seksual.
                    </p>
                </div>

            </div>
        </section>

        {{-- CONTOH DI KAMPUS --}}
        <section class="ep-section">
            <div class="ep-section-heading">
                <small>03 — Contoh di Lingkungan Kampus</small>
                <h2>Bagaimana Hal Ini Bisa Terjadi?</h2>
                <p>
                    Berikut beberapa gambaran situasi yang perlu diwaspadai
                    dalam lingkungan pendidikan dan pergaulan mahasiswa.
                </p>
            </div>

            <div class="ep-grid">

                <div class="ep-example">
                    <h4>
                        <i class="bi bi-wallet2 me-2"></i>
                        Tekanan Finansial
                    </h4>
                    <p>
                        Seseorang dipaksa memberikan uang atau barang
                        dengan ancaman akan mendapatkan konsekuensi
                        tertentu jika menolak.
                    </p>
                </div>

                <div class="ep-example">
                    <h4>
                        <i class="bi bi-chat-square-text me-2"></i>
                        Ancaman dalam Komunikasi
                    </h4>
                    <p>
                        Mahasiswa menerima ancaman melalui pesan pribadi
                        yang bertujuan memaksanya memenuhi suatu tuntutan.
                    </p>
                </div>

                <div class="ep-example">
                    <h4>
                        <i class="bi bi-person-exclamation me-2"></i>
                        Penyalahgunaan Posisi
                    </h4>
                    <p>
                        Seseorang memanfaatkan kedudukan atau pengaruhnya
                        untuk menekan mahasiswa agar memberikan sesuatu
                        atau memenuhi tuntutan yang tidak semestinya.
                    </p>
                </div>

                <div class="ep-example">
                    <h4>
                        <i class="bi bi-shield-lock me-2"></i>
                        Ancaman Bermuatan Seksual
                    </h4>
                    <p>
                        Seseorang menggunakan ancaman atau tekanan yang
                        berkaitan dengan tindakan seksual untuk memaksa
                        orang lain memenuhi tuntutan tertentu.
                    </p>
                </div>

            </div>
        </section>

        {{-- PERBEDAAN --}}
        <section class="ep-section">
            <div class="ep-section-heading">
                <small>04 — Memahami Batasan</small>
                <h2>Perbedaan Pemerasan dan Permintaan Biasa</h2>
                <p>
                    Tidak setiap permintaan atau perselisihan merupakan
                    pemerasan. Penting untuk memahami adanya unsur paksaan,
                    ancaman, dan tujuan yang merugikan.
                </p>
            </div>

            <div class="ep-grid">

                <div class="ep-content-card">
                    <div class="ep-icon">
                        <i class="bi bi-chat-square-heart"></i>
                    </div>
                    <h3>Permintaan atau Kesepakatan Biasa</h3>
                    <p>
                        Terjadi ketika para pihak dapat menyampaikan
                        pendapat, mempertimbangkan permintaan, dan
                        mengambil keputusan tanpa ancaman atau paksaan.
                    </p>
                </div>

                <div class="ep-content-card">
                    <div class="ep-icon">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                    <h3>Pemerasan</h3>
                    <p>
                        Melibatkan unsur pemaksaan melalui ancaman atau
                        tekanan untuk memperoleh sesuatu atau membuat
                        seseorang melakukan tindakan tertentu.
                    </p>
                </div>

            </div>

            <div class="ep-note">
                <strong>
                    <i class="bi bi-info-circle me-1"></i>
                    Perhatian
                </strong>
                <p>
                    Penentuan apakah suatu tindakan memenuhi unsur pemerasan
                    secara hukum tidak cukup hanya berdasarkan satu ciri.
                    Perlu dilakukan pemeriksaan terhadap fakta dan ketentuan
                    hukum yang relevan.
                </p>
            </div>
        </section>

        {{-- DAMPAK --}}
        <section class="ep-section">
            <div class="ep-section-heading">
                <small>05 — Dampak</small>
                <h2>Dampak terhadap Korban</h2>
                <p>
                    Pemerasan dapat memengaruhi rasa aman, kondisi psikologis,
                    dan kehidupan sosial maupun akademik seseorang.
                </p>
            </div>

            <div class="ep-grid">

                <div class="ep-content-card">
                    <div class="ep-icon">
                        <i class="bi bi-heart-pulse"></i>
                    </div>
                    <h3>Dampak Psikologis</h3>
                    <p>
                        Dapat menimbulkan rasa takut, cemas, tertekan,
                        kehilangan rasa aman, dan kesulitan mengambil
                        keputusan secara bebas.
                    </p>
                </div>

                <div class="ep-content-card">
                    <div class="ep-icon">
                        <i class="bi bi-mortarboard"></i>
                    </div>
                    <h3>Dampak Akademik</h3>
                    <p>
                        Korban dapat mengalami kesulitan berkonsentrasi,
                        mengikuti kegiatan perkuliahan, atau menjalankan
                        aktivitas akademik sehari-hari.
                    </p>
                </div>

                <div class="ep-content-card">
                    <div class="ep-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <h3>Dampak Sosial</h3>
                    <p>
                        Dapat memengaruhi hubungan dengan orang lain,
                        kepercayaan terhadap lingkungan, dan kenyamanan
                        dalam berinteraksi.
                    </p>
                </div>

                <div class="ep-content-card">
                    <div class="ep-icon">
                        <i class="bi bi-shield-exclamation"></i>
                    </div>
                    <h3>Dampak terhadap Keamanan</h3>
                    <p>
                        Ancaman yang diterima dapat membuat korban
                        merasa tidak aman dan khawatir terhadap
                        keselamatan maupun privasinya.
                    </p>
                </div>

            </div>
        </section>

        {{-- LANGKAH PERLINDUNGAN --}}
        <section class="ep-section">
            <div class="ep-section-heading">
                <small>06 — Perlindungan</small>
                <h2>Apa yang Dapat Dilakukan?</h2>
                <p>
                    Jika mengalami atau mengetahui tindakan pemerasan,
                    keselamatan dan perlindungan korban harus menjadi
                    perhatian utama.
                </p>
            </div>

            <div class="ep-content-card">
                <ul class="ep-list">

                    <li>
                        <i class="bi bi-check-circle-fill"></i>
                        <span>
                            <strong>Utamakan keselamatan diri.</strong>
                            Jangan memaksakan diri menghadapi pihak yang
                            mengancam jika situasi terasa tidak aman.
                        </span>
                    </li>

                    <li>
                        <i class="bi bi-check-circle-fill"></i>
                        <span>
                            <strong>Simpan informasi yang relevan dengan aman.</strong>
                            Jika memungkinkan dan aman, catat waktu kejadian,
                            bentuk ancaman, serta informasi komunikasi yang
                            berkaitan dengan peristiwa tersebut.
                        </span>
                    </li>

                    <li>
                        <i class="bi bi-check-circle-fill"></i>
                        <span>
                            <strong>Jangan menyebarkan informasi sensitif.</strong>
                            Hindari membagikan identitas, dokumen pribadi,
                            atau konten sensitif kepada pihak yang tidak
                            berwenang.
                        </span>
                    </li>

                    <li>
                        <i class="bi bi-check-circle-fill"></i>
                        <span>
                            <strong>Cari dukungan dari pihak tepercaya.</strong>
                            Kamu dapat meminta bantuan kepada orang yang
                            dipercaya atau pihak berwenang sesuai dengan
                            situasi yang dihadapi.
                        </span>
                    </li>

                    <li>
                        <i class="bi bi-check-circle-fill"></i>
                        <span>
                            <strong>Hubungi pihak yang berwenang.</strong>
                            Jika terdapat ancaman atau dugaan tindak pidana,
                            pertimbangkan untuk mencari bantuan melalui
                            saluran resmi yang sesuai.
                        </span>
                    </li>

                    <li>
                        <i class="bi bi-check-circle-fill"></i>
                        <span>
                            <strong>Hubungi Satgas PPKS jika sesuai ruang lingkupnya.</strong>
                            Apabila peristiwa berkaitan dengan kekerasan
                            seksual di lingkungan perguruan tinggi, kamu
                            dapat meminta informasi mengenai prosedur
                            pengaduan dan pendampingan.
                        </span>
                    </li>

                </ul>
            </div>

            <div class="ep-highlight">
                <h3>
                    <i class="bi bi-shield-check me-2"></i>
                    Korban Berhak Mendapatkan Perlindungan
                </h3>
                <p>
                    Korban tidak seharusnya disalahkan atas ancaman atau
                    tekanan yang dialaminya. Informasi mengenai kejadian
                    perlu ditangani secara hati-hati, menjaga kerahasiaan
                    identitas, serta memperhatikan kebutuhan dan keamanan
                    korban.
                </p>
            </div>
        </section>

        {{-- LANDASAN HUKUM --}}
        <section class="ep-section">
            <div class="ep-section-heading">
                <small>07 — Landasan Hukum</small>
                <h2>Regulasi yang Berkaitan</h2>
                <p>
                    Pemerasan dapat berkaitan dengan ketentuan hukum yang
                    berbeda, bergantung pada bentuk perbuatan dan unsur
                    yang terpenuhi.
                </p>
            </div>

            <div class="ep-legal">
                <h4>UU Nomor 1 Tahun 2023 tentang Kitab Undang-Undang Hukum Pidana</h4>
                <p>
                    Menjadi salah satu landasan hukum dalam memahami
                    tindak pidana pemerasan dan pengancaman. Penerapan
                    ketentuannya harus disesuaikan dengan unsur perbuatan
                    serta ketentuan KUHP yang berlaku.
                </p>
            </div>

            <div class="ep-legal">
                <h4>UU Nomor 12 Tahun 2022 tentang Tindak Pidana Kekerasan Seksual</h4>
                <p>
                    Pasal 14 mengatur kekerasan seksual berbasis elektronik.
                    Ketentuan Pasal 14 ayat (2) secara khusus mengatur
                    ancaman atau pemerasan untuk melakukan atau membiarkan
                    perbuatan seksual.
                </p>
            </div>

            <div class="ep-legal">
                <h4>UU Nomor 27 Tahun 2022 tentang Pelindungan Data Pribadi</h4>
                <p>
                    Berkaitan dengan pelindungan data pribadi dan hak
                    seseorang atas informasi pribadinya. Relevansinya
                    bergantung pada bagaimana data pribadi digunakan
                    atau diproses dalam suatu peristiwa.
                </p>
            </div>

            <div class="ep-note">
                <strong>
                    <i class="bi bi-bookmark-check me-1"></i>
                    Catatan hukum
                </strong>
                <p>
                    Materi ini merupakan pengantar edukasi, bukan penetapan
                    bahwa suatu kejadian pasti merupakan tindak pidana
                    pemerasan atau kekerasan seksual. Penilaian hukum
                    memerlukan pemeriksaan fakta dan ketentuan yang berlaku.
                </p>
            </div>
        </section>

        {{-- CTA --}}
        <section class="ep-bottom">
            <div class="ep-bottom-content">
                <div class="ep-bottom-icon">
                    <i class="bi bi-shield-check"></i>
                </div>

                <div class="ep-bottom-text">
                    <h2>Kamu Berhak Mendapatkan Perlindungan</h2>
                    <p>
                        Jika mengalami tindakan yang termasuk dalam ruang
                        lingkup penanganan Satgas PPKS, kamu dapat mempelajari
                        prosedur pengaduan dan menghubungi pihak yang
                        berwenang di lingkungan kampus.
                    </p>
                </div>

                <a href="{{ url('/lapor') }}" class="ep-btn">
                    Buat Pengaduan
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </section>

        {{-- KEMBALI --}}
        <a href="{{ url('/informasi-edukasi') }}" class="ep-back">
            <i class="bi bi-arrow-left"></i>
            Kembali ke halaman Edukasi & SOP
        </a>

    </div>
</div>

@endsection
