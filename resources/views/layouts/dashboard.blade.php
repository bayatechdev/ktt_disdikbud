<!DOCTYPE html>

<html lang="{{ session()->get('locale') ?? app()->getLocale() }}" class="{{ $configData['style'] }}-style {{ $navbarFixed ?? '' }} {{ $menuFixed ?? '' }} {{ $menuCollapsed ?? '' }} {{ $footerFixed ?? '' }} {{ $customizerHidden ?? '' }}" dir="{{ $configData['textDirection'] }}"
  data-theme="{{ $configData['theme'] }}" data-assets-path="{{ asset('/assets') . '/' }}" data-base-url="{{ url('/') }}" data-framework="laravel" data-template="{{ $configData['layout'] . '-menu-' . $configData['theme'] . '-' . $configData['style'] }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>@yield('title') |
    {{ config('variables.appName') ? config('variables.appName') : 'appName' }} -
    {{ config('variables.appSuffix') ? config('variables.appSuffix') : 'appSuffix' }}</title>
  <meta name="description" content="{{ config('variables.appDescription') ? config('variables.appDescription') : '' }}" />
  <meta name="keywords" content="{{ config('variables.appKeyword') ? config('variables.appKeyword') : '' }}">
  <!-- laravel CRUD token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Canonical SEO -->
  <link rel="canonical" href="{{ config('variables.productPage') ? config('variables.productPage') : '' }}">
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/ktt-logo.png') }}" />

  <!-- Include Styles -->
  @stack('prepend-style')
  @include('layouts/sections/styles')
  {{-- @include('includes.style') --}}
  @stack('addon-style')

  <!-- Include Scripts for customizer, helper, analytics, config -->
  @include('layouts/sections/scriptsIncludes')
</head>

<body>
  <!-- Layout Content -->
  @yield('layoutContent')
  <!--/ Layout Content -->



  <!-- Include Scripts -->
  @stack('prepend-script')
  @include('layouts/sections/scripts')
  @stack('addon-script')

  <div id="loading_spinner" style="z-index: 99999;">
    <div class="spinner-border" style="width: 3rem; height: 3rem; position: absolute; top:50%; left: 50%; z-index: 999999;" role="status">
      <span class="sr-only" style="z-index: 9999999;">Loading...</span>
    </div>
  </div>

</body>
<script>
  $(document).ready(function() {
    $('#loading_spinner').hide();
  });
</script>

{{-- <body>
  @include('includes.navbar')
  @yield('content')
  @include('includes.footer')

  @stack('prepend-script')
  @include('includes.script')
  @stack('addon-script')
</body> --}}

</html>
