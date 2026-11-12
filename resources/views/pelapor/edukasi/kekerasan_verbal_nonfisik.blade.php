
@extends('layouts.app')

@section('title', 'Kekerasan Verbal dan Nonfisik - Edukasi PPKS FSH UINSA')

@section('content')

<style>
    .verbal-detail-page {
        --vd-ink: #344b50;
        --vd-muted: #71838a;
        --vd-teal: #416c72;
        --vd-blue: #dce8f4;
        --vd-sage: #dce9e2;
        --vd-lavender: #e9e2f2;
        --vd-cream: #f5efe8;

        color: var(--vd-ink);
        padding-bottom: 75px;
    }

    .verbal-detail-page .container {
        max-width: 1100px;
    }

    .vd-breadcrumb {
        padding: 28px 0 20px;
        font-size: 13px;
        color: var(--vd-muted);
    }

    .vd-breadcrumb a {
        color: var(--vd-teal);
        text-decoration: none;
    }

    .vd-breadcrumb a:hover {
        text-decoration: underline;
    }

    .vd-hero {
        position: relative;
        overflow: hidden;
        padding: 55px;
        border-radius: 28px;
        background: linear-gradient(
            125deg,
            #e9e2f2 0%,
            #dce8f4 55%,
            #dce9e2 100%
        );
        margin-bottom: 45px;
    }

    .vd-hero::after {
        content: '';
        position: absolute;
        width: 250px;
        height: 250px;
        right: -65px;
        top: -90px;
        border-radius: 50%;
        background: rgba(255,255,255,.25);
    }

    .vd-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 15px;
        border-radius: 30px;
        background: rgba(255,255,255,.65);
        color: var(--vd-teal);
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .vd-hero h1 {
        max-width: 700px;
        font-size: clamp(30px, 4vw, 43px);
        font-weight: 750;
        line-height: 1.2;
        margin-bottom: 18px;
    }

    .vd-hero p {
        max-width: 700px;
        color: #5d7177;
        line-height: 1.8;
        margin-bottom: 0;
        font-size: 15px;
    }

    .vd-section {
        margin-bottom: 42px;
    }

    .vd-section-heading {
        margin-bottom: 20px;
    }

    .vd-section-heading h2 {
        font-size: 24px;
        font-weight: 750;
        margin-bottom: 9px;
    }

    .vd-section-heading p {
        color: var(--vd-muted);
        font-size: 14px;
        line-height: 1.7;
        margin-bottom: 0;
    }

    .vd-content-card {
        height: 100%;
        padding: 27px;
        border: 1px solid #e8eeee;
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 8px 25px rgba(52,75,80,.045);
    }

    .vd-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 15px;
        background: var(--vd-lavender);
        color: var(--vd-teal);
        font-size: 22px;
        margin-bottom: 17px;
    }

    .vd-content-card h3 {
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 11px;
    }

    .vd-content-card p,
    .vd-content-card li {
        font-size: 14px;
        color: var(--vd-muted);
        line-height: 1.8;
    }

    .vd-content-card ul {
        padding-left: 19px;
        margin-bottom: 0;
    }

    .vd-example {
        display: flex;
        gap: 15px;
        align-items: flex-start;
        padding: 17px 0;
        border-bottom: 1px solid #edf0f0;
    }

    .vd-example:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .vd-example i {
        color: var(--vd-teal);
        font-size: 18px;
        margin-top: 2px;
    }

    .vd-example p {
        margin: 0;
        font-size: 14px;
        line-height: 1.75;
    }

    .vd-note {
        padding: 24px;
        border-radius: 18px;
        background: #f3f6f8;
        border-left: 4px solid var(--vd-teal);
    }

    .vd-note h3 {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 9px;
    }

    .vd-note p {
        color: var(--vd-muted);
        font-size: 14px;
        line-height: 1.8;
        margin-bottom: 0;
    }

    .vd-help-box {
        padding: 32px;
        border-radius: 22px;
        background: linear-gradient(120deg, #dce9e2, #e9e2f2);
        margin-top: 45px;
    }

    .vd-help-box h2 {
        font-size: 23px;
        font-weight: 750;
        margin-bottom: 12px;
    }

    .vd-help-box p {
        color: #62777b;
        font-size: 14px;
        line-height: 1.8;
        max-width: 700px;
    }

    .vd-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        padding: 12px 20px;
        border-radius: 12px;
        background: var(--vd-teal);
        color: #fff;
        text-decoration: none;
        font-size: 14px;
        font-weight: 650;
        transition: .2s;
    }

    .vd-btn:hover {
        background: #31565c;
        color: #fff;
        transform: translateY(-2px);
    }

    .vd-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--vd-teal);
        font-size: 14px;
        font-weight: 650;
        text-decoration: none;
        margin-top: 30px;
    }

    .vd-back:hover {
        color: #31565c;
    }

    @media (max-width: 768px) {
        .vd-hero {
            padding: 32px 25px;
        }

        .vd-content-card {
            padding: 22px;
        }

        .vd-help-box {
            padding: 25px;
        }
    }
</style>

<div class="verbal-detail-page">
    <div class="container">

        {{-- Breadcrumb --}}
        <div class="vd-breadcrumb">
            <a href="{{ url('/') }}">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ url('/informasi-edukasi') }}">Edukasi & SOP</a>
            <span class="mx-2">/</span>
            <span>Kekerasan Verbal dan Nonfisik</span>
        </div>

        {{-- Hero --}}
        <section class="vd-hero">
            <div class="vd-label">
                <i class="bi bi-book"></i>
                MATERI EDUKASI
            </div>

            <h1>Mengenal Kekerasan Verbal dan Nonfisik</h1>

            <p>
                Kekerasan tidak selalu ditunjukkan melalui tindakan fisik.
                Ucapan, ancaman, intimidasi, dan perilaku yang merendahkan
                seseorang juga perlu dikenali agar tercipta lingkungan
                kampus yang aman, saling menghargai, dan bebas dari
                kekerasan.
            </p>
        </section>

        {{-- Pengertian --}}
        <section class="vd-section">
            <div class="vd-section-heading">
                <h2>Apa yang Dimaksud dengan Kekerasan Verbal dan Nonfisik?</h2>
                <p>Memahami tindakan yang dapat menyakiti tanpa kontak fisik.</p>
            </div>

            <div class="vd-content-card">
                <p>
                    Kekerasan verbal merupakan tindakan menggunakan kata-kata,
                    ucapan, atau komunikasi untuk merendahkan, menghina,
                    mengancam, mempermalukan, atau menyakiti orang lain.
                </p>

                <p class="mb-0">
                    Sementara itu, kekerasan nonfisik merupakan istilah
                    yang lebih luas untuk menggambarkan tindakan yang
                    dapat menimbulkan tekanan, rasa takut, atau penderitaan
                    psikologis tanpa harus melibatkan kontak fisik.
                    Bentuk dan klasifikasi hukumnya bergantung pada
                    karakteristik serta konteks kejadian.
                </p>
            </div>
        </section>

        {{-- Bentuk tindakan --}}
        <section class="vd-section">
            <div class="vd-section-heading">
                <h2>Bentuk-Bentuk Kekerasan Verbal dan Nonfisik</h2>
                <p>
                    Berikut beberapa contoh perilaku yang perlu dikenali
                    dalam interaksi sehari-hari.
                </p>
            </div>

            <div class="row g-3">

                <div class="col-md-6">
                    <div class="vd-content-card">
                        <div class="vd-icon">
                            <i class="bi bi-chat-square-text"></i>
                        </div>
                        <h3>Penghinaan dan Ucapan Merendahkan</h3>
                        <p>
                            Menggunakan kata-kata yang menghina, mengejek,
                            mempermalukan, atau merendahkan martabat
                            seseorang.
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="vd-content-card">
                        <div class="vd-icon">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                        <h3>Ancaman dan Intimidasi</h3>
                        <p>
                            Mengucapkan ancaman atau menggunakan kata-kata
                            yang bertujuan menimbulkan rasa takut dan
                            membuat seseorang merasa tertekan.
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="vd-content-card">
                        <div class="vd-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h3>Perundungan Verbal</h3>
                        <p>
                            Mengejek, memberikan julukan yang merendahkan,
                            atau mempermalukan seseorang, terutama ketika
                            dilakukan secara berulang.
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="vd-content-card">
                        <div class="vd-icon">
                            <i class="bi bi-heartbreak"></i>
                        </div>
                        <h3>Tekanan Psikologis</h3>
                        <p>
                            Perilaku seperti intimidasi, manipulasi,
                            atau pengucilan yang dapat membuat seseorang
                            merasa takut, tertekan, atau tidak aman.
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="vd-content-card">
                        <div class="vd-icon">
                            <i class="bi bi-chat-square-heart"></i>
                        </div>
                        <h3>Ucapan Bernuansa Seksual yang Tidak Diinginkan</h3>
                        <p>
                            Komentar, siulan, atau ucapan bernuansa seksual
                            yang tidak diinginkan dan membuat seseorang
                            merasa direndahkan atau tidak nyaman.
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="vd-content-card">
                        <div class="vd-icon">
                            <i class="bi bi-person-x"></i>
                        </div>
                        <h3>Pengucilan dan Perilaku Mengontrol</h3>
                        <p>
                            Mengucilkan, membatasi interaksi, atau
                            mengendalikan seseorang melalui tekanan
                            dan intimidasi.
                        </p>
                    </div>
                </div>

            </div>
        </section>

        {{-- Contoh kampus --}}
        <section class="vd-section">
            <div class="vd-section-heading">
                <h2>Contoh Situasi di Lingkungan Kampus</h2>
                <p>
                    Ilustrasi berikut membantu mengenali perilaku yang
                    dapat merugikan orang lain.
                </p>
            </div>

            <div class="vd-content-card">

                <div class="vd-example">
                    <i class="bi bi-check-circle-fill"></i>
                    <p>
                        Seorang mahasiswa terus-menerus diejek dan
                        dipermalukan oleh teman sekelasnya karena
                        penampilan atau latar belakang pribadinya.
                    </p>
                </div>

                <div class="vd-example">
                    <i class="bi bi-check-circle-fill"></i>
                    <p>
                        Seseorang mengancam akan mempermalukan mahasiswa
                        lain apabila tidak mengikuti keinginannya.
                    </p>
                </div>

                <div class="vd-example">
                    <i class="bi bi-check-circle-fill"></i>
                    <p>
                        Seorang mahasiswa menerima komentar bernuansa
                        seksual yang tidak diinginkan dari orang lain
                        di lingkungan kampus.
                    </p>
                </div>

                <div class="vd-example">
                    <i class="bi bi-check-circle-fill"></i>
                    <p>
                        Sekelompok mahasiswa sengaja mengucilkan dan
                        mempermalukan seseorang secara berulang sehingga
                        ia merasa tidak aman untuk mengikuti kegiatan kampus.
                    </p>
                </div>

            </div>
        </section>

        {{-- Dampak --}}
        <section class="vd-section">
            <div class="vd-section-heading">
                <h2>Dampak yang Dapat Ditimbulkan</h2>
                <p>
                    Kekerasan verbal dan nonfisik dapat memengaruhi
                    kesejahteraan serta aktivitas seseorang.
                </p>
            </div>

            <div class="row g-3">

                <div class="col-md-4">
                    <div class="vd-content-card">
                        <div class="vd-icon">
                            <i class="bi bi-emoji-frown"></i>
                        </div>
                        <h3>Dampak Emosional</h3>
                        <p>
                            Dapat menimbulkan rasa takut, malu, tertekan,
                            kehilangan rasa percaya diri, atau perasaan
                            tidak aman.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="vd-content-card">
                        <div class="vd-icon">
                            <i class="bi bi-mortarboard"></i>
                        </div>
                        <h3>Dampak Akademik</h3>
                        <p>
                            Dapat mengganggu konsentrasi, kenyamanan
                            belajar, partisipasi kelas, dan aktivitas
                            akademik.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="vd-content-card">
                        <div class="vd-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h3>Dampak Sosial</h3>
                        <p>
                            Dapat membuat seseorang menarik diri dari
                            lingkungan pertemanan atau merasa kesulitan
                            membangun hubungan yang sehat.
                        </p>
                    </div>
                </div>

            </div>
        </section>

        {{-- Hal penting --}}
        <section class="vd-section">
            <div class="vd-section-heading">
                <h2>Hal yang Perlu Dipahami</h2>
            </div>

            <div class="vd-note">
                <h3>
                    <i class="bi bi-info-circle me-2"></i>
                    Perbedaan pendapat tidak selalu merupakan kekerasan
                </h3>

                <p>
                    Kritik, diskusi, dan perbedaan pendapat merupakan
                    bagian dari kehidupan akademik. Namun, komunikasi
                    dapat menjadi bentuk perilaku yang merugikan ketika
                    digunakan untuk menghina, mengancam, mengintimidasi,
                    melecehkan, atau merendahkan seseorang. Penilaiannya
                    perlu memperhatikan konteks, pola tindakan, dampak,
                    serta ketentuan yang berlaku.
                </p>
            </div>

            <div class="vd-note mt-3">
                <h3>
                    <i class="bi bi-shield-check me-2"></i>
                    Kekerasan verbal dapat memiliki unsur seksual
                </h3>

                <p>
                    Ucapan atau komentar bernuansa seksual yang tidak
                    diinginkan dapat termasuk dalam pembahasan kekerasan
                    seksual nonfisik apabila memenuhi unsur yang diatur
                    dalam peraturan. Karena itu, tidak semua penghinaan
                    atau ucapan kasar otomatis dikategorikan sebagai
                    tindak pidana kekerasan seksual.
                </p>
            </div>
        </section>

        {{-- Perlindungan --}}
        <section class="vd-section">
            <div class="vd-section-heading">
                <h2>Jika Mengalami atau Mengetahui Kejadian</h2>
                <p>
                    Kamu berhak mendapatkan lingkungan kampus yang aman
                    dan memperoleh bantuan.
                </p>
            </div>

            <div class="vd-content-card">
                <ul>
                    <li>
                        Utamakan keselamatan dan kenyamanan diri.
                    </li>
                    <li>
                        Ceritakan pengalaman kepada orang yang dipercaya
                        atau petugas layanan yang berwenang.
                    </li>
                    <li>
                        Catat informasi kejadian atau simpan bukti yang
                        tersedia apabila aman untuk dilakukan.
                    </li>
                    <li>
                        Hubungi Satgas PPKS untuk memperoleh informasi
                        mengenai layanan pengaduan dan pendampingan.
                    </li>
                    <li>
                        Hindari menyebarkan identitas dan informasi pribadi
                        pihak yang terlibat kepada publik.
                    </li>
                </ul>
            </div>
        </section>

        {{-- Dasar hukum --}}
        <section class="vd-section">
            <div class="vd-section-heading">
                <h2>Landasan Hukum Terkait</h2>
                <p>
                    Rujukan hukum ditentukan berdasarkan bentuk tindakan
                    dan unsur yang terdapat dalam kejadian.
                </p>
            </div>

            <div class="vd-content-card">
                <h3>Undang-Undang Nomor 12 Tahun 2022</h3>
                <p>
                    Undang-Undang tentang Tindak Pidana Kekerasan Seksual
                    mengatur berbagai bentuk kekerasan seksual, termasuk
                    pelecehan seksual nonfisik sesuai unsur yang ditentukan
                    dalam peraturan.
                </p>

                <a href="https://peraturan.bpk.go.id/Details/207944/uu-no-12-tahun-2022"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="vd-back">
                    Lihat peraturan
                    <i class="bi bi-box-arrow-up-right"></i>
                </a>

                <hr class="my-4">

                <h3>Undang-Undang Nomor 1 Tahun 2023</h3>
                <p>
                    Kitab Undang-Undang Hukum Pidana (KUHP) memuat
                    ketentuan mengenai sejumlah tindak pidana yang
                    dapat berkaitan dengan ancaman, penghinaan,
                    atau tindakan lainnya, bergantung pada unsur
                    dan konteks perbuatannya.
                </p>

                <a href="https://peraturan.bpk.go.id/Details/234935/uu-no-1-tahun-2023"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="vd-back">
                    Lihat peraturan
                    <i class="bi bi-box-arrow-up-right"></i>
                </a>
            </div>
        </section>

        {{-- CTA --}}
        <section class="vd-help-box">
            <h2>Kamu Berhak Dihargai dan Didengarkan</h2>

            <p>
                Jika kamu mengalami atau mengetahui tindakan yang
                merugikan, Satgas PPKS FSH UINSA dapat menjadi salah
                satu tempat untuk memperoleh informasi mengenai
                pengaduan dan pendampingan.
            </p>

            <a href="{{ url('/lapor') }}" class="vd-btn">
                Buat Pengaduan
                <i class="bi bi-arrow-right"></i>
            </a>
        </section>

        {{-- Kembali --}}
        <a href="{{ url('/informasi-edukasi') }}" class="vd-back">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Informasi dan Edukasi
        </a>

    </div>
</div>

@endsection
