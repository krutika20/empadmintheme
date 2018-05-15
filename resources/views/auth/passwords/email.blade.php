@extends('layouts.main')

@section('content')
<div class="login-box">
	<div class="login-logo">
		<a href="{{URL::to('/')}}"><b>Employee</b></a>
	</div>
	<div class="login-box-body">
		@if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
		<p class="login-box-msg">Recover your password from here</p>
		<form method="POST" action="{{ route('password.email') }}">
         	{{ csrf_field() }}
	     	<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
    			<input type="email" class="form-control" placeholder="Enter a email address" id="email" name="email" value="{{ old('email') }}" required>
    			<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    			@if ($errors->has('email'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
  			</div>
  			<div class="row">
    			<div class="col-xs-8">
    				<button type="submit" class="btn btn-primary btn-block btn-flat">Send Password Reset Link</button>
    			</div>
    		</div>
        </form>
	</div>
</div>
@endsection