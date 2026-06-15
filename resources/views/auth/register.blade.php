<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registrasi — Sistem Etik</title>
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
.auth-card{background:#fff;border-radius:20px;width:100%;max-width:460px;padding:44px 40px;box-shadow:0 24px 60px rgba(0,0,0,.25)}
.auth-logo{width:56px;height:56px;border-radius:14px;background:linear-gradient(135deg,#2563eb,#0ea5e9);display:flex;align-items:center;justify-content:center;font-size:26px;color:#fff;margin:0 auto 20px;box-shadow:0 8px 20px rgba(37,99,235,.4)}
.auth-title{font-size:1.4rem;font-weight:700;color:#1e293b;text-align:center;margin-bottom:4px}
.auth-sub{font-size:.84rem;color:#64748b;text-align:center;margin-bottom:28px}
.form-control{border:1px solid #e2e8f0;border-radius:10px;padding:11px 14px;font-size:.875rem;transition:all .2s}
.form-control:focus{border-color:#2563eb;box-shadow:0 0 0 3px rgba(37,99,235,.12);outline:none}
.form-label{font-size:.82rem;font-weight:500;color:#374151;margin-bottom:5px}
.input-group-text{background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px 0 0 10px;color:#94a3b8}
.input-group .form-control{border-radius:0 10px 10px 0}
.btn-primary{background:linear-gradient(90deg,#2563eb,#0ea5e9);border:none;border-radius:10px;padding:12px;font-size:.9rem;font-weight:600;width:100%;transition:all .2s}
.btn-primary:hover{transform:translateY(-1px);box-shadow:0 8px 20px rgba(37,99,235,.35)}
.auth-link{color:#2563eb;text-decoration:none;font-weight:500}
@keyframes slideUp{from{opacity:0;transform:translateY(30px)}to{opacity:1;transform:translateY(0)}}
.auth-card{animation:slideUp .5s ease}
</style>
</head>
<body>
<div class="auth-card">
  <div class="auth-logo"><i class="bi bi-person-plus"></i></div>
  <h1 class="auth-title">Buat Akun Baru</h1>
  <p class="auth-sub">Daftar sebagai Peneliti</p>

  @if($errors->any())
  <div class="alert alert-danger mb-3" style="border-radius:10px;font-size:.83rem">
    <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
  </div>
  @endif

  <form method="POST" action="{{ route('register.post') }}">
    @csrf
    <div class="mb-3">
      <label class="form-label">Nama Lengkap</label>
      <div class="input-group">
        <span class="input-group-text"><i class="bi bi-person"></i></span>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Nama lengkap Anda" required>
      </div>
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <div class="input-group">
        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="email@contoh.com" required>
      </div>
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <div class="input-group">
        <span class="input-group-text"><i class="bi bi-lock"></i></span>
        <input type="password" name="password" class="form-control" placeholder="Min. 8 karakter" required>
      </div>
    </div>
    <div class="mb-4">
      <label class="form-label">Konfirmasi Password</label>
      <div class="input-group">
        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
        <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
      </div>
    </div>
    <div class="alert mb-4 p-3" style="background:#eff6ff;border-radius:10px;border-left:3px solid #2563eb;font-size:.8rem;color:#1e40af">
      <i class="bi bi-info-circle me-1"></i>
      Akun akan diaktifkan oleh Admin sebelum dapat digunakan.
    </div>
    <button type="submit" class="btn btn-primary">
      <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
    </button>
  </form>
  <div class="text-center mt-3" style="font-size:.84rem">
    Sudah punya akun? <a href="{{ route('login') }}" class="auth-link">Masuk disini</a>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>