<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sistem Etik — Komite Etik Penelitian</title>
<meta name="description" content="Sistem Pengajuan Ethical Clearance Penelitian secara online. Cepat, transparan, dan aman.">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
/* RESET & BASE */
*{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
body{font-family:'Inter',sans-serif;color:#1e293b;background:#fff;line-height:1.6;overflow-x:hidden}
a{text-decoration:none;color:inherit}
img,svg{max-width:100%;display:block}
.container{max-width:1200px;margin:0 auto;padding:0 24px}

:root{
  --primary:#1e3a5f;--secondary:#2563eb;--accent:#0ea5e9;
  --dark:#0a1628;--light:#f1f5f9;--border:#e2e8f0;
  --text:#1e293b;--muted:#64748b;
}

/* NAVBAR */
.navbar{position:fixed;top:0;left:0;right:0;z-index:1000;background:rgba(255,255,255,.92);backdrop-filter:saturate(180%) blur(14px);-webkit-backdrop-filter:saturate(180%) blur(14px);border-bottom:1px solid transparent;transition:all .3s ease}
.navbar.scrolled{border-bottom-color:var(--border);box-shadow:0 4px 20px rgba(0,0,0,.04)}
.nav-wrap{display:flex;align-items:center;justify-content:space-between;height:72px}
.brand{display:flex;align-items:center;gap:12px}
.brand-logo{width:44px;height:44px;border-radius:12px;background:linear-gradient(135deg,#2563eb,#0ea5e9);display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.3rem;box-shadow:0 4px 14px rgba(37,99,235,.4)}
.brand-text h1{font-size:1rem;font-weight:700;color:var(--primary);line-height:1.1}
.brand-text p{font-size:.7rem;color:var(--muted);margin-top:2px}
.nav-menu{display:flex;align-items:center;gap:8px;list-style:none}
.nav-menu a{padding:8px 16px;border-radius:8px;font-size:.88rem;font-weight:500;color:#475569;transition:all .2s}
.nav-menu a:hover{color:var(--secondary);background:#eff6ff}
.nav-actions{display:flex;align-items:center;gap:10px}
.btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:10px 22px;border-radius:10px;font-size:.88rem;font-weight:600;cursor:pointer;transition:all .25s ease;border:none}
.btn-ghost{background:transparent;color:var(--primary)}
.btn-ghost:hover{background:#eff6ff;color:var(--secondary)}
.btn-primary{background:linear-gradient(135deg,#2563eb,#0ea5e9);color:#fff;box-shadow:0 6px 18px rgba(37,99,235,.35)}
.btn-primary:hover{transform:translateY(-2px);box-shadow:0 10px 24px rgba(37,99,235,.45)}
.btn-outline{background:transparent;color:#fff;border:2px solid rgba(255,255,255,.4)}
.btn-outline:hover{background:#fff;color:var(--primary);border-color:#fff}
.btn-light{background:#fff;color:var(--primary);box-shadow:0 6px 18px rgba(0,0,0,.1)}
.btn-light:hover{transform:translateY(-2px);box-shadow:0 10px 24px rgba(0,0,0,.18)}
.btn-lg{padding:14px 30px;font-size:.95rem}
.mobile-toggle{display:none;width:42px;height:42px;border-radius:10px;background:transparent;border:1px solid var(--border);color:var(--primary);font-size:1.3rem;align-items:center;justify-content:center;cursor:pointer}

/* HERO */
.hero{position:relative;padding:140px 0 100px;background:radial-gradient(ellipse at top right,rgba(14,165,233,.25),transparent 60%),radial-gradient(ellipse at bottom left,rgba(37,99,235,.3),transparent 55%),linear-gradient(170deg,#0a1628 0%,#0f2040 40%,#1e3a5f 100%);color:#fff;overflow:hidden}
.hero::before{content:'';position:absolute;inset:0;background-image:radial-gradient(circle at 1px 1px,rgba(255,255,255,.08) 1px,transparent 0);background-size:32px 32px;opacity:.6;pointer-events:none}
.hero-blob-1,.hero-blob-2{position:absolute;border-radius:50%;filter:blur(80px);opacity:.4;pointer-events:none}
.hero-blob-1{width:480px;height:480px;background:#2563eb;top:-100px;right:-100px;animation:float 10s ease-in-out infinite}
.hero-blob-2{width:380px;height:380px;background:#0ea5e9;bottom:-80px;left:-80px;animation:float 12s ease-in-out infinite reverse}
@keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-30px)}}
.hero-grid{position:relative;z-index:1;display:grid;grid-template-columns:1.1fr 1fr;gap:60px;align-items:center}
.hero-badge{display:inline-flex;align-items:center;gap:8px;padding:6px 16px;border-radius:30px;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.15);font-size:.78rem;font-weight:500;margin-bottom:20px;backdrop-filter:blur(10px)}
.hero-badge i{color:#0ea5e9}
.hero h2{font-size:3.3rem;font-weight:800;line-height:1.1;margin-bottom:20px;letter-spacing:-.02em}
.hero h2 .grad{background:linear-gradient(90deg,#0ea5e9,#7dd3fc);-webkit-background-clip:text;background-clip:text;color:transparent}
.hero p{font-size:1.1rem;color:rgba(255,255,255,.78);margin-bottom:32px;max-width:560px}
.hero-cta{display:flex;gap:14px;flex-wrap:wrap}
.hero-trust{display:flex;align-items:center;gap:18px;margin-top:36px;font-size:.82rem;color:rgba(255,255,255,.65);flex-wrap:wrap}
.trust-item{display:flex;align-items:center;gap:8px}
.trust-item i{color:#10b981;font-size:1.1rem}

/* Mockup */
.hero-mockup{position:relative;animation:floatY 6s ease-in-out infinite}
@keyframes floatY{0%,100%{transform:translateY(0)}50%{transform:translateY(-14px)}}
.mockup-card{background:#fff;color:var(--text);border-radius:20px;padding:24px;box-shadow:0 30px 60px rgba(0,0,0,.4);transform:rotate(-2deg)}
.mockup-header{display:flex;align-items:center;justify-content:space-between;padding-bottom:16px;border-bottom:1px solid var(--border);margin-bottom:16px}
.mockup-dot{width:10px;height:10px;border-radius:50%;background:#cbd5e1;display:inline-block;margin-right:5px}
.mockup-dot.r{background:#ef4444}.mockup-dot.y{background:#f59e0b}.mockup-dot.g{background:#10b981}
.mockup-title{font-size:.78rem;font-weight:600;color:#64748b}
.mockup-stats{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:16px}
.mockup-stat{padding:14px;border-radius:12px;color:#fff}
.ms-blue{background:linear-gradient(135deg,#1e3a5f,#2563eb)}
.ms-teal{background:linear-gradient(135deg,#0d9488,#14b8a6)}
.ms-orange{background:linear-gradient(135deg,#b45309,#f59e0b)}
.ms-green{background:linear-gradient(135deg,#065f46,#10b981)}
.mockup-stat .n{font-size:1.5rem;font-weight:700;line-height:1}
.mockup-stat .l{font-size:.66rem;opacity:.85;margin-top:4px}
.mockup-list-item{display:flex;align-items:center;justify-content:space-between;padding:10px 0;border-bottom:1px dashed var(--border);font-size:.78rem;gap:10px}
.mockup-list-item:last-child{border-bottom:none}
.mockup-list-item .ttl{color:#1e293b;font-weight:500}
.mockup-list-item .bdg{font-size:.66rem;padding:3px 10px;border-radius:20px;font-weight:600;white-space:nowrap}
.bdg-app{background:#ecfdf5;color:#065f46}
.bdg-rev{background:#eff6ff;color:#1d4ed8}
.bdg-pen{background:#fffbeb;color:#92400e}
.mockup-side{position:absolute;background:#fff;color:var(--text);border-radius:14px;padding:14px 18px;box-shadow:0 20px 40px rgba(0,0,0,.25);display:flex;align-items:center;gap:12px}
.mockup-side-1{top:-22px;left:-30px;transform:rotate(-4deg)}
.mockup-side-2{bottom:-26px;right:-20px;transform:rotate(3deg)}
.mockup-side .ic{width:42px;height:42px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;color:#fff}
.ic-green{background:linear-gradient(135deg,#065f46,#10b981)}
.ic-blue{background:linear-gradient(135deg,#1e3a5f,#2563eb)}
.mockup-side .t{font-size:.78rem;font-weight:600;color:#1e293b}
.mockup-side .s{font-size:.66rem;color:#64748b}

/* STATS */
.stats-section{margin-top:-60px;position:relative;z-index:5;padding:0 0 30px}
.stats-grid{background:#fff;border-radius:20px;padding:36px 24px;box-shadow:0 20px 60px rgba(0,0,0,.12);display:grid;grid-template-columns:repeat(4,1fr);border:1px solid var(--border)}
.stat-item{text-align:center;padding:0 16px;border-right:1px solid var(--border)}
.stat-item:last-child{border-right:none}
.stat-item .num{font-size:2.3rem;font-weight:800;background:linear-gradient(135deg,#1e3a5f,#0ea5e9);-webkit-background-clip:text;background-clip:text;color:transparent;line-height:1}
.stat-item .lbl{font-size:.82rem;color:var(--muted);margin-top:6px;font-weight:500}

/* SECTION */
.section{padding:90px 0}
.section-head{text-align:center;max-width:680px;margin:0 auto 56px}
.section-tag{display:inline-block;padding:6px 16px;border-radius:30px;background:#eff6ff;color:var(--secondary);font-size:.74rem;font-weight:600;text-transform:uppercase;letter-spacing:.08em;margin-bottom:14px}
.section-title{font-size:2.3rem;font-weight:800;color:var(--primary);line-height:1.2;letter-spacing:-.01em;margin-bottom:12px}
.section-sub{font-size:1rem;color:var(--muted);max-width:560px;margin:0 auto}

/* FEATURES */
.features-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px}
.feature-card{background:#fff;border:1px solid var(--border);border-radius:18px;padding:30px;transition:all .3s ease;position:relative;overflow:hidden}
.feature-card::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,#2563eb,#0ea5e9);transform:scaleX(0);transform-origin:left;transition:transform .3s ease}
.feature-card:hover{transform:translateY(-6px);box-shadow:0 20px 40px rgba(0,0,0,.08);border-color:transparent}
.feature-card:hover::before{transform:scaleX(1)}
.feature-icon{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.5rem;margin-bottom:18px}
.fi-1{background:linear-gradient(135deg,#1e3a5f,#2563eb)}
.fi-2{background:linear-gradient(135deg,#0d9488,#14b8a6)}
.fi-3{background:linear-gradient(135deg,#6d28d9,#8b5cf6)}
.fi-4{background:linear-gradient(135deg,#b45309,#f59e0b)}
.fi-5{background:linear-gradient(135deg,#065f46,#10b981)}
.fi-6{background:linear-gradient(135deg,#be123c,#f43f5e)}
.feature-card h3{font-size:1.1rem;font-weight:700;color:var(--primary);margin-bottom:8px}
.feature-card p{font-size:.88rem;color:var(--muted);line-height:1.6}

/* WORKFLOW */
.workflow-section{background:linear-gradient(180deg,#f8fafc,#eff6ff)}
.workflow{display:grid;grid-template-columns:repeat(5,1fr);gap:16px;position:relative}
.workflow::before{content:'';position:absolute;top:38px;left:10%;right:10%;height:2px;background:repeating-linear-gradient(90deg,#cbd5e1 0 8px,transparent 8px 16px);z-index:0}
.workflow-step{background:#fff;border-radius:16px;padding:28px 18px;text-align:center;border:1px solid var(--border);position:relative;z-index:1;transition:all .3s}
.workflow-step:hover{transform:translateY(-4px);box-shadow:0 15px 30px rgba(0,0,0,.08)}
.workflow-num{width:54px;height:54px;border-radius:50%;background:linear-gradient(135deg,#2563eb,#0ea5e9);color:#fff;font-weight:700;font-size:1.2rem;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;box-shadow:0 8px 20px rgba(37,99,235,.35);border:4px solid #fff}
.workflow-step h4{font-size:.92rem;font-weight:700;color:var(--primary);margin-bottom:6px}
.workflow-step p{font-size:.78rem;color:var(--muted);line-height:1.5}

/* ROLES */
.roles-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:16px}
.role-card{background:#fff;border:1px solid var(--border);border-radius:16px;padding:24px 18px;text-align:center;transition:all .3s}
.role-card:hover{transform:translateY(-4px);box-shadow:0 12px 28px rgba(0,0,0,.08);border-color:var(--secondary)}
.role-icon{width:60px;height:60px;border-radius:50%;margin:0 auto 14px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;color:#fff}
.role-card h4{font-size:.95rem;font-weight:700;color:var(--primary);margin-bottom:6px}
.role-card p{font-size:.78rem;color:var(--muted);line-height:1.5}

/* CTA */
.cta-section{padding:80px 0}
.cta-banner{position:relative;overflow:hidden;background:linear-gradient(135deg,#0a1628 0%,#1e3a5f 50%,#2563eb 100%);border-radius:24px;padding:60px 50px;color:#fff;display:flex;align-items:center;justify-content:space-between;gap:30px;flex-wrap:wrap}
.cta-banner::before{content:'';position:absolute;top:-50%;right:-10%;width:400px;height:400px;border-radius:50%;background:radial-gradient(circle,rgba(14,165,233,.4),transparent 70%)}
.cta-banner::after{content:'';position:absolute;bottom:-50%;left:-5%;width:300px;height:300px;border-radius:50%;background:radial-gradient(circle,rgba(125,211,252,.25),transparent 70%)}
.cta-content{position:relative;z-index:1;max-width:600px}
.cta-content h3{font-size:2rem;font-weight:800;margin-bottom:10px;line-height:1.2}
.cta-content p{font-size:1rem;color:rgba(255,255,255,.8)}
.cta-actions{position:relative;z-index:1;display:flex;gap:12px;flex-wrap:wrap}

/* FOOTER */
.footer{background:#0a1628;color:rgba(255,255,255,.65);padding:60px 0 24px}
.footer-grid{display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:40px;margin-bottom:40px}
.footer-brand h2{color:#fff;font-size:1.05rem;font-weight:700;margin-bottom:8px;display:flex;align-items:center;gap:10px}
.footer-brand .mini-logo{width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,#2563eb,#0ea5e9);display:inline-flex;align-items:center;justify-content:center;color:#fff}
.footer-brand p{font-size:.86rem;line-height:1.7;margin-bottom:14px;max-width:340px}
.footer-social{display:flex;gap:10px}
.footer-social a{width:38px;height:38px;border-radius:10px;background:rgba(255,255,255,.06);display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.75);font-size:1.05rem;transition:all .2s}
.footer-social a:hover{background:var(--secondary);color:#fff;transform:translateY(-2px)}
.footer-col h4{color:#fff;font-size:.88rem;font-weight:600;margin-bottom:16px;text-transform:uppercase;letter-spacing:.06em}
.footer-col ul{list-style:none}
.footer-col li{margin-bottom:10px}
.footer-col a{font-size:.86rem;transition:color .2s}
.footer-col a:hover{color:#0ea5e9}
.footer-col .contact-item{display:flex;align-items:flex-start;gap:10px;font-size:.84rem;margin-bottom:12px}
.footer-col .contact-item i{color:#0ea5e9;font-size:1rem;margin-top:3px}
.footer-bottom{border-top:1px solid rgba(255,255,255,.08);padding-top:24px;text-align:center;font-size:.82rem}
.footer-bottom span{color:#fff;font-weight:500}

/* ANIMATION */
.reveal{opacity:0;transform:translateY(30px);transition:all .8s ease}
.reveal.visible{opacity:1;transform:translateY(0)}

/* MOBILE MENU */
.mobile-menu{display:none;position:fixed;top:72px;left:0;right:0;background:#fff;border-bottom:1px solid var(--border);padding:20px 24px;z-index:999;box-shadow:0 10px 24px rgba(0,0,0,.06)}
.mobile-menu.open{display:block}
.mobile-menu a{display:block;padding:12px 0;font-size:.95rem;color:var(--primary);font-weight:500;border-bottom:1px solid var(--border)}
.mobile-menu a:last-of-type{border-bottom:none}
.mobile-menu .btn{width:100%;margin-top:12px}

/* RESPONSIVE */
@media(max-width:991px){
  .hero{padding:120px 0 80px}
  .hero h2{font-size:2.4rem}
  .hero-grid{grid-template-columns:1fr;gap:40px}
  .hero-mockup{max-width:480px;margin:0 auto}
  .stats-grid{grid-template-columns:repeat(2,1fr);gap:20px;padding:24px}
  .stat-item{border-right:none;padding:10px 0}
  .stat-item:nth-child(odd){border-right:1px solid var(--border)}
  .features-grid{grid-template-columns:repeat(2,1fr)}
  .workflow{grid-template-columns:repeat(2,1fr);gap:20px}
  .workflow::before{display:none}
  .roles-grid{grid-template-columns:repeat(2,1fr)}
  .footer-grid{grid-template-columns:1fr 1fr;gap:30px}
  .cta-content h3{font-size:1.6rem}
  .section-title{font-size:1.9rem}
}
@media(max-width:640px){
  .nav-menu,.btn-ghost.desktop{display:none}
  .mobile-toggle{display:inline-flex}
  .hero{padding:110px 0 60px}
  .hero h2{font-size:2rem}
  .hero p{font-size:.95rem}
  .stats-grid{grid-template-columns:1fr}
  .stat-item{border-right:none !important;border-bottom:1px solid var(--border);padding:14px 0}
  .stat-item:last-child{border-bottom:none}
  .features-grid{grid-template-columns:1fr}
  .workflow{grid-template-columns:1fr}
  .roles-grid{grid-template-columns:1fr 1fr}
  .footer-grid{grid-template-columns:1fr}
  .cta-banner{padding:40px 26px;text-align:center}
  .cta-content{margin:0 auto}
  .cta-actions{justify-content:center}
  .section{padding:60px 0}
  .section-title{font-size:1.6rem}
  .mockup-side-1{left:-10px}
  .mockup-side-2{right:-10px}
}
</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar" id="navbar">
  <div class="container nav-wrap">
    <a href="#" class="brand">
      <div class="brand-logo"><i class="bi bi-shield-check"></i></div>
      <div class="brand-text">
        <h1>Sistem Etik</h1>
        <p>Komite Etik Penelitian</p>
      </div>
    </a>

    <ul class="nav-menu">
      <li><a href="#beranda">Beranda</a></li>
      <li><a href="#fitur">Fitur</a></li>
      <li><a href="#alur">Alur Proses</a></li>
      <li><a href="#role">Pengguna</a></li>
      <li><a href="#kontak">Kontak</a></li>
    </ul>

    <div class="nav-actions">
      @auth
        <a href="{{ url('/dashboard') }}" class="btn btn-primary">
          <i class="bi bi-grid-1x2-fill"></i> Dashboard
        </a>
      @else
        @if(Route::has('login'))
          <a href="{{ route('login') }}" class="btn btn-ghost desktop">
            <i class="bi bi-box-arrow-in-right"></i> Masuk
          </a>
        @endif
        @if(Route::has('register'))
          <a href="{{ route('register') }}" class="btn btn-primary">
            <i class="bi bi-person-plus-fill"></i> Daftar
          </a>
        @endif
      @endauth
      <button class="mobile-toggle" onclick="toggleMobileMenu()" aria-label="Menu">
        <i class="bi bi-list"></i>
      </button>
    </div>
  </div>

  <div class="mobile-menu" id="mobileMenu">
    <a href="#beranda" onclick="closeMobileMenu()">Beranda</a>
    <a href="#fitur" onclick="closeMobileMenu()">Fitur</a>
    <a href="#alur" onclick="closeMobileMenu()">Alur Proses</a>
    <a href="#role" onclick="closeMobileMenu()">Pengguna</a>
    <a href="#kontak" onclick="closeMobileMenu()">Kontak</a>
    @guest
      @if(Route::has('login'))
        <a href="{{ route('login') }}" class="btn btn-ghost">Masuk</a>
      @endif
    @endguest
  </div>
</nav>

<!-- HERO -->
<section class="hero" id="beranda">
  <div class="hero-blob-1"></div>
  <div class="hero-blob-2"></div>

  <div class="container hero-grid">
    <div class="hero-content">
      <div class="hero-badge">
        <i class="bi bi-patch-check-fill"></i>
        <span>Platform Ethical Clearance Resmi</span>
      </div>
      <h2>Ajukan <span class="grad">Ethical Clearance</span> Penelitian Anda Secara Online</h2>
      <p>
        Sistem pengajuan dan review etik penelitian terintegrasi.
        Cepat, transparan, dan aman — dari pengajuan proposal hingga
        penerbitan sertifikat etik digital.
      </p>
      <div class="hero-cta">
        @auth
          <a href="{{ url('/dashboard') }}" class="btn btn-light btn-lg">
            <i class="bi bi-arrow-right-circle"></i> Buka Dashboard
          </a>
        @else
          @if(Route::has('register'))
            <a href="{{ route('register') }}" class="btn btn-light btn-lg">
              <i class="bi bi-rocket-takeoff-fill"></i> Mulai Sekarang
            </a>
          @endif
          <a href="#fitur" class="btn btn-outline btn-lg">
            <i class="bi bi-info-circle"></i> Pelajari Selengkapnya
          </a>
        @endauth
      </div>

      <div class="hero-trust">
        <div class="trust-item"><i class="bi bi-check-circle-fill"></i> Gratis Pendaftaran</div>
        <div class="trust-item"><i class="bi bi-check-circle-fill"></i> Aman & Terverifikasi</div>
        <div class="trust-item"><i class="bi bi-check-circle-fill"></i> 24/7 Online</div>
      </div>
    </div>

    <div class="hero-mockup">
      <div class="mockup-side mockup-side-1">
        <div class="ic ic-green"><i class="bi bi-check2-circle"></i></div>
        <div>
          <div class="t">Approved</div>
          <div class="s">Sertifikat Etik Terbit</div>
        </div>
      </div>

      <div class="mockup-card">
        <div class="mockup-header">
          <div>
            <span class="mockup-dot r"></span>
            <span class="mockup-dot y"></span>
            <span class="mockup-dot g"></span>
          </div>
          <div class="mockup-title">Dashboard Sistem Etik</div>
        </div>

        <div class="mockup-stats">
          <div class="mockup-stat ms-blue">
            <div class="n">128</div>
            <div class="l">Total Proposal</div>
          </div>
          <div class="mockup-stat ms-orange">
            <div class="n">14</div>
            <div class="l">Menunggu Review</div>
          </div>
          <div class="mockup-stat ms-teal">
            <div class="n">23</div>
            <div class="l">Dalam Proses</div>
          </div>
          <div class="mockup-stat ms-green">
            <div class="n">91</div>
            <div class="l">Disetujui</div>
          </div>
        </div>

        <div>
          <div class="mockup-list-item">
            <span class="ttl">Penelitian Kualitatif Kesehatan</span>
            <span class="bdg bdg-app">Approved</span>
          </div>
          <div class="mockup-list-item">
            <span class="ttl">Studi Eksperimental Obat A</span>
            <span class="bdg bdg-rev">Review</span>
          </div>
          <div class="mockup-list-item">
            <span class="ttl">Survey Sosial Demografi</span>
            <span class="bdg bdg-pen">Pending</span>
          </div>
        </div>
      </div>

      <div class="mockup-side mockup-side-2">
        <div class="ic ic-blue"><i class="bi bi-file-earmark-medical-fill"></i></div>
        <div>
          <div class="t">Proposal Baru</div>
          <div class="s">+5 hari ini</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- STATS -->
<section class="stats-section">
  <div class="container">
    <div class="stats-grid">
      <div class="stat-item">
        <div class="num">500+</div>
        <div class="lbl">Proposal Diproses</div>
      </div>
      <div class="stat-item">
        <div class="num">50+</div>
        <div class="lbl">Reviewer Aktif</div>
      </div>
      <div class="stat-item">
        <div class="num">95%</div>
        <div class="lbl">Tingkat Persetujuan</div>
      </div>
      <div class="stat-item">
        <div class="num">24/7</div>
        <div class="lbl">Akses Online</div>
      </div>
    </div>
  </div>
</section>

<!-- FEATURES -->
<section class="section" id="fitur">
  <div class="container">
    <div class="section-head reveal">
      <span class="section-tag">Fitur Unggulan</span>
      <h3 class="section-title">Semua yang Anda Butuhkan dalam Satu Platform</h3>
      <p class="section-sub">Dirancang khusus untuk memudahkan peneliti, sekretariat, reviewer, dan ketua komite etik dalam mengelola proses ethical clearance.</p>
    </div>

    <div class="features-grid">
      <div class="feature-card reveal">
        <div class="feature-icon fi-1"><i class="bi bi-cloud-upload-fill"></i></div>
        <h3>Pengajuan Online</h3>
        <p>Submit proposal penelitian Anda kapan saja, di mana saja. Lengkap dengan unggah dokumen pendukung.</p>
      </div>

      <div class="feature-card reveal">
        <div class="feature-icon fi-2"><i class="bi bi-graph-up-arrow"></i></div>
        <h3>Tracking Real-time</h3>
        <p>Pantau status proposal Anda secara langsung. Dari verifikasi, review, hingga keputusan akhir.</p>
      </div>

      <div class="feature-card reveal">
        <div class="feature-icon fi-3"><i class="bi bi-people-fill"></i></div>
        <h3>Review Berkualitas</h3>
        <p>Reviewer berpengalaman dengan sistem penugasan otomatis dan feedback yang terstruktur.</p>
      </div>

      <div class="feature-card reveal">
        <div class="feature-icon fi-4"><i class="bi bi-award-fill"></i></div>
        <h3>Sertifikat Digital</h3>
        <p>Sertifikat etik diterbitkan secara digital, ditandatangani Ketua Komite, dan dapat diunduh kapan saja.</p>
      </div>

      <div class="feature-card reveal">
        <div class="feature-icon fi-5"><i class="bi bi-diagram-3-fill"></i></div>
        <h3>Multi-Role Akses</h3>
        <p>Sistem terintegrasi untuk Peneliti, Sekretariat, Reviewer, Ketua, dan Admin dengan hak akses berbeda.</p>
      </div>

      <div class="feature-card reveal">
        <div class="feature-icon fi-6"><i class="bi bi-shield-lock-fill"></i></div>
        <h3>Aman & Terpercaya</h3>
        <p>Data penelitian terenkripsi dan disimpan dengan standar keamanan tinggi. Privasi peneliti terjamin.</p>
      </div>
    </div>
  </div>
</section>

<!-- WORKFLOW -->
<section class="section workflow-section" id="alur">
  <div class="container">
    <div class="section-head reveal">
      <span class="section-tag">Alur Proses</span>
      <h3 class="section-title">5 Langkah Mudah Mendapatkan Sertifikat Etik</h3>
      <p class="section-sub">Proses yang sederhana, jelas, dan transparan dari awal hingga akhir.</p>
    </div>

    <div class="workflow">
      <div class="workflow-step reveal">
        <div class="workflow-num">1</div>
        <h4>Daftar Akun</h4>
        <p>Buat akun peneliti & menunggu aktivasi admin</p>
      </div>
      <div class="workflow-step reveal">
        <div class="workflow-num">2</div>
        <h4>Ajukan Proposal</h4>
        <p>Upload proposal & dokumen pendukung penelitian</p>
      </div>
      <div class="workflow-step reveal">
        <div class="workflow-num">3</div>
        <h4>Verifikasi</h4>
        <p>Sekretariat memverifikasi kelengkapan dokumen</p>
      </div>
      <div class="workflow-step reveal">
        <div class="workflow-num">4</div>
        <h4>Review Etik</h4>
        <p>Reviewer melakukan telaah & memberikan keputusan</p>
      </div>
      <div class="workflow-step reveal">
        <div class="workflow-num">5</div>
        <h4>Sertifikat</h4>
        <p>Sertifikat etik terbit & dapat diunduh peneliti</p>
      </div>
    </div>
  </div>
</section>

<!-- ROLES -->
<section class="section" id="role">
  <div class="container">
    <div class="section-head reveal">
      <span class="section-tag">Pengguna Sistem</span>
      <h3 class="section-title">Dirancang untuk Setiap Peran</h3>
      <p class="section-sub">Setiap pengguna memiliki akses dan tampilan yang disesuaikan dengan tanggung jawabnya.</p>
    </div>

    <div class="roles-grid">
      <div class="role-card reveal">
        <div class="role-icon" style="background:linear-gradient(135deg,#1e3a5f,#2563eb)"><i class="bi bi-person-badge-fill"></i></div>
        <h4>Peneliti</h4>
        <p>Mengajukan & memantau proposal etik</p>
      </div>
      <div class="role-card reveal">
        <div class="role-icon" style="background:linear-gradient(135deg,#0d9488,#14b8a6)"><i class="bi bi-clipboard-check-fill"></i></div>
        <h4>Sekretariat</h4>
        <p>Verifikasi & assign reviewer proposal</p>
      </div>
      <div class="role-card reveal">
        <div class="role-icon" style="background:linear-gradient(135deg,#6d28d9,#8b5cf6)"><i class="bi bi-search"></i></div>
        <h4>Reviewer</h4>
        <p>Telaah & beri keputusan ethical clearance</p>
      </div>
      <div class="role-card reveal">
        <div class="role-icon" style="background:linear-gradient(135deg,#b45309,#f59e0b)"><i class="bi bi-pen-fill"></i></div>
        <h4>Ketua</h4>
        <p>Tanda tangan sertifikat etik resmi</p>
      </div>
      <div class="role-card reveal">
        <div class="role-icon" style="background:linear-gradient(135deg,#be123c,#f43f5e)"><i class="bi bi-gear-fill"></i></div>
        <h4>Admin</h4>
        <p>Kelola pengguna & monitoring sistem</p>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-section">
  <div class="container">
    <div class="cta-banner reveal">
      <div class="cta-content">
        <h3>Siap Mengajukan Proposal Etik Anda?</h3>
        <p>Bergabunglah bersama ratusan peneliti lain yang telah mempercayakan ethical clearance mereka pada sistem kami.</p>
      </div>
      <div class="cta-actions">
        @auth
          <a href="{{ url('/dashboard') }}" class="btn btn-light btn-lg">
            <i class="bi bi-grid-1x2-fill"></i> Ke Dashboard
          </a>
        @else
          @if(Route::has('register'))
            <a href="{{ route('register') }}" class="btn btn-light btn-lg">
              <i class="bi bi-person-plus-fill"></i> Daftar Gratis
            </a>
          @endif
          @if(Route::has('login'))
            <a href="{{ route('login') }}" class="btn btn-outline btn-lg">
              <i class="bi bi-box-arrow-in-right"></i> Masuk
            </a>
          @endif
        @endauth
      </div>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer class="footer" id="kontak">
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <h2>
          <span class="mini-logo"><i class="bi bi-shield-check"></i></span>
          Sistem Etik
        </h2>
        <p>
          Platform digital pengajuan dan review ethical clearance penelitian
          yang cepat, transparan, dan aman. Mendukung peneliti dalam menjalankan
          riset yang beretika.
        </p>
        <div class="footer-social">
          <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
          <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>

      <div class="footer-col">
        <h4>Navigasi</h4>
        <ul>
          <li><a href="#beranda">Beranda</a></li>
          <li><a href="#fitur">Fitur</a></li>
          <li><a href="#alur">Alur Proses</a></li>
          <li><a href="#role">Pengguna</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>Akses</h4>
        <ul>
          @if(Route::has('login'))
            <li><a href="{{ route('login') }}">Masuk</a></li>
          @endif
          @if(Route::has('register'))
            <li><a href="{{ route('register') }}">Daftar Akun</a></li>
          @endif
          <li><a href="{{ route('proposals.template') }}">Template Proposal</a></li>
          <li><a href="#">Panduan Pengguna</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>Kontak</h4>
        <div class="contact-item">
          <i class="bi bi-geo-alt-fill"></i>
          <span>Komite Etik Penelitian<br>Kampus Universitas, Indonesia</span>
        </div>
        <div class="contact-item">
          <i class="bi bi-envelope-fill"></i>
          <span>etik@kampus.ac.id</span>
        </div>
        <div class="contact-item">
          <i class="bi bi-telephone-fill"></i>
          <span>(021) 1234-5678</span>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      © {{ date('Y') }} <span>Sistem Etik</span> — Komite Etik Penelitian. All rights reserved.
    </div>
  </div>
</footer>

<script>
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
  if (window.scrollY > 20) navbar.classList.add('scrolled');
  else navbar.classList.remove('scrolled');
});

function toggleMobileMenu(){
  document.getElementById('mobileMenu').classList.toggle('open');
}
function closeMobileMenu(){
  document.getElementById('mobileMenu').classList.remove('open');
}

const reveals = document.querySelectorAll('.reveal');
const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
      observer.unobserve(entry.target);
    }
  });
}, { threshold: 0.12 });
reveals.forEach(el => observer.observe(el));

const counters = document.querySelectorAll('.stat-item .num');
const counterObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (!entry.isIntersecting) return;
    const el = entry.target;
    const text = el.textContent.trim();
    const match = text.match(/^(\d+)(.*)$/);
    if (!match) return;
    const target = parseInt(match[1], 10);
    const suffix = match[2];
    let current = 0;
    const step = Math.max(1, Math.ceil(target / 40));
    const timer = setInterval(() => {
      current += step;
      if (current >= target) { current = target; clearInterval(timer); }
      el.textContent = current + suffix;
    }, 30);
    counterObserver.unobserve(el);
  });
}, { threshold: 0.5 });
counters.forEach(c => counterObserver.observe(c));
</script>
</body>
</html>
