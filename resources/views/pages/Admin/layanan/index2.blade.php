@extends('layouts.admin')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="inline">
        Layanan
        <small>Jenis Layanan</small>
      </h1>
      {{-- <div class="pull-right inline">
        <a href="#" class="btn btn-warning">
          <i class="fa fa-plus"></i> Tambah Layanan
        </a>
      </div> --}}
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box py-5">
            <div class="box-body">
              <table id="example1" class="table table-striped">
                <thead>
                  <tr>
                    <th width="25px" class="text-center">No</th>
                    <th>Nama Layanan</th>
                    <th class="text-center">Publish</th>
                    <th width="10px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($items as $item)
                    <tr>
                      <td class="text-center">{{ $loop->iteration }}</td>
                      <td>{{ $item->title }}</td>
                      <td class="text-center">{{ $item->publish ? 'Y' : 'T' }}</td>
                      <td class="text-center" nowrap>
                        <a href="#" class="btn btn-success btn-xs Btn_upload" data-id="{{ $item->id }}">
                          <i class="fa fa-cloud-upload" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Upload Berkas"></i>
                        </a>
                        {{-- <a href="#" class="btn btn-info btn-xs">
                          <i class="fa fa-edit" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Ubah"></i>
                        </a>
                        <button class="btn btn-danger btn-xs">
                          <i class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Hapus"></i>
                        </button> --}}
                      </td>
                    </tr>
                  @empty
                  @endforelse
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal -->
  <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content" style="border-radius: 7px;">
        <div class="modal-header">
          <button type="button" class="close btn-lg" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title text-bold" id="lableModal"></h5>
        </div>
        <form action="{{ route('layanan_store') }}" method="POST" id="input_form" enctype="multipart/form-data">
          @csrf
          <div class="modal-body pt-0" id="myModal">
            {{-- Loading... --}}

            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
              @php
                $jenis_berkas = config('global.jenis_berkas');
              @endphp
              <input type="hidden" hidden id="layananjenis_id" name="layananjenis_id" class="form-control" style="border-radius: 5px;">
              <input type="hidden" hidden id="layanan_tab_id" name="layanan_tab_id" class="form-control" style="border-radius: 5px;">
              <ul class="nav nav-tabs" id="nav_tab">
                @foreach ($jenis_berkas as $key => $value)
                  <li data-id="{{ $key }}" class="{{ $key == 1 ? 'active' : '' }} klik_tab"><a href="#tab_{{ $key }}" data-toggle="tab">{{ $value['title'] }}</a></li>
                @endforeach
              </ul>
              <div class="tab-content">
                @foreach ($jenis_berkas as $key => $value)
                  <div class="tab-pane {{ $key == 1 ? 'active' : '' }}" id="tab_{{ $key }}">

                  </div>
                @endforeach
                {{-- <div class="box-footer">
                  <ul class="mailbox-attachments clearfix">
                    <li>
                      <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                      <div class="mailbox-attachment-info">
                        <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> Sep2014-report.pdf</a>
                        <span class="mailbox-attachment-size">
                          1,245 KB
                          <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                      </div>
                    </li>
                    <li>
                      <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                      <div class="mailbox-attachment-info">
                        <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> App Description.docx</a>
                        <span class="mailbox-attachment-size">
                          1,245 KB
                          <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                      </div>
                    </li>
                    <li>
                      <span class="mailbox-attachment-icon has-img"><img src="../../dist/img/photo1.png" alt="Attachment"></span>
                      <div class="mailbox-attachment-info">
                        <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> photo1.png</a>
                        <span class="mailbox-attachment-size">
                          2.67 MB
                          <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                      </div>
                    </li>
                  </ul>
                </div> --}}
              </div>
            </div>
            <div class="row mt-4 px-4">
              <div class="col-xs-12 col-sm-8 col-md-8">
                <div class="form-group">
                  <small>Nama File <span id="berkas_esktensi"></span></small>
                  <input type="text" name="title" class="form-control" required style="border-radius: 5px;">
                </div>
              </div>
              <div class="col-xs-6 col-sm-4 col-md-2">
                <div class="form-group">
                  <small>File</small>
                  <input type="file" id="file" name="file" class="form-control" required accept="" style="border-radius: 5px;">
                </div>
              </div>
              {{-- <div class="col-xs-6 col-sm-2">
                        <div class="form-group">
                          <small>Urutan</small>
                          <input type="text" name="order" class="form-control" value="" style="border-radius: 5px;">
                        </div>
                      </div> --}}
              <div class="col-xs-6 col-sm-12 col-md-2">
                <div style="opacity: 0;">Aksi</div>
                <div class="row px-4">
                  <div class="col-xs-6 p-1">
                    <button type="submit" class="btn btn-success btn-block">Save</button>

                  </div>
                  <div class="col-xs-6 p-1">
                    <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
                  </div>
                </div>
                {{-- <a href="#" class="btn btn-success btn_berkas_simpan">Simpan</a> --}}
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('addon-style')
  <link rel="stylesheet" href="{{ url('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endpush

@push('addon-script')
  <script src="{{ url('backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ url('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

  <script>
    $(function() {
      $('#example1').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': false,
        'info': true,
        'autoWidth': false,
      })
    })
  </script>

  <script>
    function klik_tab() {
      var tab_active = $('ul#nav_tab').find('li.active').attr('data-id');
      // console.log(tab_active);
      $('#layanan_tab_id').val(tab_active);
      var jns = JSON.parse('{!! $jns !!}');
      // console.log(jns[tab_active].title);
      $('#file').attr('accept', jns[tab_active].extension);
      $('#berkas_esktensi').text('(' + jns[tab_active].extension + ')');
      var id = $('#layananjenis_id').val();
      // console.log(id);
      $.ajax({
        url: "{{ url('dashboard/layanan/layanan_tab') }}/" + id + '/' + tab_active,
        type: 'GET',
        beforeSend: function() {
          $("#tab_" + tab_active).html('<div class="text-center m-4 p-4">Loading...</div>');
        },
        success: function(response) {
          $("#tab_" + tab_active).html(response);
        }
      });

    }

    // SHOW MODAL
    $(document).on('click', '.Btn_upload', function(e) {
      $('#lableModal').text('Unggah Berkas');
      $('#showModal').modal('show');
      let id = $(this).attr('data-id');
      $('#layananjenis_id').val(id);
      klik_tab();
    });

    // KLIK TAB
    $(document).on('click', '.klik_tab', function(e) {
      klik_tab();
    });

    // DELETE SCREENING
    $(document).on('click', '.btn_remove_file', function(e) {
      e.preventDefault();
      let id = $(this).attr('data-file');
      let name = $(this).attr('data-name');
      let csrf = '{{ csrf_token() }}';
      Swal.fire({
        title: 'Yakin ingin menghapus file ' + name + ' ?',
        text: "Data ini tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus!',
        cancelButtonText: 'Batal',
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "{{ route('delete_file') }}",
            method: 'delete',
            data: {
              token: id,
              _token: csrf
            },
            success: function(response) {
              Swal.fire(
                'Terhapus!',
                'Data berhasil dihapus.',
                'success'
              );
              $('#showModal').modal('hide');
            },
            error: function(responseJSON) {
              console.log(responseJSON);
              Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                showConfirmButton: true,
              });
              $('#showModal').modal('hide');
            }
          });
        }
      })
    });
  </script>
@endpush
