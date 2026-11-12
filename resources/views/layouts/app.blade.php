
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Satgas PPKS FSH UINSA')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --ppks-blue: #DCE8F4;
            --ppks-sage: #DCE9E2;
            --ppks-lavender: #E9E2F2;
            --ppks-cream: #F5EFE8;
            --ppks-teal: #416C72;
            --ppks-dark: #344B50;
            --ppks-muted: #71838A;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #F8FAFB;
            color: var(--ppks-dark);
            margin: 0;
        }

        /* NAVBAR */

        .ppks-navbar {
            position: sticky;
            top: 0;
            z-index: 1030;
            background: rgba(255,255,255,.82);
            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);
            border-bottom: 1px solid rgba(65,108,114,.10);
            box-shadow: 0 5px 25px rgba(65,108,114,.045);
            padding: 13px 0;
        }

        .ppks-brand {
            display: flex;
            align-items: center;
            gap: 11px;
            text-decoration: none;
            color: var(--ppks-dark);
        }

        .ppks-brand:hover {
            color: var(--ppks-teal);
        }

        .brand-icon {
            width: 43px;
            height: 43px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 14px;
            background: linear-gradient(135deg, #DCE8F4, #DCE9E2);
            color: var(--ppks-teal);
            font-size: 1.4rem;
        }

        .brand-name {
            font-size: 1rem;
            font-weight: 800;
            line-height: 1.3;
            letter-spacing: -.4px;
        }

        .brand-subtitle {
            display: block;
            color: var(--ppks-muted);
            font-size: .65rem;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .ppks-navbar .navbar-nav {
            align-items: center;
            gap: 7px;
        }

        .ppks-navbar .nav-link {
            color: #65777D;
            font-size: .88rem;
            font-weight: 600;
            padding: 11px 16px !important;
            border-radius: 12px;
            transition: all .25s ease;
        }

        .ppks-navbar .nav-link:hover {
            color: var(--ppks-teal);
            background: rgba(220,233,226,.55);
        }

        .ppks-navbar .nav-link.active {
            color: var(--ppks-teal);
            background: linear-gradient(120deg, #E5EDF6, #E9E5F1);
            font-weight: 700;
        }

        /* PORTAL BUTTON */

        .btn-portal {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 19px;
            border-radius: 12px;
            border: 1px solid var(--ppks-teal);
            background: var(--ppks-teal);
            color: white;
            text-decoration: none;
            font-size: .85rem;
            font-weight: 700;
            transition: .3s ease;
            box-shadow: 0 5px 15px rgba(65,108,114,.14);
        }

        .btn-portal:hover {
            background: #345A60;
            color: white;
            transform: translateY(-2px);
        }

        /* MOBILE TOGGLER */

        .ppks-toggler {
            border: 1px solid rgba(65,108,114,.2);
            border-radius: 11px;
            padding: 8px 11px;
            color: var(--ppks-teal);
        }

        .ppks-toggler:focus {
            box-shadow: 0 0 0 3px rgba(65,108,114,.12);
        }

        /* MAIN CONTENT */

        .ppks-main {
            min-height: 70vh;
        }

        /* FOOTER */

        .ppks-footer {
            position: relative;
            overflow: hidden;
            background: linear-gradient(120deg, #E5EDF6, #EDE8F4, #E2EEE8);
            border-top: 1px solid rgba(255,255,255,.8);
            padding: 35px 0;
            margin-top: 30px;
        }

        .footer-brand {
            color: var(--ppks-dark);
            font-weight: 800;
        }

        .footer-text {
            color: #71838A;
            font-size: .82rem;
            line-height: 1.8;
        }

        @media (max-width: 991px) {
            .ppks-navbar .navbar-nav {
                align-items: stretch;
                padding-top: 15px;
                gap: 5px;
            }

            .ppks-navbar .nav-link {
                padding: 12px 15px !important;
            }

            .btn-portal {
                margin-top: 10px;
                width: 100%;
            }

            .ppks-navbar .navbar-collapse {
                padding-bottom: 8px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                scroll-behavior: auto !important;
                transition: none !important;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg ppks-navbar">
        <div class="container">

            <!-- BRAND -->
            <a class="ppks-brand" href="{{ url('/') }}">

                <div class="brand-icon">
                    <i class="bi bi-shield-check"></i>
                </div>

                <div>
                    <div class="brand-name">Satgas PPKS</div>
                    <span class="brand-subtitle">FSH UINSA</span>
                </div>

            </a>

            <!-- MOBILE BUTTON -->
            <button class="navbar-toggler ppks-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Buka navigasi">

                <i class="bi bi-list fs-3"></i>

            </button>

            <!-- NAVIGATION -->
            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                           href="{{ url('/') }}">

                            <i class="bi bi-house-door me-1"></i>
                            Beranda 

                        </a>
                    </li>

                    <li class="nav-item">
    <a class="nav-link {{ request()->is('informasi-edukasi') ? 'active' : '' }}"
       href="{{ url('/informasi-edukasi') }}">
        <i class="bi bi-book me-1"></i>
        Edukasi 
    </a>
</li>

                    <li class="nav-item">
    <a class="nav-link {{ request()->is('layanan') ? 'active' : '' }}"
       href="{{ url('/layanan') }}">
        <i class="bi bi-heart-pulse me-1"></i>
        Layanan
    </a>
</li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('lacak') ? 'active' : '' }}"
                           href="{{ url('/lacak') }}">

                            <i class="bi bi-search me-1"></i>
                            Lacak Status

                        </a>
                    </li>

                    <li class="nav-item ms-lg-3">
                        <a class="btn-portal"
                           href="{{ route('internal.login') }}">

                            <i class="bi bi-person-lock"></i>
                            Portal Satgas

                        </a>
                    </li>

                </ul>

            </div>

        </div>
    </nav>


    <!-- MAIN CONTENT -->
    <main class="ppks-main">
        @yield('content')
    </main>


    <!-- FOOTER -->
    <footer class="ppks-footer">

        <div class="container">

            <div class="row align-items-center gy-3">

                <div class="col-md-7">

                    <div class="footer-brand mb-2">
                        <i class="bi bi-shield-check me-2"></i>
                        Satgas PPKS FSH UINSA
                    </div>

                    <p class="footer-text mb-0">
                        Ruang aman untuk mendengarkan, mendampingi,
                        dan melindungi seluruh civitas akademika.
                    </p>

                </div>

                <div class="col-md-5 text-md-end">

                    <p class="footer-text mb-0">
                        &copy; {{ date('Y') }} Tim Satgas PPKS
                        <br>
                        Fakultas Syariah dan Hukum
                        <br>
                        UIN Sunan Ampel Surabaya
                    </p>

                </div>

            </div>

        </div>

    </footer>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>
