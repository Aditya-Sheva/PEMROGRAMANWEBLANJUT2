@extends('layouts.app')
@section('title','Detail Proposal')
@section('page-title','Detail Proposal')

@section('content')
@php
$steps=['pending','document_check','under_review','approved','data_confirmation','waiting_signature','published'];
$currentStep=array_search($proposal->status,$steps);
if(in_array($proposal->status,['approved_with_recommendation','resubmission','disapproved'])) $currentStep=3;
$statusLabels=['pending'=>'Menunggu Verifikasi','document_check'=>'Pemeriksaan Berkas','under_review'=>'Dalam Review','approved'=>'Disetujui','approved_with_recommendation'=>'Disetujui + Rekomendasi','resubmission'=>'Perlu Revisi','disapproved'=>'Ditolak','data_confirmation'=>'Konfirmasi Data','waiting_signature'=>'Menunggu Tanda Tangan','published'=>'Published'];
$statusColors=['pending'=>'secondary','document_check'=>'info','under_review'=>'primary','approved'=>'success','approved_with_recommendation'=>'warning','resubmission'=>'warning','disapproved'=>'danger','data_confirmation'=>'warning','waiting_signature'=>'primary','published'=>'success'];
@endphp

<nav aria-label="breadcrumb" class="mb-3">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('proposals.index') }}">Proposal</a></li>
    <li class="breadcrumb-item active">Detail</li>
  </ol>
</nav>

<!-- Header -->
<div class="card mb-3 fade-up">
  <div class="card-body p-4">
    <div class="d-flex align-items-start justify-content-between flex-wrap gap-3">
      <div>
        <h5 class="fw-bold mb-1" style="color:#1e293b">{{ $proposal->title }}</h5>
        <div class="d-flex align-items-center gap-2 flex-wrap">
          <span class="badge-status status-{{ $proposal->status }}">
            {{ $statusLabels[$proposal->status] ?? $proposal->status }}
          </span>
          @if($proposal->review_type)
          <span class="badge" style="background:#f0fdf4;color:#166534;font-size:.72rem">
            {{ ucwords(str_replace('_',' ',$proposal->review_type)) }}
          </span>
          @endif
        </div>
      </div>
      @if($proposal->status === 'published')
      <a href="{{ route('proposals.certificate',$proposal) }}" class="btn btn-success">
        <i class="bi bi-award me-2"></i>Download Surat Kelaikan Etik
      </a>
      @endif
    </div>

    <!-- Timeline -->
    <div class="timeline mt-4">
      @foreach(['Pengajuan','Verifikasi','Review','Keputusan','Konfirmasi Data','Tanda Tangan','Published'] as $idx => $step)
      <div class="timeline-step {{ $currentStep > $idx ? 'done' : ($currentStep == $idx ? 'active' : '') }}">
        <div class="timeline-dot">
          @if($currentStep > $idx)<i class="bi bi-check" style="font-size:.7rem"></i>
          @else{{ $idx+1 }}@endif
        </div>
        <div class="timeline-label">{{ $step }}</div>
      </div>
      @endforeach
    </div>
  </div>
</div>

<div class="row g-3">
  <!-- Kiri: Info + Dokumen + Feedback -->
  <div class="col-lg-8">

    <!-- Info Proposal -->
    <div class="card mb-3 fade-up">
      <div class="card-header">
        <h6 class="card-header-title"><i class="bi bi-info-circle me-2" style="color:#2563eb"></i>Informasi Proposal</h6>
      </div>
      <div class="card-body p-4">
        <div class="row g-3">
          <div class="col-sm-6">
            <div class="text-muted small mb-1">Nama Peneliti</div>
            <div class="fw-500" style="font-size:.9rem">{{ $proposal->researcher_name }}</div>
          </div>
          <div class="col-sm-6">
            <div class="text-muted small mb-1">Institusi</div>
            <div style="font-size:.9rem">{{ $proposal->institution ?? '—' }}</div>
          </div>
          <div class="col-sm-6">
            <div class="text-muted small mb-1">Tanggal Pengajuan</div>
            <div style="font-size:.9rem">{{ \Carbon\Carbon::parse($proposal->submission_date)->format('d F Y') }}</div>
          </div>
          <div class="col-sm-6">
            <div class="text-muted small mb-1">Diajukan Oleh</div>
            <div style="font-size:.9rem">{{ $proposal->user->name }}</div>
          </div>
          @if($proposal->description)
          <div class="col-12">
            <div class="text-muted small mb-1">Deskripsi</div>
            <div style="font-size:.875rem;line-height:1.7;color:#374151">{{ $proposal->description }}</div>
          </div>
          @endif
        </div>
      </div>
    </div>

    <!-- Dokumen -->
    <div class="card mb-3 fade-up delay-1">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h6 class="card-header-title"><i class="bi bi-paperclip me-2" style="color:#2563eb"></i>Dokumen ({{ $proposal->documents->count() }})</h6>
      </div>
      <div class="card-body p-4">
        @if($proposal->documents->isEmpty())
          <div class="empty-state py-4"><i class="bi bi-file-earmark" style="font-size:2rem"></i><h6>Belum ada dokumen</h6></div>
        @else
          <div class="list-group list-group-flush">
          @foreach($proposal->documents as $doc)
          <div class="list-group-item px-0 d-flex align-items-center gap-3" style="border-color:#f1f5f9">
            <div style="width:38px;height:38px;border-radius:10px;background:#fef2f2;display:flex;align-items:center;justify-content:center;flex-shrink:0">
              <i class="bi bi-file-earmark-pdf" style="color:#ef4444;font-size:1.1rem"></i>
            </div>
            <div class="flex-grow-1">
              <div style="font-size:.875rem;font-weight:500;color:#1e293b">{{ $doc->document_name }}</div>
              <div class="text-muted" style="font-size:.75rem">
                {{ ucfirst($doc->document_type) }} · {{ \Carbon\Carbon::parse($doc->created_at)->format('d M Y') }}
              </div>
            </div>
            <a href="{{ Storage::url($doc->file_path) }}" target="_blank"
               class="btn btn-sm btn-outline-secondary" style="border-radius:8px">
              <i class="bi bi-download me-1"></i>Unduh
            </a>
          </div>
          @endforeach
          </div>
        @endif

        @if(auth()->user()->isPeneliti() && in_array($proposal->status,['pending','document_check','resubmission']))
        <hr class="my-3">
        <form method="POST" action="{{ route('proposals.upload',$proposal) }}" enctype="multipart/form-data">
          @csrf
          <label class="form-label">Upload Dokumen Pendukung</label>
          <input type="file" name="documents[]" class="form-control form-control-sm mb-2"
                 multiple accept=".pdf,.doc,.docx,.jpg,.png">
          <button type="submit" class="btn btn-sm btn-primary">
            <i class="bi bi-upload me-1"></i>Upload
          </button>
        </form>
        @endif
      </div>
    </div>

    <!-- Feedback Reviewer -->
    @if($proposal->reviews->isNotEmpty())
    <div class="card fade-up delay-2">
      <div class="card-header">
        <h6 class="card-header-title"><i class="bi bi-chat-left-text me-2" style="color:#2563eb"></i>Feedback Reviewer</h6>
      </div>
      <div class="card-body p-4">
        @foreach($proposal->reviews as $review)
        <div class="p-3 mb-3 rounded-3" style="background:#f8fafc;border:1px solid #e2e8f0">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <div class="d-flex align-items-center gap-2">
              <div style="width:30px;height:30px;border-radius:50%;background:linear-gradient(135deg,#2563eb,#0ea5e9);color:#fff;display:flex;align-items:center;justify-content:center;font-size:.7rem;font-weight:700">
                {{ strtoupper(substr($review->reviewer->name,0,2)) }}
              </div>
              <span style="font-weight:500;font-size:.875rem">{{ $review->reviewer->name }}</span>
            </div>
            @if($review->status === 'completed')
              <span class="badge-status status-approved">Selesai</span>
            @else
              <span class="badge-status status-pending">Pending</span>
            @endif
          </div>
          @if($review->feedback)
            <p style="font-size:.875rem;color:#374151;margin-bottom:8px;line-height:1.7">{{ $review->feedback }}</p>
            <div class="small text-muted">Rekomendasi: <strong style="color:#1e293b">{{ ucwords(str_replace('_',' ',$review->recommendation ?? '-')) }}</strong></div>
          @else
            <p class="text-muted small mb-0">Belum ada feedback.</p>
          @endif
        </div>
        @endforeach
      </div>
    </div>
    @endif

    <!-- Keputusan Akhir -->
    @if($proposal->decision)
    <div class="card mt-3 fade-up delay-3">
      <div class="card-header">
        <h6 class="card-header-title"><i class="bi bi-gavel me-2" style="color:#2563eb"></i>Keputusan Akhir</h6>
      </div>
      <div class="card-body p-4">
        <div class="row g-3">
          <div class="col-sm-6"><div class="text-muted small mb-1">Keputusan</div>
            <span class="badge-status status-{{ $proposal->decision->decision }}">{{ ucwords(str_replace('_',' ',$proposal->decision->decision)) }}</span>
          </div>
          <div class="col-sm-6"><div class="text-muted small mb-1">Tanggal</div>
            <div style="font-size:.875rem">{{ \Carbon\Carbon::parse($proposal->decision->decided_at)->format('d F Y') }}</div>
          </div>
          @if($proposal->decision->certificate_number)
          <div class="col-sm-6"><div class="text-muted small mb-1">No. Sertifikat</div>
            <div style="font-size:.875rem;font-weight:600;color:#065f46">{{ $proposal->decision->certificate_number }}</div>
          </div>
          @endif
          @if($proposal->decision->notes)
          <div class="col-12"><div class="text-muted small mb-1">Catatan</div>
            <div style="font-size:.875rem">{{ $proposal->decision->notes }}</div>
          </div>
          @endif
        </div>
      </div>
    </div>
    @endif
  </div>

  <!-- Kanan: Panel Aksi -->
  <div class="col-lg-4">

    <!-- SEKRETARIAT: Verifikasi -->
    @if(auth()->user()->isSecretary() && $proposal->status === 'pending')
    <div class="card mb-3 fade-up">
      <div class="card-header">
        <h6 class="card-header-title"><i class="bi bi-list-check me-2" style="color:#2563eb"></i>Verifikasi Berkas</h6>
      </div>
      <div class="card-body p-4">
        <form method="POST" action="{{ route('secretary.verify',$proposal) }}">
          @csrf
          <label class="form-label">Jenis Review <span class="text-danger">*</span></label>
          <select name="review_type" class="form-select mb-3" required>
            <option value="">-- Pilih Jenis --</option>
            <option value="exempted">Exempted</option>
            <option value="expedited">Expedited</option>
            <option value="full_board">Full Board</option>
          </select>
          <button type="submit" class="btn btn-primary w-100">
            <i class="bi bi-check2-circle me-2"></i>Verifikasi & Lanjutkan
          </button>
        </form>
      </div>
    </div>
    @endif

    <!-- SEKRETARIAT: Assign Reviewer -->
    @if(auth()->user()->isSecretary() && $proposal->status === 'document_check')
    <div class="card mb-3 fade-up">
      <div class="card-header">
        <h6 class="card-header-title"><i class="bi bi-person-check me-2" style="color:#2563eb"></i>Assign Reviewer</h6>
      </div>
      <div class="card-body p-4">
        <form method="POST" action="{{ route('secretary.assign',$proposal) }}">
          @csrf
          <label class="form-label">Pilih Reviewer <span class="text-danger">*</span></label>
          <select name="reviewer_ids[]" class="form-select mb-2" multiple required style="height:120px">
            @foreach($reviewers as $rv)
            <option value="{{ $rv->id }}">{{ $rv->name }}</option>
            @endforeach
          </select>
          <div class="form-text mb-3">Tahan <kbd>Ctrl</kbd> untuk pilih beberapa reviewer</div>
          <button type="submit" class="btn btn-primary w-100">
            <i class="bi bi-person-plus me-2"></i>Tugaskan Reviewer
          </button>
        </form>
      </div>
    </div>
    @endif

    <!-- SEKRETARIAT: Keputusan -->
    @if(auth()->user()->isSecretary() && in_array($proposal->status,['under_review','resubmission']))
    <div class="card mb-3 fade-up">
      <div class="card-header">
        <h6 class="card-header-title"><i class="bi bi-gavel me-2" style="color:#2563eb"></i>Buat Keputusan</h6>
      </div>
      <div class="card-body p-4">
        <form method="POST" action="{{ route('secretary.decision',$proposal) }}">
          @csrf
          <label class="form-label">Keputusan <span class="text-danger">*</span></label>
          <select name="decision" class="form-select mb-3" required>
            <option value="">-- Pilih --</option>
            <option value="approved">Approved</option>
            <option value="approved_with_recommendation">Approved with Recommendation</option>
            <option value="resubmission">Resubmission</option>
            <option value="disapproved">Disapproved</option>
          </select>
          <label class="form-label">Catatan</label>
          <textarea name="notes" class="form-control mb-3" rows="3" placeholder="Catatan untuk peneliti..."></textarea>
          <button type="submit" class="btn btn-primary w-100">
            <i class="bi bi-save me-2"></i>Simpan Keputusan
          </button>
        </form>
      </div>
    </div>
    @endif

    <!-- ADMIN: Assign Sekretariat (Submission) -->
    @if(auth()->user()->isAdmin() && $proposal->status === 'pending')
    <div class="card mb-3 fade-up">
      <div class="card-header">
        <h6 class="card-header-title"><i class="bi bi-person-check me-2" style="color:#2563eb"></i>Assign Sekretariat</h6>
      </div>
      <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.assign-secretary',$proposal) }}">
          @csrf
          <label class="form-label">Pilih Sekretariat <span class="text-danger">*</span></label>
          <select name="secretary_id" class="form-select mb-3" required>
            <option value="">-- Pilih --</option>
            @foreach($secretaries as $sec)
            <option value="{{ $sec->id }}">{{ $sec->name }}</option>
            @endforeach
          </select>
          <button type="submit" class="btn btn-primary w-100">
            <i class="bi bi-person-plus me-2"></i>Assign Sekretariat
          </button>
        </form>
      </div>
    </div>
    @endif

    <!-- ADMIN: Workflow Etik -->
    @if(auth()->user()->isAdmin() && in_array($proposal->status, ['approved','approved_with_recommendation']))
    <div class="card mb-3 fade-up">
      <div class="card-header">
        <h6 class="card-header-title"><i class="bi bi-award me-2" style="color:#2563eb"></i>Persiapan Surat Etik</h6>
      </div>
      <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.send-confirmation',$proposal) }}">
          @csrf
          <label class="form-label">Nomor Sertifikat <span class="text-danger">*</span></label>
          <input type="text" name="certificate_number" class="form-control mb-3" required
                 value="{{ $proposal->decision->certificate_number ?? 'SKE-'.date('Y').'-'.str_pad($proposal->id, 4, '0', STR_PAD_LEFT) }}">
          <label class="form-label">Pilih Ketua <span class="text-danger">*</span></label>
          <select name="chief_id" class="form-select mb-3" required>
            <option value="">-- Pilih --</option>
            @foreach($chiefs as $chief)
            <option value="{{ $chief->id }}" @selected(optional($proposal->decision)->chief_id === $chief->id)>
              {{ $chief->name }}
            </option>
            @endforeach
          </select>
          <button type="submit" class="btn btn-primary w-100">
            <i class="bi bi-send me-2"></i>Kirim Konfirmasi ke Peneliti
          </button>
        </form>
      </div>
    </div>
    @endif

    @if(auth()->user()->isAdmin() && $proposal->status === 'waiting_signature')
    <div class="card mb-3 fade-up">
      <div class="card-header">
        <h6 class="card-header-title"><i class="bi bi-broadcast me-2" style="color:#2563eb"></i>Publish Surat Etik</h6>
      </div>
      <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.publish',$proposal) }}">
          @csrf
          <div class="small text-muted mb-3">Pastikan tanda tangan ketua sudah diupload sebelum publish.</div>
          <button type="submit" class="btn btn-success w-100">
            <i class="bi bi-check2-circle me-2"></i>Publish Surat Etik
          </button>
        </form>
      </div>
    </div>
    @endif

    <!-- PENELITI: Konfirmasi Data -->
    @if(auth()->user()->isPeneliti() && $proposal->status === 'data_confirmation')
    <div class="card mb-3 fade-up">
      <div class="card-header">
        <h6 class="card-header-title"><i class="bi bi-check2-square me-2" style="color:#2563eb"></i>Konfirmasi Data</h6>
      </div>
      <div class="card-body p-4">
        <div class="small text-muted mb-3">Periksa kembali data proposal & nomor sertifikat sebelum melanjutkan.</div>
        <form method="POST" action="{{ route('proposals.confirm',$proposal) }}">
          @csrf
          <button type="submit" class="btn btn-primary w-100">
            <i class="bi bi-check2-circle me-2"></i>Konfirmasi Data
          </button>
        </form>
      </div>
    </div>
    @endif

    <!-- PENELITI: Resubmission -->
    @if(auth()->user()->isPeneliti() && $proposal->status === 'resubmission')
    <div class="card mb-3 fade-up">
      <div class="card-header">
        <h6 class="card-header-title"><i class="bi bi-arrow-repeat me-2" style="color:#2563eb"></i>Upload Revisi Proposal</h6>
      </div>
      <div class="card-body p-4">
        <form method="POST" action="{{ route('proposals.resubmit',$proposal) }}" enctype="multipart/form-data">
          @csrf
          <label class="form-label">File Proposal Revisi <span class="text-danger">*</span></label>
          <input type="file" name="proposal_file" class="form-control mb-3" accept=".pdf,.doc,.docx" required>
          <label class="form-label">Dokumen Pendukung (Opsional)</label>
          <input type="file" name="documents[]" class="form-control mb-3" multiple accept=".pdf,.doc,.docx,.jpg,.png">
          <button type="submit" class="btn btn-primary w-100">
            <i class="bi bi-upload me-2"></i>Kirim Revisi
          </button>
        </form>
      </div>
    </div>
    @endif

    <!-- REVIEWER: Submit Feedback -->
    @if(auth()->user()->isReviewer())
    @php $myReview = $proposal->reviews->where('reviewer_id',auth()->id())->first() @endphp
    @if($myReview && $myReview->status === 'pending')
    <div class="card mb-3 fade-up">
      <div class="card-header">
        <h6 class="card-header-title"><i class="bi bi-pencil-square me-2" style="color:#2563eb"></i>Submit Feedback</h6>
      </div>
      <div class="card-body p-4">
        <form method="POST" action="{{ route('reviewer.feedback',$myReview) }}">
          @csrf
          <label class="form-label">Feedback <span class="text-danger">*</span></label>
          <textarea name="feedback" class="form-control mb-3" rows="5" required
                    placeholder="Tuliskan hasil review Anda secara detail..."></textarea>
          <label class="form-label">Rekomendasi <span class="text-danger">*</span></label>
          <select name="recommendation" class="form-select mb-3" required>
            <option value="">-- Pilih --</option>
            <option value="approved">Approved</option>
            <option value="approved_with_recommendation">Approved with Recommendation</option>
            <option value="resubmission">Resubmission</option>
            <option value="disapproved">Disapproved</option>
          </select>
          <button type="submit" class="btn btn-primary w-100">
            <i class="bi bi-send me-2"></i>Kirim Feedback
          </button>
        </form>
      </div>
    </div>
    @elseif($myReview && $myReview->status === 'completed')
    <div class="card mb-3 fade-up">
      <div class="card-body p-4 text-center">
        <div style="width:50px;height:50px;border-radius:50%;background:#ecfdf5;display:flex;align-items:center;justify-content:center;margin:0 auto 12px">
          <i class="bi bi-check-circle-fill" style="color:#10b981;font-size:1.5rem"></i>
        </div>
        <h6 class="fw-bold mb-1">Feedback Terkirim</h6>
        <p class="text-muted small mb-0">Anda telah menyelesaikan review untuk proposal ini.</p>
      </div>
    </div>
    @endif
    @endif

    <!-- Info Card -->
    <div class="card fade-up delay-2">
      <div class="card-body p-4">
        <h6 class="fw-bold mb-3" style="font-size:.85rem;color:#64748b;text-transform:uppercase;letter-spacing:.05em">Info Proposal</h6>
        <div class="d-flex flex-column gap-2" style="font-size:.82rem">
          <div class="d-flex justify-content-between"><span class="text-muted">ID Proposal</span><strong>#{{ $proposal->id }}</strong></div>
          <div class="d-flex justify-content-between"><span class="text-muted">Dokumen</span><strong>{{ $proposal->documents->count() }} file</strong></div>
          <div class="d-flex justify-content-between"><span class="text-muted">Reviewer</span><strong>{{ $proposal->reviews->count() }} orang</strong></div>
          <div class="d-flex justify-content-between"><span class="text-muted">Dibuat</span><strong>{{ $proposal->created_at->format('d M Y') }}</strong></div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection