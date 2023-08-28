@extends('layouts/layoutMaster')

@section('title', 'Cagar Budaya')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
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
  <script src="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/autosize/autosize.js') }}"></script>
@endsection

@section('content')
  <div class="row g-4 mb-4">
    <div class="col-sm-12 col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Cagar Budaya</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $ttl }}</h4>
                {{-- <small class="text-success">(+)</small> --}}
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
            <th>Cagar Budaya</th>
            <th>Gambar</th>
            <th width="10px" nowrap>Aksi</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

  @include('_partials._modals.modal-cagarbudaya-add')
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
    $(document).on('click', '.btn_tambah', function(e) {
      e.preventDefault();
      window.location.href = "{{ route('cagarbudaya_create') }}";
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
          ajax: "{!! route('berita_list') !!}", // JSON file to add data
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
                return meta.row + 1;
              }
            },
            {
              targets: 2,
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
              text: '<i class="bx bx-plus me-md-2"></i><span class="d-md-inline-block d-none">Tambah Data</span>',
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
            },
            {
              text: '<i class="bx bx-plus me-md-2"></i><span class="d-md-inline-block d-none">Modal</span>',
              className: 'add-new btn btn-primary',
              attr: {
                'data-bs-toggle': 'modal',
                'data-bs-target': '#modalAddData',
              }
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
      const textarea = document.querySelector('#content');
      if (textarea) {
        autosize(textarea);
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
      // --------------------------------------------------------------------
    });
  </script>
@endpush
