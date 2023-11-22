<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{-- CREF Token --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- SEO Meta tags --}}
  <meta name="keywords" content="" />
  <meta name="description" content="" />

  <title>@hasSection('template_title')@yield('template_title') | @endif {{ config('app.name', Lang::get('titles.app')) }}</title>

  {{-- Fonts --}}
  <link rel="stylesheet" href="{{ asset('assets/font/fonts.css') }}">

  {{-- Styles --}}
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/common.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  
  @yield('template_linked_css')

  <style type="text/css">
    @yield('template_fastload_css')
  </style>

  {{-- Scripts --}}
  <script>
    window.Laravel = {!! json_encode([
      'csrfToken' => csrf_token(),
    ]) !!};
  </script>

  @yield('head')

  @include('scripts.ga-analytics')

</head>
<body>
  <div id="app">
    
    @include('layouts.partials.navbar')

    <main id="main">
  
      @yield('content')

    </main>

    <footer id="footer">
      <div class="container">
        <div class="copyright">©️ 2023 カーポート倶楽部 All Rights Reserved.</div>
      </div>
    </footer>

    {{-- Scripts --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/js/common.js') }}"></script>

    @yield('footer_scripts')

  </body>
</html>
