@extends('layouts.kamus')

@section('title', 'Kamus Bahasa Daerah - Dinas Pendidikan dan Kebudayaan - Kabupaten Tana Tidung')

@section('content')
  <div class="st-content">
    <!-- Section Kamus -->
    <section id="kamusdaerah">
      <div class="st-height-b80 st-height-lg-b40"></div>
      <div class="py-5" style="background-color: #eee">
        <div class="container mt-5">
          <div class="st-section-heading st-style1">
            <h2 class="st-section-heading-title">Kamus Bahasa Daerah</h2>
            <div class="st-seperator">
              <div class="st-seperator-left wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s"></div>
              <div class="st-seperator-center"><img src="{{ url('assets/img/logo.png') }}" alt="icon">
              </div>
              <div class="st-seperator-right wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s"></div>
            </div>
            <div class="st-section-heading-subtitle">Kamus Elektronik Bahasa Daerah Tidung dan Belusu</div>
          </div>
          <div class="st-height-b40 st-height-lg-b40"></div>

          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <form method="POST" id="form_translate" action="{{ route('translate') }}">
                @csrf
                <div id="st-alert1"></div>
                <div class="row">
                  <div class="col">
                    <div class="row">
                      <div class="col-6">
                        <div class="st-form-field st-style1">
                          <div class="st-custom-select-wrap">
                            <select name="slang" id="slang" class="st_select1"
                              data-placeholder="- Pilih Bahasa -">
                              <option></option>
                              <option value="IND" selected>Indonesia</option>
                              <option value="TDG">Tidung</option>
                              <option value="BLS">Belusu</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="st-form-field st-style1">
                          <div class="st-custom-select-wrap">
                            <select name="dlang" class="st_select1" id="dlang"
                              data-placeholder="- Pilih Bahasa -">
                              <option></option>
                              <option value="IND">Indonesia</option>
                              <option value="TDG">Tidung</option>
                              <option value="BLS" selected>Belusu</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="st-form-field st-style1">
                          <input type="text" id="word" name="word" placeholder="Masukkan teks">
                        </div>
                      </div>
                      <div class="col-lg-12 text-center">
                        <button class="st-btn st-style1 st-color1 st-size-medium" type="submit" id=""
                          name="submit">&nbsp;&nbsp;&nbsp;Translate <span class="loading"><span id="dots"></span></span></button>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12 mt-4">
                        <div class="translate-box st-form-field st-style1 translate_box">
                          {{-- <textarea cols="30" rows="8" id="translate" name="translate" placeholder="Terjemahan" readonly></textarea> --}}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Section Kamus -->
@endsection

@push('addon-style')
  <link rel="stylesheet" href="{{ url('assets/library/leaflet.fullscreen-master/Control.FullScreen.css') }}" />
  <link rel="stylesheet" href="{{ url('assets/css/custom.css?2') }}" />
@endpush
