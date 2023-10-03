<!-- Modal -->
<div class="modal fade" id="modalAddData" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-md mx-auto" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAddDataTitle">Tambah Pegawai</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="add-new pt-0" id="addForm" action="" method="POST" role="form" enctype="multipart/form-data">
          @csrf
          <input type="text" hidden id="token" name="token" class="form-control" autocomplete="off" placeholder="token" />
          <div class="row mt-2 px-1">
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="nama">nama<sup class="text-danger">*</sup></label>
              <div class="col-sm-8">
                <input type="text" id="nama" name="nama" class="form-control" autocomplete="off" placeholder="" required />
              </div>
            </div>
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="nip">nip<sup class="text-danger">*</sup></label>
              <div class="col-sm-8">
                <input type="text" id="nip" name="nip" class="form-control" autocomplete="off" placeholder="" required />
              </div>
            </div>
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="agama">Agama<sup class="text-danger">*</sup></label>
              <div class="col-sm-8">
                <select id="agama" name="agama" class="form-select" required>
                  <option value="" selected disabled>-</option>
                  @foreach (config('global.agama') as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            {{-- <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="jkel">jkel<sup class="text-danger">*</sup></label>
              <div class="col-sm-8">
                <select id="jkel" name="jkel" class="form-select" required>
                  <option value="1" selected>Laki-Laki</option>
                  <option value="0">Perempuan</option>
                </select>
              </div>
            </div> --}}
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10">Jenis Kelamin<sup class="text-danger">*</sup></label>
              <div class="col-sm-8 pt-1">
                <div class="form-check form-check-inline">
                  <input type="radio" id="jkel1" name="jkel" class="form-check-input" value="1" checked required />
                  <label class="form-check-label" for="jkel1"> Laki-Laki </label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="radio" id="jkel0" name="jkel" class="form-check-input" value="0" />
                  <label class="form-check-label" for="jkel0"> Perempuan </label>
                </div>
              </div>
            </div>
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="publish">Status Pegawai<sup class="text-danger">*</sup></label>
              <div class="col-sm-8">
                <select id="publish" name="publish" class="form-select" required>
                  <option value="1" selected>Aktif</option>
                  <option value="0">Tidak</option>
                </select>
              </div>
            </div>
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="gambar">Foto Pegawai<sup class="text-danger">*</sup></label>
              <div class="col-sm-8">
                <input type="file" id="gambar" name="gambar" class="form-control" accept=".jpg,.jpeg,.png" />
              </div>
            </div>
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="notelp">No Telp</label>
              <div class="col-sm-8">
                <input type="text" id="notelp" name="notelp" class="form-control" autocomplete="off" />
              </div>
            </div>
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="lahir_tempat">Tempat Lahir</label>
              <div class="col-sm-8">
                <input type="text" id="lahir_tempat" name="lahir_tempat" class="form-control" autocomplete="off" />
              </div>
            </div>
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="lahir_tanggal">Tanggal Lahir</label>
              <div class="col-sm-8">
                <input type="text" id="lahir_tanggal" name="lahir_tanggal" placeholder="DD/MM/YYYY" class="form-control" autocomplete="off" />
              </div>
            </div>
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="bidang_id">Pilih Bidang</label>
              <div class="col-sm-8">
                <select id="bidang_id" name="bidang_id" class="form-select">
                  <option value="" selected>-</option>
                  @foreach ($bidangs as $data)
                    <option value="{{ $data->id }}">{{ $data->title }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="jabatan_id">Pilih Jabatan</label>
              <div class="col-sm-8">
                <select id="jabatan_id" name="jabatan_id" class="form-select">
                  <option value="" selected>-</option>
                  @foreach ($jabatans as $data)
                    <option value="{{ $data->id }}">{{ $data->title }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="golongan_id">Pilih Golongan</label>
              <div class="col-sm-8">
                <select id="golongan_id" name="golongan_id" class="form-select">
                  <option value="" selected>-</option>
                  @foreach ($golongans as $data)
                    <option value="{{ $data->id }}">{{ $data->title }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="eselon_id">Pilih Eselon</label>
              <div class="col-sm-8">
                <select id="eselon_id" name="eselon_id" class="form-select">
                  <option value="" selected>-</option>
                  @foreach ($eselons as $data)
                    <option value="{{ $data->id }}">{{ $data->title }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="alamat">Alamat</label>
              <div class="col-sm-8">
                <textarea id="alamat" name="alamat" class="form-control" rows="2" placeholder="Alamat" autocomplete="off"></textarea>
              </div>
            </div>
            {{-- <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="order">Urutan</label>
              <div class="col-sm-8">
                <input type="number" id="order" name="order" class="form-control" autocomplete="off" placeholder="Urutan" />
              </div>
            </div> --}}
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" id="btn_submit">Simpan</button>
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
