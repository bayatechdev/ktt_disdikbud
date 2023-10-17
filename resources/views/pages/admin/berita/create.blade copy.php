@extends('layouts/layoutMaster')

@section('title', 'Berita')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
@endsection

@section('page-style')
@endsection

@section('vendor-script')
  <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-buttons/datatables-buttons.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-buttons/buttons.html5.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-buttons/buttons.print.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/bloodhound/bloodhound.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/autosize/autosize.js') }}"></script>
@endsection

@section('page-script')
  {{-- <script src="{{ asset('assets/js/ui-carousel.js') }}"></script> --}}
  <script src="{{ asset('assets/js/modal-rekom-member-add.js') }}"></script>
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
  'token'<br>
  'tags'<br>
  'user_id'<br>
  'slug'<br>
  'hits'<br>
  <!-- Basic Layout -->
  <div class="row g-3 px-2">
    <div class="card p-4">
      <div class="row mt-4">
        <input type="text" id="token" name="token" class="form-control d-none" placeholder="token" />

        <div class="col-lg-7">
          <div class="mb-4">
            <div class="row mb-3 g-1">
              <label class="col-sm-4 col-form-label" for="title">Judul</label>
              <div class="col-sm-8">
                <input type="text" id="title" name="title" class="form-control" autocomplete="off" placeholder="Judul Berita" required />
              </div>
            </div>
            <div class="row mb-3 g-1">
              <label class="col-sm-4 col-form-label" for="tanggal">Tanggal Berita</label>
              <div class="col-sm-8">
                <input type="text" id="tanggal" name="tanggal" placeholder="DD/MM/YYYY" class="form-control" autocomplete="off" required />
              </div>
            </div>
            <div class="row mb-3 g-1">
              <label class="col-sm-4 col-form-label" for="kategori_id">Kategori</label>
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
              <label class="col-sm-4 col-form-label" for="image">Gambar</label>
              <div class="col-sm-8">
                <input type="file" id="image" name="image" class="form-control" accept=".png,.jpg,.jpeg">
              </div>
            </div>
            <div class="row mb-3 g-1">
              <label class="col-sm-4 col-form-label" for="content">Isi Berita</label>
              <div class="col-sm-8">
                <textarea id="content" name="content" class="form-control" rows="5" placeholder="Isi Berita" autocomplete="off"></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          {{-- <div class="bg-lighter p-3 rounded mb-3"> --}}
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
              <select id="tags" name="tags" class="select2_tags form-select" multiple>
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
          {{-- </div> --}}

        </div>
        {{-- <div class="col-lg-12">
          <textarea id="content" name="content" class="form-control" rows="5" placeholder="Isi Berita" autocomplete="off"></textarea>
        </div> --}}

        {{-- <div class="col-lg-12">
          <div class="row mb-3 g-1">
            <label class="col-sm-2 col-form-label" for="content">Isi Berita</label>
            <div class="col-sm-8">
              <textarea id="content" name="content" class="form-control" rows="5" placeholder="Isi Berita" autocomplete="off"></textarea>
            </div>
          </div>
        </div> --}}

      </div>

      <div class="pt-4">
        <div class="row justify-content-end">
          <div class="col-sm-8">
            <button type="submit" class="btn btn-primary me-sm-2 me-1" id="btn_submit">Simpan</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>

    </div>

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
            placeholder: '--Pilih--',
            dropdownParent: $this.parent()
          });
        });
      }
      if (select2_bidang.length) {
        select2_bidang.each(function() {
          var $this = $(this);
          $this.wrap('<div class="position-relative"></div>').select2({
            placeholder: '--Pilih--',
            dropdownParent: $this.parent()
          });
        });
      }
      if (select2_tags.length) {
        select2_tags.each(function() {
          var $this = $(this);
          $this.wrap('<div class="position-relative"></div>').select2({
            placeholder: '--Pilih--',
            dropdownParent: $this.parent()
          });
        });
      }
      // --------------------------------------------------------------------
    });
  </script>
@endpush
