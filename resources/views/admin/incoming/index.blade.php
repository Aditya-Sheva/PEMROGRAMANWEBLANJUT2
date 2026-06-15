@extends('layouts.app')
@section('title','Proposal Masuk (CRUD)')
@section('page-title','Proposal Masuk (CRUD Admin)')

@section('content')
@php
  $statusLabels = [
    'pending' => 'Menunggu Verifikasi',
    'document_check' => 'Pemeriksaan Berkas',
    'under_review' => 'Dalam Review',
    'approved' => 'Disetujui',
    'approved_with_recommendation' => 'Disetujui + Rekomendasi',
    'resubmission' => 'Perlu Revisi',
    'disapproved' => 'Ditolak',
    'data_confirmation' => 'Konfirmasi Data',
    'waiting_signature' => 'Menunggu Tanda Tangan',
  ];
@endphp

<div class="card mb-3 fade-up">
  <div class="card-body p-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
      <div>
        <h5 class="mb-1 fw-bold" style="color:#1e293b">Kelola Proposal Masuk</h5>
        <p class="text-muted mb-0 small">Kelola data proposal non-published (create, read, update, delete).</p>
      </div>
      <a href="{{ route('admin.incoming.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Tambah Proposal Masuk
      </a>
    </div>

    <form method="GET" action="{{ route('admin.incoming.index') }}" class="row g-2">
      <div class="col-md-4">
        <label class="form-label">Filter Status</label>
        <select name="status" class="form-select">
          <option value="">Semua Status</option>
          @foreach($statuses as $st)
            <option value="{{ $st }}" @selected($status === $st)>{{ $statusLabels[$st] ?? $st }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label">Cari Proposal</label>
        <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Cari judul / peneliti / institusi...">
      </div>
      <div class="col-md-2 d-flex align-items-end gap-2">
        <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i></button>
        <a href="{{ route('admin.incoming.index') }}" class="btn btn-light w-100"><i class="bi bi-arrow-counterclockwise"></i></a>
      </div>
    </form>
  </div>
</div>

<div class="card fade-up delay-1">
  <div class="table-responsive">
    <table class="table mb-0">
      <thead>
        <tr>
          <th class="ps-4">Proposal</th>
          <th>Peneliti (Akun)</th>
          <th>Tgl Pengajuan</th>
          <th>Status</th>
          <th>Dokumen</th>
          <th class="pe-4">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($proposals as $proposal)
          <tr>
            <td class="ps-4">
              <div style="font-weight:600">{{ $proposal->title }}</div>
              <div class="text-muted small">#{{ $proposal->id }} · {{ $proposal->institution ?: 'Tanpa institusi' }}</div>
            </td>
            <td>
              <div style="font-weight:500">{{ $proposal->researcher_name }}</div>
              <div class="text-muted small">{{ $proposal->user->name ?? '-' }}</div>
            </td>
            <td><span class="text-muted small">{{ \Carbon\Carbon::parse($proposal->submission_date)->format('d M Y') }}</span></td>
            <td>
              <span class="badge-status status-{{ $proposal->status }}">
                {{ $statusLabels[$proposal->status] ?? $proposal->status }}
              </span>
            </td>
            <td><span class="text-muted small">{{ $proposal->documents->count() }} file</span></td>
            <td class="pe-4">
              <div class="d-flex gap-1">
                <a href="{{ route('proposals.show', $proposal) }}" class="btn btn-sm btn-outline-primary" title="Detail">
                  <i class="bi bi-eye"></i>
                </a>
                <a href="{{ route('admin.incoming.edit', $proposal) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                  <i class="bi bi-pencil-square"></i>
                </a>
                <form action="{{ route('admin.incoming.destroy', $proposal) }}" method="POST" onsubmit="return confirm('Hapus proposal ini? Tindakan ini tidak dapat dibatalkan.')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6">
              <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <h6 class="mb-1">Belum ada proposal masuk</h6>
                <a href="{{ route('admin.incoming.create') }}" class="btn btn-primary btn-sm mt-2">Tambah Proposal</a>
              </div>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($proposals->hasPages())
  <div class="card-footer bg-white border-top-0 d-flex justify-content-center py-3">
    {{ $proposals->links() }}
  </div>
  @endif
</div>
@endsection
