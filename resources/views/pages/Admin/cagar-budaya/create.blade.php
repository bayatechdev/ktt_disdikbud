@extends('layouts/layoutMaster')

@section('title', 'Cagar Budaya')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endsection

@section('page-style')
@endsection

@section('vendor-script')
  <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/autosize/autosize.js') }}"></script>
@endsection

@section('content')
  <div class="title-with-button d-flex justify-content-between align-items-center">
    <h4 class="fw-bold py-3">
      <span class="text-muted fw-light">Cagar Budaya / </span> Tambah Data
    </h4>
    <div class="text-muted float-end">
      <a href="{{ route('cagarbudaya_index') }}" class="btn"><span class="d-md-inline-block"><i class="bx bx-arrow-back"></i></span></a></span>
    </div>
  </div>
  <!-- Basic Layout -->
  <div class="row g-3">
    <form class="add-new pt-0" id="addForm" action="{{ route('cagarbudaya_store') }}" method="POST" role="form" enctype="multipart/form-data">
      @csrf
      <div class="card p-4">
        <div class="text-center mb-2">
          <h4 class="mb-2">Tambah Data</h4>
          <p>Silahkan Input Cagar Budaya</p>
        </div>
        <div class="row mt-2 px-4">
          <div class="row mb-3 g-1">
            <label class="col-sm-4 col-form-label" for="title">Nama Cagar Budaya<sup class="text-danger">*</sup></label>
            <div class="col-sm-8">
              <input type="text" id="title" name="title" class="form-control" autocomplete="off" placeholder="Nama Cagar Budaya" required />
            </div>
          </div>
          <div class="row mb-3 g-1">
            <label class="col-sm-4 col-form-label" for="title">Nama Tempat<sup class="text-danger">*</sup></label>
            <div class="col-sm-8">
              <input type="text" id="title" name="title" class="form-control" autocomplete="off" placeholder="Nama Tempat" required />
            </div>
          </div>
          <div class="row mb-3 g-1">
            <label class="col-sm-4 col-form-label" for="title">Alamat<sup class="text-danger">*</sup></label>
            <div class="col-sm-8">
              <input type="text" id="title" name="title" class="form-control" autocomplete="off" placeholder="Alamat" required />
            </div>
          </div>
          <div class="row mb-3 g-1">
            <label class="col-sm-4 col-form-label" for="desa_id">Desa/Kelurahan<sup class="text-danger">*</sup></label>
            <div class="col-sm-8">
              <select id="desa_id" name="desa_id" class="select2_desa form-select" data-allow-clear="true" required>
                <option value="">-</option>
                @foreach ($desas as $desa)
                  <option value="{{ $desa->id }}">{{ $desa->kecamatan->title }} - {{ $desa->title }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3 g-1">
            <label class="col-sm-4 col-form-label" for="title">Latitude<sup class="text-danger">*</sup></label>
            <div class="col-sm-8">
              <input type="text" id="title" name="title" class="form-control" autocomplete="off" placeholder="Latitude" required />
            </div>
          </div>
          <div class="row mb-3 g-1">
            <label class="col-sm-4 col-form-label" for="title">Longitude<sup class="text-danger">*</sup></label>
            <div class="col-sm-8">
              <input type="text" id="title" name="title" class="form-control" autocomplete="off" placeholder="Longitude" required />
            </div>
          </div>
          {{-- <div class="row mb-3 g-1">
            <label class="col-sm-4 col-form-label" for="image">Gambar Berita<sup class="text-danger">*</sup></label>
            <div class="col-sm-8">
              <input type="file" id="image" name="image" class="form-control" accept=".png,.jpg,.jpeg" required>
            </div>
          </div> --}}
          <div class="row mb-3 g-1">
            <label class="col-sm-4 col-form-label">Publish</label>
            <div class="col-sm-8 pt-1">
              <div class="form-check form-check-inline">
                <input type="radio" id="publish1" name="publish" class="form-check-input" value="1" />
                <label class="form-check-label" for="publish1"> Ya </label>
              </div>
              <div class="form-check form-check-inline">
                <input type="radio" id="publish0" name="publish" class="form-check-input" value="0" checked required />
                <label class="form-check-label" for="publish0"> Tidak </label>
              </div>
            </div>
          </div>
          <div class="row mb-3 g-1">
            <label class="col-sm-4 col-form-label" for="content">Riwayat Kepemilikan<sup class="text-danger">*</sup></label>
            <div class="col-sm-8">
              <textarea id="content" name="content" class="form-control" rows="5" placeholder="Riwayat Kepemilikan" autocomplete="off" required></textarea>
            </div>
          </div>
          <div class="row mb-3 g-1">
            <label class="col-sm-4 col-form-label" for="content">Deskripsi<sup class="text-danger">*</sup></label>
            <div class="col-sm-8">
              <textarea id="content" name="content" class="form-control" rows="5" placeholder="Deskripsi" autocomplete="off" required></textarea>
            </div>
          </div>
          <div class="row mb-3 g-1">
            <label class="col-sm-4 col-form-label" for="content">Latar Sejarah<sup class="text-danger">*</sup></label>
            <div class="col-sm-8">
              <textarea id="content" name="content" class="form-control" rows="5" placeholder="Latar Sejarah" autocomplete="off" required></textarea>
            </div>
          </div>
        </div>

        <div class="pt-4">
          <div class="row justify-content-end">
            <div class="col-sm-8">
              <button type="submit" class="btn btn-primary me-sm-2 me-1" id="btn_submit">Simpan</button>
              <a href="{{ route('cagarbudaya_index') }}" class="btn btn-label-secondary">
                Batal
              </a>
            </div>
          </div>
        </div>

      </div>
    </form>
  </div>
@endsection

@push('addon-style')
@endpush

@push('addon-script')
  <script>
    $(function() {
      // ------------------------Bootstrap Datepicker-Format--------------------------------------------
      var bsDatepickerFormat = $('#tanggal');
      if (bsDatepickerFormat.length) {
        bsDatepickerFormat.datepicker({
          todayHighlight: true,
          format: 'dd/mm/yyyy',
          orientation: isRtl ? 'auto right' : 'auto left'
        });
      }
      // ------------------------------Autosize--------------------------------------
      const textarea = document.querySelector('#content');
      if (textarea) {
        autosize(textarea);
      }

      // ---------------------------Select2-----------------------------------------
      const select2_desa = $('.select2_desa');
      const select2_bidang = $('.select2_bidang');
      const select2_tags = $('.select2_tags');

      // Default
      if (select2_desa.length) {
        select2_desa.each(function() {
          var $this = $(this);
          $this.wrap('<div class="position-relative"></div>').select2({
            placeholder: '--Pilih Desa--',
            dropdownParent: $this.parent()
          });
        });
      }
      if (select2_bidang.length) {
        select2_bidang.each(function() {
          var $this = $(this);
          $this.wrap('<div class="position-relative"></div>').select2({
            placeholder: '--Pilih Bidang--',
            dropdownParent: $this.parent()
          });
        });
      }
      if (select2_tags.length) {
        select2_tags.each(function() {
          var $this = $(this);
          $this.wrap('<div class="position-relative"></div>').select2({
            placeholder: '--Pilih Tag--',
            dropdownParent: $this.parent()
          });
        });
      }
      // --------------------------------------------------------------------
    });
  </script>
@endpush
