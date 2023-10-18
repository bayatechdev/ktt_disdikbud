@extends('layouts.public')

@section('title', 'Galeri Foto')

@section('content')
  <section id="gallery">
    <div class="st-content">
      <div class="container">
        <div class="st-height-b120 st-height-lg-b80"></div>
        <div class="container">
          <div class="st-section-heading st-style1">
            <h2 class="st-section-heading-title">Galeri Foto</h2>
            <div class="st-seperator">
              <div class="st-seperator-left wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s"></div>
              <div class="st-seperator-center"><img src="{{ url('frontend/assets/img/icons/4') }}.png" alt="icon"></div>
              <div class="st-seperator-right wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s"></div>
            </div>
            <div class="st-section-heading-subtitle">
              Lihat Galeri Kami
            </div>
          </div>
          <div class="st-height-b40 st-height-lg-b40"></div>
        </div>
        <div class="container">
          <div class="st-portfolio-wrapper">
            <div class="st-isotop-filter st-style1 text-center">
              <ul class="st-mp0">
                <li class="active"><a href="#" data-filter="*">All</a></li>
                @foreach ($albums as $album)
                  <li><a href="#" data-filter=".album_{{ $album->id }}">{{ $album->title }}</a></li>
                @endforeach
              </ul>
            </div>
            <div class="st-isotop st-style1 st-port-col-3 st-has-gutter st-lightgallery">
              <div class="st-grid-sizer"></div>
              @foreach ($items as $item)
                <div class="st-isotop-item album_{{ $item->albums_id }}">
                  <a href="{{ Storage::url('fotos/images/' . $item->image) }}" class="st-project st-zoom st-lightbox-item st-link-hover-wrap">
                    <div class="st-project-img st-zoom-in"><img src="{{ Storage::url('fotos/images/' . $item->image) }}" alt="Gambar"></div>
                    <span class="st-link-hover"><i class="fas fa-arrows-alt"></i></span>
                  </a>
                </div>
              @endforeach
            </div><!-- .isotop -->
          </div>
        </div>
        <div class="st-height-b120 st-height-lg-b80"></div>
      </div>
    </div>
  </section>
@endsection

@push('addon-style')
@endpush

@push('addon-script')
@endpush
