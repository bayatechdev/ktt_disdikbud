@extends('layouts/layoutMaster')

@section('title', 'Galleries')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
  {{-- <link rel="stylesheet" href="{{ url('frontend/glightbox/dist/css/glightbox.css') }}" /> --}}
@endsection

@section('page-style')
  <link rel="stylesheet" href="{{ url('frontend/glightbox/dist/css/glightbox.css') }}" />
@endsection

@section('vendor-script')
  {{-- <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script> --}}
  <script src="{{ asset('assets/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-buttons/datatables-buttons.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
  {{-- <script src="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script> --}}
  <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/autosize/autosize.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
  <script src="{{ url('frontend/glightbox/dist/js/glightbox.js') }}"></script>

@endsection

@section('content')
  <div class="row g-4 mb-4">
    <div class="col-sm-12 col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Album</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $ttl }}</h4>
                {{-- <small class="text-success">(+)</small> --}}
              </div>
              <small>Total</small>
            </div>
            <span class="badge bg-label-primary rounded p-2">
              <i class="bx bx-image bx-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Invoice List Table -->
  <div class="card">
    <div class="card-datatable table-responsive">
      <table class="data-table table border-top" style="font-size: 12px;">
        <thead>
          <tr>
            <th width="10px" nowrap>#</th>
            <th>Album</th>
            <th>Publish</th>
            <th>Gambar</th>
            <th width="10px" nowrap>Aksi</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

  @include('_partials._modals.modal-gallery-album-add')
@endsection

@push('addon-style')
  <style>
    .data-table tr th {
      font-size: 10px;
    }
  </style>
@endpush

@push('addon-script')
  <script>
    // RESET
    function resetForm() {
      $("#addForm")[0].reset();
    }

    function album_simpan() {
      $('#btn_submit').addClass('btn-primary');
      $('#btn_submit').removeClass('btn-warning');
      $('#btn_submit').text('Simpan');
      $('#image').attr('required', true);
    }

    function album_edit() {
      $('#btn_submit').removeClass('btn-primary');
      $('#btn_submit').addClass('btn-warning');
      $('#btn_submit').text('Ubah');
      $('#image').attr('required', false);
    }

    $(document).on('click', '.btn_tambah', function(e) {
      e.preventDefault();
      resetForm();
      album_simpan();
      $('#modalAddData').modal('show');
    });

    // EDIT
    $(document).on('click', '.btn_edit', function(e) {
      let token = $(this).attr('data-token');
      // console.log(token);
      if (token) {
        $.ajax({
          type: 'GET',
          url: "/dashboard/galleries/album_edit/" + token,
          dataType: 'json',
          beforeSend: function() {
            $('#loading_spinner').show();
          },
          complete: function() {
            $('#loading_spinner').hide();
          },
          success: function(response, textStatus, xhr) {
            album_edit();
            resetForm();
            $.each(response.data, function(key, value) {
              $("#" + key).val(value).change();

              console.log('key : ' + key + '\nVal : ' + value);
            });
            $('#modalAddData').modal('show');
          },
          error: function(event, jqXHR, ajaxSettings, thrownError) {
            console.log(event + ' - ' + jqXHR + ' - ' + ajaxSettings + ' - ' + thrownError);
          }
        });
      }
    });

    $("#addForm").submit(function(e) {
      e.preventDefault();
      const fd = new FormData(this);
      $.ajax({
        url: "{{ route('album_store') }}",
        method: 'POST',
        data: fd,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        beforeSend: function() {
          $('#loading_spinner').show();
          $('#modalAddData').modal('hide');
        },
        complete: function() {
          $('#loading_spinner').hide();
        },
        success: function(response) {
          console.log(response);
          if (response.status == 200) {
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Data berhasil disimpan',
              showConfirmButton: false,
              timer: 1000
            });
            $('.data-table').DataTable().ajax.reload();
            resetForm();
          }
        },
        error: function() {
          Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Terjadi Kesalahan',
            showConfirmButton: true,
          });
        }
      });
    });

    // DELETE
    $(document).on('click', '.delete-record', function(e) {
      e.preventDefault();
      let token = $(this).attr('data-token');
      let name = $(this).attr('data-name');
      let csrf = '{{ csrf_token() }}';
      Swal.fire({
        title: 'Yakin ingin menghapus \n' + name + '?',
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
            url: "{{ route('album_delete') }}",
            method: 'delete',
            data: {
              token: token,
              _token: csrf
            },
            success: function(response) {
              if (response.status == 200) {
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Data berhasil dihapus',
                  showConfirmButton: false,
                  timer: 1000
                });
                $('.data-table').DataTable().ajax.reload();
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
        }
      })
    });
  </script>

  {{-- DATATABLE --}}
  <script>
    $(function() {
      // Variable declaration for table
      var data_table = $('.data-table');
      var role = {{ $user_role }};

      // Invoice datatable
      if (data_table.length) {
        var dt_invoice = data_table.DataTable({
          ajax: "{!! route('album_list') !!}", // JSON file to add data
          columns: [
            // columns according to JSON
            {
              data: ''
            },
            {
              data: 'title'
            },
            {
              data: 'publish'
            },
            {
              data: 'image'
            },
            {
              data: ''
            },
          ],
          columnDefs: [
            // Columns  
            {
              targets: 0,
              render: function(data, type, full, meta) {
                row_number = meta.row + 1;
                return '<div>' + row_number + '</div>';
              }
            },
            {
              targets: 1,
              render: function(data, type, full, meta) {
                return '<span class="d-flex flex-column">' + data + '</span>' +
                  '<small class="text-muted">Urutan: ' + full['order'] +
                  '</small>';
              }
            },
            {
              targets: 2,
              render: function(data, type, full, meta) {
                var publish = '<span class="badge bg-label-danger me-1">Tidak</span>';
                if (full['publish'] == 1) {
                  publish = '<span class="badge bg-label-primary me-1">Ya</span>';
                }
                return publish;
              }
            },
            {
              targets: 3,
              render: function(data, type, full, meta) {
                var img = '<a href="/storage/albums/images/' + data + '" class="glightbox"><img src="/storage/albums/images/thumb_' + data + '" alt="Avatar" class="rounded-2" width="100px"></a>';

                return img;
              }
            },
            {
              // Actions
              targets: -1,
              title: 'Actions',
              searchable: false,
              orderable: false,
              responsivePriority: 3,
              render: function(data, type, full, meta) {
                var $token = full['token'];
                var $name = full['title'];

                var btn_aksi = '<a href="javascript:;" data-bs-toggle="tooltip" class="text-body btn_edit" data-token="' +
                  $token + '" data-bs-placement="top" title="Edit"><i class="bx bx-edit mx-1 text-warning"></i></a>' +
                  '<a href="javascript:;" data-bs-toggle="tooltip" class="text-body delete-record" data-token="' +
                  $token + '" data-name="' + $name +
                  '" data-bs-placement="top" title="Hapus"><i class="bx bx-trash mx-1 text-danger"></i></a>';

                // if (role == 20) {
                //   btn_aksi = '';
                // }

                return (
                  '<div class="d-flex align-items-center">' +
                  btn_aksi +
                  '</div>'
                );
              }
            }
          ],
          dom: '<"row ms-2 me-3"' +
            '<"col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-start gap-2"l<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start mt-md-0 mt-3"B>>' +
            '<"col-12 col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row pe-3 gap-md-2"f<"invoice_status mb-3 mb-md-0">>' +
            '>t' +
            '<"row mx-2"' +
            '<"col-sm-12 col-md-6"i>' +
            '<"col-sm-12 col-md-6"p>' +
            '>',
          language: {
            sLengthMenu: '_MENU_',
            search: '',
            searchPlaceholder: 'Cari Data'
          },
          buttons: [
            //Button  
            {
              text: '<i class="bx bx-plus me-md-2"></i><span class="d-md-inline-block d-none">Tambah</span>',
              className: 'add-new btn btn-primary btn_tambah',
            },
          ]
        });
      }

      // On each datatable draw, initialize tooltip
      data_table.on('draw.dt', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
          return new bootstrap.Tooltip(tooltipTriggerEl, {
            boundary: document.body
          });
        });
      });

      setTimeout(() => {
        $('.dataTables_filter .form-control').removeClass('form-control-sm');
        $('.dataTables_length .form-select').removeClass('form-select-sm');

        // GlightBox
        var lightbox = GLightbox();
        lightbox.on('open', (target) => {
          console.log('lightbox opened');
        });
      }, 300);
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
      const textarea_alamat = document.querySelector('#alamat');
      if (textarea_alamat) {
        autosize(textarea_alamat);
      }
      const textarea_riwayat_kepemilikan = document.querySelector('#riwayat_kepemilikan');
      if (textarea_riwayat_kepemilikan) {
        autosize(textarea_riwayat_kepemilikan);
      }
      const textarea_deskripsi = document.querySelector('#deskripsi');
      if (textarea_deskripsi) {
        autosize(textarea_deskripsi);
      }
      const textarea_latar_sejarah = document.querySelector('#latar_sejarah');
      if (textarea_latar_sejarah) {
        autosize(textarea_latar_sejarah);
      }
      const textarea_cb_deskripsi = document.querySelector('#cb_deskripsi');
      if (textarea_cb_deskripsi) {
        autosize(textarea_cb_deskripsi);
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
      // --------------------------Cleave Phone Number------------------------------------------
      // Phone Number
      // const phoneMaskList = document.querySelectorAll('.phone-mask')
      // if (phoneMaskList) {
      //   phoneMaskList.forEach(function(phoneMask) {
      //     new Cleave(phoneMask, {
      //       phone: true,
      //       phoneRegionCode: 'ID'
      //     });
      //   });
      // }
      // --------------------------------------------------------------------
    });
  </script>
@endpush
