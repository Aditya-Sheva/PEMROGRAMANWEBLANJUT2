<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title','Dashboard') — Sistem Etik</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<style>
*{font-family:'Inter',sans-serif;box-sizing:border-box}
:root{
  --primary:#1e3a5f;--secondary:#2563eb;--accent:#0ea5e9;
  --sidebar-w:260px;--topbar-h:64px;
  --bg:#f1f5f9;--card:#ffffff;--border:#e2e8f0;
}
body{background:var(--bg);min-height:100vh;margin:0}

/* SIDEBAR */
.sidebar{
  position:fixed;top:0;left:0;width:var(--sidebar-w);height:100vh;
  background:linear-gradient(175deg,#1e3a5f 0%,#0f2040 60%,#0a1628 100%);
  z-index:1050;overflow-y:auto;transition:transform .3s ease;
  display:flex;flex-direction:column;
}
.sidebar::-webkit-scrollbar{width:4px}
.sidebar::-webkit-scrollbar-thumb{background:rgba(255,255,255,.15);border-radius:2px}
.sidebar-header{
  padding:24px 20px 18px;
  border-bottom:1px solid rgba(255,255,255,.08);
  flex-shrink:0;
}
.sidebar-logo{
  width:46px;height:46px;border-radius:12px;
  background:linear-gradient(135deg,#2563eb,#0ea5e9);
  display:flex;align-items:center;justify-content:center;
  font-size:22px;color:#fff;margin-bottom:12px;
  box-shadow:0 4px 14px rgba(37,99,235,.4);
}
.sidebar-brand-name{color:#fff;font-size:.95rem;font-weight:700;margin:0;letter-spacing:.01em}
.sidebar-brand-sub{color:rgba(255,255,255,.4);font-size:.7rem;margin-top:2px}
.nav-label{
  color:rgba(255,255,255,.28);font-size:.62rem;font-weight:700;
  letter-spacing:.14em;text-transform:uppercase;
  padding:18px 20px 7px;
}
.sidebar .nav-link{
  color:rgba(255,255,255,.6);padding:10px 14px;
  border-radius:10px;margin:2px 10px;
  font-size:.84rem;font-weight:450;
  display:flex;align-items:center;gap:10px;
  transition:all .2s;border:1px solid transparent;
}
.sidebar .nav-link:hover{
  color:#fff;background:rgba(255,255,255,.08);
}
.sidebar .nav-link.active{
  color:#fff;background:linear-gradient(90deg,rgba(37,99,235,.7),rgba(14,165,233,.4));
  border-color:rgba(37,99,235,.5);font-weight:500;
}
.sidebar .nav-link i{font-size:1rem;width:20px;text-align:center;flex-shrink:0}
.sidebar-footer{
  margin-top:auto;padding:14px 10px;
  border-top:1px solid rgba(255,255,255,.08);
}
.user-info-card{
  background:rgba(255,255,255,.06);border-radius:10px;
  padding:12px 14px;display:flex;align-items:center;gap:10px;
}
.user-avatar{
  width:34px;height:34px;border-radius:50%;
  background:linear-gradient(135deg,#2563eb,#0ea5e9);
  color:#fff;display:flex;align-items:center;justify-content:center;
  font-size:.75rem;font-weight:700;flex-shrink:0;
}
.user-name{color:#fff;font-size:.82rem;font-weight:500;line-height:1.2}
.user-role{color:rgba(255,255,255,.4);font-size:.7rem}

/* TOPBAR */
.topbar{
  position:fixed;top:0;left:var(--sidebar-w);right:0;height:var(--topbar-h);
  background:#fff;border-bottom:1px solid var(--border);
  display:flex;align-items:center;padding:0 28px;gap:16px;z-index:900;
}
.topbar-title{font-size:1rem;font-weight:600;color:#1e293b;flex:1}
.topbar-btn{
  width:38px;height:38px;border-radius:10px;border:1px solid var(--border);
  background:transparent;display:flex;align-items:center;justify-content:center;
  color:#64748b;cursor:pointer;transition:all .2s;
}
.topbar-btn:hover{background:var(--bg);color:#1e293b}
.topbar-user{
  display:flex;align-items:center;gap:8px;
  background:var(--bg);border-radius:40px;
  padding:5px 14px 5px 6px;cursor:pointer;
  border:1px solid var(--border);transition:all .2s;
  text-decoration:none;
}
.topbar-user:hover{background:#e2e8f0}
.topbar-avatar{
  width:30px;height:30px;border-radius:50%;
  background:linear-gradient(135deg,#2563eb,#0ea5e9);
  color:#fff;display:flex;align-items:center;justify-content:center;
  font-size:.72rem;font-weight:700;
}
.topbar-username{font-size:.82rem;font-weight:500;color:#1e293b}

/* MAIN */
.main-wrap{margin-left:var(--sidebar-w);padding-top:var(--topbar-h);min-height:100vh}
.page-body{padding:28px}

/* CARDS */
.card{
  border:1px solid var(--border);border-radius:14px;
  background:var(--card);box-shadow:0 1px 3px rgba(0,0,0,.04);
  transition:box-shadow .2s,transform .2s;
}
.card:hover{box-shadow:0 4px 20px rgba(0,0,0,.08)}
.card-header{
  background:transparent;border-bottom:1px solid var(--border);
  padding:18px 22px;border-radius:14px 14px 0 0;
}
.card-header-title{font-size:.9rem;font-weight:600;color:#1e293b;margin:0}

/* STAT CARDS */
.stat-card{
  border-radius:14px;padding:22px;color:#fff;
  position:relative;overflow:hidden;border:none;
}
.stat-card::before{
  content:'';position:absolute;right:-15px;top:-15px;
  width:90px;height:90px;border-radius:50%;
  background:rgba(255,255,255,.12);
}
.stat-card::after{
  content:'';position:absolute;right:20px;bottom:-20px;
  width:60px;height:60px;border-radius:50%;
  background:rgba(255,255,255,.08);
}
.stat-number{font-size:2.4rem;font-weight:700;line-height:1;margin-bottom:4px}
.stat-label{font-size:.78rem;opacity:.85;font-weight:400}
.stat-icon{font-size:2rem;opacity:.7;position:absolute;right:22px;top:22px}
.bg-blue{background:linear-gradient(135deg,#1e3a5f,#2563eb)}
.bg-teal{background:linear-gradient(135deg,#0d9488,#14b8a6)}
.bg-purple{background:linear-gradient(135deg,#6d28d9,#8b5cf6)}
.bg-orange{background:linear-gradient(135deg,#b45309,#f59e0b)}
.bg-green{background:linear-gradient(135deg,#065f46,#10b981)}
.bg-red{background:linear-gradient(135deg,#991b1b,#ef4444)}

/* BADGES */
.badge-status{padding:5px 12px;border-radius:30px;font-size:.72rem;font-weight:500}

/* TABLE */
.table th{
  font-size:.72rem;text-transform:uppercase;letter-spacing:.07em;
  color:#94a3b8;font-weight:600;border-bottom:1px solid var(--border);
  background:#f8fafc;padding:12px 16px;
}
.table td{padding:13px 16px;vertical-align:middle;color:#374151;font-size:.875rem}
.table tbody tr{border-bottom:1px solid #f1f5f9;transition:background .15s}
.table tbody tr:hover{background:#f8fafc}
.table tbody tr:last-child{border-bottom:none}

/* FORM */
.form-control,.form-select{
  border:1px solid var(--border);border-radius:8px;
  padding:9px 14px;font-size:.875rem;transition:all .2s;
}
.form-control:focus,.form-select:focus{
  border-color:#2563eb;box-shadow:0 0 0 3px rgba(37,99,235,.12);outline:none;
}
.form-label{font-size:.82rem;font-weight:500;color:#374151;margin-bottom:5px}

/* BUTTONS */
.btn{border-radius:8px;font-size:.84rem;font-weight:500;padding:8px 18px;transition:all .2s}
.btn-primary{background:#2563eb;border-color:#2563eb;color:#fff}
.btn-primary:hover{background:#1d4ed8;border-color:#1d4ed8;transform:translateY(-1px)}
.btn-outline-primary{border-color:#2563eb;color:#2563eb}
.btn-outline-primary:hover{background:#2563eb;color:#fff}
.btn-success{background:#10b981;border-color:#10b981}
.btn-success:hover{background:#059669;border-color:#059669}

/* ALERTS */
.alert{border-radius:10px;border:none;font-size:.84rem}
.alert-success{background:#ecfdf5;color:#065f46;border-left:4px solid #10b981;border-radius:0 10px 10px 0}
.alert-danger{background:#fef2f2;color:#991b1b;border-left:4px solid #ef4444;border-radius:0 10px 10px 0}
.alert-info{background:#eff6ff;color:#1e40af;border-left:4px solid #3b82f6;border-radius:0 10px 10px 0}
.alert-warning{background:#fffbeb;color:#92400e;border-left:4px solid #f59e0b;border-radius:0 10px 10px 0}

/* STATUS BADGES */
.status-pending{background:#f1f5f9;color:#475569}
.status-document_check{background:#eff6ff;color:#1d4ed8}
.status-under_review{background:#eff6ff;color:#1d4ed8}
.status-approved{background:#ecfdf5;color:#065f46}
.status-approved_with_recommendation{background:#fffbeb;color:#92400e}
.status-resubmission{background:#fff7ed;color:#9a3412}
.status-disapproved{background:#fef2f2;color:#991b1b}
.status-data_confirmation{background:#fffbeb;color:#92400e}
.status-waiting_signature{background:#eff6ff;color:#1d4ed8}
.status-published{background:#ecfdf5;color:#065f46}

/* ANIMATIONS */
@keyframes fadeUp{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
.fade-up{animation:fadeUp .4s ease both}
.delay-1{animation-delay:.06s}.delay-2{animation-delay:.12s}
.delay-3{animation-delay:.18s}.delay-4{animation-delay:.24s}

/* TIMELINE STATUS */
.timeline{display:flex;gap:0;margin-bottom:24px}
.timeline-step{flex:1;text-align:center;position:relative}
.timeline-step::before{
  content:'';position:absolute;top:14px;left:50%;right:-50%;
  height:2px;background:#e2e8f0;z-index:0;
}
.timeline-step:last-child::before{display:none}
.timeline-dot{
  width:28px;height:28px;border-radius:50%;border:2px solid #e2e8f0;
  background:#fff;display:flex;align-items:center;justify-content:center;
  margin:0 auto 6px;font-size:.65rem;position:relative;z-index:1;transition:all .3s;
}
.timeline-step.done .timeline-dot{background:#10b981;border-color:#10b981;color:#fff}
.timeline-step.active .timeline-dot{background:#2563eb;border-color:#2563eb;color:#fff;box-shadow:0 0 0 4px rgba(37,99,235,.2)}
.timeline-step.done::before{background:#10b981}
.timeline-label{font-size:.65rem;color:#94a3b8;font-weight:500}
.timeline-step.done .timeline-label,.timeline-step.active .timeline-label{color:#1e293b}

/* RESPONSIVE */
@media(max-width:991px){
  .sidebar{transform:translateX(-100%)}
  .sidebar.open{transform:translateX(0)}
  .main-wrap{margin-left:0}
  .topbar{left:0}
  .page-body{padding:16px}
}

/* EMPTY STATE */
.empty-state{text-align:center;padding:60px 20px}
.empty-state i{font-size:3.5rem;opacity:.2;display:block;margin-bottom:16px}
.empty-state h6{color:#64748b;font-weight:500}

/* BREADCRUMB */
.breadcrumb-item a{color:#2563eb;text-decoration:none;font-size:.82rem}
.breadcrumb-item.active{color:#64748b;font-size:.82rem}
.breadcrumb-item+.breadcrumb-item::before{color:#94a3b8}
</style>
@stack('styles')
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">
  <div class="sidebar-header">
    <div class="sidebar-logo"><i class="bi bi-shield-check"></i></div>
    <div class="sidebar-brand-name">Sistem Etik</div>
    <div class="sidebar-brand-sub">Komite Etik Penelitian</div>
  </div>

  <nav class="pt-2 flex-grow-1">
    <div class="nav-label">Menu Utama</div>
    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
      <i class="bi bi-grid-1x2-fill"></i> Dashboard
    </a>

    @if(auth()->user()->isPeneliti())
    <div class="nav-label">Peneliti</div>
    <a href="{{ route('proposals.index') }}" class="nav-link {{ request()->routeIs('proposals.index') ? 'active' : '' }}">
      <i class="bi bi-folder2-open"></i> Proposal Saya
    </a>
    <a href="{{ route('proposals.create') }}" class="nav-link {{ request()->routeIs('proposals.create') ? 'active' : '' }}">
      <i class="bi bi-plus-circle-fill"></i> Ajukan Proposal
    </a>
    @endif

    @if(auth()->user()->isAdmin())
    <div class="nav-label">Admin</div>
    <a href="{{ route('admin.incoming.index') }}" class="nav-link {{ request()->routeIs('admin.incoming.*') ? 'active' : '' }}">
      <i class="bi bi-inbox-fill"></i> Proposal Masuk (CRUD)
    </a>
    <a href="{{ route('proposals.index') }}" class="nav-link {{ request()->routeIs('proposals.index') ? 'active' : '' }}">
      <i class="bi bi-folder2-open"></i> Semua Proposal
    </a>
    <a href="{{ route('admin.monitoring') }}" class="nav-link {{ request()->routeIs('admin.monitoring') ? 'active' : '' }}">
      <i class="bi bi-activity"></i> Monitoring Dokumen
    </a>
    <a href="{{ route('admin.templates') }}" class="nav-link {{ request()->routeIs('admin.templates') ? 'active' : '' }}">
      <i class="bi bi-file-earmark-arrow-up"></i> Template Submission
    </a>
    <a href="{{ route('admin.ethics') }}" class="nav-link {{ request()->routeIs('admin.ethics') ? 'active' : '' }}">
      <i class="bi bi-award-fill"></i> Workflow Etik
    </a>

    <a href="{{ route('admin.pending-users') }}" class="nav-link {{ request()->routeIs('admin.pending-users') ? 'active' : '' }}">
      <i class="bi bi-person-check-fill"></i> Aktivasi Akun
      @php $pendingCount = \App\Models\User::where('role','peneliti')->where('is_active',false)->count() @endphp
      @if($pendingCount > 0)
        <span class="badge bg-danger ms-auto">{{ $pendingCount }}</span>
      @endif
    </a>
    @endif

    @if(auth()->user()->isSecretary())
    <div class="nav-label">Sekretariat</div>
    <a href="{{ route('proposals.index') }}" class="nav-link {{ request()->routeIs('proposals.index') ? 'active' : '' }}">
      <i class="bi bi-folder2-open"></i> Semua Proposal
    </a>
    @endif

    @if(auth()->user()->isReviewer())
    <div class="nav-label">Reviewer</div>
    <a href="{{ route('reviewer.index') }}" class="nav-link {{ request()->routeIs('reviewer.index') ? 'active' : '' }}">
      <i class="bi bi-clipboard2-check-fill"></i> Review Saya
    </a>
    @endif

    @if(auth()->user()->isKetua())
    <div class="nav-label">Ketua</div>
    <a href="{{ route('chief.index') }}" class="nav-link {{ request()->routeIs('chief.index') ? 'active' : '' }}">
      <i class="bi bi-pen"></i> Tanda Tangan Etik
    </a>
    @endif
  </nav>

  <div class="sidebar-footer">
    <div class="user-info-card">
      <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name,0,2)) }}</div>
      <div class="flex-1" style="min-width:0">
        <div class="user-name text-truncate">{{ auth()->user()->name }}</div>
        <div class="user-role">{{ ucfirst(auth()->user()->role) }}</div>
      </div>
      <form method="POST" action="{{ route('logout') }}" class="ms-1">
        @csrf
        <button type="submit" class="btn p-0 border-0" style="color:rgba(255,255,255,.4)" title="Keluar">
          <i class="bi bi-box-arrow-right"></i>
        </button>
      </form>
    </div>
  </div>
</aside>

<!-- TOPBAR -->
<header class="topbar">
  <button class="topbar-btn d-lg-none" onclick="document.getElementById('sidebar').classList.toggle('open')">
    <i class="bi bi-list fs-5"></i>
  </button>
  <div class="topbar-title">@yield('page-title','Dashboard')</div>

  @if(session('success'))
  <div class="alert alert-success py-2 px-3 mb-0 d-flex align-items-center gap-2" style="font-size:.8rem">
    <i class="bi bi-check-circle-fill"></i>{{ session('success') }}
  </div>
  @endif
  @if(session('error'))
  <div class="alert alert-danger py-2 px-3 mb-0 d-flex align-items-center gap-2" style="font-size:.8rem">
    <i class="bi bi-exclamation-circle-fill"></i>{{ session('error') }}
  </div>
  @endif

  <div class="dropdown">
    <div class="topbar-user dropdown-toggle" data-bs-toggle="dropdown">
      <div class="topbar-avatar">{{ strtoupper(substr(auth()->user()->name,0,2)) }}</div>
      <span class="topbar-username d-none d-md-block">{{ auth()->user()->name }}</span>
    </div>
    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="border-radius:12px;min-width:200px">
      <li class="px-3 py-2">
        <div style="font-size:.8rem;font-weight:600;color:#1e293b">{{ auth()->user()->name }}</div>
        <div style="font-size:.72rem;color:#94a3b8">{{ auth()->user()->email }}</div>
        <span class="badge mt-1" style="background:#eff6ff;color:#1d4ed8;font-size:.68rem">{{ ucfirst(auth()->user()->role) }}</span>
      </li>
      <li><hr class="dropdown-divider my-1"></li>
      <li>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="dropdown-item d-flex align-items-center gap-2" style="color:#ef4444;font-size:.84rem">
            <i class="bi bi-box-arrow-right"></i> Keluar
          </button>
        </form>
      </li>
    </ul>
  </div>
</header>

<!-- OVERLAY mobile -->
<div id="overlay" onclick="document.getElementById('sidebar').classList.remove('open');this.style.display='none'"
  style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.4);z-index:1040"></div>

<!-- MAIN CONTENT -->
<main class="main-wrap">
  <div class="page-body">
    @yield('content')
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('sidebar').addEventListener('transitionend', function() {
  document.getElementById('overlay').style.display =
    this.classList.contains('open') ? 'block' : 'none';
});
</script>
@stack('scripts')
</body>
</html>