<!doctype html>
<html lang="id" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistem Informasi Akademik Fakultas Hukum Universitas Pancasila">
    <meta name="theme-color" content="#2563eb">
    <title>@yield('title', 'Dashboard') - {{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('build/metis/assets/icons/favicon.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="{{ asset('build/metis/assets/main-Kuf3cpUe.css') }}">
    <style>
        .brand-mark{width:38px;height:38px;display:grid;place-items:center;border-radius:12px;background:linear-gradient(135deg,#1d4ed8,#0ea5e9);color:#fff;font-weight:800;box-shadow:0 8px 20px rgba(37,99,235,.24)}
        .academic-hero{background:linear-gradient(120deg,#172554,#1d4ed8 58%,#0ea5e9);color:#fff;border:0;overflow:hidden;position:relative}
        .academic-hero:after{content:"";position:absolute;width:230px;height:230px;border:45px solid rgba(255,255,255,.08);border-radius:50%;right:-55px;top:-85px}
        .table>tbody>tr:last-child>td{border-bottom:0}.avatar-initial{width:38px;height:38px;display:grid;place-items:center;border-radius:50%;font-weight:700;background:#dbeafe;color:#1d4ed8}
        [data-bs-theme="dark"] .academic-hero{background:linear-gradient(120deg,#020617,#172554 60%,#075985)}
    </style>
</head>
<body data-page="dashboard" class="admin-layout">
<a href="#main-content" class="skip-link">Lewati ke konten utama</a>
<div id="loading-screen" class="loading-screen"><div class="loading-spinner"><div class="spinner-border text-primary"><span class="visually-hidden">Memuat...</span></div></div></div>
<div class="admin-app"><div class="admin-wrapper" id="admin-wrapper">
    <header class="admin-header">
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
                    <span class="brand-mark">FH</span><span><span class="d-block h5 mb-0 fw-bold text-primary-emphasis">Akademik FHUP</span><small class="text-muted d-none d-sm-block">Fakultas Hukum</small></span>
                </a>
                <button class="hamburger-menu" type="button" data-sidebar-toggle aria-label="Buka menu"><i class="bi bi-list"></i></button>
                <div class="search-container flex-grow-1 mx-4 d-none d-md-block">
                    <div class="position-relative"><input type="search" class="form-control" placeholder="Cari mahasiswa, mata kuliah..." aria-label="Pencarian"><i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-3"></i></div>
                </div>
                <div class="navbar-nav flex-row align-items-center">
                    <button class="btn btn-outline-secondary me-2" type="button" data-theme-toggle title="Ganti tema"><i class="bi bi-moon-stars"></i></button>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary d-flex align-items-center" data-bs-toggle="dropdown"><span class="avatar-initial me-2" style="width:26px;height:26px;font-size:.7rem">{{ mb_strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}</span><span class="d-none d-md-inline">{{ auth()->user()->name }}</span><i class="bi bi-chevron-down ms-2"></i></button>
                        <ul class="dropdown-menu dropdown-menu-end"><li><span class="dropdown-item-text"><small class="text-muted">Masuk melalui HRIS</small><br><span class="small">{{ auth()->user()->email }}</span></span></li><li><hr class="dropdown-divider"></li><li><form method="POST" action="{{ route('logout') }}">@csrf<button class="dropdown-item text-danger" type="submit"><i class="bi bi-box-arrow-right me-2"></i>Keluar</button></form></li></ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <aside class="admin-sidebar" id="admin-sidebar">
        <div class="sidebar-content"></div>
    </aside>
    <div class="sidebar-backdrop" aria-hidden="true"></div>
    <main id="main-content" class="admin-main">@yield('content')</main>
    <footer class="admin-footer"><div class="container-fluid"><div class="d-flex justify-content-between"><small>&copy; {{ date('Y') }} Fakultas Hukum Universitas Pancasila</small><small class="text-muted">Sistem Informasi Akademik</small></div></div></footer>
</div></div>
<script type="module" src="{{ asset('build/metis/assets/main-BqKkk_Lj.js') }}"></script>
<script type="module" src="{{ asset('build/metis/assets/rolldown-runtime-hePW80VL.js') }}"></script>
<script type="module" src="{{ asset('build/metis/assets/vendor-ui-Be8JR3ju.js') }}"></script>
<script type="module" src="{{ asset('build/metis/assets/vendor-bootstrap-Dj44xPS1.js') }}"></script>
<script type="module" src="{{ asset('build/metis/assets/vendor-charts-_UPf9h_O.js') }}"></script>
<script type="module" src="{{ asset('build/metis/assets/main-1Eks1J0_.js') }}"></script>
@stack('scripts')
</body>
</html>
