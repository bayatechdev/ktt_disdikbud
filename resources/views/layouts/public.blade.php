<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="">
  <!-- Page Title -->
  <title>@yield('title')</title>
  <!-- Favicon Icon -->
  <link href="{{ url('assets/img/logo.png') }}" rel="icon">

  @stack('prepend-style')
  @include('includes.style')
  @stack('addon-style')

</head>

<body>
  @include('includes.navbar')
  @yield('content')
  @include('includes.footer')

  @stack('prepend-script')
  @include('includes.script')
  @stack('addon-script')
</body>

</html>
