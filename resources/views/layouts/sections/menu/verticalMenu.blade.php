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
