
@extends('layouts.app')

@section('title', 'Konfirmasi Pengaduan - Satgas PPKS FSH UINSA')

@section('content')

<style>
    .confirmation-page {
        --blue: #DCE8F4;
        --sage: #DCE9E2;
        --lavender: #E9E2F2;
        --cream: #F5EFE8;
        --teal: #416C72;
        --dark: #344B50;
        --muted: #71838A;

        min-height: 80vh;
        padding: 65px 20px 85px;
        background:
            radial-gradient(circle at 10% 15%, rgba(220,232,244,.65), transparent 30%),
            radial-gradient(circle at 90% 75%, rgba(233,226,242,.55), transparent 30%);
        color: var(--dark);
    }

    .confirmation-wrapper {
        max-width: 760px;
        margin: 0 auto;
    }

    .confirmation-card {
        background: rgba(255,255,255,.78);
        border: 1px solid rgba(255,255,255,.9);
        border-radius: 28px;
        padding: 48px 55px;
        text-align: center;
        box-shadow: 0 18px 55px rgba(52,75,80,.09);
        backdrop-filter: blur(14px);
    }

    .confirmation-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 15px;
        background: var(--sage);
        color: var(--teal);
        border-radius: 30px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: .4px;
        margin-bottom: 25px;
    }

    .success-illustration {
        width: 112px;
        height: 112px;
        border-radius: 50%;
        margin: 0 auto 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(145deg, #E1EFE6, #DCE8F4);
        box-shadow: 0 10px 30px rgba(65,108,114,.10);
        position: relative;
    }

    .success-illustration::before {
        content: "";
        position: absolute;
        inset: -9px;
        border: 1px dashed rgba(65,108,114,.25);
        border-radius: 50%;
    }

    .success-illustration svg {
        width: 53px;
        height: 53px;
        color: var(--teal);
    }

    .confirmation-card h1 {
        color: var(--dark);
        font-size: clamp(25px, 4vw, 34px);
        line-height: 1.3;
        font-weight: 750;
        margin: 0 0 14px;
    }

    .confirmation-description {
        color: var(--muted);
        font-size: 14px;
        line-height: 1.8;
        max-width: 530px;
        margin: 0 auto;
    }

    .ticket-box {
        margin: 32px 0 25px;
        padding: 23px;
        background: linear-gradient(135deg, #F0F5F9, #F5F1F8);
        border: 1px dashed #B8C9CC;
        border-radius: 18px;
    }

    .ticket-label {
        color: var(--muted);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .ticket-number {
        color: var(--teal);
        font-size: 25px;
        font-weight: 800;
        letter-spacing: 1.5px;
        margin-bottom: 9px;
    }

    .ticket-note {
        color: var(--muted);
        font-size: 11px;
        line-height: 1.6;
    }

    .reminder-box {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        padding: 17px 19px;
        background: rgba(220,233,226,.48);
        border: 1px solid rgba(180,207,190,.5);
        border-radius: 15px;
        text-align: left;
        margin-bottom: 28px;
    }

    .reminder-icon {
        width: 35px;
        height: 35px;
        flex-shrink: 0;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #DCE9E2;
        color: var(--teal);
    }

    .reminder-icon svg {
        width: 18px;
        height: 18px;
    }

    .reminder-box strong {
        display: block;
        font-size: 13px;
        margin-bottom: 4px;
        color: var(--dark);
    }

    .reminder-box p {
        font-size: 12px;
        line-height: 1.7;
        color: var(--muted);
        margin: 0;
    }

    .confirmation-actions {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .btn-track,
    .btn-home {
        width: 100%;
        min-height: 49px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        border-radius: 13px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        transition: .25s ease;
    }

    .btn-track {
        background: var(--teal);
        color: white;
        border: 1px solid var(--teal);
        box-shadow: 0 7px 18px rgba(65,108,114,.16);
    }

    .btn-track:hover {
        background: #345B60;
        color: white;
        transform: translateY(-2px);
    }

    .btn-home {
        background: rgba(255,255,255,.75);
        color: var(--teal);
        border: 1px solid #D6E0E1;
    }

    .btn-home:hover {
        background: var(--blue);
        color: var(--dark);
    }

    .btn-track svg,
    .btn-home svg {
        width: 17px;
        height: 17px;
    }

    .privacy-note {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        margin-top: 25px;
        color: var(--muted);
        font-size: 11px;
        line-height: 1.6;
    }

    .privacy-note svg {
        width: 15px;
        height: 15px;
        flex-shrink: 0;
        color: var(--teal);
    }

    @media (max-width: 600px) {
        .confirmation-page {
            padding: 40px 15px 60px;
        }

        .confirmation-card {
            padding: 35px 22px;
            border-radius: 22px;
        }

        .success-illustration {
            width: 95px;
            height: 95px;
        }

        .ticket-number {
            font-size: 21px;
        }

        .reminder-box {
            padding: 14px;
        }
    }
</style>

<div class="confirmation-page">
    <div class="confirmation-wrapper">

        <div class="confirmation-card">

            <div class="confirmation-label">
                <span>✦</span>
                KONFIRMASI PENGADUAN
            </div>

            <div class="success-illustration">
                <svg viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2.2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 6 9 17l-5-5"></path>
                </svg>
            </div>

            <h1>Terima Kasih Telah<br>Mempercayai Kami</h1>

            <p class="confirmation-description">
                Pengaduan Anda telah melalui tahap pengiriman.
                Satgas PPKS berkomitmen untuk menjaga kerahasiaan
                identitas dan menangani setiap pengaduan dengan
                penuh perhatian serta sesuai prosedur.
            </p>

            <div class="ticket-box">
                <div class="ticket-label">Nomor Tiket Pengaduan</div>

                <div class="ticket-number">
                    {{ $ticketNumber ?? '—' }}
                </div>
            </div>

            <div class="reminder-box">
                <div class="reminder-icon">
                    <svg viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 8v4l2.5 2.5"></path>
                        <circle cx="12" cy="12" r="9"></circle>
                    </svg>
                </div>

                <div>
                    <strong>Simpan nomor tiket Anda</strong>
                    <p>
                        Nomor tiket digunakan untuk memantau perkembangan
                        pengaduan. Pastikan nomor ini disimpan dengan aman
                        dan tidak dibagikan kepada pihak yang tidak berkepentingan.
                    </p>
                </div>
            </div>

            <div class="confirmation-actions">

                <a href="{{ url('/lacak') }}" class="btn-track">
                    <svg viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="7"></circle>
                        <path d="m20 20-4-4"></path>
                    </svg>
                    Lacak Pengaduan
                </a>

                <a href="{{ url('/') }}" class="btn-home">
                    <svg viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="m3 10 9-7 9 7"></path>
                        <path d="M5 9v11h14V9"></path>
                        <path d="M9 20v-6h6v6"></path>
                    </svg>
                    Kembali ke Beranda
                </a>

            </div>

            <div class="privacy-note">
                <svg viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <rect x="4" y="10" width="16" height="11" rx="2"></rect>
                    <path d="M8 10V7a4 4 0 0 1 8 0v3"></path>
                </svg>

                Identitas dan informasi pribadi Anda dilindungi
                sesuai kebijakan kerahasiaan Satgas PPKS.
            </div>

        </div>

    </div>
</div>

@endsection
