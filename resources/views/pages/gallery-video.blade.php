@extends('layouts.public')

@section('title', 'Galeri Video')

@section('content')
  <section id="gallery">
    <div class="st-content">
      <div class="container">
        <div class="st-height-b120 st-height-lg-b80"></div>
        <div class="container">
          <div class="st-section-heading st-style1">
            <h2 class="st-section-heading-title">Galeri Video</h2>
            <div class="st-seperator">
              <div class="st-seperator-left wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s"></div>
              <div class="st-seperator-center"><img src="{{ url('assets/img/logo.png') }}" alt="icon"></div>
              <div class="st-seperator-right wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s"></div>
            </div>
            <div class="st-section-heading-subtitle">
              Lihat Video Kami
            </div>
          </div>
          <div class="st-height-b40 st-height-lg-b40"></div>
        </div>
        <div class="container">
          <div class="st-portfolio-wrapper">
            <div class="row">
              @foreach ($items as $item)
                <div class="col-sm-12 col-md-4 col-lg-3 pb-4">
                  @php
                    $url = $item->link;
                    $query_str = parse_url($url, PHP_URL_QUERY);
                    parse_str($query_str, $query);
                    $ytID = @$query['v'];
                    $imgurl = "https://img.youtube.com/vi/$ytID/0.jpg";
                  @endphp
                  <div class="inner text-center">
                    <a href="https://www.youtube.com/watch?v={{ $ytID }}" class="glightbox3 pb-2">
                      <img src="{{ url($imgurl) }}" alt="image" />
                    </a>
                    <span style="font-size: 12px;">{{ $item->title }} Lorem ipsum dolor sit.</span>
                  </div>
                </div>
              @endforeach



              <!-- .col -->
            </div>

          </div>
        </div>
        <div class="st-height-b120 st-height-lg-b80"></div>
      </div>
    </div>
  </section>
@endsection

@push('prepend-style')
  {{-- <link rel="stylesheet" href="{{ url('frontend/glightbox/demo/css/style.css') }}" /> --}}
  <link rel="stylesheet" href="{{ url('frontend/glightbox/dist/css/glightbox.css') }}" />
@endpush

@push('prepend-script')
  <script src="{{ url('frontend/glightbox/demo/js/valde.min.js') }}"></script>
  <script src="{{ url('frontend/glightbox/dist/js/glightbox.js') }}"></script>
  <script src="{{ url('frontend/glightbox/demo/js/site.js') }}"></script>
  <script>
    var lightbox = GLightbox();
    lightbox.on('open', (target) => {
      console.log('lightbox opened');
    });
    var lightboxDescription = GLightbox({
      selector: '.glightbox2'
    });
    var lightboxVideo = GLightbox({
      selector: '.glightbox3'
    });
    lightboxVideo.on('slide_changed', ({
      prev,
      current
    }) => {
      console.log('Prev slide', prev);
      console.log('Current slide', current);

      const {
        slideIndex,
        slideNode,
        slideConfig,
        player
      } = current;

      if (player) {
        if (!player.ready) {
          // If player is not ready
          player.on('ready', (event) => {
            // Do something when video is ready
          });
        }

        player.on('play', (event) => {
          console.log('Started play');
        });

        player.on('volumechange', (event) => {
          console.log('Volume change');
        });

        player.on('ended', (event) => {
          console.log('Video ended');
        });
      }
    });
  </script>
@endpush
