
@extends('layouts.app')

@section('title', 'Lacak Pengaduan - Satgas PPKS FSH UINSA')

@section('content')

<style>
    .tracking-page {
        --track-ink: #344b50;
        --track-muted: #7b8c91;
        --track-teal: #416c72;
        --track-line: #e5ecee;

        min-height: 80vh;
        padding: 55px 0 65px;
        background:
            radial-gradient(circle at 8% 5%, rgba(220,232,244,.75), transparent 28%),
            radial-gradient(circle at 94% 15%, rgba(233,226,242,.7), transparent 28%),
            #f7f9fa;
        color: var(--track-ink);
    }

    .tracking-shell {
        max-width: 900px;
        margin: 0 auto;
    }

    .tracking-heading {
        max-width: 650px;
        margin: 0 auto 32px;
        text-align: center;
    }

    .tracking-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border: 1px solid rgba(65,108,114,.13);
        border-radius: 30px;
        background: rgba(255,255,255,.75);
        color: var(--track-teal);
        font-size: .73rem;
        font-weight: 800;
        letter-spacing: .4px;
    }

    .tracking-heading h1 {
        margin: 18px 0 10px;
        font-size: clamp(1.8rem, 4vw, 2.5rem);
        font-weight: 800;
        letter-spacing: -1px;
    }

    .tracking-heading p {
        margin: 0;
        color: var(--track-muted);
        font-size: .9rem;
        line-height: 1.8;
    }

    .tracking-search-card {
        padding: 27px;
        margin-bottom: 24px;
        border: 1px solid rgba(220,230,233,.9);
        border-radius: 21px;
        background: rgba(255,255,255,.94);
        box-shadow: 0 16px 45px rgba(52,75,80,.06);
    }

    .search-card-heading {
        display: flex;
        align-items: center;
        gap: 13px;
        margin-bottom: 20px;
    }

    .search-icon {
        width: 43px;
        height: 43px;
        flex: 0 0 43px;
        display: grid;
        place-items: center;
        border-radius: 13px;
        background: #eaf1f5;
        color: var(--track-teal);
        font-size: 1.2rem;
    }

    .search-card-heading h2 {
        margin: 0 0 4px;
        font-size: .98rem;
        font-weight: 800;
    }

    .search-card-heading p {
        margin: 0;
        color: var(--track-muted);
        font-size: .75rem;
    }

    .tracking-input-group {
        display: flex;
        gap: 10px;
    }

    .tracking-input-group input {
        min-height: 49px;
        padding: 12px 15px;
        border: 1px solid #dfe8ea;
        border-radius: 11px;
        background: #fbfcfd;
        color: var(--track-ink);
        font-size: .83rem;
        box-shadow: none;
    }

    .tracking-input-group input:focus {
        border-color: #8eaaa8;
        box-shadow: 0 0 0 3px rgba(65,108,114,.09);
    }

    .tracking-input-group button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-width: 145px;
        padding: 12px 18px;
        border: 0;
        border-radius: 11px;
        background: var(--track-teal);
        color: white;
        font-size: .8rem;
        font-weight: 800;
        transition: .2s ease;
    }

    .tracking-input-group button:hover {
        background: #345a60;
        transform: translateY(-1px);
    }

    .tracking-help {
        display: block;
        margin-top: 10px;
        color: #87969a;
        font-size: .7rem;
        line-height: 1.6;
    }

    .tracking-alert {
        display: none;
        padding: 13px 15px;
        margin-top: 16px;
        border: 1px solid #f0dddd;
        border-radius: 11px;
        background: #fff8f8;
        color: #ad686d;
        font-size: .77rem;
        line-height: 1.6;
    }

    /* Hasil pelacakan */

    .tracking-result {
        display: none;
        overflow: hidden;
        border: 1px solid rgba(220,230,233,.9);
        border-radius: 21px;
        background: #fff;
        box-shadow: 0 16px 45px rgba(52,75,80,.06);
    }

    .result-header {
        padding: 23px 27px;
        border-bottom: 1px solid var(--track-line);
        background: linear-gradient(105deg, #f0f6fa, #f5f2f9 55%, #f0f6f2);
    }

    .result-header-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .result-header h2 {
        margin: 0;
        font-size: 1rem;
        font-weight: 800;
    }

    .demo-badge {
        padding: 6px 10px;
        border-radius: 20px;
        background: #fff1d9;
        color: #96713b;
        font-size: .65rem;
        font-weight: 800;
    }

    .ticket-number {
        margin-top: 13px;
        color: var(--track-teal);
        font-size: 1.1rem;
        font-weight: 800;
        letter-spacing: .5px;
    }

    .ticket-caption {
        margin-top: 3px;
        color: var(--track-muted);
        font-size: .7rem;
    }

    .result-body {
        padding: 27px;
    }

    .current-status-card {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        padding: 19px;
        margin-bottom: 28px;
        border: 1px solid #dce9e2;
        border-radius: 15px;
        background: linear-gradient(110deg, #edf5f0, #f8fbf9);
    }

    .current-status-icon {
        width: 42px;
        height: 42px;
        flex: 0 0 42px;
        display: grid;
        place-items: center;
        border-radius: 12px;
        background: white;
        color: #648d7a;
        font-size: 1.15rem;
    }

    .current-status-label {
        margin-bottom: 4px;
        color: #7d9186;
        font-size: .69rem;
        font-weight: 700;
    }

    .current-status-value {
        color: #416c72;
        font-size: 1rem;
        font-weight: 800;
    }

    .current-status-description {
        margin-top: 5px;
        color: #71858a;
        font-size: .74rem;
        line-height: 1.6;
    }

    .timeline-title {
        margin-bottom: 21px;
        font-size: .91rem;
        font-weight: 800;
    }

    .tracking-timeline {
        position: relative;
        padding-left: 8px;
    }

    .timeline-item {
        position: relative;
        display: flex;
        gap: 15px;
        min-height: 88px;
    }

    .timeline-item:last-child {
        min-height: auto;
    }

    .timeline-indicator {
        position: relative;
        width: 25px;
        flex: 0 0 25px;
        display: flex;
        justify-content: center;
    }

    .timeline-indicator::after {
        position: absolute;
        top: 25px;
        bottom: -2px;
        left: 11px;
        width: 2px;
        background: #e5ecee;
        content: "";
    }

    .timeline-item:last-child .timeline-indicator::after {
        display: none;
    }

    .timeline-dot {
        z-index: 1;
        width: 23px;
        height: 23px;
        display: grid;
        place-items: center;
        border: 2px solid #dce6e8;
        border-radius: 50%;
        background: white;
        color: white;
        font-size: .65rem;
    }

    .timeline-item.completed .timeline-dot {
        border-color: #6e9b87;
        background: #6e9b87;
    }

    .timeline-item.active .timeline-dot {
        border: 5px solid #dce9e2;
        background: #416c72;
    }

    .timeline-item.completed .timeline-indicator::after {
        background: #9bbdaf;
    }

    .timeline-content {
        flex: 1;
        padding-bottom: 24px;
    }

    .timeline-content h4 {
        margin: 1px 0 5px;
        color: #465d62;
        font-size: .82rem;
        font-weight: 800;
    }

    .timeline-content p {
        margin: 0;
        color: #89979b;
        font-size: .72rem;
        line-height: 1.65;
    }

    .timeline-item.pending .timeline-content h4 {
        color: #9ba8ab;
        font-weight: 700;
    }

    .result-privacy {
        display: flex;
        gap: 10px;
        align-items: flex-start;
        padding: 14px;
        margin-top: 12px;
        border: 1px solid #e5eaf0;
        border-radius: 12px;
        background: #f8fafc;
        color: #788a8f;
        font-size: .71rem;
        line-height: 1.65;
    }

    .result-privacy i {
        margin-top: 2px;
        color: #64868a;
    }

    .tracking-empty {
        display: none;
        padding: 35px 20px;
        text-align: center;
        border: 1px dashed #d9e4e6;
        border-radius: 17px;
        background: rgba(255,255,255,.65);
    }

    .tracking-empty i {
        display: block;
        margin-bottom: 12px;
        color: #8ba5a5;
        font-size: 2rem;
    }

    .tracking-empty h3 {
        margin-bottom: 7px;
        color: #52696e;
        font-size: .9rem;
        font-weight: 800;
    }

    .tracking-empty p {
        margin: 0;
        color: #89979b;
        font-size: .74rem;
        line-height: 1.7;
    }

    .tracking-back {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-top: 23px;
        color: #71858a;
        font-size: .77rem;
        font-weight: 700;
        text-decoration: none;
    }

    .tracking-back:hover {
        color: var(--track-teal);
    }

    @media (max-width: 575.98px) {
        .tracking-page {
            padding: 35px 0 45px;
        }

        .tracking-search-card {
            padding: 20px;
        }

        .tracking-input-group {
            flex-direction: column;
        }

        .tracking-input-group button {
            width: 100%;
        }

        .result-header,
        .result-body {
            padding: 20px;
        }

        .current-status-card {
            padding: 15px;
        }
    }
</style>

<div class="tracking-page">
    <div class="container tracking-shell">

        <!-- HEADER -->
        <header class="tracking-heading">

            <span class="tracking-eyebrow">
                <i class="bi bi-search"></i>
                PELACAKAN PENGADUAN
            </span>

            <h1>Lacak Status Pengaduan</h1>

            <p>
                Pantau perkembangan penanganan pengaduanmu melalui
                nomor tiket yang diperoleh setelah mengirimkan formulir.
                Kamu tidak perlu membuat akun untuk melakukan pelacakan.
            </p>

        </header>

        <!-- FORM PENCARIAN -->
        <section class="tracking-search-card">

            <div class="search-card-heading">

                <div class="search-icon">
                    <i class="bi bi-ticket-perforated"></i>
                </div>

                <div>
                    <h2>Masukkan Nomor Tiket</h2>
                    <p>Gunakan nomor tiket pengaduan yang kamu miliki.</p>
                </div>

            </div>

            <form id="trackingForm" method="post" action="{{ route('report.track') }}">
                @csrf

                <div class="tracking-input-group">

                    <input
                        type="text"
                        id="ticketNumber"
                        name="ticket"
                        class="form-control"
                        placeholder="Contoh: PPKS-2026-AB12CD34"
                        autocomplete="off"
                        required
                    >

                    <button type="submit">
                        <i class="bi bi-search"></i>
                        Lacak Pengaduan
                    </button>

                </div>

                @error('ticket')<div class="text-danger small mt-2">{{ $message }}</div>@enderror

                <small class="tracking-help">
                    Nomor tiket bersifat pribadi. Jangan membagikannya
                    kepada orang lain.
                </small>

            </form>

            <div
                id="trackingAlert"
                class="tracking-alert"
                role="alert"
                aria-live="polite"
            ></div>

        </section>

        <!-- HASIL PELACAKAN -->
        <section id="trackingResult" class="tracking-result" data-ticket="{{ $trackedReport?->ticket_number ?? '' }}" data-status="{{ $trackedReport ? str_replace('_', ' ', $trackedReport->status) : '' }}">

            <div class="result-header">

                <div class="result-header-top">

                    <h2>
                        <i class="bi bi-file-earmark-check me-2"
                           style="color:#416c72;"></i>
                        Informasi Pengaduan
                    </h2>

                    <span class="demo-badge">
                        SIMULASI FRONTEND
                    </span>

                </div>

                <div class="ticket-number" id="resultTicketNumber">
                    {{ $trackedReport?->ticket_number ?? '' }}
                </div>

                <div class="ticket-caption">
                    Nomor tiket pelacakan
                </div>

            </div>

            <div class="result-body">

                <!-- STATUS TERKINI -->
                <div class="current-status-card">

                    <div class="current-status-icon">
                        <i class="bi bi-hourglass-split"></i>
                    </div>

                    <div>

                        <div class="current-status-label">
                            STATUS TERKINI
                        </div>

                        <div
                            class="current-status-value"
                            id="currentStatus"
                        >
                            Diterima
                        </div>

                        <div
                            class="current-status-description"
                            id="currentDescription"
                        >
                            Pengaduan telah diterima oleh sistem dan
                            menunggu proses verifikasi awal.
                        </div>

                    </div>

                </div>

                <!-- TIMELINE -->
                <h3 class="timeline-title">
                    <i class="bi bi-list-check me-2"
                       style="color:#416c72;"></i>
                    Tahapan Penanganan Pengaduan
                </h3>

                <div class="tracking-timeline">

                    <div class="timeline-item active">

                        <div class="timeline-indicator">
                            <span class="timeline-dot"></span>
                        </div>

                        <div class="timeline-content">
                            <h4>Diterima</h4>
                            <p>
                                Pengaduan berhasil diterima dan tercatat
                                dalam sistem Satgas PPKS.
                            </p>
                        </div>

                    </div>

                    <div class="timeline-item pending">

                        <div class="timeline-indicator">
                            <span class="timeline-dot"></span>
                        </div>

                        <div class="timeline-content">
                            <h4>Diverifikasi</h4>
                            <p>
                                Tim Satgas melakukan pemeriksaan awal
                                terhadap kelengkapan dan kesesuaian
                                informasi pengaduan.
                            </p>
                        </div>

                    </div>

                    <div class="timeline-item pending">

                        <div class="timeline-indicator">
                            <span class="timeline-dot"></span>
                        </div>

                        <div class="timeline-content">
                            <h4>Pemanggilan Saksi/Pelaku</h4>
                            <p>
                                Tahapan pemanggilan pihak terkait
                                sesuai kebutuhan dan prosedur penanganan.
                            </p>
                        </div>

                    </div>

                    <div class="timeline-item pending">

                        <div class="timeline-indicator">
                            <span class="timeline-dot"></span>
                        </div>

                        <div class="timeline-content">
                            <h4>Pemeriksaan/Rujukan</h4>
                            <p>
                                Proses pemeriksaan, analisis, atau
                                pendampingan lanjutan sesuai kebutuhan kasus.
                            </p>
                        </div>

                    </div>

                    <div class="timeline-item pending">

                        <div class="timeline-indicator">
                            <span class="timeline-dot"></span>
                        </div>

                        <div class="timeline-content">
                            <h4>Eskalasi/Selesai</h4>
                            <p>
                                Penanganan dapat dilanjutkan melalui
                                eskalasi kepada pihak berwenang atau
                                dinyatakan selesai sesuai hasil penanganan.
                            </p>
                        </div>

                    </div>

                </div>

                <!-- PRIVASI -->
                <div class="result-privacy">

                    <i class="bi bi-shield-lock-fill"></i>

                    <span>
                        Demi menjaga kerahasiaan, halaman pelacakan
                        hanya menampilkan tahapan umum penanganan.
                        Identitas, kronologi, bukti, dan informasi
                        sensitif lainnya tidak ditampilkan di halaman publik.
                    </span>

                </div>

            </div>

        </section>

        <!-- TAMPILAN KETIKA BELUM MENCARI -->
        <div id="trackingEmpty" class="tracking-empty">

            <i class="bi bi-search"></i>

            <h3>{{ $trackedReport ? 'Status Pengaduan' : 'Belum Ada Pengaduan yang Dilacak' }}</h3>

            <p>
                Masukkan nomor tiket pada kolom di atas untuk
                melihat perkembangan pengaduanmu.
            </p>

        </div>

        <div class="text-center">

            <a href="{{ url('/') }}" class="tracking-back">
                <i class="bi bi-arrow-left"></i>
                Kembali ke beranda
            </a>

        </div>

    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const result = document.getElementById('trackingResult');
    const empty = document.getElementById('trackingEmpty');
    const alertBox = document.getElementById('trackingAlert');
    if (result.dataset.ticket) {
        document.getElementById('ticketNumber').value = result.dataset.ticket;
        document.getElementById('resultTicketNumber').textContent = result.dataset.ticket;
        document.getElementById('currentStatus').textContent = result.dataset.status;
        document.getElementById('currentDescription').textContent = 'Tahapan terakhir pengaduan tercatat pada sistem.';
        result.style.display = 'block'; empty.style.display = 'none';
    } else {
        result.style.display = 'none'; empty.style.display = 'block';
    }
    @if($errors->has('ticket')) alertBox.style.display = 'block'; @else alertBox.style.display = 'none'; @endif
});
</script>

@endsection
