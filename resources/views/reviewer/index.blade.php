@extends('layouts.app')
@section('title','Review Saya')
@section('page-title','Daftar Review')

@section('content')
@php
$statusLabels=['pending'=>'Pending','document_check'=>'Cek Dokumen','under_review'=>'Direview','approved'=>'Disetujui','approved_with_recommendation'=>'Disetujui+Rek','resubmission'=>'Revisi','disapproved'=>'Ditolak','data_confirmation'=>'Konfirmasi Data','waiting_signature'=>'Menunggu TTD','published'=>'Published'];
@endphp

<div class="mb-4">
  <h5 class="mb-1 fw-bold" style="color:#1e293b">Review Ditugaskan</h5>
  <p class="text-muted mb-0 small">{{ $reviews->total() }} proposal perlu direview</p>
</div>

<div class="row g-3">
  @forelse($reviews as $review)
  <div class="col-lg-6 fade-up">
    <div class="card h-100">
      <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-start mb-3">
          <div class="flex-grow-1 me-3">
            <h6 class="fw-bold mb-1" style="font-size:.9rem;color:#1e293b">
              {{ Str::limit($review->proposal->title, 60) }}
            </h6>
            <div class="text-muted" style="font-size:.78rem">{{ $review->proposal->researcher_name }}</div>
          </div>
          @if($review->status === 'completed')
            <span class="badge-status status-approved flex-shrink-0">Selesai</span>
          @else
            <span class="badge-status status-pending flex-shrink-0">Pending</span>
          @endif
        </div>

        <div class="d-flex flex-wrap gap-2 mb-3">
          <span class="badge" style="background:#f1f5f9;color:#475569;font-size:.72rem">
            <i class="bi bi-calendar me-1"></i>
            {{ \Carbon\Carbon::parse($review->proposal->submission_date)->format('d M Y') }}
          </span>
          @if($review->proposal->review_type)
          <span class="badge" style="background:#eff6ff;color:#1d4ed8;font-size:.72rem">
            {{ ucwords(str_replace('_',' ',$review->proposal->review_type)) }}
          </span>
          @endif
        </div>

        @if($review->feedback)
        <div class="p-3 rounded-3 mb-3" style="background:#f8fafc;border:1px solid #e2e8f0;font-size:.82rem;color:#374151">
          <div class="fw-500 mb-1 text-muted" style="font-size:.72rem">FEEDBACK ANDA:</div>
          {{ Str::limit($review->feedback, 120) }}
          <div class="mt-1"><strong>Rekomendasi:</strong> {{ ucwords(str_replace('_',' ',$review->recommendation ?? '-')) }}</div>
        </div>
        @endif

        <div class="d-flex gap-2">
          <a href="{{ route('proposals.show',$review->proposal) }}" class="btn btn-sm btn-outline-primary flex-grow-1">
            <i class="bi bi-eye me-1"></i>Lihat Proposal
          </a>
          @if($review->status === 'pending')
          <a href="{{ route('proposals.show',$review->proposal) }}#feedback" class="btn btn-sm btn-primary flex-grow-1">
            <i class="bi bi-pencil me-1"></i>Beri Feedback
          </a>
          @endif
        </div>
      </div>
    </div>
  </div>
  @empty
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="empty-state">
          <i class="bi bi-clipboard2-check"></i>
          <h6 class="mb-1">Belum ada review ditugaskan</h6>
          <p class="text-muted small mb-0">Proposal yang ditugaskan kepada Anda akan muncul di sini</p>
        </div>
      </div>
    </div>
  </div>
  @endforelse
</div>

@if($reviews->hasPages())
<div class="d-flex justify-content-center mt-4">{{ $reviews->links() }}</div>
@endif
@endsection