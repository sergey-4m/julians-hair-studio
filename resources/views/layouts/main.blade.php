<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ionicons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/AdminLTE.min.css') }}" rel="stylesheet">
    <link href="{{ asset('datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
	    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
    <link href="{{ asset('css/skins/_all-skins.min.css') }}" rel="stylesheet">
</head>
<body class="hold-transition skin-blue sidebar-mini">
	@yield('contents')
	<script src="{{ asset('/js/manifest.js') }}"></script>
	<script src="{{ asset('/js/vendor.js') }}"></script>
    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="{{ asset('/js/tree.js') }}"></script>
    <script src="{{ asset('datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('js/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
</body>
</html>