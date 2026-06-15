@extends('layouts.app')
@section('title','Edit Proposal Masuk')
@section('page-title','Edit Proposal Masuk')

@section('content')
<div class="row justify-content-center">
  <div class="col-lg-10">
    <nav aria-label="breadcrumb" class="mb-3">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.incoming.index') }}">Proposal Masuk</a></li>
        <li class="breadcrumb-item active">Edit</li>
      </ol>
    </nav>

    <div class="card fade-up">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h6 class="card-header-title mb-0">
          <i class="bi bi-pencil-square me-2" style="color:#2563eb"></i>Form Edit Proposal Masuk
        </h6>
        <a href="{{ route('proposals.show', $proposal) }}" class="btn btn-sm btn-outline-primary">
          <i class="bi bi-eye me-1"></i>Lihat Detail
        </a>
      </div>
      <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.incoming.update', $proposal) }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          @include('admin.incoming._form', ['proposal' => $proposal, 'submitLabel' => 'Update Proposal'])
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
