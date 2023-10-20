@extends('layouts/layoutMaster')

@section('title', 'Kamus')

@section('content')
  <div class="row g-4 mb-4">
    <div class="col-sm-12 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>{{ $bahasa1 }}-{{ $bahasa2 }}</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $ttl1 }}</h4>
                {{-- <small class="text-success">(+)</small> --}}
              </div>
              <small>Total Kata</small>
              <div class="mt-2">
                <a href="{{ route('kamus_page', $bhs1) }}">
                  <button type="button" class="btn btn-primary">Lihat Kamus</button>
                </a>
              </div>
            </div>
            <span class="badge bg-label-primary rounded p-2">
              <i class="bx bxs-book bx-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-12 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>{{ $bahasa2 }}-{{ $bahasa1 }}</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $ttl2 }}</h4>
                {{-- <small class="text-success">(+)</small> --}}
              </div>
              <small>Total Kata</small>
              <div class="mt-2">
                <a href="{{ route('kamus_page', $bhs2) }}">
                  <button type="button" class="btn btn-warning">Lihat Kamus</button>
                </a>
              </div>
            </div>
            <span class="badge bg-label-warning rounded p-2">
              <i class="bx bxs-book bx-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
