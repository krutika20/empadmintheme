@extends('layouts.main')

@section('content')
<div class="login-box">
	<div class="login-logo">
		<a href="{{URL::to('/')}}"><b>Employee</b></a>
	</div>
@if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif 
	<div class="login-box-body">
		@if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif


		<p class="login-box-msg">Reset password</p>
		<form method="POST" action="{{ route('password.request') }}">
         	{{ csrf_field() }}
         	<input type="hidden" name="token" value="{{ $token }}">
	     	<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
    			<input type="email" class="form-control" placeholder="Enter a email address" id="email" name="email" value="{{ old('email') }}" required>
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
    			@if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
  			</div>
  			<div class="row">
    			<div class="col-xs-8">
    				<button type="submit" class="btn btn-primary btn-block btn-flat">Reset Password</button>
    			</div>
    		</div>
        </form>
	</div>
</div>
@endsection