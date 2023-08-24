@isset($pageConfigs)
{!! Helper::updatePageConfig($pageConfigs) !!}
@endisset
@php
$configData = Helper::appClasses();

$customizerHidden = ($customizerHidden ?? '');
@endphp

@extends('layouts/dashboard')

@section('layoutContent')

<!-- Content -->
@yield('content')
<!--/ Content -->

@endsection
