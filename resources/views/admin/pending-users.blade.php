@extends('layouts.app')
@section('title','Aktivasi Akun')
@section('page-title','Aktivasi Akun Pengguna')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h5 class="mb-1 fw-bold" style="color:#1e293b">Aktivasi Akun</h5>
    <p class="text-muted mb-0 small">{{ $users->total() }} akun menunggu aktivasi</p>
  </div>
</div>

<div class="card fade-up">
  <div class="table-responsive">
    <table class="table mb-0">
      <thead>
        <tr>
          <th class="ps-4">Nama</th>
          <th>Email</th>
          <th>Role</th>
          <th>Tanggal Daftar</th>
          <th class="pe-4">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $user)
        <tr>
          <td class="ps-4">
            <div class="d-flex align-items-center gap-3">
              <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#f59e0b,#fbbf24);color:#fff;display:flex;align-items:center;justify-content:center;font-size:.72rem;font-weight:700;flex-shrink:0">
                {{ strtoupper(substr($user->name,0,2)) }}
              </div>
              <span style="font-weight:500;font-size:.875rem">{{ $user->name }}</span>
            </div>
          </td>
          <td><span style="font-size:.82rem;color:#64748b">{{ $user->email }}</span></td>
          <td><span class="badge" style="background:#eff6ff;color:#1d4ed8;font-size:.72rem">{{ ucfirst($user->role) }}</span></td>
          <td><span style="font-size:.82rem;color:#64748b">{{ $user->created_at->format('d M Y, H:i') }}</span></td>
          <td class="pe-4">
            <form method="POST" action="{{ route('admin.activate',$user) }}" class="d-inline">
              @csrf
              <button type="submit" class="btn btn-sm btn-success"
                      onclick="return confirm('Aktifkan akun {{ $user->name }}?')">
                <i class="bi bi-check-circle me-1"></i>Aktifkan
              </button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="5">
          <div class="empty-state">
            <i class="bi bi-person-check"></i>
            <h6 class="mb-1">Semua akun sudah aktif</h6>
            <p class="text-muted small mb-0">Tidak ada akun yang menunggu aktivasi</p>
          </div>
        </td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($users->hasPages())
  <div class="card-footer bg-white d-flex justify-content-center py-3">
    {{ $users->links() }}
  </div>
  @endif
</div>
@endsection
