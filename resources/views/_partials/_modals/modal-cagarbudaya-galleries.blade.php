<!-- Modal -->
<div class="modal fade" id="modalAddGallery" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body px-4 py-0">
        <p class="text-center">Pilih Atau Upload Gambar</p>
        <form class="card-body" id="berkasForm" action="{{ route('cagarbudaya_gallery_store') }}" method="POST" role="form" enctype="multipart/form-data">
          @csrf
          <input type="text" hidden id="cagar_budaya_id" name="cagar_budaya_id" class="form-control" value="" placeholder="cagar_budaya_id" required>
          <input type="text" hidden id="cb_id" name="id" class="form-control" value="" placeholder="">

          <div id="pageGalleries">
            {{-- Page-Pelayanan-Berkas --}}
          </div>

          <div class="row text-center pb-3 cLoading">
            <small class="text-muted">Loading...</small>
          </div>

          <div class="row g-2 mt-4">
            <div class="col-sm-6">
              <input type="text" id="cb_title" name="title" class="form-control" placeholder="Judul Gambar" required>
            </div>
            <div class="col-sm-3">
              <input type="number" id="cb_order" name="order" max="10" class="form-control" placeholder="Urutan Tampil" required>
            </div>
            <div class="col-sm-3">
              <input type="file" id="cb_file" name="file" class="form-control" accept=".png,.jpg,.jpeg" required>
            </div>
            <div class="col-sm-12">
              <textarea id="cb_deskripsi" name="deskripsi" class="form-control" rows="2" placeholder="Deskripsi" autocomplete="off"></textarea>
            </div>
          </div>
      </div>
      <div class="modal-footer px-4 py-2">
        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" id="btn_pilih">Upload</button>
      </div>
      </form>
    </div>
  </div>
</div>
