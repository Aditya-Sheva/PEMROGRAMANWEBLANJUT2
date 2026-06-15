@extends('layouts.app')
@section('title','Monitoring Dokumen')
@section('page-title','Monitoring Dokumen')

@section('content')
<div class="card fade-up">
  <div class="card-header">
    <h6 class="card-header-title"><i class="bi bi-activity me-2" style="color:#2563eb"></i>Monitoring Semua Dokumen</h6>
  </div>
  <div class="table-responsive">
    <table class="table mb-0">
      <thead>
        <tr>
          <th class="ps-4">Proposal</th>
          <th>Peneliti</th>
          <th>Status</th>
          <th>Dokumen</th>
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
          <td><span class="badge-status status-{{ $proposal->status }}">{{ $proposal->status_label }}</span></td>
          <td><span class="text-muted small">{{ $proposal->documents->count() }} file</span></td>
          <td class="pe-4">
            <a href="{{ route('proposals.show',$proposal) }}" class="btn btn-sm btn-outline-primary">
              <i class="bi bi-eye"></i>
            </a>
          </td>
        </tr>
        @empty
        <tr><td colspan="5">
          <div class="empty-state">
            <i class="bi bi-folder2-open"></i>
            <h6 class="mb-1">Belum ada proposal</h6>
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