@extends('layouts/layoutMaster')

@section('title', 'Kepegawaian')

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
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Bidang</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $ttl }}</h4>
                {{-- <small class="text-success">(+)</small> --}}
              </div>
              <small>Total</small>
            </div>
            <span class="badge bg-label-primary rounded p-2">
              <i class="bx bx-data bx-sm"></i>
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
            <th width="10px" nowrap>#</th>
            <th>Bidang</th>
            <th width="10px" nowrap>Aksi</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

  <!-- Offcanvas to add SPPD -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAdd" aria-labelledby="offcanvasAddLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddLabel" class="offcanvas-title">Bidang</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
      <form class="add-new pt-0" id="addForm" action="" method="POST" role="form" enctype="multipart/form-data">
        @csrf
        <input type="text" class="form-control" hidden id="token" placeholder="token" name="token" />
        <div class="mb-3">
          <label class="form-label" for="title">Nama Bidang</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Nama Bidang">
        </div>
        {{-- <div class="mb-3">
          <label class="form-label" for="nick">Singkatan</label>
          <input type="text" class="form-control" id="nick" name="nick">
        </div> --}}
        <div class="mb-3">
          <label class="form-label" for="urutan">Urutan Tampil</label>
          <input type="number" class="form-control" id="urutan" name="urutan" value="20" />
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
    }

    // RESET
    $(document).on('click', '.btn_tambah', function(e) {
      reset_form();
      $('#offcanvasAdd').offcanvas('show');
    });

    // EDIT
    $(document).on('click', '.edit-record', function(e) {
      let token = $(this).attr('data-token');
      if (token) {
        $.ajax({
          url: "{{ route('bidang_edit') }}",
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
              $.each(response.data, function(key, value) {

                $("#" + key).val(value).change();

                // console.log('key : ' + key + '\nVal : ' + value);
              });
              $('#offcanvasAdd').offcanvas('show');
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
        url: "{{ route('bidang.store') }}",
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
              position: 'center',
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
        title: 'Yakin ingin menghapus \n (' + name + ')?',
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
            url: "{{ route('bidang_delete') }}",
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
              } else if (response.status == 201) {
                Swal.fire({
                  position: 'center',
                  icon: 'warning',
                  title: 'Gagal dihapus, Data masih digunakan!',
                  showConfirmButton: true,
                });
              }
            },
            error: function() {
              Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                showConfirmButton: true,
              })
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
          ajax: 'bidang_list', // JSON file to add data
          columns: [
            // columns according to JSON
            {
              data: ''
            },
            {
              data: 'title'
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
              // Actions
              targets: -1,
              title: 'Actions',
              searchable: false,
              orderable: false,
              responsivePriority: 3,
              render: function(data, type, full, meta) {
                var $token = full['token'];
                var $name = full['title'];

                var btn_aksi = '<a href="javascript:;" data-bs-toggle="tooltip" class="text-body edit-record" data-token="' +
                  $token + '" data-bs-placement="top" title="Edit"><i class="bx bx-edit mx-1"></i></a>' +
                  '<a href="javascript:;" data-bs-toggle="tooltip" class="text-body delete-record" data-token="' +
                  $token + '" data-name="' + $name +
                  '" data-bs-placement="top" title="Hapus"><i class="bx bx-trash mx-1"></i></a>';

                if (role == 2 || role == 3) {
                  btn_aksi = '';
                }

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
            text: '<i class="bx bx-plus me-md-2"></i><span class="d-md-inline-block d-none">Bidang</span>',
            className: 'add-new btn btn-primary add-record btn_tambah',
            attr: {
              // 'data-bs-toggle': 'offcanvas',
              // 'data-bs-target': '#offcanvasAdd',
              'hidden': function() {
                if (role == 0 || role == 1) {
                  return false;
                } else {
                  return true;
                }
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
