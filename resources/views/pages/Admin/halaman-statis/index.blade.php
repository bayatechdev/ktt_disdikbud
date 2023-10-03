@extends('layouts/layoutMaster')

@section('title', 'Pages')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}">
  <link rel="stylesheet" href="{{ url('frontend/glightbox/dist/css/glightbox.css') }}" />
@endsection

@section('vendor-script')
  <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-buttons/datatables-buttons.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
  <script src="{{ url('frontend/glightbox/dist/js/glightbox.js') }}"></script>
@endsection

@section('content')
  <div class="row g-4 mb-4">
    <div class="col-sm-12 col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Halaman Statis</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $ttl }}</h4>
                {{-- <small class="text-success">(+)</small> --}}
              </div>
              <small>Total</small>
            </div>
            <span class="badge bg-label-primary rounded p-2">
              <i class="bx bx-file bx-sm"></i>
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
            <th>Judul</th>
            <th>Gambar</th>
            <th>Publish</th>
            <th width="10px" nowrap>Aksi</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
@endsection

@push('addon-style')
  <style>
    .data-table tr th {
      font-size: 10px;
    }

    .tbl-detail tr {
      line-height: 1.1;
    }

    .td-1 {
      font-size: 11px;
      font-weight: 400;
    }

    .td-2 {
      font-size: 11px;
      font-weight: bold;
      padding-left: 3px;
    }

    .td-3 {
      font-size: 10px;
      padding-left: 5px;
    }
  </style>
@endpush

@push('addon-script')
  <script>
    // RESET
    $(document).on('click', '.btn_tambah', function(e) {
      e.preventDefault();
      window.location.href = "{{ route('halaman_statis_create') }}";
    });

    // DELETE
    $(document).on('click', '.delete-record', function(e) {
      e.preventDefault();
      let token = $(this).attr('data-token');
      let name = $(this).attr('data-name');
      let csrf = '{{ csrf_token() }}';
      Swal.fire({
        title: 'Yakin ingin menghapus Data?',
        text: name,
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
            url: "{{ route('halaman_statis_delete') }}",
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
          ajax: 'halaman_statis_list', // JSON file to add data
          columns: [
            // columns according to JSON
            {
              data: ''
            },
            {
              data: 'title'
            },
            {
              data: 'image'
            },
            {
              data: 'publish'
            },
            {
              data: ''
            }
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
                  '</small> ' +
                  ' <small class="text-muted">Views: ' + full['hits'] +
                  '</small>';
              }
            },
            {
              targets: 2,
              render: function(data, type, full, meta) {
                var img = '<a href="/storage/halaman-statis/images/' + data + '" class="glightbox"><img src="/storage/halaman-statis/images/thumb_' + data + '" alt="Avatar" class="rounded-2" width="100px"></a>';

                return img;
              }
            },
            {
              targets: 3,
              render: function(data, type, full, meta) {
                var publish = '<span class="badge bg-label-danger me-1">Tidak</span>';
                if (full['publish'] == 1) {
                  publish = '<span class="badge bg-label-primary me-1">Ya</span>';
                }
                return publish;
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

                var btn_aksi = '<a href="/dashboard/pages/halaman_statis_edit/' + $token + '" data-bs-toggle="tooltip" class="text-body edit-record" data-token="' +
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
          // Buttons with Dropdown
          buttons: [{
            text: '<i class="bx bx-plus me-md-2"></i><span class="d-md-inline-block d-none">Tambah</span>',
            className: 'add-new btn btn-primary add-record btn_tambah',
            attr: {
              // 'data-bs-toggle': 'offcanvas',
              // 'data-bs-target': '#offcanvasAdd',
              'hidden': function() {
                return false;
                // if (role == 0 || role == 1) {
                //   return false;
                // } else {
                //   return true;
                // }
              },
            }
          }]
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
@endpush
