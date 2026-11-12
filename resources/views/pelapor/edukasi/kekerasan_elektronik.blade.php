
@extends('layouts.app')

@section('title', 'Kekerasan Berbasis Elektronik - Edukasi PPKS FSH UINSA')

@section('content')

<style>
    .electronic-detail-page {
        --ed-ink: #344B50;
        --ed-muted: #71838A;
        --ed-teal: #416C72;
        --ed-blue: #DCE8F4;
        --ed-sage: #DCE9E2;
        --ed-lavender: #E9E2F2;
        --ed-cream: #F5EFE8;
        --ed-white: #FFFFFF;

        color: var(--ed-ink);
        padding-bottom: 75px;
    }

    .ed-container {
        width: min(1080px, calc(100% - 40px));
        margin: auto;
    }

    .ed-breadcrumb {
        padding: 25px 0 18px;
        font-size: 13px;
        color: var(--ed-muted);
    }

    .ed-breadcrumb a {
        color: var(--ed-teal);
        text-decoration: none;
    }

    .ed-breadcrumb span {
        margin: 0 8px;
    }

    .ed-hero {
        background: linear-gradient(120deg, #DCE8F4, #E9E2F2);
        border-radius: 25px;
        padding: 55px 45px;
        position: relative;
        overflow: hidden;
        margin-bottom: 45px;
    }

    .ed-hero::after {
        content: "\f5fc";
        font-family: "bootstrap-icons";
        position: absolute;
        right: 55px;
        bottom: -35px;
        font-size: 190px;
        color: rgba(255,255,255,.45);
        transform: rotate(-12deg);
    }

    .ed-hero-content {
        position: relative;
        z-index: 1;
        max-width: 650px;
    }

    .ed-label {
        display: inline-block;
        padding: 8px 15px;
        border-radius: 30px;
        background: rgba(255,255,255,.65);
        color: var(--ed-teal);
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 18px;
    }

    .ed-hero h1 {
        font-size: clamp(28px, 4vw, 42px);
        line-height: 1.2;
        font-weight: 700;
        margin-bottom: 18px;
    }

    .ed-hero p {
        color: #596E74;
        line-height: 1.8;
        font-size: 15px;
        margin-bottom: 25px;
    }

    .ed-btn {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        background: var(--ed-teal);
        color: white;
        padding: 12px 21px;
        border-radius: 30px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        transition: .2s;
    }

    .ed-btn:hover {
        background: #31575D;
        color: white;
        transform: translateY(-2px);
    }

    .ed-section {
        margin-bottom: 42px;
    }

    .ed-section-heading {
        margin-bottom: 20px;
    }

    .ed-section-heading small {
        color: var(--ed-teal);
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .ed-section-heading h2 {
        font-size: 25px;
        font-weight: 700;
        margin: 8px 0;
    }

    .ed-section-heading p {
        color: var(--ed-muted);
        font-size: 14px;
        line-height: 1.8;
        max-width: 760px;
        margin: 0;
    }

    .ed-content-card {
        background: white;
        border: 1px solid #E8EDEF;
        border-radius: 18px;
        padding: 25px;
        margin-bottom: 16px;
    }

    .ed-content-card h3 {
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .ed-content-card p {
        color: var(--ed-muted);
        font-size: 14px;
        line-height: 1.85;
        margin-bottom: 0;
    }

    .ed-icon {
        width: 43px;
        height: 43px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        font-size: 20px;
        margin-bottom: 15px;
        background: var(--ed-blue);
        color: var(--ed-teal);
    }

    .ed-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .ed-example {
        background: #F8FAFB;
        border: 1px solid #E9EFF0;
        padding: 19px;
        border-radius: 15px;
    }

    .ed-example h4 {
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .ed-example p {
        color: var(--ed-muted);
        font-size: 13px;
        line-height: 1.75;
        margin: 0;
    }

    .ed-note {
        background: #F5F0F9;
        border-left: 4px solid #A99BC0;
        border-radius: 12px;
        padding: 20px 22px;
        margin-top: 20px;
    }

    .ed-note strong {
        display: block;
        margin-bottom: 7px;
        font-size: 14px;
    }

    .ed-note p {
        color: var(--ed-muted);
        font-size: 13px;
        line-height: 1.8;
        margin: 0;
    }

    .ed-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .ed-list li {
        display: flex;
        gap: 12px;
        margin-bottom: 15px;
        color: var(--ed-muted);
        font-size: 14px;
        line-height: 1.8;
    }

    .ed-list i {
        color: var(--ed-teal);
        margin-top: 3px;
        flex-shrink: 0;
    }

    .ed-highlight {
        background: linear-gradient(120deg, #E7F0F5, #E8EFE9);
        border-radius: 20px;
        padding: 28px;
    }

    .ed-highlight h3 {
        font-size: 19px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .ed-highlight p {
        color: var(--ed-muted);
        font-size: 14px;
        line-height: 1.85;
        margin: 0;
    }

    .ed-legal {
        background: var(--ed-cream);
        border-radius: 17px;
        padding: 23px;
        margin-bottom: 13px;
    }

    .ed-legal h4 {
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .ed-legal p {
        color: var(--ed-muted);
        font-size: 13px;
        line-height: 1.8;
        margin: 0;
    }

   
.ed-bottom {
    background: linear-gradient(120deg, #DCE8F4, #E9E2F2);
    border-radius: 22px;
    padding: 32px;
    margin-top: 45px;
}

.ed-bottom-content {
    display: flex;
    align-items: center;
    gap: 22px;
}

.ed-bottom-icon {
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

.ed-bottom-text {
    flex: 1;
}

.ed-bottom h2 {
    font-size: 20px;
    font-weight: 700;
    color: #344B50;
    margin-bottom: 9px;
}

.ed-bottom p {
    color: #71838A;
    font-size: 13px;
    line-height: 1.8;
    margin: 0;
}

.ed-bottom .ed-btn {
    background: #416C72;
    color: white;
    white-space: nowrap;
    flex-shrink: 0;
}

.ed-bottom .ed-btn:hover {
    background: #31575D;
    color: white;
}

@media (max-width: 768px) {
    .ed-bottom-content {
        flex-direction: column;
        align-items: flex-start;
    }

    .ed-bottom .ed-btn {
        align-self: flex-start;
    }
}


    .ed-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--ed-teal);
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        margin-top: 25px;
    }

    .ed-back:hover {
        color: #294E54;
    }

    @media (max-width: 768px) {
        .ed-container {
            width: min(100% - 28px, 1080px);
        }

        .ed-hero {
            padding: 38px 25px;
        }

        .ed-hero::after {
            right: 5px;
            font-size: 120px;
        }

        .ed-grid {
            grid-template-columns: 1fr;
        }

        .ed-content-card {
            padding: 21px;
        }

        .ed-bottom {
            padding: 28px 20px;
        }
    }
</style>

<div class="electronic-detail-page">
    <div class="ed-container">

        {{-- BREADCRUMB --}}
        <div class="ed-breadcrumb">
            <a href="{{ url('/') }}">Beranda</a>
            <span>/</span>
            <a href="{{ url('/informasi-edukasi') }}">Edukasi & SOP</a>
            <span>/</span>
            <span>Kekerasan Berbasis Elektronik</span>
        </div>

        {{-- HERO --}}
        <section class="ed-hero">
            <div class="ed-hero-content">
                <span class="ed-label">
                    <i class="bi bi-shield-lock me-1"></i>
                    Edukasi dan Pencegahan
                </span>

                <h1>Mengenal Kekerasan Berbasis Elektronik</h1>

                <p>
                    Ruang digital seharusnya menjadi tempat yang aman untuk
                    berkomunikasi, belajar, dan berekspresi. Kenali tindakan
                    yang melanggar batas, mengganggu privasi, atau merugikan
                    orang lain melalui teknologi digital.
                </p>

                <a href="#pengertian" class="ed-btn">
                    Mulai Membaca
                    <i class="bi bi-arrow-down"></i>
                </a>
            </div>
        </section>

        {{-- PENGERTIAN --}}
        <section class="ed-section" id="pengertian">
            <div class="ed-section-heading">
                <small>01 — Pengertian</small>
                <h2>Apa Itu Kekerasan Berbasis Elektronik?</h2>
                <p>
                    Memahami tindakan yang menggunakan perangkat dan media
                    digital untuk mengganggu, mengancam, merendahkan, atau
                    merugikan seseorang.
                </p>
            </div>

            <div class="ed-content-card">
                <div class="ed-icon">
                    <i class="bi bi-phone"></i>
                </div>

                <h3>Pengertian Umum</h3>

                <p>
                    Kekerasan berbasis elektronik merupakan istilah untuk
                    tindakan merugikan yang dilakukan melalui sarana digital,
                    seperti telepon genggam, komputer, media sosial, aplikasi
                    pesan, atau platform daring lainnya. Tindakan tersebut
                    dapat berkaitan dengan pelecehan, intimidasi, ancaman,
                    penyalahgunaan informasi pribadi, maupun penyebaran
                    konten tanpa persetujuan.
                </p>
            </div>

            <div class="ed-note">
                <strong>
                    <i class="bi bi-info-circle me-1"></i>
                    Perlu dipahami
                </strong>
                <p>
                    Kekerasan berbasis elektronik merupakan istilah yang luas.
                    Dalam konteks UU TPKS, terdapat bentuk khusus yang disebut
                    kekerasan seksual berbasis elektronik (KSBE). Tidak semua
                    konflik, komentar negatif, atau tindakan tidak menyenangkan
                    di internet otomatis termasuk KSBE. Penilaian perlu
                    memperhatikan bentuk tindakan dan unsur hukumnya.
                </p>
            </div>
        </section>

        {{-- BENTUK-BENTUK --}}
        <section class="ed-section">
            <div class="ed-section-heading">
                <small>02 — Bentuk Tindakan</small>
                <h2>Bentuk-Bentuk Kekerasan di Ruang Digital</h2>
                <p>
                    Berikut beberapa contoh tindakan yang dapat terjadi
                    melalui teknologi dan media elektronik.
                </p>
            </div>

            <div class="ed-grid">

                <div class="ed-content-card">
                    <div class="ed-icon">
                        <i class="bi bi-chat-square-text"></i>
                    </div>
                    <h3>Pelecehan Melalui Pesan Digital</h3>
                    <p>
                        Mengirimkan pesan, komentar, atau komunikasi yang
                        mengandung pelecehan, ancaman, maupun unsur seksual
                        yang tidak dikehendaki oleh penerimanya.
                    </p>
                </div>

                <div class="ed-content-card">
                    <div class="ed-icon">
                        <i class="bi bi-camera"></i>
                    </div>
                    <h3>Penyebaran Konten Tanpa Persetujuan</h3>
                    <p>
                        Menyebarkan atau memperlihatkan konten pribadi
                        seseorang tanpa persetujuan, termasuk konten yang
                        melanggar privasi atau berkaitan dengan kekerasan
                        seksual berbasis elektronik.
                    </p>
                </div>

                <div class="ed-content-card">
                    <div class="ed-icon">
                        <i class="bi bi-person-lock"></i>
                    </div>
                    <h3>Penyalahgunaan Identitas Digital</h3>
                    <p>
                        Menggunakan identitas, foto, atau informasi pribadi
                        orang lain tanpa izin untuk tujuan yang merugikan,
                        menipu, mempermalukan, atau mengintimidasi.
                    </p>
                </div>

                <div class="ed-content-card">
                    <div class="ed-icon">
                        <i class="bi bi-broadcast"></i>
                    </div>
                    <h3>Intimidasi dan Ancaman Daring</h3>
                    <p>
                        Menggunakan media sosial, aplikasi pesan, atau
                        platform digital untuk mengancam, meneror,
                        mempermalukan, atau menekan seseorang.
                    </p>
                </div>

                <div class="ed-content-card">
                    <div class="ed-icon">
                        <i class="bi bi-share"></i>
                    </div>
                    <h3>Penyebaran Informasi Pribadi</h3>
                    <p>
                        Membagikan informasi pribadi seseorang tanpa
                        persetujuan sehingga dapat mengganggu keamanan,
                        kenyamanan, dan privasinya.
                    </p>
                </div>

                <div class="ed-content-card">
                    <div class="ed-icon">
                        <i class="bi bi-globe"></i>
                    </div>
                    <h3>Pelecehan di Platform Daring</h3>
                    <p>
                        Melakukan tindakan yang merendahkan atau melecehkan
                        seseorang melalui forum, grup percakapan, ruang kelas
                        virtual, maupun platform digital lainnya.
                    </p>
                </div>

            </div>
        </section>

        {{-- CONTOH DI KAMPUS --}}
        <section class="ed-section">
            <div class="ed-section-heading">
                <small>03 — Contoh di Lingkungan Kampus</small>
                <h2>Bagaimana Hal Ini Bisa Terjadi?</h2>
                <p>
                    Beberapa situasi berikut dapat menjadi gambaran tindakan
                    yang perlu diwaspadai dalam kehidupan mahasiswa.
                </p>
            </div>

            <div class="ed-grid">
                <div class="ed-example">
                    <h4>
                        <i class="bi bi-chat-dots me-2"></i>
                        Grup Percakapan
                    </h4>
                    <p>
                        Seseorang terus menerima pesan yang melecehkan,
                        mengintimidasi, atau merendahkan dirinya dalam grup
                        komunikasi mahasiswa.
                    </p>
                </div>

                <div class="ed-example">
                    <h4>
                        <i class="bi bi-instagram me-2"></i>
                        Media Sosial
                    </h4>
                    <p>
                        Foto atau informasi pribadi mahasiswa disebarkan
                        tanpa persetujuannya dengan tujuan mempermalukan
                        atau merugikan.
                    </p>
                </div>

                <div class="ed-example">
                    <h4>
                        <i class="bi bi-envelope me-2"></i>
                        Pesan Pribadi
                    </h4>
                    <p>
                        Seseorang menerima komunikasi bernada ancaman,
                        pelecehan, atau tekanan yang membuatnya merasa
                        tidak aman.
                    </p>
                </div>

                <div class="ed-example">
                    <h4>
                        <i class="bi bi-camera-video me-2"></i>
                        Konten Digital
                    </h4>
                    <p>
                        Konten pribadi seseorang digunakan atau disebarkan
                        tanpa persetujuannya dan menimbulkan kerugian
                        bagi orang tersebut.
                    </p>
                </div>
            </div>
        </section>

        {{-- DAMPAK --}}
        <section class="ed-section">
            <div class="ed-section-heading">
                <small>04 — Dampak</small>
                <h2>Dampak terhadap Korban</h2>
                <p>
                    Kekerasan di ruang digital dapat memberikan dampak
                    yang meluas hingga kehidupan sehari-hari.
                </p>
            </div>

            <div class="ed-grid">
                <div class="ed-content-card">
                    <div class="ed-icon">
                        <i class="bi bi-heart-pulse"></i>
                    </div>
                    <h3>Dampak Psikologis</h3>
                    <p>
                        Dapat menimbulkan rasa takut, cemas, malu, kehilangan
                        rasa aman, dan kesulitan mempercayai orang lain.
                    </p>
                </div>

                <div class="ed-content-card">
                    <div class="ed-icon">
                        <i class="bi bi-mortarboard"></i>
                    </div>
                    <h3>Dampak Akademik</h3>
                    <p>
                        Korban dapat mengalami kesulitan berkonsentrasi,
                        mengikuti kegiatan perkuliahan, atau berinteraksi
                        di lingkungan kampus.
                    </p>
                </div>

                <div class="ed-content-card">
                    <div class="ed-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <h3>Dampak Sosial</h3>
                    <p>
                        Dapat memengaruhi hubungan pertemanan, kepercayaan
                        sosial, serta kenyamanan korban dalam menggunakan
                        ruang digital.
                    </p>
                </div>

                <div class="ed-content-card">
                    <div class="ed-icon">
                        <i class="bi bi-shield-exclamation"></i>
                    </div>
                    <h3>Dampak terhadap Privasi</h3>
                    <p>
                        Informasi pribadi yang disalahgunakan dapat
                        menimbulkan kekhawatiran terhadap keamanan dan
                        kendali atas data diri.
                    </p>
                </div>
            </div>
        </section>

        {{-- LANGKAH PERLINDUNGAN --}}
        <section class="ed-section">
            <div class="ed-section-heading">
                <small>05 — Perlindungan</small>
                <h2>Apa yang Dapat Dilakukan?</h2>
                <p>
                    Jika mengalami atau mengetahui tindakan yang merugikan
                    di ruang digital, terdapat beberapa langkah yang dapat
                    dipertimbangkan.
                </p>
            </div>

            <div class="ed-content-card">
                <ul class="ed-list">
                    <li>
                        <i class="bi bi-check-circle-fill"></i>
                        <span>
                            <strong>Utamakan keamanan diri.</strong>
                            Hindari interaksi lebih lanjut apabila komunikasi
                            tersebut membuatmu merasa terancam.
                        </span>
                    </li>

                    <li>
                        <i class="bi bi-check-circle-fill"></i>
                        <span>
                            <strong>Simpan informasi yang relevan dengan aman.</strong>
                            Jika aman dilakukan, catat waktu kejadian,
                            platform yang digunakan, dan informasi akun terkait.
                            Jangan menyebarkan ulang konten sensitif.
                        </span>
                    </li>

                    <li>
                        <i class="bi bi-check-circle-fill"></i>
                        <span>
                            <strong>Manfaatkan fitur keamanan platform.</strong>
                            Kamu dapat mempertimbangkan fitur blokir,
                            pembatasan interaksi, atau pelaporan akun sesuai
                            kebutuhan dan situasi keamananmu.
                        </span>
                    </li>

                    <li>
                        <i class="bi bi-check-circle-fill"></i>
                        <span>
                            <strong>Cari dukungan dari pihak tepercaya.</strong>
                            Ceritakan situasi yang dialami kepada orang
                            yang dipercaya atau pihak kampus yang berwenang.
                        </span>
                    </li>

                    <li>
                        <i class="bi bi-check-circle-fill"></i>
                        <span>
                            <strong>Hubungi Satgas PPKS jika sesuai dengan ruang lingkupnya.</strong>
                            Kamu dapat meminta informasi mengenai prosedur
                            pengaduan dan bentuk pendampingan yang tersedia.
                        </span>
                    </li>
                </ul>
            </div>

            <div class="ed-highlight">
                <h3>
                    <i class="bi bi-shield-check me-2"></i>
                    Privasi dan Keamanan Korban Harus Diutamakan
                </h3>
                <p>
                    Korban tidak perlu menyebarkan konten pribadi atau
                    sensitif untuk membuktikan pengalamannya kepada publik.
                    Penanganan informasi dan bukti sebaiknya dilakukan
                    melalui saluran yang aman dan oleh pihak yang berwenang
                    sesuai prosedur.
                </p>
            </div>
        </section>

        {{-- LANDASAN HUKUM --}}
        <section class="ed-section">
            <div class="ed-section-heading">
                <small>06 — Landasan Hukum</small>
                <h2>Regulasi yang Berkaitan</h2>
                <p>
                    Penanganan tindakan berbasis elektronik dapat berkaitan
                    dengan beberapa ketentuan hukum. Penerapannya bergantung
                    pada bentuk tindakan dan unsur yang terpenuhi.
                </p>
            </div>

            <div class="ed-legal">
                <h4>UU Nomor 12 Tahun 2022 tentang Tindak Pidana Kekerasan Seksual</h4>
                <p>
                    Mengatur kekerasan seksual berbasis elektronik dalam
                    Pasal 14. Ketentuan ini berkaitan dengan tindakan
                    tertentu yang dilakukan menggunakan sarana elektronik
                    dan memenuhi unsur sebagaimana diatur dalam undang-undang.
                </p>
            </div>

            <div class="ed-legal">
                <h4>UU Nomor 1 Tahun 2024 tentang Perubahan Kedua atas UU ITE</h4>
                <p>
                    Mengatur berbagai ketentuan terkait aktivitas dan
                    informasi elektronik. Penerapannya perlu disesuaikan
                    dengan jenis perbuatan dan ketentuan yang berlaku.
                </p>
            </div>

            <div class="ed-legal">
                <h4>Ketentuan Perlindungan Data Pribadi</h4>
                <p>
                    UU Nomor 27 Tahun 2022 tentang Pelindungan Data Pribadi
                    menjadi salah satu landasan dalam memahami hak atas
                    pelindungan data pribadi dan kewajiban terkait
                    pemrosesannya.
                </p>
            </div>

            <div class="ed-note">
                <strong>
                    <i class="bi bi-bookmark-check me-1"></i>
                    Catatan hukum
                </strong>
                <p>
                    Informasi ini merupakan pengantar edukasi, bukan
                    penetapan bahwa suatu kejadian pasti merupakan tindak
                    pidana tertentu. Penilaian hukum perlu dilakukan
                    berdasarkan fakta dan ketentuan yang berlaku.
                </p>
            </div>
        </section>

        
{{-- CTA --}}
<section class="ed-bottom">
    <div class="ed-bottom-content">
        <div class="ed-bottom-icon">
            <i class="bi bi-shield-check"></i>
        </div>

        <div class="ed-bottom-text">
            <h2>Kamu Berhak Merasa Aman di Ruang Digital</h2>
            <p>
                Jika mengalami tindakan yang termasuk dalam ruang lingkup
                penanganan Satgas PPKS, kamu dapat mempelajari prosedur
                pengaduan dan menghubungi pihak yang berwenang di lingkungan
                kampus.
            </p>
        </div>

        <a href="{{ url('/lapor') }}" class="ed-btn">
            Buat Pengaduan
            <i class="bi bi-arrow-right"></i>
        </a>
    </div>
</section>


        <a href="{{ url('/informasi-edukasi') }}" class="ed-back">
            <i class="bi bi-arrow-left"></i>
            Kembali ke halaman Edukasi & SOP
        </a>

    </div>
</div>

@endsection
