<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="ScreenOrientation" content="autoRotate:disabled" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />

  <title>@yield('title')</title>

  <link rel="icon" type="image/png" href="{{ url('assets/img/ktt-logo.png') }}" />

  @stack('prepend-style')
  @include('includes.style')
  @stack('addon-style')

</head>

<body class="theme-light">
  {{-- @include('includes.navbar') --}}
  @yield('content')
  @include('includes.menu')
  {{-- @include('includes.footer') --}}

  @stack('prepend-script')
  @include('includes.script')
  @stack('addon-script')
</body>

</html>
