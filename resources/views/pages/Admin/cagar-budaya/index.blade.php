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
            <th>Lokasi</th>
            <th>Koordinat</th>
            <th>Gambar</th>
            <th width="10px" nowrap>Aksi</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

  @include('_partials._modals.modal-cagarbudaya-add')
  @include('_partials._modals.modal-cagarbudaya-galleries')
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
      $("#desa_id").select2("val", "0");
      // $('#latar_sejarah').attr('rows', 3);
    }

    function gal_simpan() {
      $('#btn_pilih').addClass('btn-primary');
      $('#btn_pilih').removeClass('btn-warning');
      $('#btn_pilih').text('Simpan');
      $('#cb_file').attr('required', true);
    }

    function gal_edit() {
      $('#btn_pilih').removeClass('btn-primary');
      $('#btn_pilih').addClass('btn-warning');
      $('#btn_pilih').text('Ubah');
      $('#cb_file').attr('required', false);
    }

    function onlyOne(checkbox) {
      var checkboxes = document.getElementsByName('berkas_pilih');
      checkboxes.forEach((item) => {
        if (item !== checkbox) {
          item.checked = false;
        }
      })
      var checkedValue = $('.berkas_pilih:checked').val();
      // $('#berkas_id').val(checkedValue);
      if (checkedValue) {
        gal_edit();
        $.ajax({
          type: 'GET',
          url: "/dashboard/cagar_budaya/cagarbudaya_gallery_edit/" + checkedValue,
          dataType: 'json',
          success: function(response, textStatus, xhr) {
            // resetForm();
            $.each(response.data, function(key, value) {
              $("#cb_" + key).val(value).change();
            });
          },
          error: function(event, jqXHR, ajaxSettings, thrownError) {
            console.log(event + ' - ' + jqXHR + ' - ' + ajaxSettings + ' - ' + thrownError);
          }
        });
      } else {
        gal_simpan();
        var cgbdy_id = $('#cagar_budaya_id').val();
        $("#berkasForm")[0].reset();
        $('#cagar_budaya_id').val(cgbdy_id);
      }



    }

    // Link page
    // $(document).on('click', '.btn_tambah', function(e) {
    //   e.preventDefault();
    //   window.location.href = "{{ route('cagarbudaya_create') }}";
    // });

    $(document).on('click', '.btn_tambah', function(e) {
      e.preventDefault();
      resetForm();
      $('#modalAddData').modal('show');

    });

    $(document).on('click', '.btn_gallery', function(e) {
      e.preventDefault();
      gal_simpan();
      $("#berkasForm")[0].reset(); // Reset dulu sebelum di tampilkan
      $('#modalAddGallery').modal('show');
      var cb_id = $(this).attr('data-cb_id');
      $('#cagar_budaya_id').val(cb_id);
      // console.log(cb_id);
      $.ajax({
        type: "GET",
        url: "/dashboard/cagar_budaya/cagarbudaya_galleries/" + cb_id,
        datatype: "json",
        success: function(data, response, textStatus, xhr) {
          $("#pageGalleries").html(data);
          $(".cLoading").addClass('d-none');
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

    // EDIT
    $(document).on('click', '.btn_edit', function(e) {
      let token = $(this).attr('data-token');
      // console.log(token);
      if (token) {
        $.ajax({
          type: 'GET',
          url: "/dashboard/cagar_budaya/cagarbudaya_edit/" + token,
          dataType: 'json',
          beforeSend: function() {
            $('#loading_spinner').show();
          },
          complete: function() {
            $('#loading_spinner').hide();
          },
          success: function(response, textStatus, xhr) {
            resetForm();
            $.each(response.data, function(key, value) {
              $("#" + key).val(value).change();

              // console.log('key : ' + key + '\nVal : ' + value);
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
        url: "{{ route('cagarbudaya_store') }}",
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
          ajax: "{!! route('cagarbudaya_list') !!}", // JSON file to add data
          columns: [
            // columns according to JSON
            {
              data: ''
            },
            {
              data: 'nama_objek'
            },
            {
              data: 'nama_tempat'
            },
            {
              data: 'koordinat_lat'
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
                row_number = meta.row + 1;
                return '<div>' + row_number + '</div>';
              }
            },
            {
              targets: 1,
              render: function(data, type, full, meta) {
                return '<span class="d-flex flex-column">' + data + '</span>' +
                  '<small class="text-muted">' +
                  full['deskripsi'] +
                  '</small>';;
              }
            },
            {
              targets: 2,
              render: function(data, type, full, meta) {
                var desa = '-';
                var alamat = '';
                if (full['desa']) {
                  desa = ' Desa: ' + full['desa']['title'];
                }

                if (full['alamat']) {
                  alamat = full['alamat'];
                }
                return '<span class="d-flex flex-column">' + data + '</span>' +
                  '<small class="text-muted">' + alamat + desa + '</small>';
              }
            },
            {
              targets: 3,
              render: function(data, type, full, meta) {
                var lat = '-';
                var long = '-';
                if (data) {
                  lat = data;
                }
                if (full['koordinat_long']) {
                  long = full['koordinat_long'];
                }
                return '<div> ' + lat + '</div><div> ' + long + '</div>';
              }
            },
            {
              targets: 4,
              render: function(data, type, full, meta) {
                // var id = JSON.parse(data);
                var name = '';
                var galleries = full['galleries'];
                var number = 0;

                if (!galleries.length) {
                  return '<a href="#" class="btn_gallery" data-cb_id="' + full['id'] + '"><small><i>Tambah Gambar</i></small></a>';
                }

                galleries.forEach(element => {
                  number++;
                  if (number > 3) {
                    return
                  }
                  if (element.file) {
                    name +=
                      '<div class="avatar avatar-xs"><img src="/storage/cagar-budaya/images/thumb_' +
                      element.file +
                      '" alt="Avatar" class="rounded-circle pull-up" data-bs-toggle="tooltip" data-bs-placement="top" title="' +
                      element.title + '"></div>';
                  } else {
                    name +=
                      '<div class="avatar avatar-xs"><img src="https://ui-avatars.com/api/?name=' +
                      element.title +
                      '" alt="Avatar" class="rounded-circle pull-up" data-bs-toggle="tooltip" data-bs-placement="top" title="' +
                      element.title + '"></div>';
                  }
                });

                if (galleries.length > 3) {
                  // console.log(number);
                  name +=
                    '<div class="avatar avatar-xs"><span class="avatar-initial rounded-circle pull-up bg-secondary" data-bs-toggle="tooltip"data-bs-placement="bottom" title="' +
                    (galleries.length - 3) + ' Lainnya">+' +
                    (galleries.length - 3) + '</span></div>';
                }
                return '<div class="d-flex align-items-center avatar-group btn_gallery" data-cb_id="' + full['id'] + '">' + name + '</div>';


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
                var $token = full['id'];
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
