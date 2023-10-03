@extends('layouts/layoutMaster')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
@endsection

@section('vendor-script')
  <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-buttons/datatables-buttons.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js') }}"></script>
@endsection

@section('content')
  <div class="row g-4 mb-4">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Golongan</span>
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
      <table class="data-table table border-top">
        <thead>
          <tr>
            <td></td>
            <td>#</td>
            <th>Golongan</th>
            <th>Uraian</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
  <!-- Offcanvas to add Data Pegawai -->
  <div class="offcanvas offcanvas-top h-100" tabindex="-1" id="offcanvasAdd" aria-labelledby="offcanvasAddLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddLabel" class="offcanvas-title">Data Pegawai</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
      <form class="add-new pt-0" id="addForm" action="" method="POST" role="form" enctype="multipart/form-data">
        @csrf
        <input type="text" class="form-control" hidden id="token" placeholder="token" name="token" />
        <div class="row">
          <div class="col-sm-6">
            <div class="mb-3">
              <label class="form-label" for="nama">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required />
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label" for="nip">NIP</label>
                  <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP" required />
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label" for="aktif">Jenis Kelamin</label><br>
                  <div class="form-check form-check-inline mt-2">
                    <input class="form-check-input" type="radio" name="aktif" id="aktif1" value="1" required />
                    <label class="form-check-label mb-2" for="aktif1">Ya</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="aktif" id="aktif0" value="0" required />
                    <label class="form-check-label mb-2" for="aktif0">Tidak</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="mb-3">
                  <label class="form-label" for="tempat">Tempat Lahir</label>
                  <input type="text" class="form-control" id="tempat" name="tempat" required />
                </div>
              </div>
              <div class="col-sm-6">
                <div class="mb-3">
                  <label class="form-label" for="tanggal">Tangal Lahir</label>
                  <input type="text" id="bs-datepicker-format" name="tanggal" placeholder="DD/MM/YYYY" class="form-control" required />
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label" for="alamat">Alamat</label>
              <textarea class="form-control" name="alamat" id="alamat" role="document" rows="1"></textarea>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="mb-3">
              <label class="form-label" for="jabatan_id">Jabatan</label>
              <select id="jabatan_id" name="jabatan_id" class="form-select" required>
                <option value="">Pilih</option>
                <option value="">Kepala Dinas</option>
                <option value="">Sekertaris</option>
              </select>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="mb-3">
                  <label class="form-label" for="category_id">Golongan</label>
                  <select id="category_id" name="category_id" class="form-select" required>
                    <option value="">Pilih</option>
                    <option value="">I/A</option>
                    <option value="">I/B</option>
                    <option value="">I/C</option>
                    <option value="">I/D</option>
                    <option value="">II/A</option>
                    <option value="">II/B</option>
                    <option value="">II/C</option>
                    <option value="">II/D</option>
                    <option value="">III/A</option>
                    <option value="">III/B</option>
                    <option value="">III/C</option>
                    <option value="">III/D</option>
                    <option value="">IV/A</option>
                    <option value="">IV/B</option>
                    <option value="">IV/C</option>
                    <option value="">IV/D</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="mb-3">
                  <label class="form-label" for="category_id">Eselon</label>
                  <select id="category_id" name="category_id" class="form-select" required>
                    <option value="">Pilih</option>
                    <option value="">I.A</option>
                    <option value="">I.B</option>
                    <option value="">II.A</option>
                    <option value="">II.B</option>
                    <option value="">III.A</option>
                    <option value="">III.B</option>
                    <option value="">IV.A</option>
                    <option value="">IV.B</option>
                    <option value="">V</option>
                    <option value="">-</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label" for="agama">Agama</label>
              <select id="agama" name="agama" class="form-select" required>
                <option value="">Pilih</option>
                <option value="">Islam</option>
                <option value="">Keristen</option>
                <option value="">Katholik</option>
                <option value="">Budha</option>
                <option value="">Hindu</option>
                <option value="">Khonghucu</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label" for="file">Foto</label>
              <input type="file" class="form-control" id="file" name="file" />
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
      </form>
    </div>
  </div>
@endsection

@push('addon-style')
  <style>
    .font-tnm {
      font-family: 'Times New Roman', Times, serif;
    }
  </style>
@endpush

@push('addon-script')
  <script>
    // Show Modal
    $(document).on('click', '.btn_preview', function(e) {
      $('#modalCenter').modal('show');
    });

    // CREATE OR UPDATE
    $("#addForm").submit(function(e) {
      e.preventDefault();
      const fd = new FormData(this);
      $.ajax({
        url: "{{ route('surat_keluar.store') }}",
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
            url: "{{ route('surat_keluar_delete') }}",
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

    // EDIT
    $(document).on('click', '.edit-record', function(e) {
      let token = $(this).attr('data-token');
      if (token) {
        $.ajax({
          url: "{{ route('surat_keluar_edit') }}",
          type: 'POST',
          data: {
            token: token,
            _token: '{{ csrf_token() }}',
          },
          success: function(response, textStatus, xhr) {
            // console.log(response.data);
            $("#addForm")[0].reset();
            if (xhr.status == 200) {
              $('#offcanvasAdd').offcanvas('show');
              $.each(response.data, function(key, value) {
                // if (key == 'owner_gender' && value == 'L') {
                //   $("#L").prop("checked", true);
                // } else {
                //   $("#P").prop("checked", true);
                // }

                // if (key == 'user_id') {
                //   $("#user_id").val(value).change();
                // }

                // if (key == 'desa_id') {
                //   $("#desa_id").val(value).change();
                // }
                if (key == 'tanggal_surat') {
                  const str = value;
                  const [year, month, day] = str.split('-');
                  $("#bs-datepicker-format").val(day + '/' + month + '/' + year);
                }

                $("#" + key).val(value);

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

    // =====================DATATABLE=========================
    $(function() {
      // Variable declaration for table
      var data_table = $('.data-table');
      var $nomor = 1;

      // Invoice datatable
      if (data_table.length) {
        var dt_invoice = data_table.DataTable({
          ajax: 'golongan_list', // JSON file to add data
          columns: [
            // columns according to JSON
            {
              data: ''
            },
            {
              data: ''
            },
            {
              data: 'title'
            },
            {
              data: 'description'
            }
          ],
          columnDefs: [{
              // For Responsive
              className: 'control',
              responsivePriority: 1,
              searchable: false,
              targets: 0,
              render: function(data, type, full, meta) {
                return '';
              }
            },
            {
              targets: 1,
              responsivePriority: 4,
              render: function(data, type, full, meta) {
                return meta.row + 1;
              }
            },
            {
              targets: 2,
              responsivePriority: 2,
              render: function(data, type, full, meta) {
                var $gol = full['title'];
                return '<span class="fw-semibold font-tnm">' + $gol + '</span>';
              }
            },
            {
              targets: 3,
              responsivePriority: 3,
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
          // buttons: [{
          //   text: '<i class="bx bx-plus me-md-2"></i><span class="d-md-inline-block d-none">Surat Keluar</span>',
          //   className: 'add-new btn btn-primary add-record',
          //   attr: {
          //     'data-bs-toggle': 'offcanvas',
          //     'data-bs-target': '#offcanvasAdd'
          //   }
          // }],
          // For responsive popup
          responsive: {
            details: {
              display: $.fn.dataTable.Responsive.display.modal({
                header: function(row) {
                  var data = row.data();
                  return 'Detail dari ' + data['title'];
                }
              }),
              type: 'column',
              renderer: function(api, rowIdx, columns) {
                var data = $.map(columns, function(col, i) {
                  if (col.columnIndex == 1) {
                    col.title = ''
                  };
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
          },
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
