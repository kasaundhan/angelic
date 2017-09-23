<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
	<meta charset="utf-8"/>
	<title>SB Admin v2.0 in Laravel 5</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/>
<link rel="stylesheet" href="{{URL::asset('public/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{URL::asset('public/assets/stylesheets/styles.css')}}" />
<link rel="stylesheet" href="{{URL::asset('public/css/jquery-ui.css')}}" />

<script src="{{URL::asset('resources/assets/js/jquery.min.js')}}"></script>
<script src="{{URL::asset('resources/assets/js/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('public/assets/scripts/frontend.js') }}" ></script>
<script src="{{URL::asset('resources/assets/js/jquery-ui.js')}}"></script>

<script src="{{URL::asset('resources/assets/js/jquery.validate.min.js')}}"></script>

<script src="{{URL::asset('resources/assets/js/cc_c2a.min.js')}}"></script>

</head>
<body>
	@yield('body')

</body>
</html>