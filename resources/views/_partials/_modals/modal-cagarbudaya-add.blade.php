<!-- Modal -->
<div class="modal fade" id="modalAddData" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable  mx-auto" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAddDataTitle">Tambah Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {{-- <div class="text-center mb-2">
          <h4 class="mb-2">Tambah Data</h4>
          <p>Silahkan Input Cagar Budaya</p>
        </div> --}}
        <form class="add-new pt-0" id="addForm" action="{{ route('cagarbudaya_store') }}" method="POST" role="form" enctype="multipart/form-data">
          @csrf
          <input type="hidden" hidden id="id" name="id" class="form-control" autocomplete="off" placeholder="id" />
          <div class="row mt-2 px-1">
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="nama_objek">Nama Objek<sup class="text-danger">*</sup></label>
              <div class="col-sm-8">
                <input type="text" id="nama_objek" name="nama_objek" class="form-control" autocomplete="off" placeholder="Nama Cagar Budaya" required />
              </div>
            </div>
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="nama_tempat">Nama Tempat</label>
              <div class="col-sm-8">
                <input type="text" id="nama_tempat" name="nama_tempat" class="form-control" autocomplete="off" placeholder="Lokasi Cagar Budaya" />
              </div>
            </div>
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="alamat">Alamat</label>
              <div class="col-sm-8">
                {{-- <input type="text" id="alamat" name="alamat" class="form-control" autocomplete="off" placeholder="Alamat" /> --}}
                <textarea id="alamat" name="alamat" class="form-control" rows="2" placeholder="Alamat" autocomplete="off"></textarea>
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
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="koordinat_lat">Latitude</label>
              <div class="col-sm-8">
                <input type="text" id="koordinat_lat" name="koordinat_lat" class="form-control" autocomplete="off" placeholder="Contoh: 3.34563213453" />
              </div>
            </div>
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="koordinat_long">Longitude</label>
              <div class="col-sm-8">
                <input type="text" id="koordinat_long" name="koordinat_long" class="form-control" autocomplete="off" placeholder="Contoh: 117.1231224432" />
              </div>
            </div>
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="riwayat_kepemilikan">Riwayat Kepemilikan</label>
              <div class="col-sm-8">
                <textarea id="riwayat_kepemilikan" name="riwayat_kepemilikan" class="form-control" rows="3" placeholder="Riwayat Kepemilikan" autocomplete="off"></textarea>
              </div>
            </div>
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="deskripsi">Deskripsi</label>
              <div class="col-sm-8">
                <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3" placeholder="Deskripsi" autocomplete="off"></textarea>
              </div>
            </div>
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="latar_sejarah">Latar Sejarah</label>
              <div class="col-sm-8">
                <textarea id="latar_sejarah" name="latar_sejarah" class="form-control" rows="3" placeholder="Latar Sejarah" autocomplete="off"></textarea>
              </div>
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
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
