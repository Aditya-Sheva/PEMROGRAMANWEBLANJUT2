<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login — Sistem Etik</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<style>
*{font-family:'Inter',sans-serif}
body{
  min-height:100vh;
  background:linear-gradient(135deg,#0f2040 0%,#1e3a5f 40%,#1d4ed8 100%);
  display:flex;align-items:center;justify-content:center;padding:20px;
}
.auth-card{
  background:#fff;border-radius:20px;width:100%;max-width:440px;
  padding:44px 40px;box-shadow:0 24px 60px rgba(0,0,0,.25);
}
.auth-logo{
  width:56px;height:56px;border-radius:14px;
  background:linear-gradient(135deg,#2563eb,#0ea5e9);
  display:flex;align-items:center;justify-content:center;
  font-size:26px;color:#fff;margin:0 auto 20px;
  box-shadow:0 8px 20px rgba(37,99,235,.4);
}
.auth-title{font-size:1.5rem;font-weight:700;color:#1e293b;text-align:center;margin-bottom:4px}
.auth-sub{font-size:.84rem;color:#64748b;text-align:center;margin-bottom:28px}
.form-control{
  border:1px solid #e2e8f0;border-radius:10px;padding:11px 14px;
  font-size:.875rem;transition:all .2s;
}
.form-control:focus{border-color:#2563eb;box-shadow:0 0 0 3px rgba(37,99,235,.12);outline:none}
.form-label{font-size:.82rem;font-weight:500;color:#374151;margin-bottom:5px}
.input-group-text{background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px 0 0 10px;color:#94a3b8}
.input-group .form-control{border-radius:0 10px 10px 0}
.btn-primary{
  background:linear-gradient(90deg,#2563eb,#0ea5e9);border:none;
  border-radius:10px;padding:12px;font-size:.9rem;font-weight:600;
  width:100%;transition:all .2s;
}
.btn-primary:hover{transform:translateY(-1px);box-shadow:0 8px 20px rgba(37,99,235,.35)}
.divider{display:flex;align-items:center;gap:12px;margin:20px 0}
.divider::before,.divider::after{content:'';flex:1;height:1px;background:#e2e8f0}
.divider span{font-size:.75rem;color:#94a3b8;white-space:nowrap}
.auth-link{color:#2563eb;text-decoration:none;font-weight:500}
.auth-link:hover{color:#1d4ed8}
@keyframes slideUp{from{opacity:0;transform:translateY(30px)}to{opacity:1;transform:translateY(0)}}
.auth-card{animation:slideUp .5s ease}
</style>
</head>
<body>
<div class="auth-card">
  <div class="auth-logo"><i class="bi bi-shield-check"></i></div>
  <h1 class="auth-title">Selamat Datang</h1>
  <p class="auth-sub">Sistem Informasi Etik Penelitian</p>

  @if(session('success'))
  <div class="alert alert-success d-flex align-items-center gap-2 mb-3" style="border-radius:10px;font-size:.83rem">
    <i class="bi bi-check-circle-fill"></i>{{ session('success') }}
  </div>
  @endif

  @if($errors->any())
  <div class="alert alert-danger d-flex align-items-center gap-2 mb-3" style="border-radius:10px;font-size:.83rem">
    <i class="bi bi-exclamation-circle-fill"></i>{{ $errors->first() }}
  </div>
  @endif

  <form method="POST" action="{{ route('login.post') }}">
    @csrf
    <div class="mb-3">
      <label class="form-label">Email</label>
      <div class="input-group">
        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}"
               placeholder="email@contoh.com" required autofocus>
      </div>
    </div>
    <div class="mb-4">
      <label class="form-label">Password</label>
      <div class="input-group">
        <span class="input-group-text"><i class="bi bi-lock"></i></span>
        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
      </div>
    </div>
    <div class="mb-3 d-flex align-items-center justify-content-between">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="remember" id="remember">
        <label class="form-check-label" for="remember" style="font-size:.82rem">Ingat saya</label>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">
      <i class="bi bi-box-arrow-in-right me-2"></i>Masuk ke Sistem
    </button>
  </form>

  <div class="divider"><span>Belum punya akun?</span></div>
  <div class="text-center">
    <a href="{{ route('register') }}" class="auth-link">Daftar sebagai Peneliti</a>
  </div>

  <div class="mt-4 p-3 rounded-3" style="background:#f8fafc;font-size:.75rem;color:#64748b">
    <strong>Demo Login:</strong><br>
    Sekretariat: sekretariat@etik.com<br>
    Reviewer: reviewer1@etik.com<br>
    Peneliti: peneliti@etik.com<br>
    <em>Password: password123</em>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>