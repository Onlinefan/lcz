<!DOCTYPE html>
<html lang="@yield('lang', config('app.locale', 'en'))">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Atnic">

  <title>@yield('title', config('app.name', 'INSPINIA'))</title>

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Styles -->
  @section('styles')
    <link href="{{ mix('/css/inspinia.css') }}" rel="stylesheet">
    <link href="{{ asset('/storage/css/c3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/storage/css/plugins/footable/footable.core.css') }}" rel="stylesheet">
    <link href="{{ asset('/storage/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/storage/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">

  @show

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  @stack('head')
</head>

<body class="body-small {{ config('inspinia.skin', '') }}">
<div id="wrapper">
  @include('inspinia::layouts.sidebar.main')
  @include('inspinia::layouts.main-panel.main')
</div>

@section('scripts')
  <script src="{{ mix('/js/manifest.js') }}" charset="utf-8"></script>
  <script src="{{ mix('/js/vendor.js') }}" charset="utf-8"></script>
  <script src="{{ mix('/js/inspinia.js') }}" charset="utf-8"></script>
  <script src="{{ asset('/storage/js/d3.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('/storage/js/c3.min.js') }}" charset="utf-8"></script>
  <script>
    if (typeof jQuery === 'undefined' && typeof $ !== 'undefined') {
      jQuery = $;
    }
  </script>
@show
@stack('body')
<!-- FooTable -->
<script src="{{ asset('/storage/js/plugins/footable/footable.all.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('/storage/js/plugins/dataTables/datatables.min.js') }}"></script>
<script src="{{ asset('/storage/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Input Mask -->
<script src="{{ asset('/storage/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>
<!-- Jvectormap -->
<script src="{{ asset('/storage/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('/storage/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('/storage/js/plugins/jvectormap/jquery-jvectormap-ru-mill.js') }}"></script>
<script src="{{ asset('/storage/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('/storage/js/plugins/touchpunch/jquery.ui.touch-punch.min.js') }}"></script>
<script src="{{ asset('/storage/js/main.js') }}"></script>
</body>

</html>
