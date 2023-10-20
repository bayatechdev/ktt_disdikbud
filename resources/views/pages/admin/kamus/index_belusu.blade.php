@extends('layouts/layoutMaster')

@section('title', 'Kamus')

@section('content')
  <div class="row g-4 mb-4">
    <div class="col-sm-12 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Indonesia - Belusu</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $ind_bls }}</h4>
                {{-- <small class="text-success">(+)</small> --}}
              </div>
              <small>Total</small>
              <div class="mt-2">
                <a href="#">
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
              <span>Belusu - Indonesia</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $bls_ind }}</h4>
                {{-- <small class="text-success">(+)</small> --}}
              </div>
              <small>Total</small>
              <div class="mt-2">
                <a href="{{ route('bls_ind_page') }}">
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
