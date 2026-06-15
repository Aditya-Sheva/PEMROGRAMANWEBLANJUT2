@extends('layouts.app')
@section('title','Template Submission')
@section('page-title','Template Submission')

@section('content')
<div class="row g-3">
  <div class="col-lg-5">
    <div class="card fade-up">
      <div class="card-header">
        <h6 class="card-header-title"><i class="bi bi-upload me-2" style="color:#2563eb"></i>Upload Template Baru</h6>
      </div>
      <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.templates.upload') }}" enctype="multipart/form-data">
          @csrf
          <label class="form-label">Nama Template <span class="text-danger">*</span></label>
          <input type="text" name="name" class="form-control mb-3" placeholder="Template Ethical Clearance" required>
          <label class="form-label">File Template <span class="text-danger">*</span></label>
          <input type="file" name="file" class="form-control mb-3" accept=".pdf,.doc,.docx" required>
          <button type="submit" class="btn btn-primary w-100">
            <i class="bi bi-cloud-arrow-up me-2"></i>Upload Template
          </button>
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-7">
    <div class="card fade-up delay-1">
      <div class="card-header">
        <h6 class="card-header-title"><i class="bi bi-files me-2" style="color:#2563eb"></i>Daftar Template</h6>
      </div>
      <div class="table-responsive">
        <table class="table mb-0">
          <thead>
            <tr>
              <th class="ps-4">Nama</th>
              <th>Uploader</th>
              <th>Tanggal</th>
              <th class="pe-4">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($templates as $tpl)
            <tr>
              <td class="ps-4">
                <div style="font-weight:500">{{ $tpl->name }}</div>
              </td>
              <td><span class="text-muted small">{{ $tpl->uploader->name ?? 'Admin' }}</span></td>
              <td><span class="text-muted small">{{ $tpl->created_at->format('d M Y') }}</span></td>
              <td class="pe-4">
                <a href="{{ Storage::url($tpl->file_path) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                  <i class="bi bi-download"></i>
                </a>
              </td>
            </tr>
            @empty
            <tr><td colspan="4">
              <div class="empty-state">
                <i class="bi bi-file-earmark"></i>
                <h6 class="mb-1">Belum ada template</h6>
              </div>
            </td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
      @if($templates->hasPages())
      <div class="card-footer bg-white border-top-0 d-flex justify-content-center py-3">
        {{ $templates->links() }}
      </div>
      @endif
    </div>
  </div>
</div>
@endsection