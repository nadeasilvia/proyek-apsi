<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem PPKS FSH UINSA')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .bg-uin { background-color: #0d5c3a; } /* Warna hijau khas kampus */
        .text-uin { color: #0d5c3a; }
    </style>
</head>
<body class="bg-light">

    <!-- Navbar Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-uin shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <i class="bi bi-shield-check me-2"></i>Satgas PPKS FSH UINSA
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}"><i class="bi bi-house-door me-1"></i>Beranda & Edukasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/lapor') }}"><i class="bi bi-pencil-square me-1"></i>Buat Laporan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/lacak') }}"><i class="bi bi-search me-1"></i>Lacak Status</a></li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-outline-light btn-sm px-3 mt-1 mt-lg-0" href="{{ url('/satgas/dashboard') }}">
                            <i class="bi bi-person-lock me-1"></i>Portal Satgas
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content Area -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-5 fs-7">
        <div class="container">
            <small>&copy; 2026 Tim Satgas PPKS - Fakultas Syariah & Hukum UIN Sunan Ampel Surabaya</small>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/bs/bootstrap.bundle.min.js"></script>
</body>
</html>