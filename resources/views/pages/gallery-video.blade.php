@extends('layouts.public')

@section('title', 'Galeri Video')

@section('content')
  <section id="gallery">
    <div class="st-content">
      <div class="container">
        <div class="st-height-b120 st-height-lg-b80"></div>
        <div class="container">
          <div class="st-section-heading st-style1">
            <h2 class="st-section-heading-title">Galeri Berita</h2>
            <div class="st-seperator">
              <div class="st-seperator-left wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s"></div>
              <div class="st-seperator-center"><img src="{{ url('frontend/assets/img/icons/4') }}.png" alt="icon"></div>
              <div class="st-seperator-right wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s"></div>
            </div>
            <div class="st-section-heading-subtitle">
              Gambar yang di tampilkan merupakan gambar dari berita yang telah diupload
            </div>
          </div>
          <div class="st-height-b40 st-height-lg-b40"></div>
        </div>
        <div class="container">
          <div class="st-portfolio-wrapper">
            <div class="row">
              @foreach ($items as $item)
                <div class="col-lg-4 col-md-6 col-sm-12">
                  <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" width="816" height="459" src="{{ $item->link }}" allowfullscreen>
                    </iframe>
                  </div>
                </div>
              @endforeach
              <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="embed-responsive embed-responsive-16by9">
                  <iframe class="embed-responsive-item" width="816" height="459" src="https://www.youtube.com/embed/vGOL7ZvuGMc" allowfullscreen>
                  </iframe>
                </div>
              </div>
              {{-- <div class="col-md-3 wow fadeInRight" data-wow-duration="0.8s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 0.8s; animation-delay: 0.2s; animation-name: fadeInRight;">
                <div class="st-video-block st-style1 st-zoom">
                  <div class="st-video-block-img st-zoom-in st-dynamic-bg" data-src="assets/img/video-block-img.jpg" style="background-image: url(&quot;assets/img/video-block-img.jpg&quot;);"></div>
                  <a href="https://www.youtube.com/embed/jRcfE2xxSAw?autoplay=1" class="st-play-btn st-style1 st-video-open">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 336 336" xml:space="preserve">
                      <g>
                        <path
                          d="M286.8,49.2C256.4,18.8,214.4,0,168,0C121.6,0,79.6,18.8,49.2,49.2C18.8,79.6,0,121.6,0,168c0,46.4,18.8,88.4,49.2,118.8
                      C79.6,317.2,121.6,336,168,336c46.4,0,88.4-18.8,118.8-49.2C317.2,256.4,336,214.4,336,168C336,121.6,317.2,79.6,286.8,49.2z
                       M272.4,272.4c-26.8,26.8-63.6,43.2-104.4,43.2s-77.6-16.4-104.4-43.2C37.2,245.6,20.4,208.8,20.4,168S36.8,90.4,63.6,63.6
                      C90.4,36.8,127.2,20.4,168,20.4s77.6,16.4,104.4,43.2c26.8,26.8,43.2,63.6,43.2,104.4S298.8,245.6,272.4,272.4z">
                        </path>
                      </g>
                      <g>
                        <path
                          d="M261.2,156c-0.8-0.8-2-2.4-3.2-4c-0.4-0.4-0.4-0.4-0.8-0.8c-1.2-1.2-2.4-2-4-2.8l-59.2-34c0,0-0.4,0-0.4-0.4L134,79.6
                      c-5.2-3.2-11.2-3.6-16.8-2.4c-5.6,1.6-10.4,5.2-13.6,10.4c-1.2,1.6-1.6,3.6-2.4,5.2c-0.4,1.2-0.4,2.8-0.8,4.4c0,0.4,0,1.2,0,1.6
                      V168v68.8c0,6,2.4,11.6,6.4,15.6s9.6,6.4,15.6,6.4c2,0,4.4-0.4,6.4-1.2s4-1.6,5.6-2.8l58.8-34l0.8-0.4l59.2-34
                      c0.4,0,0.4-0.4,0.8-0.4c4.8-3.2,8.4-8,9.6-13.2C265.2,167.2,264.4,161.2,261.2,156z M244,168.4c0,0.4-0.4,0.8-0.8,0.8h-0.4
                      L184,203.6l-0.4,0.4l-58.8,34c-0.4,0-0.4,0.4-0.8,0.4c0,0-0.4,0-0.4,0.4h-0.4c-0.4,0-0.8-0.4-1.2-0.4c-0.4-0.4-0.4-0.8-0.4-1.2
                      V168V99.2v-0.4v-0.4c0.4-0.4,0.8-0.8,1.2-0.8c0.4,0,0.8,0,1.2,0l59.2,34l0.4,0.4l59.6,34.4l0.4,0.4l0.4,0.4
                      C244,167.6,244,168,244,168.4z">
                        </path>
                      </g>
                    </svg>
                    <span class="st-video-animaiton"><span></span></span>
                  </a>
                </div>
              </div> --}}

              {{-- <div class="col-xl-3 wow fadeInRight" data-wow-duration="0.8s" data-wow-delay="0.2s">
                <div class="st-video-block st-style1 st-zoom">
                  <div class="st-video-block-img st-zoom-in st-dynamic-bg" data-src="assets/img/video-block-img.jpg"></div>
                  <a href="https://www.youtube.com/embed/jRcfE2xxSAw?autoplay=1" class="st-play-btn st-style1 st-video-open">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 336 336" xml:space="preserve">
                      <g>
                        <path
                          d="M286.8,49.2C256.4,18.8,214.4,0,168,0C121.6,0,79.6,18.8,49.2,49.2C18.8,79.6,0,121.6,0,168c0,46.4,18.8,88.4,49.2,118.8
                      C79.6,317.2,121.6,336,168,336c46.4,0,88.4-18.8,118.8-49.2C317.2,256.4,336,214.4,336,168C336,121.6,317.2,79.6,286.8,49.2z
                       M272.4,272.4c-26.8,26.8-63.6,43.2-104.4,43.2s-77.6-16.4-104.4-43.2C37.2,245.6,20.4,208.8,20.4,168S36.8,90.4,63.6,63.6
                      C90.4,36.8,127.2,20.4,168,20.4s77.6,16.4,104.4,43.2c26.8,26.8,43.2,63.6,43.2,104.4S298.8,245.6,272.4,272.4z" />
                      </g>
                      <g>
                        <path
                          d="M261.2,156c-0.8-0.8-2-2.4-3.2-4c-0.4-0.4-0.4-0.4-0.8-0.8c-1.2-1.2-2.4-2-4-2.8l-59.2-34c0,0-0.4,0-0.4-0.4L134,79.6
                      c-5.2-3.2-11.2-3.6-16.8-2.4c-5.6,1.6-10.4,5.2-13.6,10.4c-1.2,1.6-1.6,3.6-2.4,5.2c-0.4,1.2-0.4,2.8-0.8,4.4c0,0.4,0,1.2,0,1.6
                      V168v68.8c0,6,2.4,11.6,6.4,15.6s9.6,6.4,15.6,6.4c2,0,4.4-0.4,6.4-1.2s4-1.6,5.6-2.8l58.8-34l0.8-0.4l59.2-34
                      c0.4,0,0.4-0.4,0.8-0.4c4.8-3.2,8.4-8,9.6-13.2C265.2,167.2,264.4,161.2,261.2,156z M244,168.4c0,0.4-0.4,0.8-0.8,0.8h-0.4
                      L184,203.6l-0.4,0.4l-58.8,34c-0.4,0-0.4,0.4-0.8,0.4c0,0-0.4,0-0.4,0.4h-0.4c-0.4,0-0.8-0.4-1.2-0.4c-0.4-0.4-0.4-0.8-0.4-1.2
                      V168V99.2v-0.4v-0.4c0.4-0.4,0.8-0.8,1.2-0.8c0.4,0,0.8,0,1.2,0l59.2,34l0.4,0.4l59.6,34.4l0.4,0.4l0.4,0.4
                      C244,167.6,244,168,244,168.4z" />
                      </g>
                    </svg>
                    <span class="st-video-animaiton"><span></span></span>
                  </a>
                </div>
              </div><!-- .col --> --}}
            </div>

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
