<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="csrf-token" content="{{ csrf_token() }}">
	    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
	    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	</head>
	<body>
	    <div id="app"></div>
	    <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
	    <script src="{{ asset('js/app.js') }}" defer></script>
	</body>
</html>