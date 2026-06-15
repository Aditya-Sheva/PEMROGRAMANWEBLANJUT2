@extends('layouts.app')
@section('title','Daftar Proposal')
@section('page-title', (auth()->user()->isSecretary() || auth()->user()->isAdmin()) ? 'Semua Proposal' : 'Proposal Saya')

@section('content')
@php
$statusColors=['pending'=>'secondary','document_check'=>'info','under_review'=>'primary','approved'=>'success','approved_with_recommendation'=>'warning','resubmission'=>'warning','disapproved'=>'danger','data_confirmation'=>'warning','waiting_signature'=>'primary','published'=>'success'];
$statusLabels=['pending'=>'Pending','document_check'=>'Cek Dokumen','under_review'=>'Direview','approved'=>'Disetujui','approved_with_recommendation'=>'Disetujui+Rek','resubmission'=>'Revisi','disapproved'=>'Ditolak','data_confirmation'=>'Konfirmasi Data','waiting_signature'=>'Menunggu TTD','published'=>'Published'];
@endphp

<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
  <h5 class="mb-1 fw-bold" style="color:#1e293b">{{ (auth()->user()->isSecretary() || auth()->user()->isAdmin()) ? 'Semua Proposal' : 'Proposal Saya' }}</h5>
    <p class="text-muted mb-0 small">{{ $proposals->total() }} proposal ditemukan</p>
  </div>
  @if(auth()->user()->isPeneliti())
  <a href="{{ route('proposals.create') }}" class="btn btn-primary">
    <i class="bi bi-plus-circle me-2"></i>Ajukan Proposal
  </a>
  @endif
</div>

<div class="card fade-up">
  <div class="table-responsive">
    <table class="table mb-0">
      <thead>
        <tr>
          <th class="ps-4">#</th>
          <th>Judul Proposal</th>
          @if(auth()->user()->isSecretary() || auth()->user()->isAdmin())<th>Peneliti</th>@endif
          <th>Tanggal</th>
          <th>Jenis Review</th>
          <th>Status</th>
          <th class="pe-4">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($proposals as $i => $p)
        <tr>
          <td class="ps-4 text-muted small">{{ $proposals->firstItem() + $i }}</td>
          <td>
            <div style="font-weight:500;font-size:.875rem;color:#1e293b">{{ Str::limit($p->title,55) }}</div>
            @if($p->institution)<div class="text-muted" style="font-size:.75rem">{{ $p->institution }}</div>@endif
          </td>
          @if(auth()->user()->isSecretary() || auth()->user()->isAdmin())
          <td><span style="font-size:.82rem">{{ $p->user->name }}</span></td>
          @endif
          <td><span style="font-size:.82rem;color:#64748b">{{ \Carbon\Carbon::parse($p->submission_date)->format('d M Y') }}</span></td>
          <td>
            @if($p->review_type)
              <span class="badge" style="background:#eff6ff;color:#1d4ed8;font-size:.72rem">{{ ucwords(str_replace('_',' ',$p->review_type)) }}</span>
            @else
              <span class="text-muted small">—</span>
            @endif
          </td>
          <td><span class="badge-status status-{{ $p->status }}">{{ $statusLabels[$p->status] ?? $p->status }}</span></td>
          <td class="pe-4">
            <a href="{{ route('proposals.show',$p) }}" class="btn btn-sm btn-outline-primary">
              <i class="bi bi-eye me-1"></i>Detail
            </a>
            @if($p->status === 'published')
            <a href="{{ route('proposals.certificate',$p) }}" class="btn btn-sm btn-success ms-1">
              <i class="bi bi-download"></i>
            </a>
            @endif
          </td>
        </tr>
        @empty
        <tr><td colspan="7">
          <div class="empty-state">
            <i class="bi bi-folder2-open"></i>
            <h6 class="mb-1">Belum ada proposal</h6>
            @if(auth()->user()->isPeneliti())
            <a href="{{ route('proposals.create') }}" class="btn btn-primary btn-sm mt-2">Ajukan Proposal</a>
            @endif
          </div>
        </td></tr>
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