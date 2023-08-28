@extends('layouts/layoutMaster')

@section('title', 'Berita')

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
      <span class="text-muted fw-light">Berita / </span> Tambah Berita
    </h4>
    <div class="text-muted float-end">
      <a href="{{ route('berita_index') }}" class="btn"><span class="d-md-inline-block"><i class="bx bx-arrow-back"></i></span></a></span>
    </div>
  </div>
  <!-- Basic Layout -->
  <div class="row g-3 px-2">
    <form class="add-new pt-0" id="addForm" action="{{ route('berita_store') }}" method="POST" role="form" enctype="multipart/form-data">
      @csrf
      <div class="card p-4">
        <div class="text-center mb-2">
          <h4 class="mb-2">Tambah Berita</h4>
          <p>Silahkan Input Berita Terbaru</p>
        </div>
        <div class="row mt-2 px-4">
          <div class="row mb-3 g-1">
            <label class="col-sm-4 col-form-label" for="title">Judul Berita<sup class="text-danger">*</sup></label>
            <div class="col-sm-8">
              <input type="text" id="title" name="title" class="form-control" autocomplete="off" placeholder="Judul Berita" required />
            </div>
          </div>
          <div class="row mb-3 g-1">
            <label class="col-sm-4 col-form-label" for="tanggal">Tanggal Berita<sup class="text-danger">*</sup></label>
            <div class="col-sm-8">
              <input type="text" id="tanggal" name="tanggal" placeholder="DD/MM/YYYY" class="form-control" autocomplete="off" required />
            </div>
          </div>
          <div class="row mb-3 g-1">
            <label class="col-sm-4 col-form-label" for="kategori_id">Kategori Berita<sup class="text-danger">*</sup></label>
            <div class="col-sm-8">
              <select id="kategori_id" name="kategori_id" class="select2 form-select" data-allow-clear="true" required>
                <option value="">-</option>
                @foreach ($kategoris as $kategori)
                  <option value="{{ $kategori->id }}">{{ $kategori->title }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3 g-1">
            <label class="col-sm-4 col-form-label" for="image">Gambar Berita<sup class="text-danger">*</sup></label>
            <div class="col-sm-8">
              <input type="file" id="image" name="image" class="form-control" accept=".png,.jpg,.jpeg" required>
            </div>
          </div>
          <div class="row mb-3 g-1">
            <label class="col-sm-4 col-form-label" for="bidang_id">Bidang</label>
            <div class="col-sm-8">
              <select id="bidang_id" name="bidang_id" class="select2_bidang form-select" data-allow-clear="true">
                <option value="">-</option>
                @foreach ($bidangs as $bidang)
                  <option value="{{ $bidang->id }}">{{ $bidang->title }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3 g-1">
            <label class="col-sm-4 col-form-label" for="tags">Tag</label>
            <div class="col-sm-8">
              <select id="tags" name="tags[]" class="select2_tags form-select" multiple>
                @foreach ($tags as $tag)
                  <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3 g-1">
            <label class="col-sm-4 col-form-label">Headline</label>
            <div class="col-sm-8 pt-1">
              <div class="form-check form-check-inline">
                <input type="radio" id="headline1" name="headline" class="form-check-input" value="1" />
                <label class="form-check-label" for="headline1"> Ya </label>
              </div>
              <div class="form-check form-check-inline">
                <input type="radio" id="headline0" name="headline" class="form-check-input" value="0" checked required />
                <label class="form-check-label" for="headline0"> Tidak </label>
              </div>
            </div>
          </div>
          <div class="row mb-3 g-1">
            <label class="col-sm-4 col-form-label">Status</label>
            <div class="col-sm-8 pt-1">
              <div class="form-check form-check-inline">
                <input type="radio" id="publish1" name="publish" class="form-check-input" value="1" />
                <label class="form-check-label" for="publish1"> Publish </label>
              </div>
              <div class="form-check form-check-inline">
                <input type="radio" id="publish0" name="publish" class="form-check-input" value="0" checked required />
                <label class="form-check-label" for="publish0"> Draf </label>
              </div>
            </div>
          </div>
          <div class="row mb-3 g-1">
            <label class="col-sm-4 col-form-label" for="content">Isi Berita<sup class="text-danger">*</sup></label>
            <div class="col-sm-8">
              <textarea id="content" name="content" class="form-control" rows="8" placeholder="Isi Berita" autocomplete="off" required></textarea>
            </div>
          </div>
        </div>

        <div class="pt-4">
          <div class="row justify-content-end">
            <div class="col-sm-8">
              <button type="submit" class="btn btn-primary me-sm-2 me-1" id="btn_submit">Simpan</button>
              <a href="{{ route('berita_index') }}" class="btn btn-label-secondary">
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
      const select2 = $('.select2');
      const select2_bidang = $('.select2_bidang');
      const select2_tags = $('.select2_tags');

      // Default
      if (select2.length) {
        select2.each(function() {
          var $this = $(this);
          $this.wrap('<div class="position-relative"></div>').select2({
            placeholder: '--Pilih Kategori--',
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
