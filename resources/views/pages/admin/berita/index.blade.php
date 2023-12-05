@extends('layouts/layoutMaster')

@section('title', 'Berita')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}">
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
@endsection

@section('content')
  <div class="row g-4 mb-4">
    <div class="col-sm-12 col-md-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Seluruh Berita</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $ttl }}</h4>
                {{-- <small class="text-success">(+)</small> --}}
              </div>
              <small>Total</small>
            </div>
            <span class="badge bg-label-primary rounded p-2">
              <i class="bx bx-news bx-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-12 col-md-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Berita Publish</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $ttl_1 }}</h4>
                {{-- <small class="text-success">(+)</small> --}}
              </div>
              <small>Total</small>
            </div>
            <span class="badge bg-label-success rounded p-2">
              <i class="bx bx-news bx-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-12 col-md-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Berita Draf</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $ttl_0 }}</h4>
                {{-- <small class="text-success">(+)</small> --}}
              </div>
              <small>Total</small>
            </div>
            <span class="badge bg-label-secondary rounded p-2">
              <i class="bx bx-news bx-sm"></i>
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
            <th>Detail</th>
            <th>Status</th>
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
      window.location.href = "{{ route('berita_create') }}";
    });

    // DELETE
    $(document).on('click', '.delete-record', function(e) {
      e.preventDefault();
      let token = $(this).attr('data-token');
      let name = $(this).attr('data-name');
      let csrf = '{{ csrf_token() }}';
      Swal.fire({
        title: 'Yakin ingin menghapus Berita?',
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
            url: "{{ route('berita_delete') }}",
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
          ajax: 'berita_list', // JSON file to add data
          columns: [
            // columns according to JSON
            {
              data: ''
            },
            {
              data: 'title'
            },
            {
              data: 'ketegori_id'
            },
            {
              data: 'headline'
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
                return meta.row + 1;
              }
            },
            {
              targets: 1,
              render: function(data, type, full, meta) {
                sub_str = '-';
                if (full['content']) {
                  var sub_str = full['content'] + '...';

                  // if (sub_str.length > 200) sub_str = sub_str.substring(0, 200) + '...';
                }
                return '<span class="d-flex flex-column">' + data + '</span>' +
                  '<small>' +
                  '(' + moment(full['tanggal']).format('DD/MM/YYYY') + ')&nbsp' +
                  '</small>' +
                  '<small class="text-muted">' +
                  sub_str +
                  '</small>';
              }
            },
            {
              targets: 2,
              render: function(data, type, full, meta) {
                var kategori = '-';
                var bidang = '-';
                var user = '-';
                if (full['kategori']) {
                  kategori = full['kategori']['title'];
                }

                if (full['bidang']) {
                  bidang = full['bidang']['title'];
                }

                if (full['user']) {
                  user = full['user']['name'];
                }

                if (full['tags'] == 'null') {
                  tags = '-';
                } else {
                  tags = JSON.parse(full['tags']);
                }
                return '<table class="tbl-detail">' +
                  '<tr valign="top"><td class="td-1 text-nowrap px-0 mx-0">Kategori </td><td class="td-2">:</td><td class="td-3">' + kategori + '</td></tr>' +
                  '<tr valign="top"><td class="td-1 text-nowrap px-0 mx-0">Bidang </td><td class="td-2">:</td><td class="td-3">' + bidang + '</td></tr>' +
                  '<tr valign="top"><td class="td-1 text-nowrap px-0 mx-0">Tags </td><td class="td-2">:</td><td class="td-3">' + tags + '</td></tr>' +
                  '<tr valign="top"><td class="td-1 text-nowrap px-0 mx-0">By </td><td class="td-2">:</td><td class="td-3">' + user + '</td></tr>' +
                  '</table> ';
              }
            },
            {
              targets: 3,
              orderable: false,
              render: function(data, type, full, meta) {
                headline = '';
                if (data == 1) {
                  headline = '<small><span class="badge bg-label-success me-1">Headline</span></small>'
                }
                if (full['publish'] == 1) {
                  publish = '<small><span class="badge bg-label-primary me-1">Publish</span></small>'
                } else if (full['publish'] == 0) {
                  publish = '<small><span class="badge bg-label-secondary me-1">Draf</span></small>';
                } else if (full['publish'] == 2) {
                  publish = '<small><span class="badge bg-label-info me-1">New</span></small>';
                }
                return '<span class="text-nowrap">' + headline + publish + '</span>';
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

                var btn_aksi = '<a href="/dashboard/berita/berita_edit/' + $token + '" data-bs-toggle="tooltip" class="text-body edit-record" data-token="' +
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
            text: '<i class="bx bx-plus me-md-2"></i><span class="d-md-inline-block d-none">Berita</span>',
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
      }, 300);
    });
  </script>
@endpush
