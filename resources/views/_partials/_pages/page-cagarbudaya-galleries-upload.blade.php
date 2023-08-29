@if ($datas->count())
  <div class="row mb-3 g-2">
    @foreach ($datas as $data)
      <div class="col-md-3 mb-md-0 mb-2 text-center">
        <div class="form-check custom-option custom-option-image custom-option-image-check berkas-klik">
          <input class="form-check-input berkas_pilih" type="checkbox" value="{{ $data->id }}" id="check_berkas{{ $data->id }}" name="berkas_pilih" onclick="onlyOne(this)" />
          <label class="form-check-label custom-option-content" for="check_berkas{{ $data->id }}">
            <span class="custom-option-body">
              <img src="{{ Storage::url('cagar-budaya/images/') . $data->file }}" alt="cbImg" style="object-fit: cover; height: 100px;" />
            </span>
          </label>
        </div>
        <small class="py-0 my-0">
          <a href="{{ Storage::url('cagar-budaya/images/') . $data->file }}" class="text-primary btn_preview_upload glightbox" data-id="{{ $data->id }}"><i class='bx bx-show berkas-klik fs-6 p-0 m-0'></i></a>
          <a href="javascript:;" class="text-danger btn_hapus_upload" data-id="{{ $data->id }}"><i class='bx bx-trash berkas-klik fs-6 p-0 m-0'></i></a>
          {{ $data->title }}
        </small>
        {{-- @if ($data->title)
          <br><small class="m-0 p-0">{{ $data->title }}</small>
        @endif --}}
      </div>
      {{-- <div class="inner">
        <a href="{{ url('/assets/img/image-not-found.png') }}" class="glightbox">
          <img src="{{ url('/assets/img/image-not-found.png') }}" alt="image" />
        </a>
      </div> --}}
    @endforeach

  </div>
  {{-- <script>
    var lightbox = GLightbox();
    lightbox.on('open', (target) => {
      console.log('lightbox opened');
    });
  </script> --}}
@else
  <div class="row text-center pb-3">
    <small class="text-muted">Belum ada gambar, Silahkan Upload..</small>
  </div>
@endif
