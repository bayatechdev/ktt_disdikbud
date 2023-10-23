<!-- Modal -->
<div class="modal fade" id="modalAddData" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable  mx-auto" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAddDataTitle">Tambah Video</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="add-new pt-0" id="addForm" action="" method="POST" role="form" enctype="multipart/form-data">
          @csrf
          <input type="text" hidden id="token" name="token" class="form-control" autocomplete="off" placeholder="token" />
          <div class="row mt-2 px-1">
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="title">Judul Video</label>
              <div class="col-sm-8">
                <input type="text" id="title" name="title" class="form-control" autocomplete="off" placeholder="Judul Video" />
              </div>
            </div>
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="link">Link Video<sup class="text-danger">*</sup></label>
              <div class="col-sm-8">
                <input type="text" id="link" name="link" class="form-control" autocomplete="off" placeholder="Link Video Youtube" required />
              </div>
            </div>
            {{-- <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="image">Pilih Thumbnail<sup class="text-danger">*</sup></label>
              <div class="col-sm-8">
                <input type="file" id="image" name="image" class="form-control" accept=".jpg,.jpeg,.png" required />
              </div>
            </div> --}}
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="order">Urutan</label>
              <div class="col-sm-8">
                <input type="number" id="order" name="order" class="form-control" autocomplete="off" placeholder="Urutan" />
              </div>
            </div>
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="publish">Publish<sup class="text-danger">*</sup></label>
              <div class="col-sm-8">
                <select id="publish" name="publish" class="form-select" required>
                  <option value="1" selected>Ya</option>
                  <option value="0">Tidak</option>
                </select>
              </div>
            </div>
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
