@extends('layouts.auth')

@section('content')
	<div class="nk-block-head">
	    <div class="nk-block-head-content">
	        <h5 class="nk-block-title">Register</h5>
	        <div class="nk-block-des">
	            <p>Create New Antietam Broadband Account</p>
	        </div>
	    </div>
	</div><!-- .nk-block-head -->
	<form action="<?= url('sign-up') ?>" method="post">
		@csrf
	    <div class="form-group">
	        <label class="form-label" for="name">Name</label>
	        <input type="text" class="form-control form-control-lg" id="name" placeholder="Enter your name" name="name">
	    </div>
	    <div class="form-group">
	        <label class="form-label" for="email">Email or Username</label>
	        <input type="text" class="form-control form-control-lg" id="email" placeholder="Enter your email address or username" name="email">
	    </div>
	    <div class="form-group">
	        <label class="form-label" for="password">Password</label>
	        <div class="form-control-wrap">
	            <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
	                <em class="passcode-icon icon-show icon ni ni-eye"></em>
	                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
	            </a>
	            <input type="password" class="form-control form-control-lg" id="password" placeholder="Enter your passcode" name="password">
	        </div>
	    </div>
	    <div class="form-group">
	        <div class="custom-control custom-control-xs custom-checkbox">
	            <input type="checkbox" class="custom-control-input" id="checkbox">
	            <label class="custom-control-label" for="checkbox">I agree to Dashlite <a tabindex="-1" href="#">Privacy Policy</a> &amp; <a tabindex="-1" href="#"> Terms.</a></label>
	        </div>
	    </div>
	    <div class="form-group">
	        <button class="btn btn-lg btn-primary btn-block">Register</button>
	    </div>
	</form><!-- form -->
	<div class="form-note-s2 pt-4"> Already have an account ? <a href="<?= route('login') ?>"><strong>Sign in instead</strong></a>
	</div>
@endsection