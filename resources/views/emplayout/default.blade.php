<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel 5.6 CRUD example</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">

</head>
<body>
 
<div class="container">
    @yield('content')
</div>
<script type="text/javascript">
	var _globalObj = "{{ csrf_token() }}"
	var base_url = '{{URL::to("/")}}';
</script>
<script type="text/javascript" src="{{ URL::asset('js/jquery-latest.js') }}"></script>
 <script type="text/javascript" src="{{ URL::asset('js/custom.js') }}"></script>
</body>
<?php 
//echo "<pre>";print_r($departments);
?>
