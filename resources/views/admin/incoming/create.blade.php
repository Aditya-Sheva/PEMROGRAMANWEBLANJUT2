@extends('layouts.app')
@section('title','Tambah Proposal Masuk')
@section('page-title','Tambah Proposal Masuk')

@section('content')
<div class="row justify-content-center">
  <div class="col-lg-10">
    <nav aria-label="breadcrumb" class="mb-3">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.incoming.index') }}">Proposal Masuk</a></li>
        <li class="breadcrumb-item active">Tambah</li>
      </ol>
    </nav>

    <div class="card fade-up">
      <div class="card-header">
        <h6 class="card-header-title">
          <i class="bi bi-plus-circle me-2" style="color:#2563eb"></i>Form Tambah Proposal Masuk
        </h6>
      </div>
      <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.incoming.store') }}" enctype="multipart/form-data">
          @csrf
          @include('admin.incoming._form', ['submitLabel' => 'Simpan Proposal'])
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
