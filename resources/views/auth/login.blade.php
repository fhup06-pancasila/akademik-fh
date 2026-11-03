<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Masuk ke Sistem Informasi Akademik Fakultas Hukum Universitas Pancasila">
    <meta name="theme-color" content="#172554">
    <title>Masuk - {{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('build/metis/assets/icons/favicon.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="{{ asset('build/metis/assets/main-Kuf3cpUe.css') }}">
    <style>
        :root{--navy:#0f2347;--blue:#1d4ed8;--paper:#f5f7fb}*{box-sizing:border-box}
        body{min-height:100vh;margin:0;background:var(--paper);color:#172033}.login-shell{min-height:100vh;display:grid;grid-template-columns:minmax(420px,1.05fr) minmax(460px,.95fr)}
        .story-panel{position:relative;isolation:isolate;display:flex;flex-direction:column;justify-content:space-between;overflow:hidden;padding:clamp(2rem,5vw,5rem);color:#fff;background:linear-gradient(145deg,#07152e 0%,#102b5a 52%,#155e9b 100%)}
        .story-panel:before{content:"";position:absolute;z-index:-1;inset:0;background:radial-gradient(circle at 78% 20%,rgba(56,189,248,.3),transparent 28%),linear-gradient(130deg,transparent 54%,rgba(255,255,255,.045) 54% 55%,transparent 55%)}
        .story-panel:after{content:"";position:absolute;z-index:-1;width:460px;height:460px;border:1px solid rgba(255,255,255,.14);border-radius:50%;right:-210px;bottom:-190px;box-shadow:0 0 0 68px rgba(255,255,255,.035),0 0 0 136px rgba(255,255,255,.025)}
        .brand{display:flex;align-items:center;gap:.9rem}.brand-seal{width:54px;height:54px;display:grid;place-items:center;border:1px solid rgba(255,255,255,.32);border-radius:16px;background:rgba(255,255,255,.1);backdrop-filter:blur(12px);font-weight:800;letter-spacing:-.04em}.brand-name{font-size:1.05rem;font-weight:700}.brand-sub{font-size:.78rem;color:rgba(255,255,255,.64);letter-spacing:.07em;text-transform:uppercase}
        .story-copy{max-width:660px;margin:5rem 0}.eyebrow{display:inline-flex;align-items:center;gap:.55rem;margin-bottom:1.5rem;font-size:.76rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:#bae6fd}.eyebrow:before{content:"";width:28px;height:1px;background:#7dd3fc}.story-copy h1{font-size:clamp(2.7rem,5vw,5.6rem);line-height:.98;letter-spacing:-.055em;margin:0 0 1.5rem;max-width:760px}.story-copy p{font-size:clamp(1rem,1.4vw,1.18rem);line-height:1.75;color:rgba(255,255,255,.7);max-width:570px;margin:0}
        .trust-row{display:flex;align-items:center;gap:1.3rem;color:rgba(255,255,255,.6);font-size:.8rem}.trust-item{display:flex;align-items:center;gap:.5rem}.trust-dot{width:7px;height:7px;border-radius:50%;background:#4ade80;box-shadow:0 0 0 5px rgba(74,222,128,.12)}
        .form-panel{display:flex;align-items:center;justify-content:center;padding:clamp(2rem,6vw,6rem);background:#fff}.form-wrap{width:min(100%,440px)}.mobile-brand{display:none}.form-head{margin-bottom:2rem}.form-head h2{font-size:2rem;letter-spacing:-.035em;margin:0 0 .6rem}.form-head p{color:#64748b;margin:0;line-height:1.65}.sso-badge{display:inline-flex;align-items:center;gap:.5rem;padding:.48rem .75rem;margin-bottom:1.4rem;border-radius:999px;background:#eff6ff;color:#1d4ed8;font-size:.76rem;font-weight:700}
        .form-label{font-size:.86rem}.input-group-text{background:#fff;border-right:0;color:#94a3b8}.form-control.auth-input{min-height:52px;border-left:0;padding-left:.25rem}.form-control.auth-input:focus{box-shadow:none;border-color:#86b7fe}.input-group:focus-within .input-group-text{border-color:#86b7fe;color:#2563eb}.password-toggle{border-left:0;background:#fff;color:#64748b}.btn-login{min-height:52px;border:0;border-radius:.65rem;background:linear-gradient(135deg,#1d4ed8,#2563eb 60%,#0284c7);box-shadow:0 12px 24px rgba(37,99,235,.2);font-weight:700;transition:.2s}.btn-login:hover{transform:translateY(-1px);box-shadow:0 15px 28px rgba(37,99,235,.28)}
        .hris-note{display:flex;gap:.8rem;margin-top:1.5rem;padding:1rem;border:1px solid #e2e8f0;border-radius:.8rem;background:#f8fafc;color:#64748b;font-size:.78rem;line-height:1.55}.hris-note i{color:#2563eb;font-size:1.05rem}.support{margin-top:2rem;text-align:center;color:#94a3b8;font-size:.78rem}.support a{color:#475569;text-decoration:none;font-weight:600}
        @media(max-width:900px){.login-shell{grid-template-columns:1fr}.story-panel{display:none}.form-panel{min-height:100vh;padding:2rem 1.4rem}.mobile-brand{display:flex;color:#0f2347;margin-bottom:3rem}.mobile-brand .brand-seal{background:#eff6ff;border-color:#dbeafe;color:#1d4ed8}.mobile-brand .brand-sub{color:#64748b}}
    </style>
</head>
<body>
<main class="login-shell">
    <section class="story-panel" aria-label="Tentang Akademik FHUP">
        <div class="brand"><div class="brand-seal">FH</div><div><div class="brand-name">Universitas Pancasila</div><div class="brand-sub">Fakultas Hukum</div></div></div>
        <div class="story-copy"><span class="eyebrow">Sistem Informasi Akademik</span><h1>Satu akses untuk layanan akademik.</h1><p>Kelola aktivitas akademik Fakultas Hukum dalam lingkungan digital yang terintegrasi, aman, dan terpercaya.</p></div>
        <div class="trust-row"><span class="trust-item"><span class="trust-dot"></span>Sistem beroperasi</span><span class="trust-item"><i class="bi bi-shield-check"></i>Identitas terpusat HRIS</span></div>
    </section>
    <section class="form-panel">
        <div class="form-wrap">
            <div class="brand mobile-brand"><div class="brand-seal">FH</div><div><div class="brand-name">Akademik FHUP</div><div class="brand-sub">Universitas Pancasila</div></div></div>
            <div class="form-head"><span class="sso-badge"><i class="bi bi-shield-lock-fill"></i>Single Sign-On</span><h2>Selamat datang</h2><p>Masuk menggunakan akun HRIS FHUP untuk mengakses layanan Akademik FH.</p></div>
            @if($errors->any())<div class="alert alert-danger d-flex gap-2 py-3" role="alert"><i class="bi bi-exclamation-circle-fill flex-shrink-0"></i><div>{{ $errors->first() }}</div></div>@endif
            <a href="{{ route('oidc.redirect') }}" class="btn btn-primary btn-login w-100 d-flex align-items-center justify-content-center">Login dengan HRIS FHUP<i class="bi bi-arrow-right ms-2"></i></a>
            <div class="hris-note"><i class="bi bi-info-circle-fill"></i><span>Hanya akun yang telah diberi akses oleh administrator HRIS FHUP yang dapat masuk. Akademik FH tidak menerima atau menyimpan kata sandi Anda.</span></div>
            <div class="support">Mengalami kendala? <a href="{{ rtrim(config('services.hris.url'), '/') }}">Buka HRIS FHUP</a> atau hubungi administrator.</div>
        </div>
    </section>
</main>
</body>
</html>
