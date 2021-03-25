@extends('layouts.auth')

@section('content')

<div class="nk-block-head">
    <div class="nk-block-head-content">
        <h5 class="nk-block-title" style="text-align:center;">Set Your Password</h5>
        <div class="nk-block-des">
            <!--<p>Access the Antietam Broadband using your email and password.</p>-->
        </div>
    </div>
</div>

@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif

@if($token)
	<form action="<?= url('passwordsetting') ?>" method="post">
		@csrf
		<div class="form-group">
			<div class="form-label-group">
				<label class="form-label" for="default-pass01">Password</label>
			</div>
			<input type="password" class="form-control form-control-lg" id="default-pass01" placeholder="Enter your new password" name="password">
			@error('password')
				<span class="invalid" style="display:flex;">{{ $message }}</span>
			@enderror
			<input type="hidden" name="token" id="csrf-token" value="{{$token}}" />
		</div>
		<div class="form-group">
			<div class="form-label-group">
				<label class="form-label" for="cnf_password">Confirm Password</label>
			</div>
			<div class="form-control-wrap">
				<a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
					<em class="passcode-icon icon-show icon ni ni-eye"></em>
					<em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
				</a>
				<input type="password" class="form-control form-control-lg" id="cnf_password" placeholder="Re-enter your password" name="cnf_password">
				@error('cnf_password')
					<span class="invalid" style="display:flex;">{{ $message }}</span>
				@enderror
			</div>
		</div>
		<div class="form-group">
			<button class="btn btn-lg btn-primary btn-block">Submit</button>
		</div>
	</form>
@else
	<div style="color:red;">{{ $error }}</div>
@endif

@endsection