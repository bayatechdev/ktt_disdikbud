<!-- Transparent Modal -->
<!-- Modal template -->
{{-- <div class="modal modal-transparent fade" id="modalAddData" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content modal-top">
      <form class="add-new pt-0" id="addFormBerkas" action="{{ route('layanan_store') }}" method="POST" role="form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" hidden id="layananjenis_id" name="layananjenis_id" class="form-control">
        <input type="hidden" hidden id="layanan_tab_id" name="layanan_tab_id" class="form-control">

        <div class="modal-body p-0 m-0">
          <a href="javascript:void(0);" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></a>
          <p class="text-white text-large fw-bold mb-3">Pilih dan Upload Berkas Pelayanan</p>
          <div class="row mt-0 mb-0 px-0 ">
            <div class="nav-align-top mb-4">
              @php
                $jenis_berkas = config('global.jenis_berkas');
              @endphp
              <ul class="nav nav-tabs" id="nav_tab" role="tablist">
                @foreach ($jenis_berkas as $key => $value)
                  <li class="nav-item">
                    <button type="button" data-id="{{ $key }}" class="nav-link {{ $key == 1 ? 'active' : '' }} klik_tab" role="tab" data-bs-toggle="tab" data-bs-target="#tab_{{ $key }}" aria-controls="tab_{{ $key }}" aria-selected="true">{{ $value['title'] }}</button>
                  </li>
                @endforeach
              </ul>
              <div class="tab-content">
                @foreach ($jenis_berkas as $key => $value)
                  <div class="tab-pane fade {{ $key == 1 ? 'show active' : '' }}" id="tab_{{ $key }}" role="tabpanel">
                  </div>
                @endforeach
              </div>
            </div>
          </div>
          <input type="file" class="form-control bg-white border-0" hidden id="file" name="file">
          <span id="berkas_esktensi" class="text-white" style="font-size: 12px"></span>
          <div class="input-group input-group-lg mb-0">
            <button class="btn btn-secondary" type="button" id="btn_pilih">
              <i class="bx bx-file-find bx-sm fs-4 pb-1"></i>
              <small class="text-capitalize">Pilih File</small>
            </button>
            <input type="text" class="form-control bg-white border-0" id="title" name="title" placeholder="Nama File (boleh dikosongkan)" required>
            <button class="btn btn-primary" type="submit" id="subscribe">
              <i class="bx bx-upload bx-sm fs-4 pb-1"></i>
              <small class="text-capitalize">Upload</small>
            </button>
          </div>
          @error('file')
            <small class="text-danger">Pilih File Terlebih dahulu</small>
          @enderror
        </div>
      </form>
    </div>
  </div>
</div> --}}


<div class="modal fade" id="modalAddData" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-md mx-auto" role="document">
    <div class="modal-content">
      <form class="add-new pt-0" id="addFormBerkas" action="{{ route('layanan_store') }}" method="POST" role="form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" hidden id="layananjenis_id" name="layananjenis_id" class="form-control">
        <input type="hidden" hidden id="layanan_tab_id" name="layanan_tab_id" class="form-control">

        <div class="modal-header">
          <h5 class="modal-title" id="modalAddDataTitle">Upload Berkas</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row mt-0 mb-0 px-0">
            <div class="nav-align-top mb-4">
              @php
                $jenis_berkas = config('global.jenis_berkas');
              @endphp
              <ul class="nav nav-tabs" id="nav_tab" role="tablist">
                @foreach ($jenis_berkas as $key => $value)
                  <li class="nav-item">
                    <button type="button" data-id="{{ $key }}" class="nav-link {{ $key == 1 ? 'active' : '' }} klik_tab" role="tab" data-bs-toggle="tab" data-bs-target="#tab_{{ $key }}" aria-controls="tab_{{ $key }}" aria-selected="true">{{ $value['title'] }}</button>
                  </li>
                @endforeach
              </ul>
              <div class="tab-content">
                @foreach ($jenis_berkas as $key => $value)
                  <div class="tab-pane fade {{ $key == 1 ? 'show active' : '' }}" id="tab_{{ $key }}" role="tabpanel">
                  </div>
                @endforeach
              </div>
            </div>
          </div>
          <input type="file" class="form-control bg-white border-0" hidden id="file" name="file">
          <span id="berkas_esktensi" class="text-white" style="font-size: 12px"></span>
          <div class="input-group input-group-lg mb-0">
            <button class="btn btn-secondary" type="button" id="btn_pilih">
              <i class="bx bx-file-find bx-sm fs-4 pb-1"></i>
              <small class="text-capitalize">Pilih File</small>
            </button>
            <input type="text" class="form-control bg-white " id="title" name="title" placeholder="Nama File (boleh dikosongkan)" required>
            <button class="btn btn-primary" type="submit" id="subscribe">
              <i class="bx bx-upload bx-sm fs-4 pb-1"></i>
              <small class="text-capitalize">Upload</small>
            </button>
          </div>
          @error('file')
            <small class="text-danger">Pilih File Terlebih dahulu</small>
          @enderror

        </div>
        <div class="modal-footer">

        </div>
      </form>
    </div>
  </div>
</div>

<style>
  .pd_r_10 {
    padding-right: 10px;
  }
</style>
