{{-- <div class="box-footer"> --}}
<div class="row g-2">
  @forelse ($item->layanans->where('layanan_tab_id', $tab) as $data)
    {{-- {{ dd($data) }} --}}
    @php
      $file = \File::size(public_path('storage/layanan/' . $data->file));
      $ukuran = $file / 1000000;
    @endphp
    @if ($data->layanan_tab_id == 1)
      <div class="col-xs-6 col-sm-6 col-md-4">
        <div class="card p-2 h-100 shadow-none border">
          <div class="rounded-2 text-center mb-1">
            <a href="#"><img class="img-fluid" src="{{ Storage::url('layanan/thumb_' . $data->file) }}" alt="404" style="max-height: 100px"></a>
          </div>
          <hr class="my-0">
          <div class="card-body p-0">
            <i class="fa fa-image"></i>
            <span class="h5" style="font-size: 14px">
              {{ $data->title }}
            </span>
            <div class="d-flex justify-content-between align-items-center">
              <small style="font-size: 10px">Size: {{ round($ukuran, 2) }} Mb</small>
              <h6 class="d-flex align-items-center justify-content-center gap-1 mb-0">
                <a href="{{ Storage::url('layanan/' . $data->file) }}" download="{{ $data->title }}" class="btn btn-success btn-xs pull-right ml-1" data-toggle="tooltip" data-placement="left" title="Download"><i class="fa fa-cloud-download"></i></a>
                <a href="javascript:void(0);" class="btn btn-danger btn-xs pull-right btn_remove_file" data-file="{{ $data->token }}" data-name="{{ $data->title }}" data-toggle="tooltip" data-placement="left" title="Hapus"><i class="fa fa-remove"></i></a>
              </h6>
            </div>
          </div>
        </div>
      </div>
    @elseif ($data->layanan_tab_id == 2)
      <div class="col-xs-6 col-sm-6 col-md-4">
        <div class="card p-2 h-100 shadow-none border">
          <div class="d-flex flex-column align-items-center">
            <span><i class="bx bxs-file-pdf text-light bx-lg p-3 mb-0"></i></span>
          </div>
          <hr class="my-0">
          <div class="card-body p-0">
            <i class="fa fa-paperclip"></i>
            <span class="h5" style="font-size: 14px">
              {{ $data->title }}
            </span>
            <div class="d-flex justify-content-between align-items-center">
              <small style="font-size: 10px">Size: {{ round($ukuran, 2) }} Mb</small>
              <h6 class="d-flex align-items-center justify-content-center gap-1 mb-0">
                <a href="{{ Storage::url('layanan/' . $data->file) }}" download="{{ $data->title }}" class="btn btn-success btn-xs pull-right ml-1" data-toggle="tooltip" data-placement="left" title="Download"><i class="fa fa-cloud-download"></i></a>
                <a href="javascript:void(0);" class="btn btn-danger btn-xs pull-right btn_remove_file" data-file="{{ $data->token }}" data-name="{{ $data->title }}" data-toggle="tooltip" data-placement="left" title="Hapus"><i class="fa fa-remove"></i></a>
              </h6>
            </div>
          </div>
        </div>
      </div>

      {{-- <li>
        <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
        <div class="mailbox-attachment-info">
          <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> {{ $data->title }}</a>
          <span class="mailbox-attachment-size">
            {{ round($ukuran, 2) }} Mb
            <a href="{{ Storage::url('layanan/' . $data->file) }}" download="{{ $data->title }}" class="btn btn-default btn-xs pull-right ml-1" data-toggle="tooltip" data-placement="left" title="Download"><i class="fa fa-cloud-download"></i></a>
            <a href="javascript:void(0);" class="btn btn-danger btn-xs pull-right btn_remove_file" data-file="{{ $data->token }}" data-name="{{ $data->title }}" data-toggle="tooltip" data-placement="left" title="Hapus"><i class="fa fa-remove"></i></a>
          </span>
        </div>
      </li> --}}
    @else
      <div class="col-xs-6 col-sm-6 col-md-4">
        <div class="card p-2 h-100 shadow-none border">
          <div class="d-flex flex-column align-items-center">
            <span><i class="bx bxs-file-doc text-light bx-lg p-3 mb-0"></i></span>
          </div>
          <hr class="my-0">
          <div class="card-body p-0">
            <i class="fa fa-paperclip"></i>
            <span class="h5" style="font-size: 14px">
              {{ $data->title }}
            </span>
            <div class="d-flex justify-content-between align-items-center">
              <small style="font-size: 10px">Size: {{ round($ukuran, 2) }} Mb</small>
              <h6 class="d-flex align-items-center justify-content-center gap-1 mb-0">
                <a href="{{ Storage::url('layanan/' . $data->file) }}" download="{{ $data->title }}" class="btn btn-success btn-xs pull-right ml-1" data-toggle="tooltip" data-placement="left" title="Download"><i class="fa fa-cloud-download"></i></a>
                <a href="javascript:void(0);" class="btn btn-danger btn-xs pull-right btn_remove_file" data-file="{{ $data->token }}" data-name="{{ $data->title }}" data-toggle="tooltip" data-placement="left" title="Hapus"><i class="fa fa-remove"></i></a>
              </h6>
            </div>
          </div>
        </div>
      </div>
    @endif

  @empty
    <div class="text-center m-4 p-4">Belum ada file</div>
  @endforelse
  {{-- </div> --}}
</div>
