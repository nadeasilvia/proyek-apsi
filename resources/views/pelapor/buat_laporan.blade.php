
@extends('layouts.app')

@section('title', 'Buat Pengaduan - Satgas PPKS FSH UINSA')

@section('content')
<style>
    .report-page {
        --rp-ink: #344b50;
        --rp-muted: #75878c;
        --rp-teal: #416c72;
        --rp-line: #e5ecee;
        padding: 52px 0 30px;
        background:
            radial-gradient(circle at 8% 5%, rgba(220,232,244,.72), transparent 28%),
            radial-gradient(circle at 94% 18%, rgba(233,226,242,.68), transparent 26%),
            #f7f9fa;
        color: var(--rp-ink);
    }

    .report-shell { max-width: 1040px; margin: 0 auto; }

    .report-heading {
        text-align: center;
        max-width: 700px;
        margin: 0 auto 30px;
    }

    .report-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 13px;
        border: 1px solid rgba(65,108,114,.12);
        border-radius: 30px;
        background: rgba(255,255,255,.72);
        color: var(--rp-teal);
        font-size: .75rem;
        font-weight: 800;
        letter-spacing: .45px;
    }

    .report-heading h1 {
        margin: 17px 0 10px;
        font-size: clamp(1.8rem, 4vw, 2.55rem);
        font-weight: 800;
        letter-spacing: -1.1px;
    }

    .report-heading p {
        margin: 0;
        color: var(--rp-muted);
        font-size: .94rem;
        line-height: 1.8;
    }

    .privacy-note {
        display: flex;
        gap: 15px;
        align-items: flex-start;
        padding: 19px 21px;
        margin-bottom: 22px;
        border: 1px solid #dce9e2;
        border-radius: 18px;
        background: linear-gradient(110deg, rgba(220,233,226,.68), rgba(255,255,255,.88));
    }

    .privacy-icon {
        width: 42px;
        height: 42px;
        flex: 0 0 42px;
        display: grid;
        place-items: center;
        border-radius: 13px;
        background: #fff;
        color: var(--rp-teal);
        font-size: 1.2rem;
    }

    .privacy-note strong {
        display: block;
        margin: 1px 0 4px;
        font-size: .9rem;
    }

    .privacy-note p {
        margin: 0;
        color: #657a7e;
        font-size: .8rem;
        line-height: 1.7;
    }

    .report-card {
        overflow: hidden;
        border: 1px solid rgba(220,230,233,.9);
        border-radius: 22px;
        background: rgba(255,255,255,.94);
        box-shadow: 0 18px 55px rgba(52,75,80,.07);
    }

    .report-card-top {
        padding: 23px 28px;
        border-bottom: 1px solid var(--rp-line);
        background: linear-gradient(100deg, #f2f6fa, #f6f3f9 55%, #f0f6f2);
    }

    .report-card-top h2 {
        margin: 0 0 5px;
        font-size: 1.02rem;
        font-weight: 800;
    }

    .report-card-top p {
        margin: 0;
        color: var(--rp-muted);
        font-size: .78rem;
    }

    .report-form { padding: 27px 28px 30px; }

    .form-section {
        padding: 0 0 26px;
        margin: 0 0 26px;
        border-bottom: 1px solid var(--rp-line);
    }

    .form-section:last-of-type {
        padding-bottom: 0;
        margin-bottom: 24px;
        border-bottom: 0;
    }

    .section-heading {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 19px;
    }

    .section-number {
        width: 36px;
        height: 36px;
        flex: 0 0 36px;
        display: grid;
        place-items: center;
        border-radius: 12px;
        background: #eaf0f6;
        color: var(--rp-teal);
        font-size: .82rem;
        font-weight: 800;
    }

    .section-heading h3 {
        margin: 0 0 3px;
        font-size: .94rem;
        font-weight: 800;
    }

    .section-heading p {
        margin: 0;
        color: var(--rp-muted);
        font-size: .74rem;
    }

    .report-form .form-label {
        margin-bottom: 7px;
        color: #465d62;
        font-size: .79rem;
        font-weight: 700;
    }

    .report-form .form-control,
    .report-form .form-select {
        min-height: 46px;
        padding: 11px 13px;
        border: 1px solid #dfe8ea;
        border-radius: 11px;
        background-color: #fbfcfd;
        color: var(--rp-ink);
        font-size: .82rem;
        box-shadow: none;
    }

    .report-form textarea.form-control {
        min-height: 125px;
        resize: vertical;
    }

    .report-form .form-control:focus,
    .report-form .form-select:focus {
        border-color: #8eaaa8;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(65,108,114,.09);
    }

    .report-form .form-control::placeholder { color: #a3b0b4; }

    .field-help {
        display: block;
        margin-top: 6px;
        color: #87969a;
        font-size: .7rem;
        line-height: 1.55;
    }

    .required-mark { color: #bd6d70; }

    .choice-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0,1fr));
        gap: 10px;
    }

    .choice-option { position: relative; }

    .choice-option input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .choice-option label {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        min-height: 66px;
        padding: 13px;
        border: 1px solid #e1e9eb;
        border-radius: 13px;
        background: #fbfcfd;
        cursor: pointer;
        transition: .2s ease;
    }

    .choice-option label i {
        margin-top: 2px;
        color: #79969a;
        font-size: 1.05rem;
    }

    .choice-option label strong {
        display: block;
        margin-bottom: 3px;
        color: #465d62;
        font-size: .77rem;
    }

    .choice-option label small {
        display: block;
        color: #89979b;
        font-size: .68rem;
        line-height: 1.45;
    }

    .choice-option input:checked + label {
        border-color: #83a6a1;
        background: #f0f6f3;
        box-shadow: 0 0 0 2px rgba(65,108,114,.07);
    }

    .choice-option input:checked + label i { color: var(--rp-teal); }

    .choice-option input:focus-visible + label {
        outline: 3px solid rgba(65,108,114,.2);
        outline-offset: 2px;
    }

    .upload-box {
        padding: 20px;
        border: 1px dashed #b9cbca;
        border-radius: 14px;
        background: #f8fbfa;
    }

    .upload-empty-state { text-align: center; padding: 12px 10px; }

    .upload-empty-icon {
        display: block;
        margin-bottom: 10px;
        color: #416c72;
        font-size: 2.2rem;
    }

    .upload-empty-title {
        margin-bottom: 5px;
        color: #465d62;
        font-size: .85rem;
        font-weight: 800;
    }

    .upload-empty-description {
        margin: 0 0 16px;
        color: #89979b;
        font-size: .72rem;
        line-height: 1.6;
    }

    .btn-add-evidence {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 10px 18px;
        border: 1px solid #a9c2bd;
        border-radius: 10px;
        background: #edf5f1;
        color: #416c72;
        font-size: .78rem;
        font-weight: 800;
        transition: .2s ease;
        cursor: pointer;
    }

    .btn-add-evidence:hover {
        border-color: #789f98;
        background: #dfeee7;
        transform: translateY(-1px);
    }

    .btn-add-evidence:focus-visible {
        outline: 3px solid rgba(65,108,114,.2);
        outline-offset: 3px;
    }

    .upload-footer {
        margin-top: 15px;
        padding-top: 13px;
        border-top: 1px solid #e6eeeb;
    }

    .upload-feedback {
        margin-top: 12px;
        color: #71858a;
        font-size: .72rem;
        line-height: 1.6;
    }

    .upload-feedback.error { color: #b56c70; }

    .evidence-preview-list {
        display: flex;
        flex-direction: column;
        gap: 11px;
    }

    .evidence-item {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 12px;
        border: 1px solid #e5ecee;
        border-radius: 13px;
        background: #fff;
    }

    .evidence-thumb {
        width: 58px;
        height: 58px;
        flex: 0 0 58px;
        display: grid;
        place-items: center;
        overflow: hidden;
        border-radius: 10px;
        background: #eef3f5;
        color: #63858a;
        font-size: 1.6rem;
    }

    .evidence-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .evidence-info { flex: 1; min-width: 0; }

    .evidence-name {
        overflow: hidden;
        color: #465d62;
        font-size: .79rem;
        font-weight: 700;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .evidence-size {
        margin-top: 3px;
        color: #89979b;
        font-size: .68rem;
    }

    .evidence-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 7px;
        margin-top: 8px;
    }

    .evidence-actions button {
        display: inline-flex;
        align-items: center;
        padding: 5px 9px;
        border: 1px solid #e0e9e9;
        border-radius: 7px;
        background: #f8fbfa;
        color: #52777a;
        font-size: .68rem;
        font-weight: 700;
        transition: .2s ease;
    }

    .evidence-actions button:hover {
        background: #eaf2ef;
        border-color: #b9ceca;
    }

    .evidence-actions .remove-evidence {
        border-color: #f0dddd;
        background: #fffafa;
        color: #b56c70;
    }

    .evidence-actions .remove-evidence:hover {
        background: #fff0f0;
        border-color: #e8c5c5;
    }

    .evidence-list-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
    }

    .expectation-panel {
        padding: 18px;
        border: 1px solid #e3e9ef;
        border-radius: 14px;
        background: #f8fafc;
    }

    .expectation-description {
        margin: 0 0 12px;
        color: #829196;
        font-size: .72rem;
        line-height: 1.65;
    }

    .consent-box {
        display: flex;
        gap: 10px;
        align-items: flex-start;
        padding: 15px;
        border: 1px solid #e4ebed;
        border-radius: 13px;
        background: #fafcfc;
    }

    .consent-box input {
        width: 17px;
        height: 17px;
        flex: 0 0 17px;
        margin-top: 2px;
        accent-color: var(--rp-teal);
    }

    .consent-box label {
        color: #687c81;
        font-size: .74rem;
        line-height: 1.65;
    }

    .form-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding-top: 20px;
        border-top: 1px solid var(--rp-line);
    }

    .form-actions small {
        max-width: 470px;
        color: #89979b;
        font-size: .7rem;
        line-height: 1.6;
    }

    .btn-submit-report {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        padding: 13px 22px;
        border: 0;
        border-radius: 12px;
        background: var(--rp-teal);
        color: #fff;
        font-size: .82rem;
        font-weight: 800;
        box-shadow: 0 8px 18px rgba(65,108,114,.17);
        transition: .2s ease;
    }

    .btn-submit-report:hover {
        transform: translateY(-2px);
        background: #345a60;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-top: 20px;
        color: #71858a;
        font-size: .77rem;
        font-weight: 700;
        text-decoration: none;
    }

    .back-link:hover { color: var(--rp-teal); }

    .evidence-preview-modal .modal-content {
        overflow: hidden;
        border: 0;
        border-radius: 17px;
    }

    .evidence-preview-modal .modal-header {
        padding: 17px 20px;
        border-bottom: 1px solid #e8eeee;
        background: #f5f8f8;
    }

    .evidence-preview-modal .modal-title {
        overflow: hidden;
        color: #40595e;
        font-size: .9rem;
        font-weight: 800;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .evidence-preview-modal .modal-body {
        min-height: 250px;
        padding: 18px;
        background: #f8fafb;
    }

    .preview-media {
        display: block;
        max-width: 100%;
        max-height: 65vh;
        margin: 0 auto;
        border-radius: 10px;
        object-fit: contain;
    }

    .preview-pdf {
        display: block;
        width: 100%;
        height: 65vh;
        border: 0;
        border-radius: 8px;
        background: #fff;
    }

    @media (max-width: 767.98px) {
        .report-page { padding: 35px 0 20px; }

        .report-card-top,
        .report-form {
            padding-left: 19px;
            padding-right: 19px;
        }

        .privacy-note { padding: 16px; }

        .choice-grid { grid-template-columns: 1fr; }

        .form-actions { align-items: stretch; }

        .btn-submit-report { width: 100%; }

        .evidence-item { align-items: flex-start; }

        .evidence-thumb {
            width: 48px;
            height: 48px;
            flex-basis: 48px;
        }
    }
</style>

<div class="report-page">
    <div class="container report-shell">

        <header class="report-heading">
            <span class="report-eyebrow">
                <i class="bi bi-shield-check"></i>
                RUANG PENGADUAN AMAN
            </span>

            <h1>Sampaikan Pengaduanmu</h1>

            <p>
                Sampaikan informasi mengenai kejadian yang kamu alami
                atau ketahui. Kamu tidak perlu membuat akun untuk
                menyampaikan pengaduan kepada Satgas PPKS FSH UINSA.
            </p>
        </header>

        <div class="privacy-note" role="note">
            <div class="privacy-icon">
                <i class="bi bi-lock-fill"></i>
            </div>

            <div>
                <strong>
                    Identitasmu dijaga dengan mekanisme perlindungan data
                </strong>

                <p>
                    Formulir ini meminta identitas asli agar Satgas dapat
                    melakukan konfirmasi. Dalam tampilan kerja internal,
                    identitas ditampilkan dalam bentuk tersamarkan
                    (masking). Pembukaan identitas asli (unmasking)
                    hanya dapat dilakukan oleh Ketua Satgas sesuai
                    kewenangan dan harus tercatat dalam riwayat aktivitas.
                </p>
            </div>
        </div>

        <div class="report-card">

            <div class="report-card-top">
                <h2>
                    <i class="bi bi-file-earmark-text me-2"
                       style="color:#416c72"></i>
                    Formulir Pengaduan PPKS
                </h2>

                <p>
                    Kolom dengan tanda
                    <span class="required-mark">*</span>
                    wajib diisi. Berikan informasi sesuai yang kamu ketahui.
                </p>
            </div>

            <form
                class="report-form"
                id="studentReportForm"
                action="{{ route('report.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf

                @if($errors->any())
                    <div class="alert alert-danger" role="alert" aria-live="assertive">
                        <strong>Pengaduan belum terkirim.</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- SECTION 01 -->
                <section class="form-section">

                    <div class="section-heading">
                        <span class="section-number">01</span>

                        <div>
                            <h3>Informasi pelapor</h3>
                            <p>Data orang yang menyampaikan pengaduan.</p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label d-block">
                            Kamu melapor sebagai
                            <span class="required-mark">*</span>
                        </label>

                        <div class="choice-grid">

                            <div class="choice-option">
                                <input
                                    type="radio"
                                    id="asVictim"
                                    name="reporter_type"
                                    value="korban"
                                    required
                                >

                                <label for="asVictim">
                                    <i class="bi bi-person-check"></i>

                                    <span>
                                        <strong>Saya adalah korban</strong>
                                        <small>
                                            Saya menyampaikan pengaduan
                                            untuk diri sendiri.
                                        </small>
                                    </span>
                                </label>
                            </div>

                            <div class="choice-option">
                                <input
                                    type="radio"
                                    id="asWitness"
                                    name="reporter_type"
                                    value="saksi_perantara"
                                    required
                                >

                                <label for="asWitness">
                                    <i class="bi bi-people"></i>

                                    <span>
                                        <strong>Saya saksi / perantara</strong>
                                        <small>
                                            Saya menyampaikan informasi
                                            mengenai kejadian yang dialami
                                            korban.
                                        </small>
                                    </span>
                                </label>
                            </div>

                        </div>
                    </div>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label for="reporter_name" class="form-label">
                                Nama lengkap pelapor
                                <span class="required-mark">*</span>
                            </label>

                            <input
                                id="reporter_name"
                                name="reporter_name"
                                type="text"
                                class="form-control"
                                placeholder="Nama sesuai identitas"
                                autocomplete="name"
                                required
                            >
                        </div>

                        <div class="col-md-6">
                            <label for="reporter_identity" class="form-label">
                                NIM
                                <span class="required-mark">*</span>
                            </label>

                            <input
                                id="reporter_identity"
                                name="reporter_identity"
                                type="text"
                                class="form-control"
                                placeholder="Masukkan NIM"
                                required
                            >
                        </div>

                        <div class="col-md-6">
                            <label for="reporter_phone" class="form-label">
                                Nomor WhatsApp aktif
                                <span class="required-mark">*</span>
                            </label>

                            <input
                                id="reporter_phone"
                                name="reporter_phone"
                                type="tel"
                                class="form-control"
                                placeholder="08xxxxxxxxxx"
                                autocomplete="tel"
                                required
                            >

                            <small class="field-help">
                                Nomor ini digunakan Satgas untuk
                                menghubungimu terkait pengaduan.
                            </small>
                        </div>

                        <div class="col-md-6">
                            <label for="victim_gender" class="form-label">Gender korban (opsional)</label>
                            <select id="victim_gender" name="victim_gender" class="form-select">
                                <option value="">Pilih jika berkenan</option>
                                <option value="perempuan">Perempuan</option>
                                <option value="laki_laki">Laki-laki</option>
                                <option value="tidak_menyebutkan">Tidak ingin menyebutkan</option>
                            </select>
                            <small class="field-help">Informasi ini membantu Satgas mempertimbangkan penugasan petugas pemeriksa yang sesuai.</small>
                        </div>

                        <div class="col-md-6">
                            <label for="reporter_email" class="form-label">
                                Email aktif (opsional)
                            </label>

                            <input
                                id="reporter_email"
                                name="reporter_email"
                                type="email"
                                class="form-control"
                                placeholder="nama@email.com"
                                autocomplete="email"
                            >
                        </div>

                    </div>
                </section>

                <!-- SECTION 02 -->
                <section class="form-section" id="victimDetails" hidden>

                    <div class="section-heading">
                        <span class="section-number">02</span>

                        <div>
                            <h3>Informasi korban</h3>
                            <p>
                                Bagian ini ditujukan untuk pelapor
                                yang berperan sebagai saksi atau perantara.
                            </p>
                        </div>
                    </div>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label for="victim_name" class="form-label">
                                Nama korban
                            </label>

                            <input
                                id="victim_name"
                                name="victim_name"
                                type="text"
                                class="form-control"
                                placeholder="Nama korban, jika diketahui"
                                disabled
                            >
                        </div>

                        <div class="col-md-6">
                            <label for="victim_contact" class="form-label">
                                Kontak korban (opsional)
                            </label>

                            <input
                                id="victim_contact"
                                name="victim_contact"
                                type="text"
                                class="form-control"
                                placeholder="Nomor yang dapat dihubungi jika diizinkan"
                                disabled
                            >
                        </div>

                        <div class="col-12">
                            <small class="field-help">
                                Jangan mencantumkan kontak korban tanpa
                                sepengetahuan atau persetujuannya.
                                Satgas dapat mengarahkan proses konfirmasi
                                lebih lanjut.
                            </small>
                        </div>

                    </div>
                </section>

                <!-- SECTION 03 -->
                <section class="form-section">

                    <div class="section-heading">
                        <span class="section-number">03</span>

                        <div>
                            <h3>Informasi pihak terlapor</h3>
                            <p>
                                Isi sesuai informasi yang kamu ketahui.
                                Tidak wajib jika identitas belum diketahui.
                            </p>
                        </div>
                    </div>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label for="reported_name" class="form-label">
                                Nama pihak terlapor
                            </label>

                            <input
                                id="reported_name"
                                name="reported_name"
                                type="text"
                                class="form-control"
                                placeholder="Nama, jika diketahui"
                            >
                        </div>

                        <div class="col-md-6">
                            <label for="reported_status" class="form-label">
                                Status pihak terlapor
                            </label>

                            <select
                                id="reported_status"
                                name="reported_status"
                                class="form-select"
                            >
                                <option value="">Pilih jika diketahui</option>
                                <option value="mahasiswa">Mahasiswa</option>
                                <option value="dosen">Dosen</option>
                                <option value="tenaga_kependidikan">
                                    Tenaga Kependidikan
                                </option>
                                <option value="pihak_luar">
                                    Pihak luar kampus
                                </option>
                                <option value="tidak_diketahui">
                                    Tidak diketahui
                                </option>
                            </select>
                        </div>

                    </div>
                </section>

                <!-- SECTION 04 -->
                <section class="form-section">

                    <div class="section-heading">
                        <span class="section-number">04</span>

                        <div>
                            <h3>Detail kejadian</h3>
                            <p>
                                Ceritakan informasi kejadian dengan jelas
                                dan sesuai yang kamu ketahui.
                            </p>
                        </div>
                    </div>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label for="incident_type" class="form-label">
                                Bentuk kejadian
                                <span class="required-mark">*</span>
                            </label>

                            <select
                                id="incident_type"
                                name="incident_type"
                                class="form-select"
                                required
                            >
                                <option value="" selected disabled>
                                    Pilih kategori kejadian
                                </option>

                                <option value="verbal">Verbal</option>
                                <option value="non_fisik">Nonfisik</option>
                                <option value="fisik">Fisik</option>
                                <option value="daring">
                                    Daring / melalui media digital
                                </option>
                                <option value="lainnya">
                                    Lainnya / belum dapat dikategorikan
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="incident_date" class="form-label">
                                Tanggal kejadian (jika diketahui)
                            </label>

                            <input
                                id="incident_date"
                                name="incident_date"
                                type="date"
                                class="form-control"
                            >

                            <small class="field-help">
                                Jika tidak ingat tanggal tepatnya,
                                kosongkan bagian ini dan jelaskan
                                perkiraan waktu pada kronologi.
                            </small>
                        </div>

                        <div class="col-md-6">
                            <label for="incident_time" class="form-label">
                                Perkiraan waktu kejadian
                            </label>

                            <input
                                id="incident_time"
                                name="incident_time"
                                type="time"
                                class="form-control"
                            >
                        </div>

                        <div class="col-md-6">
                            <label for="incident_location" class="form-label">
                                Lokasi kejadian
                                <span class="required-mark">*</span>
                            </label>

                            <input
                                id="incident_location"
                                name="incident_location"
                                type="text"
                                class="form-control"
                                placeholder="Contoh: lingkungan kampus / platform digital"
                                required
                            >
                        </div>

                        <div class="col-12">
                            <label for="incident_story" class="form-label">
                                Kronologi kejadian
                                <span class="required-mark">*</span>
                            </label>

                            <textarea
                                id="incident_story"
                                name="incident_story"
                                class="form-control"
                                rows="6"
                                placeholder="Ceritakan kejadian secara bertahap."
                                required
                            ></textarea>

                            <small class="field-help" id="storyHelp">
                                Kamu tidak harus menggunakan istilah hukum.
                                Tuliskan dengan bahasamu sendiri.
                            </small>
                        </div>

                    </div>
                </section>

                <!-- SECTION 05 -->
                <section class="form-section">

                    <div class="section-heading">
                        <span class="section-number">05</span>

                        <div>
                            <h3>Bukti pendukung</h3>
                            <p>
                                Lampirkan file yang dapat membantu Satgas
                                memahami pengaduan yang kamu sampaikan.
                            </p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">
                            File bukti pendukung (opsional)
                        </label>

                        <div class="upload-box">

                            <div id="emptyUploadState" class="upload-empty-state">

                                <i class="bi bi-cloud-arrow-up upload-empty-icon"></i>

                                <div class="upload-empty-title">
                                    Belum ada bukti yang dilampirkan
                                </div>

                                <p class="upload-empty-description">
                                    Pilih file dari perangkatmu untuk
                                    melampirkan bukti pendukung pengaduan.
                                </p>

                                <button
                                    type="button"
                                    id="firstUploadButton"
                                    class="btn-add-evidence"
                                >
                                    <i class="bi bi-plus-lg"></i>
                                    Pilih File
                                </button>

                            </div>

                            <input
                                id="evidence"
                                name="evidence[]"
                                type="file"
                                hidden
                                multiple
                                accept=".pdf,.jpg,.jpeg,.png,.mp4,.webm"
                            >

                            <div id="addEvidenceArea" style="display:none;">

                                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                                    <div>
                                        <div class="fw-bold"
                                             style="font-size:.82rem;color:#465d62;">
                                            <i class="bi bi-check-circle-fill me-1"
                                               style="color:#6e9b87;"></i>
                                            Bukti berhasil ditambahkan
                                        </div>

                                        <small class="field-help">
                                            Kamu masih bisa menambahkan bukti lainnya.
                                        </small>
                                    </div>

                                    <button
                                        type="button"
                                        id="addEvidenceButton"
                                        class="btn-add-evidence"
                                    >
                                        <i class="bi bi-plus-lg"></i>
                                        Tambah File
                                    </button>

                                </div>

                            </div>

                            <div class="upload-footer">

                                <small class="field-help mt-0">
                                    Format: PDF, JPG, JPEG, PNG, MP4, dan WEBM.
                                    Maksimal 10 MB untuk setiap file.
                                </small>

                                <div
                                    id="evidenceFeedback"
                                    class="upload-feedback"
                                    aria-live="polite"
                                >
                                    Belum ada file yang dipilih.
                                </div>

                            </div>

                        </div>
                    </div>

                    <div id="evidenceContainer" style="display:none;">

                        <div class="evidence-list-header">

                            <h6 class="fw-bold mb-0"
                                style="font-size:.82rem;color:#465d62;">
                                <i class="bi bi-paperclip me-1"></i>
                                Daftar lampiran
                            </h6>

                            <span
                                id="evidenceCount"
                                class="badge rounded-pill"
                                style="background:#eaf1ef;color:#416c72;"
                            >
                                0 file
                            </span>

                        </div>

                        <div
                            id="evidencePreviewList"
                            class="evidence-preview-list"
                            aria-live="polite"
                        ></div>

                    </div>

                    <div class="expectation-panel mt-4">

                        <label for="expectation" class="form-label">
                            Harapan atau kebutuhanmu (opsional)
                        </label>

                        <p class="expectation-description">
                            Kamu dapat menyampaikan bentuk dukungan atau
                            pendampingan yang kamu butuhkan selama proses
                            penanganan pengaduan. Tidak ada kewajiban
                            untuk menentukan bentuk penyelesaian kasus.
                        </p>

                        <textarea
                            id="expectation"
                            name="expectation"
                            class="form-control"
                            rows="4"
                            placeholder="Contoh: Saya berharap mendapatkan pendampingan psikologis, memperoleh informasi perkembangan pengaduan, atau mendapatkan bantuan agar merasa lebih aman selama proses penanganan."
                        ></textarea>

                    </div>

                </section>

                <div class="consent-box mb-4">

                    <input
                        id="privacyConsent"
                        name="privacy_consent"
                        type="checkbox"
                        value="1"
                        required
                    >

                    <label for="privacyConsent">
                        Saya menyatakan bahwa informasi yang saya sampaikan
                        sesuai dengan pengalaman atau pengetahuan saya.
                        Saya memahami bahwa data identitas diperlukan
                        untuk proses tindak lanjut dan akan dikelola
                        dengan pembatasan akses serta mekanisme masking
                        identitas.
                        <span class="required-mark">*</span>
                    </label>

                </div>
                <small class="field-help mb-3">Persetujuan pada kotak di atas wajib dicentang agar pengaduan dapat dikirim.</small>

                <div class="form-actions">

                    <small>
                        <i class="bi bi-info-circle me-1"></i>
                        Identitas pelapor disamarkan dalam tampilan kerja
                        internal. Pembukaan identitas asli hanya dapat
                        dilakukan oleh Ketua Satgas sesuai kewenangan.
                    </small>

                    <button
                        type="submit"
                        class="btn-submit-report"
                    >
                        <i class="bi bi-send-fill"></i>
                        Kirim Pengaduan
                    </button>

                </div>

            </form>
        </div>

        <div class="text-center">
            <a href="{{ url('/') }}" class="back-link">
                <i class="bi bi-arrow-left"></i>
                Kembali ke beranda
            </a>
        </div>

    </div>
</div>

<div
    class="modal fade evidence-preview-modal"
    id="evidencePreviewModal"
    tabindex="-1"
    aria-labelledby="evidencePreviewTitle"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <div style="min-width:0;">
                    <h5 class="modal-title" id="evidencePreviewTitle">
                        Pratinjau lampiran
                    </h5>

                    <small
                        id="evidencePreviewMeta"
                        class="text-muted"
                    ></small>
                </div>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Tutup"
                ></button>

            </div>

            <div class="modal-body" id="evidencePreviewBody"></div>

        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ==========================================
    // 1. PENGATURAN IDENTITAS PELAPOR
    // ==========================================

    const victimDetails = document.getElementById('victimDetails');
    const victimName = document.getElementById('victim_name');
    const victimContact = document.getElementById('victim_contact');

    const reporterChoices = document.querySelectorAll(
        'input[name="reporter_type"]'
    );

    const storyLabel = document.querySelector(
        'label[for="incident_story"]'
    );

    const storyInput = document.getElementById('incident_story');
    const storyHelp = document.getElementById('storyHelp');

    function updateReporterWording() {

        const selected = document.querySelector(
            'input[name="reporter_type"]:checked'
        );

        const isWitness = selected &&
            selected.value === 'saksi_perantara';

        victimDetails.hidden = !isWitness;

        victimName.disabled = !isWitness;
        victimContact.disabled = !isWitness;

        if (!isWitness) {
            victimName.value = '';
            victimContact.value = '';
        }

        storyLabel.innerHTML = (
            isWitness
                ? 'Kronologi kejadian yang kamu saksikan atau ketahui'
                : 'Kronologi kejadian yang kamu alami'
        ) + ' <span class="required-mark">*</span>';

        storyInput.placeholder = isWitness
            ? 'Ceritakan kejadian yang kamu saksikan atau informasi yang kamu terima. Jelaskan kapan dan di mana kejadian berlangsung serta pihak yang terlibat.'
            : 'Ceritakan kejadian yang kamu alami, kapan dan di mana kejadian berlangsung, serta hal lain yang ingin kamu sampaikan. Kamu boleh menulis secara bertahap.';

        storyHelp.textContent = isWitness
            ? 'Bedakan informasi yang kamu saksikan secara langsung dengan informasi yang kamu terima dari orang lain.'
            : 'Kamu tidak harus menggunakan istilah hukum. Tuliskan pengalamanmu dengan bahasamu sendiri. Tidak apa-apa jika ada detail yang tidak kamu ingat atau belum siap kamu ceritakan.';
    }

    reporterChoices.forEach(function (choice) {
        choice.addEventListener('change', updateReporterWording);
    });

    updateReporterWording();


    // ==========================================
    // 2. PENGATURAN UPLOAD BUKTI
    // ==========================================

    const evidenceInput = document.getElementById('evidence');

    const firstUploadButton = document.getElementById(
        'firstUploadButton'
    );

    const addEvidenceButton = document.getElementById(
        'addEvidenceButton'
    );

    const emptyUploadState = document.getElementById(
        'emptyUploadState'
    );

    const addEvidenceArea = document.getElementById(
        'addEvidenceArea'
    );

    const previewList = document.getElementById(
        'evidencePreviewList'
    );

    const evidenceContainer = document.getElementById(
        'evidenceContainer'
    );

    const evidenceCount = document.getElementById(
        'evidenceCount'
    );

    const feedback = document.getElementById(
        'evidenceFeedback'
    );

    const maxFileSize = 10 * 1024 * 1024;

    const allowedExtensions = [
        'pdf',
        'jpg',
        'jpeg',
        'png',
        'mp4',
        'webm'
    ];

    let selectedFiles = [];
    let thumbnailUrls = [];
    let previewObjectUrl = null;


    // ==========================================
    // 3. MEMBUKA FILE PICKER
    // ==========================================

    function openFilePicker() {
        evidenceInput.click();
    }

    firstUploadButton.addEventListener('click', openFilePicker);
    addEvidenceButton.addEventListener('click', openFilePicker);


    // ==========================================
    // 4. FORMAT UKURAN FILE
    // ==========================================

    function formatSize(bytes) {

        if (bytes < 1024 * 1024) {
            return (bytes / 1024).toFixed(1) + ' KB';
        }

        return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
    }


    // ==========================================
    // 5. EKSTENSI FILE
    // ==========================================

    function extensionOf(file) {
        return file.name.split('.').pop().toLowerCase();
    }


    // ==========================================
    // 6. SINKRONISASI FILE INPUT
    // ==========================================

    function syncInputFiles() {

        const dataTransfer = new DataTransfer();

        selectedFiles.forEach(function (file) {
            dataTransfer.items.add(file);
        });

        evidenceInput.files = dataTransfer.files;
    }


    // ==========================================
    // 7. MENGATUR TAMPILAN UPLOAD
    // ==========================================

    function updateUploadState() {

        const hasFiles = selectedFiles.length > 0;

        emptyUploadState.style.display = hasFiles ? 'none' : 'block';
        addEvidenceArea.style.display = hasFiles ? 'block' : 'none';
        evidenceContainer.style.display = hasFiles ? 'block' : 'none';
    }


    // ==========================================
    // 8. MEMBERSIHKAN THUMBNAIL
    // ==========================================

    function clearThumbnailUrls() {

        thumbnailUrls.forEach(function (url) {
            URL.revokeObjectURL(url);
        });

        thumbnailUrls = [];
    }


    // ==========================================
    // 9. MENAMPILKAN DAFTAR LAMPIRAN
    // ==========================================

    function renderEvidence() {

        clearThumbnailUrls();
        previewList.innerHTML = '';

        updateUploadState();

        evidenceCount.textContent = selectedFiles.length + ' file';

        if (selectedFiles.length === 0) {
            return;
        }

        selectedFiles.forEach(function (file, index) {

            const ext = extensionOf(file);

            const item = document.createElement('div');
            item.className = 'evidence-item';

            const thumb = document.createElement('div');
            thumb.className = 'evidence-thumb';

            if (['jpg', 'jpeg', 'png'].includes(ext)) {

                const image = document.createElement('img');
                const imageUrl = URL.createObjectURL(file);

                thumbnailUrls.push(imageUrl);

                image.src = imageUrl;
                image.alt = 'Pratinjau ' + file.name;

                thumb.appendChild(image);

            } else {

                const icon = document.createElement('i');

                icon.className = ext === 'pdf'
                    ? 'bi bi-file-earmark-pdf'
                    : 'bi bi-file-earmark-play';

                thumb.appendChild(icon);
            }

            const info = document.createElement('div');
            info.className = 'evidence-info';

            const name = document.createElement('div');
            name.className = 'evidence-name';
            name.textContent = file.name;
            name.title = file.name;

            const size = document.createElement('div');
            size.className = 'evidence-size';
            size.textContent = formatSize(file.size);

            const actions = document.createElement('div');
            actions.className = 'evidence-actions';

            const previewButton = document.createElement('button');
            previewButton.type = 'button';
            previewButton.innerHTML =
                '<i class="bi bi-eye me-1"></i> Lihat';

            previewButton.addEventListener('click', function () {
                showPreview(file);
            });

            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'remove-evidence';
            removeButton.innerHTML =
                '<i class="bi bi-trash3 me-1"></i> Hapus';

            removeButton.addEventListener('click', function () {
                removeEvidence(index);
            });

            actions.append(previewButton, removeButton);
            info.append(name, size, actions);
            item.append(thumb, info);

            previewList.appendChild(item);
        });
    }


    // ==========================================
    // 10. MENGHAPUS FILE
    // ==========================================

    function removeEvidence(index) {

        if (index < 0 || index >= selectedFiles.length) {
            return;
        }

        const removedFile = selectedFiles[index];

        selectedFiles.splice(index, 1);

        syncInputFiles();
        renderEvidence();

        if (selectedFiles.length === 0) {

            feedback.textContent =
                'File "' + removedFile.name +
                '" berhasil dihapus. Belum ada file yang dipilih.';

        } else {

            feedback.textContent =
                'File "' + removedFile.name +
                '" berhasil dihapus dari daftar lampiran.';
        }

        feedback.classList.remove('error');
    }


    // ==========================================
    // 11. PENGATURAN MODAL PREVIEW
    // ==========================================

    const previewModalElement = document.getElementById(
        'evidencePreviewModal'
    );

    const previewBody = document.getElementById(
        'evidencePreviewBody'
    );

    const previewTitle = document.getElementById(
        'evidencePreviewTitle'
    );

    const previewMeta = document.getElementById(
        'evidencePreviewMeta'
    );

    let previewModal = null;

    if (
        typeof bootstrap !== 'undefined' &&
        previewModalElement
    ) {
        previewModal = bootstrap.Modal.getOrCreateInstance(
            previewModalElement
        );
    }


    // ==========================================
    // 12. PREVIEW FILE
    // ==========================================

    function showPreview(file) {

        if (!previewModal) {
            alert('Komponen modal Bootstrap belum tersedia.');
            return;
        }

        if (previewObjectUrl) {
            URL.revokeObjectURL(previewObjectUrl);
            previewObjectUrl = null;
        }

        previewObjectUrl = URL.createObjectURL(file);

        const ext = extensionOf(file);

        previewTitle.textContent = file.name;

        previewMeta.textContent =
            formatSize(file.size) + ' • ' + ext.toUpperCase();

        previewBody.innerHTML = '';

        let media;

        if (['jpg', 'jpeg', 'png'].includes(ext)) {

            media = document.createElement('img');
            media.src = previewObjectUrl;
            media.alt = 'Pratinjau bukti ' + file.name;
            media.className = 'preview-media';

        } else if (ext === 'pdf') {

            media = document.createElement('iframe');
            media.src = previewObjectUrl;
            media.title = 'Pratinjau dokumen PDF';
            media.className = 'preview-pdf';

        } else if (['mp4', 'webm'].includes(ext)) {

            media = document.createElement('video');
            media.src = previewObjectUrl;
            media.controls = true;
            media.preload = 'metadata';
            media.className = 'preview-media';
        }

        if (media) {
            previewBody.appendChild(media);
        }

        previewModal.show();
    }


    // ==========================================
    // 13. MENAMBAHKAN FILE
    // ==========================================

    evidenceInput.addEventListener('change', function () {

        const incomingFiles = Array.from(evidenceInput.files);

        const messages = [];
        let addedCount = 0;

        incomingFiles.forEach(function (file) {

            const ext = extensionOf(file);

            if (!allowedExtensions.includes(ext)) {
                messages.push(
                    file.name + ': format file tidak didukung.'
                );
                return;
            }

            if (file.size > maxFileSize) {
                messages.push(
                    file.name + ': ukuran file melebihi 10 MB.'
                );
                return;
            }

            if (file.size === 0) {
                messages.push(
                    file.name + ': file kosong dan tidak dapat ditambahkan.'
                );
                return;
            }

            const alreadyExists = selectedFiles.some(
                function (existingFile) {
                    return (
                        existingFile.name === file.name &&
                        existingFile.size === file.size &&
                        existingFile.lastModified === file.lastModified
                    );
                }
            );

            if (alreadyExists) {
                messages.push(
                    file.name + ': file sudah ditambahkan sebelumnya.'
                );
                return;
            }

            selectedFiles.push(file);
            addedCount++;
        });

        syncInputFiles();
        renderEvidence();

        if (messages.length > 0) {

            feedback.textContent = messages.join(' ');
            feedback.classList.add('error');

        } else if (addedCount > 0) {

            feedback.textContent =
                addedCount + ' file berhasil ditambahkan. ' +
                'Total lampiran saat ini: ' +
                selectedFiles.length + ' file.';

            feedback.classList.remove('error');
        }

        evidenceInput.value = '';
        syncInputFiles();
    });


    // ==========================================
    // 14. MEMBERSIHKAN MODAL
    // ==========================================

    if (previewModalElement) {

        previewModalElement.addEventListener(
            'hidden.bs.modal',
            function () {

                previewBody.innerHTML = '';

                if (previewObjectUrl) {
                    URL.revokeObjectURL(previewObjectUrl);
                    previewObjectUrl = null;
                }
            }
        );
    }


});
</script>
@endpush

@endsection
