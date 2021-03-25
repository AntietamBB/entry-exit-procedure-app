@extends('layouts.auth')

@section('content')
<div class="nk-block-head">
    <div class="nk-block-head-content">
        <h5 class="nk-block-title" style="text-align:center;">Sign-In</h5>
        <div class="nk-block-des">
            <!--<p>Access the Antietam Broadband using your email and password.</p>-->
        </div>
    </div>
</div>
@if(session()->has('password_update'))
    <div class="alert alert-success">
        {{ session()->get('password_update') }}
    </div>
@endif
@if (session('message'))
    <div class="alert alert-pro alert-{{ session('alert_class') }} alert-dismissible">
        <div class="alert-text">
            <h6>{{ session('message') }}</h6>
        </div>
        <button class="close" data-dismiss="alert"></button>
    </div>
@endif
<form action="<?= url('sign-in') ?>" method="post">
	@csrf
    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="default-01">Email</label>
        </div>
        <input type="text" class="form-control form-control-lg" id="default-01" placeholder="Enter your email address" name="email">
        @error('email')
            <span class="invalid" style="display: flex;">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="password">Password</label>
        </div>
        <div class="form-control-wrap">
            <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
            </a>
            <input type="password" class="form-control form-control-lg" id="password" placeholder="Enter your passcode" name="password">
            @error('password')
                <span class="invalid" style="display: flex;">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-lg btn-primary btn-block">Sign in</button>
    </div>
    <div class="form-group">
        <a href="{{ url('forgot-password') }}">Forgot Password?</a>
    </div>
</form>
<!--<div class="form-note-s2 pt-4"> New on our platform? <a href="<?= route('sign-up') ?>">Create an account</a>
</div>-->
@endsection