@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Home')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
@endsection

@section('vendor-script')
  <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-buttons/datatables-buttons.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js') }}"></script>
@endsection

@section('page-script')
  <script src="{{ asset('assets/js/dashboard/dashboards.js') }}"></script>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12 mb-4 order-0">
      <div class="card">
        <div class="d-flex align-items-end row">
          <div class="col-sm-7">
            <div class="card-body">
              <h5 class="card-title text-primary">Selamat Datang, {{ Auth::user()->name }}</h5>
            </div>
          </div>
          <div class="col-sm-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
              <img src="{{ asset('assets/img/illustrations/mail3.png') }}" height="150" alt="View Badge User">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-6 col-lg-3 mb-4">
      <div class="card card-border-shadow-primary h-100">
        <div class="card-body">
          <div class="d-flex align-items-center mb-2 pb-1">
            <div class="avatar me-2">
              <a href="{{ route('berita_index') }}">
                <span class="avatar-initial rounded bg-label-primary"><i class="bx bxs-news"></i></span>
              </a>
            </div>
            <h4 class="ms-1 mb-0">{{ $ttl_berita }}</h4>
          </div>
          <p class="mb-1">Berita</p>
          <p class="mb-0">
            {{-- <span class="fw-medium me-1">+18.2%</span> --}}
            <a href="{{ route('berita_index') }}">
              <small class="text-muted">Kunjungi Halaman</small>
            </a>

          </p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3 mb-4">
      <div class="card card-border-shadow-warning h-100">
        <div class="card-body">
          <div class="d-flex align-items-center mb-2 pb-1">
            <div class="avatar me-2">
              <a href="{{ route('cagarbudaya_index') }}">
                <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-map"></i></span>
              </a>
            </div>
            <h4 class="ms-1 mb-0">{{ $ttl_cagar }}</h4>
          </div>
          <p class="mb-1">Cagar Budaya</p>
          <p class="mb-0">
            {{-- <span class="fw-medium me-1">-8.7%</span> --}}
            <a href="{{ route('cagarbudaya_index') }}">
              <small class="text-muted">Kunjungi Halaman</small>
            </a>
          </p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3 mb-4">
      <div class="card card-border-shadow-danger h-100">
        <div class="card-body">
          <div class="d-flex align-items-center mb-2 pb-1">
            <div class="avatar me-2">
              <a href="{{ route('bahasa', 'tidung') }}">
                <span class="avatar-initial rounded bg-label-danger"><i class="bx bx-book"></i></span>
              </a>
            </div>
            <h4 class="ms-1 mb-0">{{ $ttl_tidung }} Kata</h4>
          </div>
          <p class="mb-1">Kamus Tidung</p>
          <p class="mb-0">
            {{-- <span class="fw-medium me-1">+4.3%</span> --}}
            <a href="{{ route('bahasa', 'tidung') }}">
              <small class="text-muted">Kunjungi Halaman</small>
            </a>
          </p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3 mb-4">
      <div class="card card-border-shadow-info h-100">
        <div class="card-body">
          <div class="d-flex align-items-center mb-2 pb-1">
            <div class="avatar me-2">
              <a href="{{ route('bahasa', 'belusu') }}">
                <span class="avatar-initial rounded bg-label-info"><i class="bx bx-book"></i></span>
              </a>
            </div>
            <h4 class="ms-1 mb-0">{{ $ttl_belusu }} Kata</h4>
          </div>
          <p class="mb-1">Kamus Belusu</p>
          <p class="mb-0">
            {{-- <span class="fw-medium me-1">-2.5%</span> --}}
            <a href="{{ route('bahasa', 'belusu') }}">
              <small class="text-muted">Kunjungi Halaman</small>
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>
@endsection
