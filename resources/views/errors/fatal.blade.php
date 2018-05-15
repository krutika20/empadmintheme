@extends('layouts.main')

@section('content')
<div class="login-box" style="width:100%;text-align:center">
  <div class="login-box-body">
      <h3><b>Sorry</b></h3>
      <p>{{$message}} occured in {{$fileName}}</p>
      <p></p>
      <a href="{{URL::to('/')}}"><b>Back to Home</b></a>
  </div>
</div>

@endsection
