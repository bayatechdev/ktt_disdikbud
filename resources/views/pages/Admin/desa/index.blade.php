@extends('layouts/layoutMaster')

@section('title', 'Pages')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
  {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}"> --}}
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
  {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" /> --}}
  {{-- <link rel="stylesheet" href="{{ url('frontend/glightbox/dist/css/glightbox.css') }}" /> --}}
@endsection

@section('page-style')
  {{-- <link rel="stylesheet" href="{{ url('frontend/glightbox/dist/css/glightbox.css') }}" /> --}}
@endsection

@section('vendor-script')
  {{-- <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script> --}}
  <script src="{{ asset('assets/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-buttons/datatables-buttons.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js') }}"></script>
  {{-- <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/vendor/libs/autosize/autosize.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script> --}}
  {{-- <script src="{{ url('frontend/glightbox/dist/js/glightbox.js') }}"></script> --}}

  {{-- export --}}
  <script src="{{ asset('assets/vendor/libs/jszip/jszip.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/pdfmake/pdfmake.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-buttons/buttons.html5.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-buttons/buttons.print.js') }}"></script>
  {{-- end export --}}

@endsection

@section('content')
  <div class="row g-4 mb-4">
    <div class="col-sm-12 col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Desa</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $ttl }}</h4>
              </div>
              <small>Total</small>
            </div>
            <span class="badge bg-label-primary rounded p-2">
              <i class="bx bx-map bx-sm"></i>
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
            <th>Desa</th>
            <th>Kecamatan</th>
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
  </style>
@endpush

@push('addon-script')
  {{-- DATATABLE --}}
  <script>
    $(function() {
      // Variable declaration for table
      var data_table = $('.data-table');

      // Invoice datatable
      if (data_table.length) {
        var dt_invoice = data_table.DataTable({
          ajax: "{!! route('desa_list') !!}", // JSON file to add data
          columns: [
            // columns according to JSON
            {
              data: ''
            },
            {
              data: 'title'
            },
            {
              data: 'kecamatan_id'
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
                  '<small class="text-muted">Kode: ' + full['kode'] +
                  '</small>';
              }
            },
            {
              targets: 2,
              render: function(data, type, full, meta) {
                var kecamatan = '';
                if (full['kecamatan']) {
                  kecamatan = full['kecamatan']['title'];
                }
                return '<span class="d-flex flex-column">' + kecamatan + '</span>';
              }
            },
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
            // Buttons with Dropdown
            {
              extend: 'collection',
              className: 'btn btn-label-secondary dropdown-toggle mx-3',
              text: '<i class="bx bx-upload me-2"></i>Export',
              buttons: [{
                  extend: 'print',
                  text: '<i class="bx bx-printer me-2" ></i>Print',
                  className: 'dropdown-item',
                  exportOptions: {
                    columns: [0, 1, 2],
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
                    columns: [0, 1, 2],
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
                    columns: [0, 1, 2],
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
                    columns: [0, 1, 2],
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
                    columns: [0, 1, 2],
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
            }
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
      }, 300);
    });
  </script>
@endpush
