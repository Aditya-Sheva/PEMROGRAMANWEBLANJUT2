@extends('layouts.app')
@section('title','Workflow Etik')
@section('page-title','Workflow Etik (Admin)')

@section('content')
@php
  $decisionLabels = [
    'approved' => 'Approved',
    'approved_with_recommendation' => 'Approved + Rekomendasi',
  ];
@endphp

<div class="card fade-up">
  <div class="card-header">
    <h6 class="card-header-title"><i class="bi bi-award me-2" style="color:#2563eb"></i>Proposal Tahap Keputusan</h6>
  </div>
  <div class="table-responsive">
    <table class="table mb-0">
      <thead>
        <tr>
          <th class="ps-4">Proposal</th>
          <th>Peneliti</th>
          <th>Keputusan</th>
          <th>Nomor Sertifikat</th>
          <th>Ketua</th>
          <th class="pe-4">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($proposals as $proposal)
        <tr>
          <td class="ps-4">
            <div style="font-weight:500">{{ $proposal->title }}</div>
            <div class="text-muted small">#{{ $proposal->id }}</div>
          </td>
          <td><span class="text-muted small">{{ $proposal->researcher_name }}</span></td>
          <td>
            <span class="badge-status status-{{ $proposal->status }}">
              {{ $decisionLabels[$proposal->status] ?? $proposal->status_label }}
            </span>
          </td>
          <td>
            <span class="text-muted small">{{ $proposal->decision->certificate_number ?? 'Belum diisi' }}</span>
          </td>
          <td>
            <span class="text-muted small">{{ $proposal->decision->chief->name ?? 'Belum dipilih' }}</span>
          </td>
          <td class="pe-4">
            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="collapse" data-bs-target="#confirm-{{ $proposal->id }}">
              <i class="bi bi-pencil-square me-1"></i>Input Data
            </button>
          </td>
        </tr>
        <tr class="collapse" id="confirm-{{ $proposal->id }}">
          <td colspan="6">
            <form method="POST" action="{{ route('admin.send-confirmation',$proposal) }}" class="p-3">
              @csrf
              <div class="row g-3">
                <div class="col-md-5">
                  <label class="form-label">Nomor Sertifikat</label>
                  <input type="text" name="certificate_number" class="form-control" required
                         value="{{ $proposal->decision->certificate_number ?? 'SKE-'.date('Y').'-'.str_pad($proposal->id,4,'0',STR_PAD_LEFT) }}">
                </div>
                <div class="col-md-5">
                  <label class="form-label">Ketua</label>
                  <select name="chief_id" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    @foreach($chiefs as $chief)
                    <option value="{{ $chief->id }}" @selected(optional($proposal->decision)->chief_id === $chief->id)>
                      {{ $chief->name }}
                    </option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                  <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-send me-1"></i>Kirim
                  </button>
                </div>
              </div>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="6">
          <div class="empty-state">
            <i class="bi bi-award"></i>
            <h6 class="mb-1">Belum ada proposal pada tahap keputusan</h6>
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