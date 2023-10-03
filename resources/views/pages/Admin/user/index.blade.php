@extends('layouts/layoutMaster')

@section('title', 'Pengaturan')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
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
  <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
@endsection


@section('content')
  <div class="row g-4 mb-4">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>User</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $ttl }}</h4>
                {{-- <small class="text-success">(+0)</small> --}}
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
      <table class="data-table table border-top">
        <thead>
          <tr>
            <th>User</th>
            <th>Email/Role</th>
            <th>Aktif</th>
            <th width="10px">Aksi</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
  <!-- Offcanvas to add SPPD -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAdd" aria-labelledby="offcanvasAddLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddLabel" class="offcanvas-title">User</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
      <form class="add-new pt-0" id="addForm" action="" method="POST" role="form" enctype="multipart/form-data">
        @csrf
        <input type="text" class="form-control" hidden id="token" placeholder="token" name="token" />
        <div class="mb-3">
          <label class="form-label" for="name">Nama</label>
          <input type="text" class="form-control" id="name" name="name" required />
        </div>
        <div class="mb-3">
          <label class="form-label" for="username">Username</label>
          <input type="text" class="form-control" id="username" name="username" required />
        </div>
        <div class="mb-3">
          <label class="form-label" for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" required />
        </div>
        <div class="mb-3">
          <label class="form-label" for="password">Password</label>
          <input type="password" class="form-control" minlength="6" id="password" name="password" required />
        </div>
        <div class="mb-3">
          <label for="role" class="form-label">Role</label>
          <select id="role" name="role" class="form-select" required>
            @foreach (config('global.user_role') as $index => $value)
              <option value="{{ $index }}" {{ $index == 3 ? 'selected' : '' }}>{{ $value }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label" for="publish">Aktif</label><br>
          <div class="form-check form-check-inline mt-1">
            <input class="form-check-input" type="radio" name="publish" id="publish1" value="1" required checked />
            <label class="form-check-label" for="publish1">Ya</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="publish" id="publish0" value="0" required />
            <label class="form-check-label" for="publish0">Tidak</label>
          </div>
        </div>
        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit mt-3">Submit</button>
        <button type="reset" class="btn btn-label-secondary mt-3" data-bs-dismiss="offcanvas">Cancel</button>
      </form>
    </div>
  </div>
@endsection

@push('addon-script')
  <script>
    function reset_form() {
      $("#addForm")[0].reset();
      document.getElementById("password").required = true;
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
          url: "{{ route('user_edit') }}",
          type: 'POST',
          data: {
            token: token,
            _token: '{{ csrf_token() }}',
          },
          success: function(response, textStatus, xhr) {
            reset_form();
            if (xhr.status == 200) {
              $('#offcanvasAdd').offcanvas('show');
              $.each(response.data, function(key, value) {
                if (key == 'password') {

                } else {
                  $("#" + key).val(value).change();

                  if (key == 'publish' && value == 1) {
                    $("#publish1").prop("checked", true);
                  } else if (key == 'publish' && value == 0) {
                    $("#publish0").prop("checked", true);
                  }
                  document.getElementById("password").required = false;
                }
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
        url: "{{ route('user.store') }}",
        method: 'POST',
        data: fd,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
          // console.log(response);
          if (response.status == 200) {
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Data berhasil disimpan',
              showConfirmButton: false,
              timer: 1000
            });
            $('.data-table').DataTable().ajax.reload();
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
            url: "{{ route('user_delete') }}",
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

      // Invoice datatable
      if (dt_invoice_table.length) {
        var dt_invoice = dt_invoice_table.DataTable({
          ajax: 'user_list', // JSON file to add data
          columns: [
            // columns according to JSON
            {
              data: 'name'
            },
            {
              data: 'role'
            },
            {
              data: 'publish'
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
                var $title = full['name'];
                var $username = full['username'];
                var $image = full['gambar'];
                // console.log($image);
                if ($image) {
                  // For Avatar image
                  var $output =
                    '<img src="/storage/assets/pegawai/images/thumb_' + $image['gambar'] +
                    '" alt="Avatar" class="rounded-circle">';
                } else {
                  // For Avatar badge
                  var stateNum = Math.floor(Math.random() * 6);
                  var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary'];
                  var $state = states[stateNum],
                    $title = full['name'],
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
                  '<a href="javascript:;" class="text-body text-truncate"><span class="fw-semibold">' +
                  $title +
                  '</span></a>' +
                  '<small class="text-muted">' +
                  $username +
                  '</small>' +
                  '</div>' +
                  '</div>';
                return $row_output;
              }
            },
            {
              targets: 1,
              render: function(data, type, full, meta) {
                return full['email'] + '<br><small>' + data + '</small>';
              }
            },
            {
              targets: 2,
              render: function(data, type, full, meta) {
                var $publish = 'Tidak';
                if (data == 1) {
                  $publish = 'Ya';
                }
                return $publish;
              }
            },
            {
              // Actions
              targets: -1,
              title: 'Actions',
              searchable: false,
              orderable: false,
              responsivePriority: 2,
              render: function(data, type, full, meta) {
                var $token = full['token'];
                var $name = full['name'];
                // console.log($name);
                return (
                  '<div class="d-flex align-items-center">' +
                  '<a href="javascript:;" data-bs-toggle="tooltip" class="text-body edit-record" data-token="' +
                  $token + '" data-bs-placement="top" title="Edit"><i class="bx bx-edit mx-1 text-warning"></i></a>' +
                  '<a href="javascript:;" data-bs-toggle="tooltip" class="text-body delete-record" data-token="' +
                  $token + '" data-name="' + $name +
                  '" data-bs-placement="top" title="Hapus"><i class="bx bx-trash mx-1 text-danger"></i></a>' +
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
            text: '<span class="d-md-inline-block btn_tambah">Tambah User</span>',
            className: 'add-new btn btn-primary add-record',
            attr: {
              'data-bs-toggle': 'offcanvas',
              'data-bs-target': '#offcanvasAdd'
            }
          }],
          // For responsive popup
          responsive: {
            details: {
              display: $.fn.dataTable.Responsive.display.modal({
                header: function(row) {
                  var data = row.data();
                  return 'Detail Dari ' + data['name'];
                }
              }),
              type: 'column',
              renderer: function(api, rowIdx, columns) {
                var data = $.map(columns, function(col, i) {
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
      // Autosize
      const textarea = document.querySelector('#title');
      if (textarea) {
        autosize(textarea);
      }
      // --------------------------------------------------------------------
      // Select
      const selectPicker = $('.selectpicker'),
        select2 = $('.select2'),
        select2Icons = $('.select2-icons');

      // Bootstrap Select
      // --------------------------------------------------------------------
      if (selectPicker.length) {
        selectPicker.selectpicker();
      }
      // Default
      if (select2.length) {
        select2.each(function() {
          var $this = $(this);
          $this.wrap('<div class="position-relative"></div>').select2({
            placeholder: 'Pilih',
            dropdownParent: $this.parent()
          });
        });
      }
      // --------------------------------------------------------------------
    });
  </script>
@endpush
