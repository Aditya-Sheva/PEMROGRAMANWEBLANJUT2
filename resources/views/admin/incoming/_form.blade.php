@php
  $proposalModel = isset($proposal) ? $proposal : null;
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

@if($errors->any())
  <div class="alert alert-danger mb-4">
    <ul class="mb-0 ps-3 small">
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Akun Peneliti <span class="text-danger">*</span></label>
    <select name="user_id" class="form-select" required>
      <option value="">-- Pilih Peneliti --</option>
      @foreach($researchers as $researcher)
        <option value="{{ $researcher->id }}"
          @selected(old('user_id', $proposalModel?->user_id) == $researcher->id)>
          {{ $researcher->name }} ({{ $researcher->email }})
        </option>
      @endforeach
    </select>
  </div>

  <div class="col-md-6">
    <label class="form-label">Status <span class="text-danger">*</span></label>
    <select name="status" class="form-select" required>
      @foreach($statuses as $st)
        <option value="{{ $st }}" @selected(old('status', $proposalModel?->status ?? 'pending') === $st)>
          {{ $statusLabels[$st] ?? $st }}
        </option>
      @endforeach
    </select>
  </div>

  <div class="col-12">
    <label class="form-label">Judul Penelitian <span class="text-danger">*</span></label>
    <input type="text" name="title" class="form-control"
      value="{{ old('title', $proposalModel?->title) }}" required>
  </div>

  <div class="col-md-6">
    <label class="form-label">Nama Peneliti <span class="text-danger">*</span></label>
    <input type="text" name="researcher_name" class="form-control"
      value="{{ old('researcher_name', $proposalModel?->researcher_name) }}" required>
  </div>

  <div class="col-md-6">
    <label class="form-label">Institusi</label>
    <input type="text" name="institution" class="form-control"
      value="{{ old('institution', $proposalModel?->institution) }}">
  </div>

  <div class="col-md-6">
    <label class="form-label">Tanggal Pengajuan <span class="text-danger">*</span></label>
    <input type="date" name="submission_date" class="form-control"
      value="{{ old('submission_date', optional($proposalModel?->submission_date)->format('Y-m-d') ?? $proposalModel?->submission_date ?? date('Y-m-d')) }}" required>
  </div>

  <div class="col-md-6">
    <label class="form-label">Jenis Review</label>
    <select name="review_type" class="form-select">
      <option value="">-- Belum Ditentukan --</option>
      <option value="exempted" @selected(old('review_type', $proposalModel?->review_type) === 'exempted')>Exempted</option>
      <option value="expedited" @selected(old('review_type', $proposalModel?->review_type) === 'expedited')>Expedited</option>
      <option value="full_board" @selected(old('review_type', $proposalModel?->review_type) === 'full_board')>Full Board</option>
    </select>
  </div>

  <div class="col-12">
    <label class="form-label">Deskripsi Penelitian</label>
    <textarea name="description" class="form-control" rows="4">{{ old('description', $proposalModel?->description) }}</textarea>
  </div>

  <div class="col-12">
    <label class="form-label">
      File Proposal
      @if(!$proposalModel)
        <span class="text-danger">*</span>
      @endif
    </label>
    <input type="file" name="proposal_file" class="form-control" accept=".pdf,.doc,.docx" {{ $proposalModel ? '' : 'required' }}>
    <div class="form-text">
      Format: PDF/DOC/DOCX, max 10MB.
      @if($proposalModel && $proposalModel->proposal_file)
        File saat ini: <a href="{{ Storage::url($proposalModel->proposal_file) }}" target="_blank">lihat file</a>
      @endif
    </div>
  </div>
</div>

<hr class="my-4">
<div class="d-flex gap-2">
  <button type="submit" class="btn btn-primary">
    <i class="bi bi-save me-1"></i>{{ $submitLabel ?? 'Simpan' }}
  </button>
  <a href="{{ route('admin.incoming.index') }}" class="btn btn-light">Batal</a>
</div>
