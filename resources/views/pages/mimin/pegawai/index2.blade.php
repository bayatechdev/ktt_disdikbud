@extends('layouts/layoutMaster')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
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
  <script src="{{ asset('assets/vendor/libs/autosize/autosize.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/bloodhound/bloodhound.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/tagify/tagify.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
@endsection

@section('page-script')
  {{-- <script src="{{ asset('assets/js/dashboard/surat_keluar-list.js') }}"></script> --}}
@endsection

@section('content')
  <div class="row g-4 mb-4">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Data Pegawai</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $ttl }}</h4>
                {{-- <small class="text-success">(+)</small> --}}
              </div>
              <small>Total</small>
            </div>
            <span class="badge bg-label-primary rounded p-2">
              <i class="bx bx-user bx-sm"></i>
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
            {{-- <th></th> --}}
            {{-- <th>#</th> --}}
            <th>Nama</th>
            <th>Jabatan - Bidang</th>
            <th>Eselon - Golongan</th>
            <th class="cell-fit">Aksi</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
  @include('_partials._offcanvas.offcanvas-pegawai-add')
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
    function reset_form() {
      $("#addForm")[0].reset();
    }

    // RESET
    $(document).on('click', '.btn_tambah', function(e) {
      reset_form();
    });

    // EDIT
    $(document).on('click', '.edit-record', function(e) {
      let token = $(this).attr('data-token');
      if (token) {
        $.ajax({
          url: "{{ route('pegawai_edit') }}",
          type: 'POST',
          data: {
            token: token,
            _token: '{{ csrf_token() }}',
          },
          success: function(response, textStatus, xhr) {
            // console.log(response.data);
            $("#addForm")[0].reset();
            reset_form();
            if (xhr.status == 200) {
              $('#offcanvasAdd').offcanvas('show');
              $.each(response.data, function(key, value) {
                if (key == 'jkel' && value == 1) {
                  $("#jkel1").prop("checked", true);
                } else if (key == 'jkel' && value == 0) {
                  $("#jkel0").prop("checked", true);
                }

                if (key == 'publish' && value == 1) {
                  $("#publish1").prop("checked", true);
                } else if (key == 'publish' && value == 0) {
                  $("#publish0").prop("checked", true);
                }

                if (key == 'lahir_tanggal') {
                  const str = value;
                  const [year, month, day] = str.split('-');
                  $("#bs-datepicker-format").val(day + '/' + month + '/' + year);
                }

                $("#" + key).val(value).change();

                // console.log('key : ' + key + '\nVal : ' + value);
              });
            }
          },
          error: function(event, jqXHR, ajaxSettings, thrownError) {
            console.log(event + ' - ' + jqXHR + ' - ' + ajaxSettings + ' - ' + thrownError);
          }
        });
      }
    });

    // CREATE OR UPDATE
    $("#addForm").submit(function(e) {
      e.preventDefault();
      const fd = new FormData(this);
      $.ajax({
        url: "{{ route('pegawai.store') }}",
        method: 'POST',
        data: fd,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
          console.log(response);
          if (response.status == 200) {
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Data berhasil disimpan',
              showConfirmButton: false,
              timer: 1000
            });
            $('.data-table').DataTable().ajax.reload();
            $("#addForm")[0].reset();
            reset_form();
            $('#offcanvasAdd').offcanvas('hide');
          }
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
        title: 'Yakin ingin menghapus (' + name + ')?',
        text: "Data ini tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Hapus!',
        cancelButtonText: 'Batal',
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "{{ route('pegawai_delete') }}",
            method: 'delete',
            data: {
              token: token,
              _token: csrf
            },
            success: function(response) {
              if (response.status == 200) {
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Data berhasil dihapus',
                  showConfirmButton: false,
                  timer: 1000
                });
                $('.data-table').DataTable().ajax.reload();
              } else if (response.status == 202) {
                Swal.fire({
                  position: 'top-end',
                  icon: 'warning',
                  title: 'Gagal dihapus, Data masih digunakan!',
                  showConfirmButton: false,
                  timer: 1500
                });
              } else {
                Swal.fire({
                  position: 'top-end',
                  icon: 'error',
                  title: 'Gagal dihapus!',
                  showConfirmButton: false,
                  timer: 1500
                })
              }
            }
          });
        }
      })
    });
  </script>
  <script>
    // -----------------DATATABLE---------------
    $(function() {
      // Variable declaration for table
      var dt_invoice_table = $('.data-table');
      var $nomor = 1;
      var role = {{ $user_role }};

      // Invoice datatable
      if (dt_invoice_table.length) {
        var dt_invoice = dt_invoice_table.DataTable({
          ajax: 'pegawai_list', // JSON file to add data
          columns: [
            // columns according to JSON
            // {
            //   data: ''
            // },
            // {
            //   data: ''
            // },
            {
              data: 'nama'
            },
            {
              data: 'jabatan_id'
            },
            {
              data: 'eselon_id'
            },
            {
              data: ''
            }
          ],
          columnDefs: [{
              // Nama, NIP, FOTO
              // className: 'control',
              responsivePriority: 1,
              targets: 0,
              render: function(data, type, full, meta) {
                var $title = full['nama'];
                var $nip = full['nip'];
                var $image = full['gambar'];
                var $token = full['token'];

                if ($nip == null) {
                  $nip = '-';
                }
                if ($image) {
                  // For Avatar image
                  var $output =
                    '<img src="/storage/assets/pegawai/images/thumb_' + $image +
                    '" alt="Avatar" class="rounded-circle">';
                } else {
                  // For Avatar badge
                  var stateNum = Math.floor(Math.random() * 6);
                  var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary'];
                  var $state = states[stateNum],
                    $title = full['nama'],
                    $initials = $title.match(/\b\w/g) || [];
                  $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
                  $output = '<span class="avatar-initial rounded-circle bg-label-' + $state + '">' +
                    $initials + '</span>';
                }
                // Creates full output for row
                var $row_output =
                  '<div class="d-flex justify-content-start align-items-center user-name">' +
                  '<div class="avatar-wrapper">' +
                  '<div class="avatar avatar-sm me-3">' +
                  $output +
                  '</div>' +
                  '</div>' +
                  '<div class="d-flex flex-column">' +
                  '<a href="pegawai_detail/' + $token +
                  '" class="text-body text-truncate"><span class="fw-semibold">' +
                  $title +
                  '</span></a>' +
                  '<small class="text-muted">' +
                  $nip +
                  '</small>' +
                  '</div>' +
                  '</div>';
                return $row_output;
              }
            },
            {
              targets: 1,
              responsivePriority: 4,
              render: function(data, type, full, meta) {
                var $jabatan = full['jabatan'];
                var $bidang = full['bidang'];

                if ($bidang == null) {
                  $bidang = '';
                } else {
                  $bidang = $bidang['title'];
                }

                if ($jabatan == null) {
                  $jabatan = '';
                } else {
                  $jabatan = $jabatan['title'];
                }

                return '<span class="d-flex flex-column">' + $jabatan + '</span>' +
                  '<small class="text-muted">' +
                  $bidang +
                  '</small>';
              }
            },
            {
              targets: 2,
              responsivePriority: 5,
              render: function(data, type, full, meta) {
                var $eselon = full['eselon'];
                var $golongan = full['golongan'];
                var gol_desc = '';
                if ($eselon == null) {
                  $eselon = '';
                } else {
                  $eselon = $eselon['title'];
                }

                if ($golongan == null) {
                  $golongan = '';
                  $gol_desc = '';
                } else {
                  $gol_desc = ' (' + $golongan['description'] + ')';
                  $golongan = $golongan['title'];
                }

                return '<span class="d-flex flex-column" style="font-family: Times New Roman, Times, serif;">' +
                  $eselon + '</span>' +
                  '<small class="text-muted"><span class="fw-semibold" style="font-family: Times New Roman, Times, serif;">' +
                  $golongan + '</span>' + $gol_desc +
                  '</small>';
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
                var $name = full['nama'];

                var btn_aksi = '<div class="dropdown">' +
                  '<a href="javascript:;" class="btn dropdown-toggle hide-arrow text-body p-0" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></a>' +
                  '<div class="dropdown-menu dropdown-menu-end">' +
                  '<a href="javascript:;" class="dropdown-item edit-record" data-token="' + $token +
                  '">Edit</a>' +
                  '<div class="dropdown-divider"></div>' +
                  '<a href="javascript:;" data-token="' + $token + '" data-name="' + $name +
                  '" class="dropdown-item delete-record text-danger">Delete</a>' +
                  '</div>' +
                  '</div>';

                // if (role == 2 || role == 3) {
                //   btn_aksi = '';
                // }

                return (
                  '<div class="d-flex align-items-center">' +
                  '<a href="pegawai_detail/' + $token +
                  '" data-bs-toggle="tooltip" class="text-body btn_detail" data-bs-placement="top" title="Detail"><i class="bx bx-show mx-1"></i></a>' +
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
            text: '<i class="bx bx-plus me-md-2"></i><span class="d-md-inline-block d-none">Pegawai</span>',
            className: 'add-new btn btn-primary add-record btn_tambah',
            attr: {
              'data-bs-toggle': 'offcanvas',
              'data-bs-target': '#offcanvasAdd',
              // 'hidden': function() {
              //   if (role == 0 || role == 1) {
              //     return false;
              //   } else {
              //     return true;
              //   }
              // },
            }
          }],
          // For responsive popup
          responsive: {
            details: {
              display: $.fn.dataTable.Responsive.display.modal({
                header: function(row) {
                  var data = row.data();
                  return 'Detail Dari ' + data['nama'];
                }
              }),
              type: 'column',
              renderer: function(api, rowIdx, columns) {
                var data = $.map(columns, function(col, i) {
                  // if (col.columnIndex == 1) {
                  //   col.title = ''
                  // };
                  return col.title !==
                    '' // ? Do not show row in modal popup if title is blank (for check box)
                    ?
                    '<tr data-dt-row="' +
                    col.rowIndex +
                    '" data-dt-column="' +
                    col.columnIndex +
                    '">' +
                    '<td>' +
                    col.title +
                    ':' +
                    '</td> ' +
                    '<td>' +
                    col.data +
                    '</td>' +
                    '</tr>' :
                    '';
                }).join('');

                return data ? $('<table class="table"/><tbody />').append(data) : false;
              }
            }
          }
        });
      }

      // On each datatable draw, initialize tooltip
      dt_invoice_table.on('draw.dt', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
          return new bootstrap.Tooltip(tooltipTriggerEl, {
            boundary: document.body
          });
        });
      });

      // Filter form control to default size
      // ? setTimeout used for multilingual table initialization
      setTimeout(() => {
        $('.dataTables_filter .form-control').removeClass('form-control-sm');
        $('.dataTables_length .form-select').removeClass('form-select-sm');
      }, 300);
    });

    $(function() {
      // Bootstrap Datepicker-Format
      var bsDatepickerFormat = $('#bs-datepicker-format');
      if (bsDatepickerFormat.length) {
        bsDatepickerFormat.datepicker({
          todayHighlight: true,
          format: 'dd/mm/yyyy',
          orientation: isRtl ? 'auto right' : 'auto left'
        });
      }
      // --------------------------------------------------------------------
      // Autosize
      const textarea = document.querySelector('#alamat');
      if (textarea) {
        autosize(textarea);
      }
      // --------------------------------------------------------------------
    });
  </script>
@endpush
