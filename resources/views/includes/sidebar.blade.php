<div class="st-height-b0 st-height-lg-b40"></div>
<div class="st-widget st-sidebar-widget">
  <h3 class="st-widget-title">Kategori</h3>
  <ul class="st-widget-list">
    @foreach (\Helper::berita_kategori() as $data)
      <li>
        <a href="{{ route('berita_kategori', $data->slug) }}">{{ $data->title }} <b style="font-size: 12px;"> ({{ $data->ttl_berita }})</b></a>
      </li>
    @endforeach
  </ul>
</div>
{{-- <div class="st-height-b30 st-height-lg-b30"></div>
<div class="st-widget st-sidebar-widget">
  <h3 class="st-widget-title">Bidang</h3>
  <ul class="st-widget-list">
    @foreach (\Helper::berita_bidang() as $data)
      <li><a href="#">{{ $data->title }}</a></li>
    @endforeach
  </ul>
</div>
<div class="st-height-b30 st-height-lg-b30"></div>
<div class="st-widget st-sidebar-widget">
  <h3 class="st-widget-title">Arachives</h3>
  <ul class="st-widget-list">
    <li><a href="#">March 2020</a></li>
    <li><a href="#">May 2020</a></li>
    <li><a href="#">June 2020</a></li>
    <li><a href="#">August 2020</a></li>
    <li><a href="#">September 2020</a></li>
    <li><a href="#">October 2020</a></li>
  </ul>
</div> --}}
<div class="st-height-b30 st-height-lg-b30"></div>
<div class="st-widget st-sidebar-widget" style="">
  <h3 class="st-widget-title">Recent Post</h3>
  <ul class="st-post-widget-list st-mp0">
    @foreach (\Helper::berita_recent() as $data)
      <li>
        <div class="st-post st-style1">
          <a href="{{ route('berita_detail', $data->slug) }}" class="st-post-thumb st-zoom text-center"><img src="{{ Storage::url('berita/images/thumb_' . $data->image) }}" alt="Gambar" style="max-height: 70px;"></a>
          <div class="st-post-info">
            <h2 class="st-post-title"><a href="{{ route('berita_detail', $data->slug) }}">{{ $data->title }}</a></h2>
            <div class="st-post-date">{{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</div>
          </div>
        </div>
      </li>
    @endforeach

    {{-- <li>
      <div class="st-post st-style1">
        <a href="#" class="st-post-thumb st-zoom"><img src="{{ url('assets/img/rs-post2.jpg') }}" alt="post2" class="st-zoom-in"></a>
        <div class="st-post-info">
          <h2 class="st-post-title"><a href="blog-details-right-sidebar.html">Overview Malaysia as a medical tourism...</a></h2>
          <div class="st-post-date">Jan 15, 2020</div>
        </div>
      </div>
    </li>
    <li>
      <div class="st-post st-style1">
        <a href="#" class="st-post-thumb st-zoom"><img src="{{ url('assets/img/rs-post3.jpg') }}" alt="post2" class="st-zoom-in"></a>
        <div class="st-post-info">
          <h2 class="st-post-title"><a href="blog-details-right-sidebar.html">World Parkinson’s Day 2020 comes...</a></h2>
          <div class="st-post-date">Jan 05, 2020</div>
        </div>
      </div>
    </li> --}}
  </ul>
</div>
<div class="st-height-b30 st-height-lg-b30"></div>
<div class="st-widget st-sidebar-widget">
  <h3 class="st-widget-title">Tags</h3>
  <div class="st-tagcloud">
    @foreach (\Helper::berita_tags() as $data)
      <a href="{{ route('berita_tag', $data->id) }}" class="st-tag">{{ $data->title }}</a>
    @endforeach
  </div>
</div>
