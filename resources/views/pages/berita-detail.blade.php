@extends('layouts.public')

@section('title', 'Detail Berita')

@section('content')
  <section id="blog" class="st-maps">
    <div class="st-content">
      <div class="st-page-heading st-dynamic-bg st-size-md" data-src="{{ Storage::url("berita/images/$item->image") }}">
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
              <div class="text-center">

                <img class="st-zoom-in" src="{{ Storage::url("berita/images/$item->image") }}" alt="blog">
              </div>
              {{-- <h2>{{ $item->title }}</h2> --}}
              <p>{!! $item->content !!}</p>

              <div class="st-post-info">
                <div class="st-height-b35 st-height-lg-b35"></div>
                <div class="st-post-meta">
                  <div class="st-post-tages">
                    <h4 class="st-post-tage-title">Tags:</h4>
                    <ul class="st-post-tage-list st-mp0">
                      @if ($item->tags)
                        @php
                          $tags = json_decode($item->tags);
                        @endphp
                        @if ($tags)
                          @foreach (@$tags as $tag)
                            <li><a href="{{ route('berita_tag', $tag) }}">{{ $tags_all->firstWhere('id', $tag)->title ?? '' }}</a></li>
                          @endforeach
                        @endif
                      @endif
                      {{-- <li><a href="#">php</a></li> --}}
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
              {{-- <div class="st-post-btn-gropu">
                <a href="#" class="st-btn st-style2 st-color4 st-size-medium">Previous Post</a>
                <a href="#" class="st-btn st-style2 st-color4 st-size-medium">Next Post</a>
              </div> --}}
            </div>
            <div class="st-height-b60 st-height-lg-b60"></div>
            {{-- <div class="comments-area">
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
            </div>
            <!-- .comment-respond -->
          </div> --}}
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
