@extends('layouts.main')

@section('content')
<!-- @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif -->
	<div class="register-box">
		<div class="register-logo">
			<a href="{{URL::to('/')}}"><b>Employee</b></a>
		</div>
		<div class="register-box-body">
    		<p class="login-box-msg">Register a new membership</p>
    		<form method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
        			<input type="text" id="name" class="form-control" placeholder="Full name" name="name" value="{{ old('name') }}" required autofocus> 
        			<span class="glyphicon glyphicon-user form-control-feedback"></span>
        			@if ($errors->has('name'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
      			<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
        			<input type="email" class="form-control" placeholder="Email" id="email" name="email" value="{{ old('email') }}" required>
        			<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        			@if ($errors->has('email'))
	                    <span class="text-danger">
	                        <strong>{{ $errors->first('email') }}</strong>
	                    </span>
	                @endif
      			</div>
      			<div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
        			<input type="password" class="form-control" placeholder="Password" id="password" name="password" required>
        			<span class="glyphicon glyphicon-lock form-control-feedback"></span>
        			 @if ($errors->has('password'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
      			</div>	
      			<div class="form-group has-feedback">
       	 			<input type="password" class="form-control" placeholder="Retype password" id="password-confirm" name="password_confirmation" required >
        			<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      			</div>
      			<div class="row">
        			<div class="col-xs-8">
        				<button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        			</div>
        		</div>
            </form>
            <div class="social-auth-links text-center">
      			<p>- OR -</p>
      			<a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using Facebook</a>
      			<a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using Google+</a>
    		</div>
    		<a href="{{URL::to('/login')}}" class="text-center">I already have a membership</a>
		</div>
	</div>
@endsection