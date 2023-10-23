@extends('layouts.public')

@section('title', 'Semua Berita')

@section('content')
  <section id="blog">
    <div class="st-content">
      <div class="st-height-b100 st-height-lg-b80"></div>
      <div class="container">
        <div class="st-section-heading st-style1">
          <h2 class="st-section-heading-title">Daftar Berita</h2>
          <div class="st-seperator">
            <div class="st-seperator-left wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s"></div>
            <div class="st-seperator-center"><img src="{{ url('assets/img/logo.png') }}" alt="icon"></div>
            <div class="st-seperator-right wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s"></div>
          </div>
          <div class="st-section-heading-subtitle">
            {{ $subtitle }}
          </div>
        </div>
        <div class="st-height-b40 st-height-lg-b40"></div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="st-height-b0 st-height-lg-b40"></div>
            <div class="row">
              @foreach ($items as $item)
                <div class="col-lg-6">
                  <div class="st-post st-style3 st-type1 st-color2">
                    <a href="{{ route('berita_detail', $item->slug) }}" class="st-post-thumb">
                      <img class="st-zoom-in" src="{{ Storage::url('berita/images/' . $item->image) }}" style="height: 250px; max-height: 250px; object-fit: cover;" alt="blog1">
                    </a>
                    <div class="st-post-info">
                      <h2 class="st-post-title"><a href="{{ route('berita_detail', $item->slug) }}">{{ Str::limit($item->title, 50, '...') }}</a></h2>
                      <div class="st-post-meta">
                        <span>
                          <a href="#" class="st-post-avatar">
                            <span class="st-post-avatar-text">{{ $item->user->name }}</span>
                          </a>
                        </span>
                        <span class="st-post-date">{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                      </div>
                      <div class="st-post-text">{!! Str::substr(strip_tags($item->content), 0, 160) !!}..</div>
                    </div>
                    <div class="st-post-footer">
                      <a href="{{ route('berita_detail', $item->slug) }}" class="st-btn st-style2 st-color3 st-size-medium">Read More</a>
                    </div>
                  </div>
                  <div class="st-height-b30 st-height-lg-b30"></div>
                </div>
              @endforeach

              <div class="col-lg-12">
                <ul class="pagination st-post-pagination st-color1">
                  <li class="page-item disabled"><a class="page-link" href="#">Prev</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item active"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
              </div>

              {{-- <div class="col-lg-12">
              <div class="col-2">
                {{ $items->links() }}
              </div>
            </div> --}}

            </div>
          </div>
          <div class="col-lg-4">
            {{-- Include SideBar --}}
            @include('includes.sidebar')
          </div>
        </div>
      </div>
      <div class="st-height-b100 st-height-lg-b80"></div>
    </div>
  </section>
@endsection

@push('addon-style')
@endpush

@push('addon-script')
@endpush
