@if ($item->galleries->count())
  <div class="row mb-3 g-2">
    @foreach ($item->galleries as $gal)
      <div class="col-md-6 col-sm-4 mb-2 text-center">
        <div class="form-check custom-option custom-option-image custom-option-image-check berkas-klik">
          <input class="form-check-input berkas_pilih" type="checkbox" value="{{ $gal->id }}" id="check_berkas{{ $gal->id }}" name="berkas_pilih" onclick="onlyOne(this)" />
          <label class="form-check-label custom-option-content" for="check_berkas{{ $gal->id }}">
            <span class="custom-option-body">
              <img src="{{ Storage::url('berita/images/thumb_') . $gal->gal_image }}" alt="cbImg" style="object-fit: cover; height: 100px;" />
            </span>
          </label>
        </div>
        <small>
          <div class="fw-semibold d-none" id="val_copy_{{ $gal->id }}">{{ url('/storage/berita/images/') . '/' . $gal->gal_image }}</div>
          <a href="javascript:void(0);" class="text-primary btn_copy" data-copy="val_copy_{{ $gal->id }}"><i class='bx bx-copy berkas-klik fs-6'></i></a>
          <a href="javascript:void(0);" class="text-danger btn_hapus_upload" data-id="{{ $gal->gal_token }}"><i class='bx bx-trash berkas-klik fs-6'></i></a>
          {{-- {{ $gal->gal_title }} --}}
        </small>

      </div>
    @endforeach

  </div>
@else
  <div class="row text-center pb-3">
    <small class="text-muted">Belum ada Gambar, Silahkan Upload..</small>
  </div>
@endif
