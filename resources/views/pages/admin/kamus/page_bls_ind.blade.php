@extends('layouts/layoutMaster')

@section('title', 'Kamus Belusu-Indonesia')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}">
  {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" /> --}}
  {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" /> --}}
@endsection

@section('page-style')
@endsection

@section('vendor-script')
  <script src="{{ asset('assets/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/autosize/autosize.js') }}"></script>
  {{-- <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script> --}}

  <script src="{{ asset('assets/vendor/libs/datatables-buttons/datatables-buttons.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-buttons/buttons.html5.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-buttons/buttons.print.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/jszip/jszip.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/pdfmake/pdfmake.js') }}"></script>

@endsection

@section('content')
  <div class="title-with-button d-flex justify-content-between align-items-center">
    <h4 class="fw-bold py-3">
      <span class="text-muted fw-light">Kamus Belusu / </span> Belusu-Indonesia
    </h4>
    <div class="text-muted float-end">
      <a href="{{ route('belusu_index') }}" class="btn"><span class="d-md-inline-block"><i class="bx bx-arrow-back"></i></span></a></span>
    </div>
  </div>

  <!-- Data Table -->
  <div class="card">
    <div class="card-datatable table-responsive">
      <table class="data-table table border-top" style="font-size: 12px;">
        <thead>
          <tr>
            <th width="5px" nowrap></th>
            <th width="5px" nowrap>#</th>
            <th>Kata</th>
            <th width="90%">Terjemahan</th>
            <th width="5px" class="text-center">Aksi</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

  @include('_partials._modals.modal-kamus-bls-ind')
@endsection

@push('addon-style')
  <style>
    .data-table tr th {
      font-size: 10px;
      padding-right: 5px;
      padding-left: 15px;
    }

    .data-table tr td {
      padding-right: 5px;
      padding-left: 15px;
    }
  </style>
@endpush

@push('addon-script')
  <script>
    // RESET
    function resetForm() {
      $("#addForm")[0].reset();
    }

    function simpanForm() {
      $('#btn_submit').addClass('btn-primary');
      $('#btn_submit').removeClass('btn-warning');
      $('#btn_submit').text('Simpan');
      // $('#addForm').attr('action', "{{ route('bls_ind_store') }}");
    }

    function editForm() {
      $('#btn_submit').removeClass('btn-primary');
      $('#btn_submit').addClass('btn-warning');
      $('#btn_submit').text('Ubah');
      // $('#addForm').attr('action', "{{ route('bls_ind_update') }}");
      // $('#image').attr('required', false);
    }

    $(document).on('click', '.btn_tambah', function(e) {
      e.preventDefault();
      resetForm();
      simpanForm();
      $('#modalAddData').modal('show');
    });

    $(document).on('click', '#btn_cek', function(e) {
      var word = $('#word').val();
      if (word) {
        $.ajax({
          type: 'GET',
          url: "/dashboard/kamus/cek_word/" + {{ $bhs_id }} + '/' + word,
          success: function(data, status) {
            console.log(data.data);
            // if (data.status == 0) {

            // } else if (data.status == 1) {

            // } else if (data.status == 2) {

            // }
          },
          error: function() {
            console.log("Error");
          }
        });
      }
    });

    // EDIT
    $(document).on('click', '.btn_edit', function(e) {
      let token = $(this).attr('data-token');
      // console.log(token);
      if (token) {
        $.ajax({
          type: 'GET',
          url: "/dashboard/kamus/bls_ind_edit/" + token,
          dataType: 'json',
          beforeSend: function() {
            $('#loading_spinner').show();
          },
          complete: function() {
            $('#loading_spinner').hide();
          },
          success: function(response, textStatus, xhr) {
            editForm();
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

    // $("#addForm").submit(function(e) {
    //   e.preventDefault();
    //   const fd = new FormData(this);
    //   $.ajax({
    //     url: "{{ route('album_store') }}",
    //     method: 'POST',
    //     data: fd,
    //     cache: false,
    //     contentType: false,
    //     processData: false,
    //     dataType: 'json',
    //     beforeSend: function() {
    //       $('#loading_spinner').show();
    //       $('#modalAddData').modal('hide');
    //     },
    //     complete: function() {
    //       $('#loading_spinner').hide();
    //     },
    //     success: function(response) {
    //       console.log(response);
    //       if (response.status == 200) {
    //         Swal.fire({
    //           position: 'center',
    //           icon: 'success',
    //           title: 'Data berhasil disimpan',
    //           showConfirmButton: false,
    //           timer: 1000
    //         });
    //         $('.data-table').DataTable().ajax.reload();
    //         resetForm();
    //       }
    //     },
    //     error: function() {
    //       Swal.fire({
    //         position: 'center',
    //         icon: 'error',
    //         title: 'Terjadi Kesalahan',
    //         showConfirmButton: true,
    //       });
    //     }
    //   });
    // });

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
            url: "{{ route('bls_ind_delete') }}",
            method: 'delete',
            data: {
              id: token,
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
      let borderColor, bodyBg, headingColor;

      if (isDarkStyle) {
        borderColor = config.colors_dark.borderColor;
        bodyBg = config.colors_dark.bodyBg;
        headingColor = config.colors_dark.headingColor;
      } else {
        borderColor = config.colors.borderColor;
        bodyBg = config.colors.bodyBg;
        headingColor = config.colors.headingColor;
      }

      // Invoice datatable
      if (data_table.length) {
        var dt_invoice = data_table.DataTable({
          ajax: "{!! route('bls_ind_list') !!}", // JSON file to add data
          columns: [
            // columns according to JSON
            {
              data: ''
            },
            {
              data: ''
            },
            {
              data: 'word'
            },
            {
              data: 'translate'
            },
            {
              data: ''
            },
          ],
          columnDefs: [
            // Columns  
            {
              className: 'control',
              orderable: false,
              targets: 0,
              render: function(data, type, full, meta) {
                return '';
              }
            },
            {
              targets: 1,
              orderable: true,
              responsivePriority: 3,
              render: function(data, type, full, meta) {
                row_number = meta.row + 1;
                return '<div>' + row_number + '</div>';
              }
            },
            {
              targets: 2,
              orderable: false,
              responsivePriority: 1,
              render: function(data, type, full, meta) {
                return '<span class="d-flex flex-column">' + data + '</span>';
              }
            },
            {
              targets: 3,
              orderable: false,
              responsivePriority: 2,
              render: function(data, type, full, meta) {
                return '<span class="d-flex flex-column">' + data + '</span>';
              }
            },
            {
              // Actions
              targets: -1,
              title: 'Aksi',
              searchable: false,
              orderable: false,
              responsivePriority: 4,
              render: function(data, type, full, meta) {
                var $token = full['id'];
                var $name = full['word'];

                var btn_aksi = '<a href="javascript:;" data-bs-toggle="tooltip" class="text-body btn_edit" data-token="' +
                  $token + '" data-bs-placement="top" title="Edit"><i class="bx bx-edit mx-1 text-warning"></i></a>' +
                  '<a href="javascript:;" data-bs-toggle="tooltip" class="text-body delete-record" data-token="' +
                  $token + '" data-name="' + $name +
                  '" data-bs-placement="top" title="Hapus"><i class="bx bx-trash mx-1 text-danger"></i></a>';

                return (
                  '<div class="d-flex align-items-center px-1">' +
                  btn_aksi +
                  '</div>'
                );
              }
            }
          ],
          // dom: '<"row ms-2 me-3"' +
          //   '<"col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-start gap-2"l<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start mt-md-0 mt-3"B>>' +
          //   '<"col-12 col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row pe-3 gap-md-2"f<"invoice_status mb-3 mb-md-0">>' +
          //   '>t' +
          //   '<"row mx-2"' +
          //   '<"col-sm-12 col-md-6"i>' +
          //   '<"col-sm-12 col-md-6"p>' +
          //   '>',
          dom: '<"row mx-2"' +
            '<"col-md-2"<"me-3"l>>' +
            '<"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"fB>>' +
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
              extend: 'collection',
              className: 'btn btn-label-secondary dropdown-toggle mx-3',
              text: '<i class="bx bx-upload me-2"></i>Export',
              buttons: [{
                  extend: 'print',
                  text: '<i class="bx bx-printer me-2" ></i>Print',
                  className: 'dropdown-item',
                  exportOptions: {
                    columns: [1, 2, 3],
                    // prevent avatar to be print
                    format: {
                      body: function(inner, coldex, rowdex) {
                        if (inner.length <= 0) return inner;
                        var el = $.parseHTML(inner);
                        var result = '';
                        $.each(el, function(index, item) {
                          if (item.classList !== undefined && item.classList.contains('user-name')) {
                            result = result + item.lastChild.firstChild.textContent;
                          } else if (item.innerText === undefined) {
                            result = result + item.textContent;
                          } else result = result + item.innerText;
                        });
                        return result;
                      }
                    }
                  },
                  customize: function(win) {
                    //customize print view for dark
                    $(win.document.body)
                      .css('color', headingColor)
                      .css('border-color', borderColor)
                      .css('background-color', bodyBg);
                    $(win.document.body)
                      .find('table')
                      .addClass('compact')
                      .css('color', 'inherit')
                      .css('border-color', 'inherit')
                      .css('background-color', 'inherit');
                  }
                },
                {
                  extend: 'csv',
                  text: '<i class="bx bx-file me-2" ></i>Csv',
                  className: 'dropdown-item',
                  exportOptions: {
                    columns: [1, 2, 3],
                    // prevent avatar to be display
                    format: {
                      body: function(inner, coldex, rowdex) {
                        if (inner.length <= 0) return inner;
                        var el = $.parseHTML(inner);
                        var result = '';
                        $.each(el, function(index, item) {
                          if (item.classList !== undefined && item.classList.contains('user-name')) {
                            result = result + item.lastChild.firstChild.textContent;
                          } else if (item.innerText === undefined) {
                            result = result + item.textContent;
                          } else result = result + item.innerText;
                        });
                        return result;
                      }
                    }
                  }
                },
                {
                  extend: 'excel',
                  text: 'Excel',
                  className: 'dropdown-item',
                  exportOptions: {
                    columns: [1, 2, 3],
                    // prevent avatar to be display
                    format: {
                      body: function(inner, coldex, rowdex) {
                        if (inner.length <= 0) return inner;
                        var el = $.parseHTML(inner);
                        var result = '';
                        $.each(el, function(index, item) {
                          if (item.classList !== undefined && item.classList.contains('user-name')) {
                            result = result + item.lastChild.firstChild.textContent;
                          } else if (item.innerText === undefined) {
                            result = result + item.textContent;
                          } else result = result + item.innerText;
                        });
                        return result;
                      }
                    }
                  }
                },
                {
                  extend: 'pdf',
                  text: '<i class="bx bxs-file-pdf me-2"></i>Pdf',
                  className: 'dropdown-item',
                  exportOptions: {
                    columns: [1, 2, 3],
                    // prevent avatar to be display
                    format: {
                      body: function(inner, coldex, rowdex) {
                        if (inner.length <= 0) return inner;
                        var el = $.parseHTML(inner);
                        var result = '';
                        $.each(el, function(index, item) {
                          if (item.classList !== undefined && item.classList.contains('user-name')) {
                            result = result + item.lastChild.firstChild.textContent;
                          } else if (item.innerText === undefined) {
                            result = result + item.textContent;
                          } else result = result + item.innerText;
                        });
                        return result;
                      }
                    }
                  }
                },
                {
                  extend: 'copy',
                  text: '<i class="bx bx-copy me-2" ></i>Copy',
                  className: 'dropdown-item',
                  exportOptions: {
                    columns: [1, 2, 3],
                    // prevent avatar to be display
                    format: {
                      body: function(inner, coldex, rowdex) {
                        if (inner.length <= 0) return inner;
                        var el = $.parseHTML(inner);
                        var result = '';
                        $.each(el, function(index, item) {
                          if (item.classList !== undefined && item.classList.contains('user-name')) {
                            result = result + item.lastChild.firstChild.textContent;
                          } else if (item.innerText === undefined) {
                            result = result + item.textContent;
                          } else result = result + item.innerText;
                        });
                        return result;
                      }
                    }
                  }
                }
              ]
            },
            {
              text: '<i class="bx bx-plus me-md-2"></i><span class="d-md-inline-block d-none">Tambah</span>',
              className: 'add-new btn btn-primary btn_tambah',
            }
          ],
          // For responsive popup
          responsive: {
            details: {
              display: $.fn.dataTable.Responsive.display.modal({
                header: function(row) {
                  var data = row.data();
                  return 'Detail - ' + data['word'];
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

  <script>
    $(function() {
      // ------------------------------Autosize--------------------------------------
      const textarea_translate = document.querySelector('#translate');
      if (textarea_translate) {
        autosize(textarea_translate);
      }
    });
  </script>
@endpush
