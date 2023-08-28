<!-- Modal -->
<div class="modal fade" id="modalAddData" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        {{-- <h5 class="modal-title" id="modalAddDataTitle">Modal title</h5> --}}
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="add-new pt-0" id="addForm" action="{{ route('cagarbudaya_store') }}" method="POST" role="form" enctype="multipart/form-data">
          @csrf

          <div class="text-center mb-2">
            <h4 class="mb-2">Tambah Data</h4>
            <p>Silahkan Input Cagar Budaya</p>
          </div>
          <div class="row mt-2 px-4">
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="title">Nama Objek<sup class="text-danger">*</sup></label>
              <div class="col-sm-8">
                <input type="text" id="title" name="title" class="form-control" autocomplete="off" placeholder="Nama Cagar Budaya" required />
              </div>
            </div>
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="title">Nama Tempat<sup class="text-danger">*</sup></label>
              <div class="col-sm-8">
                <input type="text" id="title" name="title" class="form-control" autocomplete="off" placeholder="Nama Tempat" required />
              </div>
            </div>
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="title">Alamat<sup class="text-danger">*</sup></label>
              <div class="col-sm-8">
                <input type="text" id="title" name="title" class="form-control" autocomplete="off" placeholder="Alamat" required />
              </div>
            </div>
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="desa_id">Desa/Kelurahan<sup class="text-danger">*</sup></label>
              <div class="col-sm-8">
                <select id="desa_id" name="desa_id" class="select2_desa form-select" data-allow-clear="true" required>
                  <option value="">-</option>
                  @foreach ($desas as $desa)
                    <option value="{{ $desa->id }}">{{ $desa->kecamatan->title }} - {{ $desa->title }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="title">Latitude<sup class="text-danger">*</sup></label>
              <div class="col-sm-8">
                <input type="text" id="title" name="title" class="form-control" autocomplete="off" placeholder="Latitude" required />
              </div>
            </div>
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="title">Longitude<sup class="text-danger">*</sup></label>
              <div class="col-sm-8">
                <input type="text" id="title" name="title" class="form-control" autocomplete="off" placeholder="Longitude" required />
              </div>
            </div>
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10">Publish</label>
              <div class="col-sm-8 pt-1">
                <div class="form-check form-check-inline">
                  <input type="radio" id="publish1" name="publish" class="form-check-input" value="1" />
                  <label class="form-check-label" for="publish1"> Ya </label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="radio" id="publish0" name="publish" class="form-check-input" value="0" checked required />
                  <label class="form-check-label" for="publish0"> Tidak </label>
                </div>
              </div>
            </div>
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="content">Riwayat Kepemilikan<sup class="text-danger">*</sup></label>
              <div class="col-sm-8">
                <textarea id="content" name="content" class="form-control" rows="3" placeholder="Riwayat Kepemilikan" autocomplete="off" required></textarea>
              </div>
            </div>
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="content">Deskripsi<sup class="text-danger">*</sup></label>
              <div class="col-sm-8">
                <textarea id="content" name="content" class="form-control" rows="3" placeholder="Deskripsi" autocomplete="off" required></textarea>
              </div>
            </div>
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="content">Latar Sejarah<sup class="text-danger">*</sup></label>
              <div class="col-sm-8">
                <textarea id="content" name="content" class="form-control" rows="3" placeholder="Latar Sejarah" autocomplete="off" required></textarea>
              </div>
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
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
