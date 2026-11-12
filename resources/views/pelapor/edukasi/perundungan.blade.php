
@extends('layouts.app')

@section('title', 'Perundungan - Edukasi PPKS FSH UINSA')

@section('content')

<style>
    .bullying-page {
        --bp-ink: #344b50;
        --bp-muted: #71838a;
        --bp-teal: #416c72;
        --bp-blue: #dce8f4;
        --bp-sage: #dce9e2;
        --bp-lavender: #e9e2f2;
        --bp-cream: #f5efe8;

        color: var(--bp-ink);
        padding-bottom: 75px;
    }

    .bullying-page .container {
        max-width: 1100px;
    }

    .bp-breadcrumb {
        padding: 28px 0 20px;
        font-size: 13px;
        color: var(--bp-muted);
    }

    .bp-breadcrumb a {
        color: var(--bp-teal);
        text-decoration: none;
    }

    .bp-breadcrumb a:hover {
        text-decoration: underline;
    }

    .bp-hero {
        position: relative;
        overflow: hidden;
        padding: 55px;
        border-radius: 28px;
        background: linear-gradient(
            125deg,
            #dce9e2 0%,
            #dce8f4 55%,
            #e9e2f2 100%
        );
        margin-bottom: 45px;
    }

    .bp-hero::after {
        content: '';
        position: absolute;
        width: 250px;
        height: 250px;
        right: -65px;
        top: -90px;
        border-radius: 50%;
        background: rgba(255,255,255,.25);
    }

    .bp-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 15px;
        border-radius: 30px;
        background: rgba(255,255,255,.65);
        color: var(--bp-teal);
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .bp-hero h1 {
        max-width: 700px;
        font-size: clamp(30px, 4vw, 43px);
        font-weight: 750;
        line-height: 1.2;
        margin-bottom: 18px;
    }

    .bp-hero p {
        max-width: 700px;
        color: #5d7177;
        line-height: 1.8;
        margin-bottom: 0;
        font-size: 15px;
    }

    .bp-section {
        margin-bottom: 42px;
    }

    .bp-section-heading {
        margin-bottom: 20px;
    }

    .bp-section-heading h2 {
        font-size: 24px;
        font-weight: 750;
        margin-bottom: 9px;
    }

    .bp-section-heading p {
        color: var(--bp-muted);
        font-size: 14px;
        line-height: 1.7;
        margin-bottom: 0;
    }

    .bp-content-card {
        height: 100%;
        padding: 27px;
        border: 1px solid #e8eeee;
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 8px 25px rgba(52,75,80,.045);
    }

    .bp-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 15px;
        background: var(--bp-sage);
        color: var(--bp-teal);
        font-size: 22px;
        margin-bottom: 17px;
    }

    .bp-content-card h3 {
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 11px;
    }

    .bp-content-card p,
    .bp-content-card li {
        font-size: 14px;
        color: var(--bp-muted);
        line-height: 1.8;
    }

    .bp-content-card ul {
        padding-left: 19px;
        margin-bottom: 0;
    }

    .bp-example {
        display: flex;
        gap: 15px;
        align-items: flex-start;
        padding: 17px 0;
        border-bottom: 1px solid #edf0f0;
    }

    .bp-example:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .bp-example i {
        color: var(--bp-teal);
        font-size: 18px;
        margin-top: 2px;
    }

    .bp-example p {
        margin: 0;
        font-size: 14px;
        line-height: 1.75;
    }

    .bp-note {
        padding: 24px;
        border-radius: 18px;
        background: #f3f6f8;
        border-left: 4px solid var(--bp-teal);
    }

    .bp-note h3 {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 9px;
    }

    .bp-note p {
        color: var(--bp-muted);
        font-size: 14px;
        line-height: 1.8;
        margin-bottom: 0;
    }

    .bp-help-box {
        padding: 32px;
        border-radius: 22px;
        background: linear-gradient(120deg, #dce9e2, #e9e2f2);
        margin-top: 45px;
    }

    .bp-help-box h2 {
        font-size: 23px;
        font-weight: 750;
        margin-bottom: 12px;
    }

    .bp-help-box p {
        color: #62777b;
        font-size: 14px;
        line-height: 1.8;
        max-width: 700px;
    }

    .bp-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        padding: 12px 20px;
        border-radius: 12px;
        background: var(--bp-teal);
        color: #fff;
        text-decoration: none;
        font-size: 14px;
        font-weight: 650;
        transition: .2s;
    }

    .bp-btn:hover {
        background: #31565c;
        color: #fff;
        transform: translateY(-2px);
    }

    .bp-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--bp-teal);
        font-size: 14px;
        font-weight: 650;
        text-decoration: none;
        margin-top: 30px;
    }

    .bp-back:hover {
        color: #31565c;
    }

    @media (max-width: 768px) {
        .bp-hero {
            padding: 32px 25px;
        }

        .bp-content-card {
            padding: 22px;
        }

        .bp-help-box {
            padding: 25px;
        }
    }
</style>

<div class="bullying-page">
    <div class="container">

        {{-- Breadcrumb --}}
        <div class="bp-breadcrumb">
            <a href="{{ url('/') }}">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ url('/informasi-edukasi') }}">Edukasi & SOP</a>
            <span class="mx-2">/</span>
            <span>Perundungan</span>
        </div>

        {{-- Hero --}}
        <section class="bp-hero">
            <div class="bp-label">
                <i class="bi bi-book"></i>
                MATERI EDUKASI
            </div>

            <h1>Mengenal Perundungan (Bullying)</h1>

            <p>
                Lingkungan kampus seharusnya menjadi tempat untuk belajar,
                berkembang, dan saling menghargai. Kenali perilaku
                perundungan agar kita dapat membangun lingkungan akademik
                yang aman, nyaman, dan bebas dari intimidasi.
            </p>
        </section>

        {{-- Pengertian --}}
        <section class="bp-section">
            <div class="bp-section-heading">
                <h2>Apa yang Dimaksud dengan Perundungan?</h2>
                <p>Memahami pengertian dan karakteristik perundungan.</p>
            </div>

            <div class="bp-content-card">
                <p>
                    Perundungan atau bullying merupakan perilaku agresif
                    yang dilakukan secara sengaja dan berulang untuk
                    menyakiti, merendahkan, mengintimidasi, atau
                    mengendalikan orang lain.
                </p>

                <p class="mb-0">
                    Perundungan dapat terjadi ketika terdapat
                    ketidakseimbangan kekuatan atau posisi antara pihak
                    yang melakukan dan pihak yang menjadi sasaran.
                    Perilaku ini dapat berlangsung secara langsung maupun
                    melalui media digital.
                </p>
            </div>
        </section>

        {{-- Bentuk perundungan --}}
        <section class="bp-section">
            <div class="bp-section-heading">
                <h2>Bentuk-Bentuk Perundungan</h2>
                <p>
                    Perundungan dapat muncul dalam berbagai bentuk,
                    tidak hanya melalui tindakan fisik.
                </p>
            </div>

            <div class="row g-3">

                <div class="col-md-6">
                    <div class="bp-content-card">
                        <div class="bp-icon">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <h3>Perundungan Fisik</h3>
                        <p>
                            Menggunakan tindakan fisik untuk menyakiti,
                            mengganggu, atau mengintimidasi seseorang.
                            Misalnya mendorong atau menghalangi seseorang
                            secara sengaja.
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="bp-content-card">
                        <div class="bp-icon">
                            <i class="bi bi-chat-square-text"></i>
                        </div>
                        <h3>Perundungan Verbal</h3>
                        <p>
                            Menghina, mengejek, memberikan julukan
                            merendahkan, atau mengucapkan kata-kata
                            yang menyakiti seseorang secara berulang.
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="bp-content-card">
                        <div class="bp-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h3>Perundungan Sosial</h3>
                        <p>
                            Mengucilkan seseorang, menyebarkan rumor,
                            mempermalukan, atau sengaja merusak hubungan
                            sosial seseorang dengan lingkungannya.
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="bp-content-card">
                        <div class="bp-icon">
                            <i class="bi bi-phone"></i>
                        </div>
                        <h3>Perundungan Siber (Cyberbullying)</h3>
                        <p>
                            Menggunakan media digital untuk menghina,
                            mempermalukan, mengintimidasi, atau
                            mengganggu seseorang.
                        </p>
                    </div>
                </div>

            </div>
        </section>

        {{-- Contoh kampus --}}
        <section class="bp-section">
            <div class="bp-section-heading">
                <h2>Contoh Perundungan di Lingkungan Kampus</h2>
                <p>
                    Berikut beberapa ilustrasi situasi yang dapat
                    membantu mengenali perilaku perundungan.
                </p>
            </div>

            <div class="bp-content-card">

                <div class="bp-example">
                    <i class="bi bi-check-circle-fill"></i>
                    <p>
                        Seorang mahasiswa terus-menerus dijadikan bahan
                        ejekan oleh teman-temannya karena penampilan
                        atau kondisi pribadinya.
                    </p>
                </div>

                <div class="bp-example">
                    <i class="bi bi-check-circle-fill"></i>
                    <p>
                        Sekelompok mahasiswa sengaja mengucilkan satu
                        orang dari kegiatan kelompok dan menyebarkan
                        rumor yang merugikan dirinya.
                    </p>
                </div>

                <div class="bp-example">
                    <i class="bi bi-check-circle-fill"></i>
                    <p>
                        Seseorang berulang kali mempermalukan mahasiswa
                        lain di hadapan teman-temannya untuk membuatnya
                        merasa rendah diri.
                    </p>
                </div>

                <div class="bp-example">
                    <i class="bi bi-check-circle-fill"></i>
                    <p>
                        Seorang mahasiswa menerima pesan atau unggahan
                        digital yang berulang kali ditujukan untuk
                        mengintimidasi atau mempermalukannya.
                    </p>
                </div>

            </div>
        </section>

        {{-- Perbedaan konflik dan perundungan --}}
        <section class="bp-section">
            <div class="bp-section-heading">
                <h2>Perbedaan Konflik dan Perundungan</h2>
                <p>
                    Tidak setiap perselisihan atau perbedaan pendapat
                    dapat langsung disebut sebagai perundungan.
                </p>
            </div>

            <div class="row g-3">

                <div class="col-md-6">
                    <div class="bp-content-card">
                        <div class="bp-icon">
                            <i class="bi bi-chat-left-dots"></i>
                        </div>

                        <h3>Konflik</h3>

                        <ul>
                            <li>Perbedaan pendapat atau kepentingan.</li>
                            <li>Dapat terjadi antara pihak yang memiliki posisi relatif setara.</li>
                            <li>Tidak selalu melibatkan perilaku agresif yang berulang.</li>
                            <li>Dapat diselesaikan melalui komunikasi dan kesepakatan.</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="bp-content-card">
                        <div class="bp-icon">
                            <i class="bi bi-shield-exclamation"></i>
                        </div>

                        <h3>Perundungan</h3>

                        <ul>
                            <li>Melibatkan perilaku agresif yang disengaja.</li>
                            <li>Dapat terjadi karena ketidakseimbangan kekuatan.</li>
                            <li>Cenderung berlangsung berulang.</li>
                            <li>Dapat membuat seseorang merasa takut atau tidak aman.</li>
                        </ul>
                    </div>
                </div>

            </div>
        </section>

        {{-- Dampak --}}
        <section class="bp-section">
            <div class="bp-section-heading">
                <h2>Dampak Perundungan</h2>
                <p>
                    Perundungan dapat memengaruhi berbagai aspek
                    kehidupan seseorang.
                </p>
            </div>

            <div class="row g-3">

                <div class="col-md-4">
                    <div class="bp-content-card">
                        <div class="bp-icon">
                            <i class="bi bi-heart"></i>
                        </div>
                        <h3>Dampak Emosional</h3>
                        <p>
                            Dapat menimbulkan rasa takut, malu,
                            kehilangan kepercayaan diri, dan
                            tekanan emosional.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="bp-content-card">
                        <div class="bp-icon">
                            <i class="bi bi-mortarboard"></i>
                        </div>
                        <h3>Dampak Akademik</h3>
                        <p>
                            Dapat mengganggu konsentrasi, motivasi
                            belajar, kehadiran, dan partisipasi
                            dalam kegiatan perkuliahan.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="bp-content-card">
                        <div class="bp-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h3>Dampak Sosial</h3>
                        <p>
                            Dapat membuat seseorang merasa terasing,
                            sulit mempercayai orang lain, atau
                            enggan berinteraksi dengan lingkungan.
                        </p>
                    </div>
                </div>

            </div>
        </section>

        {{-- Hal yang perlu dipahami --}}
        <section class="bp-section">
            <div class="bp-section-heading">
                <h2>Hal yang Perlu Dipahami</h2>
            </div>

            <div class="bp-note">
                <h3>
                    <i class="bi bi-info-circle me-2"></i>
                    Senioritas bukan alasan untuk melakukan perundungan
                </h3>

                <p>
                    Perbedaan angkatan, jabatan organisasi, pengalaman,
                    atau kedudukan tidak memberikan hak kepada seseorang
                    untuk merendahkan, mengintimidasi, maupun menyakiti
                    orang lain. Kegiatan pengenalan lingkungan kampus
                    dan organisasi harus tetap menghormati martabat
                    serta keselamatan setiap mahasiswa.
                </p>
            </div>

            <div class="bp-note mt-3">
                <h3>
                    <i class="bi bi-info-circle me-2"></i>
                    Perundungan dan kekerasan seksual perlu dibedakan
                </h3>

                <p>
                    Perundungan merupakan kategori perilaku yang luas.
                    Apabila suatu tindakan perundungan mengandung unsur
                    kekerasan seksual, tindakan tersebut juga perlu
                    ditangani berdasarkan ketentuan mengenai kekerasan
                    seksual. Klasifikasi hukumnya harus memperhatikan
                    fakta dan unsur perbuatan.
                </p>
            </div>
        </section>

        {{-- Perlindungan --}}
        <section class="bp-section">
            <div class="bp-section-heading">
                <h2>Jika Mengalami atau Mengetahui Perundungan</h2>
                <p>
                    Jangan menganggap perundungan sebagai sesuatu
                    yang harus diterima atau dianggap biasa.
                </p>
            </div>

            <div class="bp-content-card">
                <ul>
                    <li>
                        Utamakan keselamatan dan cari lingkungan
                        yang membuatmu merasa aman.
                    </li>
                    <li>
                        Ceritakan kejadian kepada orang yang dipercaya
                        atau pihak kampus yang berwenang.
                    </li>
                    <li>
                        Catat kejadian dan simpan bukti yang tersedia
                        apabila aman untuk dilakukan.
                    </li>
                    <li>
                        Jika terjadi melalui media digital, simpan
                        informasi yang relevan dan hindari menyebarkan
                        ulang konten yang merugikan.
                    </li>
                    <li>
                        Hubungi layanan kampus yang sesuai untuk
                        mendapatkan informasi dan pendampingan.
                    </li>
                </ul>
            </div>
        </section>

        {{-- Landasan hukum --}}
        <section class="bp-section">
            <div class="bp-section-heading">
                <h2>Landasan Hukum dan Kebijakan Terkait</h2>
                <p>
                    Penanganan perundungan dapat melibatkan beberapa
                    peraturan dan kebijakan sesuai konteks kejadian.
                </p>
            </div>

            <div class="bp-content-card">
                <h3>Undang-Undang Nomor 12 Tahun 2012</h3>
                <p>
                    Undang-Undang tentang Pendidikan Tinggi menjadi
                    salah satu landasan penyelenggaraan pendidikan
                    tinggi yang bertanggung jawab.
                </p>

                <a href="https://peraturan.bpk.go.id/Details/39063/uu-no-12-tahun-2012"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="bp-back">
                    Lihat peraturan
                    <i class="bi bi-box-arrow-up-right"></i>
                </a>

                <hr class="my-4">

                <h3>Undang-Undang Nomor 12 Tahun 2022</h3>
                <p>
                    Undang-Undang tentang Tindak Pidana Kekerasan Seksual
                    dapat menjadi rujukan apabila perundungan yang
                    terjadi juga memenuhi unsur tindak pidana
                    kekerasan seksual.
                </p>

                <a href="https://peraturan.bpk.go.id/Details/207944/uu-no-12-tahun-2022"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="bp-back">
                    Lihat peraturan
                    <i class="bi bi-box-arrow-up-right"></i>
                </a>
            </div>
        </section>

        {{-- CTA --}}
        <section class="bp-help-box">
            <h2>Kampus yang Aman Dimulai dari Saling Menghargai</h2>

            <p>
                Jika kamu mengalami atau mengetahui perundungan,
                jangan ragu mencari bantuan. Kamu dapat menghubungi
                pihak kampus atau Satgas PPKS FSH UINSA apabila
                kejadian tersebut berkaitan dengan kekerasan seksual
                atau berada dalam lingkup kewenangannya.
            </p>

            <a href="{{ url('/lapor') }}" class="bp-btn">
                Buat Pengaduan
                <i class="bi bi-arrow-right"></i>
            </a>
        </section>

        {{-- Kembali --}}
        <a href="{{ url('/informasi-edukasi') }}" class="bp-back">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Informasi dan Edukasi
        </a>

    </div>
</div>

@endsection
