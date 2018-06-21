@extends('layouts.auth')

@section('content')

<div class="login-box">
  <div class="login-logo">
    <a href="{{url('/')}}"><b>{{ config('app.name', 'Laravel') }}</b></a>
</div>
<!-- /.login-logo -->
<div class="login-box-body">
    <p class="login-box-msg">Reset Password</p>

    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
        @csrf

        <div class="form-group has-feedback">
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>

        <button type="submit" class="btn btn-primary btn-flat btn-block text-center">Send Password Reset Link</button>

    </form>

</div>
<!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection
