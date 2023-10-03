<!-- Offcanvas to add Data Pegawai -->
<div class="offcanvas offcanvas-top h-100" tabindex="-1" id="offcanvasAdd" aria-labelledby="offcanvasAddLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasAddLabel" class="offcanvas-title">Data Pegawai</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body mx-0 flex-grow-0">
    <form class="add-new pt-0" id="addForm" action="" method="POST" role="form" enctype="multipart/form-data">
      @csrf
      <input type="text" class="form-control" id="token" hidden placeholder="token" name="token" />
      <div class="row">
        <div class="col-sm-6">
          <div class="mb-3">
            <label class="form-label" for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" maxlength="50" required />
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label" for="nip">NIP</label>
                <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP" maxlength="20" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label" for="agama">Agama</label>
                <select id="agama" name="agama" class="form-select" required>
                  <option value="">--Pilih--</option>
                  <option value="Islam">Islam</option>
                  <option value="Kristen">Kristen</option>
                  <option value="Katholik">Katholik</option>
                  <option value="Budha">Budha</option>
                  <option value="Hindu">Hindu</option>
                  <option value="Konghucu">Konghucu</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label" for="jkel">Jenis Kelamin</label><br>
                <div class="form-check form-check-inline mt-2">
                  <input class="form-check-input" type="radio" name="jkel" id="jkel1" value="1" required />
                  <label class="form-check-label mb-2" for="jkel1">Laki-Laki</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="jkel" id="jkel0" value="0" required />
                  <label class="form-check-label mb-2" for="jkel0">Perempuan</label>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label" for="publish">Status Pegawai</label><br>
                <div class="form-check form-check-inline mt-2">
                  <input class="form-check-input" type="radio" name="publish" id="publish1" value="1" required checked />
                  <label class="form-check-label mb-2" for="publish1">Aktif</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="publish" id="publish0" value="0" required />
                  <label class="form-check-label mb-2" for="publish0">Non Aktif</label>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="mb-3">
                <label class="form-label" for="gambar">Foto</label>
                <input type="file" class="form-control" id="gambar" name="gambar" accept=".jpg, .png, .jpeg" />
              </div>
            </div>
            <div class="col-sm-6">
              <div class="mb-3">
                <label class="form-label" for="notelp">No. Hp</label>
                <input type="text" class="form-control" id="notelp" name="notelp" maxlength="30" />
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="row">
            <div class="col-sm-6">
              <div class="mb-3">
                <label class="form-label" for="lahir_tempat">Tempat Lahir</label>
                <input type="text" class="form-control" id="lahir_tempat" name="lahir_tempat" maxlength="50" required />
              </div>
            </div>
            <div class="col-sm-6">
              <div class="mb-3">
                <label class="form-label" for="lahir_tanggal">Tangal Lahir</label>
                <input type="text" id="bs-datepicker-format" name="lahir_tanggal" placeholder="DD/MM/YYYY" class="form-control" required />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label" for="jabatan_id">Jabatan</label>
                <select id="jabatan_id" name="jabatan_id" class="form-select" required>
                  <option value="">--Pilih--</option>
                  @foreach ($jabatans as $data)
                    <option value="{{ $data->id }}">{{ $data->title }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label" for="bidang_id">Bidang</label>
                <select id="bidang_id" name="bidang_id" class="form-select">
                  <option value="">--Pilih--</option>
                  @foreach ($bidangs as $data)
                    <option value="{{ $data->id }}">{{ $data->title }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label" for="golongan_id">Golongan</label>
                <select id="golongan_id" name="golongan_id" class="form-select">
                  <option value="">--Pilih--</option>
                  @foreach ($golongans as $data)
                    <option value="{{ $data->id }}">{{ $data->title }} - {{ $data->description }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label" for="eselon_id">Eselon</label>
                <select id="eselon_id" name="eselon_id" class="form-select">
                  <option value="">--Pilih--</option>
                  @foreach ($eselons as $data)
                    <option value="{{ $data->id }}">{{ $data->title }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="alamat">Alamat</label>
            <textarea class="form-control" name="alamat" id="alamat" role="document" rows="1"></textarea>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit mt-3">Submit</button>
      <button type="reset" class="btn btn-label-secondary mt-3" data-bs-dismiss="offcanvas">Cancel</button>
    </form>
  </div>
</div>
