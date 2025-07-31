@extends('layouts/layoutMaster')

@section('title', 'Berita')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
@endsection

@section('page-style')
@endsection

@section('vendor-script')
  <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/autosize/autosize.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>

  <script src="{{ asset('assets/vendor/libs/clipboard/clipboard.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/idletimer/idletimer.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/numeral/numeral.js') }}"></script>
@endsection

@section('page-script')
  <script src="{{ asset('assets/js/forms-editors.js') }}"></script>
@endsection

@section('content')
  <form class="add-new pt-0" id="addForm" action="{{ route('berita_update', $item->token) }}" method="POST"
    role="form" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="title-with-button d-md-flex justify-content-between align-items-center">
      <h4 class="fw-bold py-3">
        <span class="text-muted fw-light">Berita / </span> Edit Berita
      </h4>
      <div class="text-muted d-block">
        <a href="{{ route('berita_index') }}" class="btn btn-label-secondary me-2">
          Batal
        </a>
        <button type="submit" class="btn btn-warning me-sm-2 me-1" id="btn_submit">Ubah</button>
        {{-- </div> --}}
      </div>
    </div>
    <!-- Basic Layout -->
    <div class="row g-3">

      <div class="pb-4">
        <div class="text-center mb-2">
          {{-- <h4 class="mb-2">Tambah Berita</h4>
          <p>Silahkan Input Berita Terbaru</p> --}}
        </div>
        <div class="row g-3">
          <div class="col-md-8">
            <div class="card p-4">
              <div class="mb-2">
                <label class="form-label" for="title">Judul Berita<sup class="text-danger">*</sup></label>
                <input type="text" id="title" name="title" class="form-control" autocomplete="off"
                  placeholder="Judul Berita" value="{{ $item->title }}" required />
              </div>
              <div class="row g-2">
                <div class="col-md-6">
                  <div class="mb-2">
                    <label class="form-label" for="tanggal">Tanggal Berita<sup class="text-danger">*</sup></label>
                    <input type="text" id="tanggal" name="tanggal" placeholder="DD/MM/YYYY" class="form-control"
                      autocomplete="off" value="{{ Carbon::parse($item->tanggal)->format('d/m/Y') }}" required />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-2">
                    <label class="form-label" for="kategori_id">Kategori Berita<sup class="text-danger">*</sup></label>
                    <select id="kategori_id" name="kategori_id" class="select2 form-select" data-allow-clear="true"
                      required>
                      <option value="">-</option>
                      @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ $item->kategori_id == $kategori->id ? 'selected' : '' }}>
                          {{ $kategori->title }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="title">Isi Berita<sup class="text-danger">*</sup></label>
                <input type="text" hidden name="content">
                <div id="full-editor" style="min-height: 350px;">{!! $item->content !!}</div>
                @error('content')
                  <small class="text-danger">Input Isi Berita Terlebih Dahulu</small>
                @enderror
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card p-4">

              {{-- <div class="mb-2">
                <label class="form-label" for="image">Gambar Berita<sup class="text-danger">*</sup></label>
                <input type="file" id="image" name="image" class="form-control" accept=".png,.jpg,.jpeg">
              </div> --}}
              {{-- <div class="mb-2 d-none">
                <label class="form-label" for="bidang_id">Bidang</label>
                <select id="bidang_id" name="bidang_id" class="select2_bidang form-select" data-allow-clear="true">
                  <option value="">-</option>
                  @foreach ($bidangs as $bidang)
                    <option value="{{ $bidang->id }}" {{ $item->bidang_id == $bidang->id ? 'selected' : '' }}>{{ $bidang->title }}</option>
                  @endforeach
                </select>
              </div> --}}
              <div class="mb-2">
                <label class="form-label" for="tags">Tag</label>
                <select id="tags" name="tags[]" class="select2_tags form-select" multiple>
                  @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}" @if (is_array($item->tags) && in_array($tag->id, $item->tags)) selected="selected" @endif>
                      {{ $tag->title }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-2">
                <label class="form-label">Headline</label>
                <div class="col-sm-8 pt-1">
                  <div class="form-check form-check-inline">
                    <input type="radio" id="headline1" name="headline" class="form-check-input" value="1"
                      {{ $item->headline == 1 ? 'checked' : '' }} />
                    <label class="form-check-label" for="headline1"> Ya </label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input type="radio" id="headline0" name="headline" class="form-check-input" value="0"
                      required {{ $item->headline == 0 ? 'checked' : '' }} />
                    <label class="form-check-label" for="headline0"> Tidak </label>
                  </div>
                </div>
              </div>
              <div class="mb-2">
                <label class="form-label">Status</label>
                <div class="col-sm-8 pt-1">
                  <div class="form-check form-check-inline">
                    <input type="radio" id="publish1" name="publish" class="form-check-input" value="1"
                      {{ $item->publish == 1 ? 'checked' : '' }} />
                    <label class="form-check-label" for="publish1"> Publish </label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input type="radio" id="publish0" name="publish" class="form-check-input" value="0"
                      required {{ $item->publish == 0 ? 'checked' : '' }} />
                    <label class="form-check-label" for="publish0"> Draf </label>
                  </div>
                </div>
              </div>
            </div>


            <div class="card p-4 mt-3" id="form_gallery">
              <p class="text-center">Pilih Atau Upload Gambar</p>
              <div id="pageGallery"> <!--Page Berita Gallery-->
              </div>
              <div class="row text-center pb-3 cLoading">
                <small class="text-muted">Loading...</small>
              </div>
              <div class="row g-1">
                <input type="text" id="berita_id" hidden name="berita_id" class="form-control" placeholder=""
                  value="{{ $item->id }}">
                <div class="col-sm-12">
                  <input type="file" id="gal_image" name="gal_image" class="form-control" accept=".png,.jpg,.jpeg"
                    multiple>
                </div>
              </div>
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
    function copyToClipboard(elementId) {
      // Create a "hidden" input
      var aux = document.createElement("input");
      // Assign it the value of the specified element
      aux.setAttribute("value", document.getElementById(elementId).innerHTML);
      // Append it to the body
      document.body.appendChild(aux);
      // Highlight its content
      aux.select();
      // Copy the highlighted text
      document.execCommand("copy");
      // Remove it from the body
      document.body.removeChild(aux);

    }

    function onlyOne(checkbox) {
      var checkboxes = document.getElementsByName('berkas_pilih');
      checkboxes.forEach((item) => {
        if (item !== checkbox) {
          item.checked = false;
        }
      })
      var checkedValue = $('.berkas_pilih:checked').val();
      console.log(checkedValue);
      // $('#berkas_id').val(checkedValue);
      if (checkedValue) {
        $('#btn_pilih').removeClass('disabled');
        console.log('/dashboard/berita/berita_thumbnail/{{ $item->token }}/' + checkedValue);

        $.ajax({
          type: "GET",
          url: '/dashboard/berita/berita_thumbnail/{{ $item->token }}/' + checkedValue,
          datatype: "json",
          success: function(data, response, textStatus, xhr) {
            console.log(data.gambar);
            var img = '<img src="/storage/berita/images/thumb_' + data.gambar +
              '" alt="Gambar" style="object-fit: cover; height: 100px;" />'
            $('#thumb_berita').html(img);
            toastr['success']('', 'Berhasil mengganti thumbnail berita');

          },
          error: function() {
            console.log('error');
            Swal.fire({
              position: 'center',
              icon: 'error',
              title: 'Terjadi Kesalahan!, silahkan pilih ulang gambar',
              showConfirmButton: true,
            });
          }
        });
      } else {
        $('#btn_pilih').addClass('disabled');
      }
    }

    $(document).on('click', '.btn_copy', function(e) {
      let token = $(this).attr('data-copy');
      copyToClipboard(token);
      toastr['success']('', 'Berhasil dicopy');
    });

    function berkas_terupload() {
      $.ajax({
        type: "GET",
        url: '/dashboard/berita/berita_gallery_list/{{ $item->token }}',
        datatype: "json",
        success: function(data, response, textStatus, xhr) {
          $("#pageGallery").html(data);
          $(".cLoading").addClass('d-none');
        },
        error: function() {
          console.log('error');
        }
      });
    }

    $(document).ready(function() {
      berkas_terupload();
    });

    $(document).on('change', '#gal_image', function(e) {
      let csrf = '{{ csrf_token() }}';
      var myFormData = new FormData();
      myFormData.append('gal_image', gal_image.files[0]);
      myFormData.append('berita_id', $('#berita_id').val());

      $.ajax({
        headers: {
          'X-CSRF-TOKEN': csrf
        },
        url: "{{ route('gallery_store') }}",
        type: 'POST',
        processData: false, // important
        contentType: false, // important
        dataType: 'json',
        data: myFormData,
        enctype: 'multipart/form-data',
        beforeSend: function() {
          $('#loading_spinner').show();
        },
        complete: function() {
          $('#loading_spinner').hide();
        },
        success: function(response) {
          if (response.status == 200) {
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Gambar berhasil diupload',
              showConfirmButton: false,
              timer: 1000
            });
            berkas_terupload();
          }
        },
        error: function(xhr) {
          console.log(xhr);
          Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Terjadi Kesalahan',
            showConfirmButton: true,
          });
        }
      });
    });

    // BERKAS UPLOAD HAPUS
    $(document).on('click', '.btn_hapus_upload', function(e) {
      e.preventDefault();
      let id = $(this).attr('data-id');
      console.log(id);
      if (id) {
        let csrf = '{{ csrf_token() }}';
        Swal.fire({
          title: 'Yakin ingin menghapus Gambar?',
          text: "Data ini tidak dapat dikembalikan!",
          icon: 'warning',
          showCancelButton: true,
          customClass: {
            confirmButton: 'btn btn-danger',
            cancelButton: 'btn btn-secondary',
          },
          confirmButtonText: 'Hapus!',
          cancelButtonText: 'Batal',
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: "{{ route('berita_gallery_delete') }}",
              method: 'delete',
              data: {
                token: id,
                _token: csrf
              },
              success: function(response) {
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Data berhasil dihapus',
                  showConfirmButton: false,
                  timer: 1000
                });
                berkas_terupload();
              },
              error: function() {
                Swal.fire({
                  position: 'center',
                  icon: 'error',
                  title: 'Gagal dihapus!',
                  showConfirmButton: true,
                })
                berkas_terupload();
              }
            });
          }
        })
      }
    });
  </script>
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
