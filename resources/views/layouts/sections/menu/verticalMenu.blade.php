@php
  $configData = Helper::appClasses();
@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

  <!-- ! Hide app brand if navbar-full -->
  @if (!isset($navbarFull))
    <div class="app-brand demo">
      <a href="{{ url('/') }}" class="app-brand-link">
        <span class="app-brand-logo demo">
          {{-- @include('_partials.macros', ['width' => 25, 'withbg' => '#696cff']) --}}
          <!-- Favicon -->
          {{-- <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/ktt-logo.png') }}" /> --}}
          <img src="{{ asset('assets/img/ktt-logo.png') }}" alt="" width="25px">
        </span>
        <span class="app-brand-text demo menu-text fw-bold ms-2 text-capitalize">{{ config('variables.appName') }}</span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>
  @endif

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <li class="menu-item {{ Request::segment(1) == null ? 'active' : '' }}">
      <a href="/dashboard" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div>Dashboard</div>
      </a>
    </li>
    <li class="menu-item {{ Request::segment(2) == 'berita' ? 'active' : '' }}">
      <a href="{{ route('berita_index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-news"></i>
        <div>Berita</div>
      </a>
    </li>
    <li class="menu-item {{ Request::segment(2) == 'cagar_budaya' ? 'active' : '' }}">
      <a href="{{ route('cagarbudaya_index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-map"></i>
        <div>Cagar Budaya</div>
      </a>
    </li>
    {{-- <li class="menu-item {{ Request::segment(2) == 'asdf' ? 'active' : '' }}">
      <a href="#" class="menu-link">
        <i class="menu-icon tf-icons bx bx-message"></i>
        <div>Pengaduan</div>
      </a>
    </li> --}}
    {{-- <li class="menu-item {{ Request::segment(2) == 'asdf' ? 'active' : '' }}">
      <a href="#" class="menu-link">
        <i class="menu-icon tf-icons bx bx-message-detail"></i>
        <div>Survey</div>
      </a>
    </li> --}}
    {{-- <li class="menu-item {{ Request::segment(1) == 'kepegawaian' ? 'active open' : '' }}">
      <a href="" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bxs-city"></i>
        <div>Kepegawaian</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ Request::segment(2) == 'pegawai' ? 'active' : '' }}">
          <a href="#" class="menu-link">
            <div>Data Pegawai</div>
          </a>
        </li>
        <li class="menu-item {{ Request::segment(2) == 'jabatan' ? 'active' : '' }}">
          <a href="#" class="menu-link">
            <div>Jabatan</div>
          </a>
        </li>
        <li class="menu-item {{ Request::segment(2) == 'bidang' ? 'active' : '' }}">
          <a href="#" class="menu-link">
            <div>Bidang</div>
          </a>
        </li>
        <li class="menu-item {{ Request::segment(2) == 'golongan' ? 'active' : '' }}">
          <a href="#" class="menu-link">
            <div>Golongan</div>
          </a>
        </li>
        <li class="menu-item {{ Request::segment(2) == 'eselon' ? 'active' : '' }}">
          <a href="#" class="menu-link">
            <div>Eselon</div>
          </a>
        </li>
      </ul>
    </li> --}}
    <li class="menu-item {{ Request::segment(2) == 'data_master' ? 'active open' : '' }}">
      <a href="#" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-data"></i>
        <div>Data Master</div>
      </a>
      {{-- submenu --}}
      <ul class="menu-sub">
        <li class="menu-item {{ Request::segment(3) == 'desa' ? 'active' : '' }}">
          <a href="{{ route('desa_index') }}" class="menu-link">
            <div>Desa</div>
          </a>
        </li>
        <li class="menu-item {{ Request::segment(3) == 'kecamatan' ? 'active' : '' }}">
          <a href="#" class="menu-link">
            <div>Kecamatan</div>
          </a>
        </li>
      </ul>
    </li>
    <li class="menu-item {{ Request::segment(2) == 'galleries' ? 'active open' : '' }}">
      <a href="#" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-camera"></i>
        <div>Galleries</div>
      </a>
      {{-- submenu --}}
      <ul class="menu-sub">
        <li class="menu-item {{ Request::segment(3) == 'album_index' ? 'active' : '' }}">
          <a href="{{ route('album_index') }}" class="menu-link">
            <div>Album</div>
          </a>
        </li>
        <li class="menu-item {{ Request::segment(3) == 'foto_index' ? 'active' : '' }}">
          <a href="{{ route('foto_index') }}" class="menu-link">
            <div>Foto</div>
          </a>
        </li>
        <li class="menu-item {{ Request::segment(3) == 'video_index' ? 'active' : '' }}">
          <a href="{{ route('video_index') }}" class="menu-link">
            <div>Video</div>
          </a>
        </li>
      </ul>
    </li>
    <li class="menu-item {{ Request::segment(2) == 'pages' ? 'active open' : '' }}">
      <a href="#" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-file"></i>
        <div>Pages</div>
      </a>
      {{-- submenu --}}
      <ul class="menu-sub">
        {{-- <li class="menu-item {{ Request::segment(3) == 'desa' ? 'active' : '' }}">
          <a href="#" class="menu-link">
            <div>Agenda</div>
          </a>
        </li> --}}
        <li class="menu-item {{ Request::segment(3) == 'desa' ? 'active' : '' }}">
          <a href="#" class="menu-link">
            <div>Halaman Statis</div>
          </a>
        </li>
        <li class="menu-item {{ Request::segment(3) == 'slide_index' ? 'active' : '' }}">
          <a href="{{ route('slide_index') }}" class="menu-link">
            <div>Slide Utama</div>
          </a>
        </li>
        <li class="menu-item {{ Request::segment(3) == 'kecamatan' ? 'active' : '' }}">
          <a href="#" class="menu-link">
            <div>Tags</div>
          </a>
        </li>
        <li class="menu-item {{ Request::segment(3) == 'kecamatan' ? 'active' : '' }}">
          <a href="#" class="menu-link">
            <div>Links</div>
          </a>
        </li>
      </ul>
    </li>
    <li class="menu-item {{ Request::segment(1) == 'setting' ? 'active open' : '' }}">
      <a href="" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bxs-cog"></i>
        <div>Pengaturan</div>
      </a>
      {{-- submenu --}}
      <ul class="menu-sub">
        <li class="menu-item {{ Request::segment(2) == 'user' ? 'active' : '' }}">
          <a href="dashboard/setting/user" class="menu-link">
            <div>User</div>
          </a>
        </li>
      </ul>
    </li>

  </ul>

</aside>
