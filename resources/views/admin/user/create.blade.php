@extends('layouts.admin')

@section('content')
	<div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Add Admin User</h3>
                @if($message=Session::get('message'))
                <div>
                <p style="text-align:center;">{{$message}}</p>
                </div>
                @endif
                @if($message=Session::get('error'))
                <div>
                <p style="text-align:center;">{{$message}}</p>
                </div>
               @endif
                <div class="nk-block-des text-soft">
                    <!--<p>Lorem ipsum dolor, sit amet, consectetur adipisicing elit.</p>-->
                </div>
            </div>
        </div>
    </div>
    <div class="nk-block nk-block-lg">
        <div class="card card-bordered">
            <div class="card-inner">
                <form action="<?= url('user') ?>" method="post">
                	@csrf
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="full-name">Full Name</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="full-name" name="name" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Email address</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email-address" name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="phone-no">Phone No</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="phone-no" name="phone" value="{{ old('phone') }}">
                                    @error('phone')
                                        <span class="invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12" style="padding-bottom: 0px !important;">
                            <label class="form-label" for="phone-no" style="margin-bottom:0px;">Entry Form Abilities</label>
                        </div>
                        @foreach($entry_categories as $role)
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="category[]" value="{{ $role->name }}" id="{{ $role->name }}" {{ in_array($role->name, old('category', [])) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="{{ $role->name }}">{{ $role->title }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="col-lg-12" style="padding-bottom: 0px !important;">
                            <label class="form-label" for="phone-no" style="margin-bottom:0px;">Exit Form Abilities</label>
                        </div>
                        @foreach($exit_categories as $role)
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="category[]" value="{{ $role->name }}" id="{{ $role->name }}" {{ in_array($role->name, old('category', [])) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="{{ $role->name }}">{{ $role->title }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary"><em class="icon ni ni-save"></em><span>Save</span></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection