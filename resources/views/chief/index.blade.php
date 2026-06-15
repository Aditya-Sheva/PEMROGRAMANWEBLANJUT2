@extends('layouts.app')
@section('title','Tanda Tangan Etik')
@section('page-title','Tanda Tangan Etik')

@section('content')
<div class="card fade-up">
  <div class="card-header">
    <h6 class="card-header-title"><i class="bi bi-pen me-2" style="color:#2563eb"></i>Menunggu Tanda Tangan</h6>
  </div>
  <div class="table-responsive">
    <table class="table mb-0">
      <thead>
        <tr>
          <th class="ps-4">Proposal</th>
          <th>Peneliti</th>
          <th>Nomor Sertifikat</th>
          <th class="pe-4">Upload TTD</th>
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
          <td><span class="text-muted small">{{ $proposal->decision->certificate_number ?? '-' }}</span></td>
          <td class="pe-4">
            <form method="POST" action="{{ route('chief.signature',$proposal) }}" enctype="multipart/form-data" class="d-flex gap-2">
              @csrf
              <input type="file" name="signature" class="form-control form-control-sm" accept=".png,.jpg,.jpeg" required>
              <button type="submit" class="btn btn-sm btn-primary">
                <i class="bi bi-cloud-arrow-up"></i>
              </button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="4">
          <div class="empty-state">
            <i class="bi bi-pen"></i>
            <h6 class="mb-1">Belum ada dokumen menunggu tanda tangan</h6>
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
<div class="card fade-up mt-4">
  <div class="card-header">
    <h6 class="card-header-title"><i class="bi bi-award me-2" style="color:#2563eb"></i>Dokumen Published</h6>
  </div>
  <div class="table-responsive">
    <table class="table mb-0">
      <thead>
        <tr>
          <th class="ps-4">Proposal</th>
          <th>Peneliti</th>
          <th>Nomor Sertifikat</th>
          <th class="pe-4">Download</th>
        </tr>
      </thead>
      <tbody>
        @forelse($published as $proposal)
        <tr>
          <td class="ps-4">
            <div style="font-weight:500">{{ $proposal->title }}</div>
            <div class="text-muted small">#{{ $proposal->id }}</div>
          </td>
          <td><span class="text-muted small">{{ $proposal->researcher_name }}</span></td>
          <td><span class="text-muted small">{{ $proposal->decision->certificate_number ?? '-' }}</span></td>
          <td class="pe-4">
            <a href="{{ route('proposals.certificate',$proposal) }}" class="btn btn-sm btn-success">
              <i class="bi bi-download"></i>
            </a>
          </td>
        </tr>
        @empty
        <tr><td colspan="4">
          <div class="empty-state">
            <i class="bi bi-award"></i>
            <h6 class="mb-1">Belum ada dokumen published</h6>
          </div>
        </td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($published->hasPages())
  <div class="card-footer bg-white border-top-0 d-flex justify-content-center py-3">
    {{ $published->links() }}
  </div>
  @endif
</div>
@endsection