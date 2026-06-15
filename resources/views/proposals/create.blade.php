@extends('layouts.app')
@section('title','Ajukan Proposal')
@section('page-title','Ajukan Proposal Baru')

@section('content')
<div class="row justify-content-center">
  <div class="col-lg-8">
    <nav aria-label="breadcrumb" class="mb-3">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('proposals.index') }}">Proposal</a></li>
        <li class="breadcrumb-item active">Ajukan Baru</li>
      </ol>
    </nav>

    <div class="card fade-up">
      <div class="card-header">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
          <h6 class="card-header-title mb-0"><i class="bi bi-file-earmark-plus me-2" style="color:#2563eb"></i>Form Pengajuan Ethical Clearance</h6>
          <a class="btn btn-sm btn-outline-primary" href="{{ route('proposals.template') }}">
            <i class="bi bi-download me-1"></i>Download Template (PDF)
          </a>
        </div>
      </div>
      <div class="card-body p-4">
        @if($errors->any())
        <div class="alert alert-danger mb-4">
          <ul class="mb-0 ps-3 small">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form method="POST" action="{{ route('proposals.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="row g-3">
            <div class="col-12">
              <label class="form-label">Judul Penelitian <span class="text-danger">*</span></label>
              <input type="text" name="title" class="form-control" value="{{ old('title') }}"
                     placeholder="Masukkan judul penelitian..." required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Nama Peneliti <span class="text-danger">*</span></label>
              <input type="text" name="researcher_name" class="form-control"
                     value="{{ old('researcher_name', auth()->user()->name) }}" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Institusi / Universitas</label>
              <input type="text" name="institution" class="form-control"
                     value="{{ old('institution') }}" placeholder="Nama institusi Anda">
            </div>
            <div class="col-md-6">
              <label class="form-label">Tanggal Pengajuan <span class="text-danger">*</span></label>
              <input type="date" name="submission_date" class="form-control"
                     value="{{ old('submission_date', date('Y-m-d')) }}" required>
            </div>
            <div class="col-12">
              <label class="form-label">Deskripsi Singkat Penelitian</label>
              <textarea name="description" class="form-control" rows="4"
                        placeholder="Jelaskan latar belakang dan tujuan penelitian Anda...">{{ old('description') }}</textarea>
            </div>
            <div class="col-12">
              <label class="form-label">File Proposal <span class="text-danger">*</span></label>
              <input type="file" name="proposal_file" class="form-control"
                     accept=".pdf,.doc,.docx" required>
              <div class="form-text">Format: PDF, DOC, DOCX. Maks. 10MB</div>
            </div>
          </div>

          <hr class="my-4">
          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary px-4">
              <i class="bi bi-send me-2"></i>Kirim Proposal
            </button>
            <a href="{{ route('proposals.index') }}" class="btn btn-light px-4">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection