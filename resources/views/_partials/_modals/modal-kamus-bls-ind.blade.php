<!-- Modal -->
<div class="modal fade" id="modalAddData" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable  mx-auto" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAddDataTitle">Tambah Kamus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="add-new pt-0" id="addForm" action="" method="POST" role="form" enctype="multipart/form-data">
          @csrf
          <div class="row mt-2 px-1">
            <div class="row mb-2 g-1">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="word">Kata <small class="text-lowercase" style="font-size: 10px">(<i>Belusu</i>)</small><sup class="text-danger">*</sup></label>
              <div class="col-sm-8">
                <input type="text" id="word" name="word" class="form-control" autocomplete="off" placeholder="Kata" required />
              </div>
            </div>
            <div class="row mb-2 g-1 text-nowrap">
              <label class="col-sm-4 col-form-label text-md-end pd_r_10" for="translate">Terjemah <small class="text-lowercase" style="font-size: 10px">(<i>Indonesia</i>)</small><sup class="text-danger">*</sup></label>
              <div class="col-sm-8">
                {{-- <input type="text" id="translate" name="translate" class="form-control" autocomplete="off" placeholder="Terjemahan Kata" required /> --}}
                <textarea id="translate" name="translate" class="form-control" rows="1" placeholder="Terjemahan Kata" autocomplete="off" required></textarea>
              </div>
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-label-warning" id="btn_cek">Cek</button>
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
