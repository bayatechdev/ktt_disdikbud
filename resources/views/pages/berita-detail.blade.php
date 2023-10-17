@extends('layouts.public')

@section('title', 'Detail Berita')

@section('content')
  <div class="st-content">
    <div class="st-page-heading st-dynamic-bg" data-src="{{ Storage::url("berita/images/$item->image") }}">
      <div class="container">
        <div class="st-page-heading-in text-center">
          <h1 class="st-page-heading-title">{{ $item->title }}</h1>
          <div class="st-post-label">
            <span>By <a href="#">{{ $item->user->name }}</a></span>
            <span>{{ \Carbon\Carbon::parse($item->tanggal)->settings(['formatFunction' => 'translatedFormat'])->format('l, j F Y') }}</span>
          </div>
        </div>
      </div>
    </div><!-- .st-page-heading -->
    <div class="st-height-b100 st-height-lg-b80"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="st-post-details st-style1 st-color1">
            <img class="st-zoom-in" src="{{ Storage::url("berita/images/$item->image") }}" alt="blog1">
            <h2>{{ $item->title }}</h2>
            <p>{!! $item->content !!}</p>
            <p>Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day, going forward, a new normal that has evolved from generation X is on the runway heading towards a streamlined cloud solution. User generated content in real-time will have multiple
              touchpoints for offshoring.</p>
            <p>Capitalize on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps.</p>
            <h2>Collaboratively administrate empowered.</h2>
            <div class="st-post-info">
              <div class="st-post-text">
                <p>Podcasting operational change management inside of workflows to establish a framework. Taking seamless key performance indicators offline to maximise the long tail. Keeping your eye on the ball while performing a deep dive on the start-up mentality to derive convergence on
                  cross-platform integration.</p>
                <p>Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Dramatically visualize customer directed convergence without revolutionary ROI.</p>
                <p>Podcasting operational change management inside of workflows to establish a framework. Taking seamless key performance indicators offline to maximise the long tail.</p>
                <h2>Blog video post can also added.</h2>
                <!-- For Youtube -->
                <div class="embed-responsive embed-responsive-16by9">
                  <iframe class="embed-responsive-item" width="816" height="459" src="https://www.youtube.com/embed/vGOL7ZvuGMc" allowfullscreen>
                  </iframe>
                </div>
                <!-- For Vimeo -->
                <!-- <div class="embed-responsive embed-responsive-16by9">
                                                      <iframe class="embed-responsive-item" width="816" height="459" src="https://player.vimeo.com/video/172077385?title=0&st-byline=0&portrait=0&color=EE5A3F&autoplay=0&loop=0&wmode=transparent" allowfullscreen></iframe>
                                                  </div> -->
                <p>Completely synergize resource taxing relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas. Dynamically innovate resource-leveling customer service for state of the art customer service.</p>
                <blockquote>Integer accumsan arcu ligula, eget dictum augue egestas sed. Curabitur bibendum, lorem ac dapibus pellentesque, justo lectus bibendum enim.<small>by: <span>Mark Parker</span></small></blockquote>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use passage of Lorem Ipsum.</p>
                <h2>Phosfluorescently engage worldwide?</h2>
                <p>Proactively envisioned multimedia based expertise and cross-media growth strategies. Seamlessly visualize quality intellectual capital without superior collaboration and idea-sharing. Holistically pontificate installed base portals after maintainable products.</p>
                <div class="st-slider st-style1">
                  <div class="slick-container" data-autoplay="0" data-loop="1" data-speed="800" data-autoplay-timeout="1000" data-center="0" data-slides-per-view="1">
                    <div class="slick-wrapper">
                      <div class="slick-slide-in">
                        <div class="st-gallery-img st-style1 st-dynamic-bg st-bg" data-src="assets/img/hero-bg4.jpg"></div>
                      </div>
                      <div class="slick-slide-in">
                        <div class="st-gallery-img st-style1 st-dynamic-bg st-bg" data-src="assets/img/hero-bg3.jpg"></div>
                      </div>
                      <div class="slick-slide-in">
                        <div class="st-gallery-img st-style1 st-dynamic-bg st-bg" data-src="assets/img/hero-bg5.jpg"></div>
                      </div>
                    </div>
                  </div><!-- .slick-container -->
                  <div class="pagination st-style2"></div> <!-- If dont need Pagination then add class .st-hidden -->
                  <div class="swipe-arrow st-style1 st-hidden"> <!-- If dont need navigation then add class .st-hidden -->
                    <div class="slick-arrow-left"><i class="fa fa-angle-left"></i></div>
                    <div class="slick-arrow-right"><i class="fa fa-angle-right"></i></div>
                  </div>
                </div><!-- .st-slider -->
                <div class="st-height-b20 st-height-lg-b20"></div>
                <p>Capitalize on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.</p>
              </div>
              <div class="st-height-b35 st-height-lg-b35"></div>
              <div class="st-post-meta">
                <div class="st-post-tages">
                  <h4 class="st-post-tage-title">Tags:</h4>
                  <ul class="st-post-tage-list st-mp0">
                    <li><a href="#">App</a></li>
                    <li><a href="#">php</a></li>
                    <li><a href="#">web</a></li>
                    <li><a href="#">business</a></li>
                    <li><a href="#">agency</a></li>
                    <li><a href="#">development</a></li>
                  </ul>
                </div>
                <div class="st-post-share">
                  <h4 class="st-post-share-title">Share:</h4>
                  <div class="st-post-share-btn-list">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-behance"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                  </div>
                </div>
              </div>
              <div class="st-height-b60 st-height-lg-b60"></div>
            </div>
            <div class="st-post-btn-gropu">
              <a href="#" class="st-btn st-style2 st-color4 st-size-medium">Previous Post</a>
              <a href="#" class="st-btn st-style2 st-color4 st-size-medium">Next Post</a>
            </div>
          </div>
          <div class="st-height-b60 st-height-lg-b60"></div>
          <div class="comments-area">
            <div class="comment-list-outer">
              <h2 class="comments-title">Comments(3)</h2>
              <ol class="comment-list st-color1">
                <li class="comment">
                  <div class="comment-body">
                    <div class="comment-meta">
                      <div class="comment-author">
                        <img src="assets/img/comment1.jpg" alt="comment1" class="avatar">
                        <a href="#" class="nm">Smith Jhon</a>
                      </div><!-- .comment-author -->
                      <div class="comment-metadata">
                        <a href="#"><span>15 Jan, 2020</span></a>
                      </div><!-- .comment-metadata -->
                    </div><!-- .comment-meta -->
                    <div class="comment-content">
                      <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
                    </div>
                    <div class="reply"><a href="#" class="comment-reply-link">Reply</a></div>
                  </div>
                  <ol class="children">
                    <li class="comment">
                      <div class="comment-body">
                        <div class="comment-meta">
                          <div class="comment-author">
                            <img src="assets/img/comment2.jpg" alt="comment1" class="avatar">
                            <span class="nm"><a href="#">Robat Newman</a></span>
                          </div><!-- .comment-author -->
                          <div class="comment-metadata">
                            <a href="#"><span>15 Jan, 2020</span></a>
                          </div><!-- .comment-metadata -->
                        </div><!-- .comment-meta -->
                        <div class="comment-content">
                          <p>Consectetuer adipiscing elit. Lorem ipsum dolor sit amet, consectetuer.</p>
                        </div>
                        <div class="reply"><a href="#" class="comment-reply-link">Reply</a></div>
                      </div>
                    </li>
                  </ol><!-- .children -->
                </li>
                <li class="comment">
                  <div class="comment-body">
                    <div class="comment-meta">
                      <div class="comment-author">
                        <img src="assets/img/comment1.jpg" alt="comment1" class="avatar">
                        <span class="nm"><a href="#">Hannibal Lecter</a></span>
                      </div><!-- .comment-author -->
                      <div class="comment-metadata">
                        <a href="#"><span>26 Jan, 2016</span></a>
                      </div><!-- .comment-metadata -->
                    </div><!-- .comment-meta -->
                    <div class="comment-content">
                      <p>Lorem ipsum dolor sit amet. Lorem ipsum adipiscing elit.</p>
                    </div>
                    <div class="reply"><a href="#" class="comment-reply-link">Reply</a></div>
                  </div>
                </li>
              </ol><!-- .comment-list -->
            </div><!-- .comment-list-outer -->
            <div class="comment-respond">
              <h2 class="comment-reply-title">Add your comment</h2>
              <form method="post" class="comment-form">
                <p class="comment-form-author">
                  <input name="author" type="text" placeholder="Name*" required="">
                </p>
                <p class="comment-form-email">
                  <input name="email" type="email" placeholder="E-mail*" required="">
                </p>
                <p class="comment-form-url">
                  <input id="url" name="url" type="url" placeholder="Website">
                </p>
                <p class="comment-form-comment">
                  <textarea name="comment" cols="40" rows="5" placeholder="Write here...*" required=""></textarea>
                </p>
                <p class="form-submit">
                  <button type="submit" class="st-btn st-style1 st-color4 st-size-medium">Send Message</button>
                </p>
              </form>
            </div><!-- .comment-respond -->
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
@endsection

@push('addon-style')
@endpush

@push('addon-script')
@endpush
