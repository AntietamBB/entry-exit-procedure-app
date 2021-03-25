@extends('layouts.auth')

@section('content')

<div class="nk-block-head">
    <div class="nk-block-head-content">
        <h5 class="nk-block-title" style="text-align:center;">Forgot Password</h5>
    </div>
</div>

@if(session()->has('forgot_message_sucess'))
    <div class="alert alert-success">
        {{ session()->get('forgot_message_sucess') }}
    </div>
@endif
@if(session()->has('forgot_message'))
    <div class="alert alert-danger">
        {{ session()->get('forgot_message') }}
    </div>
@endif

<form action="<?= url('forgot_password') ?>" method="post">
	@csrf
    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="user_email">Email</label>
        </div>
        <input type="text" class="form-control form-control-lg" id="user_email" placeholder="Enter your email" name="user_email">
        @error('user_email')
            <span class="invalid">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <button class="btn btn-lg btn-primary btn-block">Submit</button>
    </div>
</form>

@endsection