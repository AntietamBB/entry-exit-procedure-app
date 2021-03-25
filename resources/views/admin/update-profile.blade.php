@extends('layouts.admin')

@section('content')
    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-aside-wrap">
                <div class="card-inner card-inner-lg">
                    <div class="nk-block-head nk-block-head-lg">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title">Update Profile Information</h4>
                                <div class="nk-block-des">
                                    <p>Update your personal info, like your Name and phone.</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content align-self-start d-lg-none">
                                <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <form action="<?= url('update-profile') ?>" method="post">
                                    @csrf                   
                                    <div class="row g-4">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-label" for="name">Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="name" name="name" @if (old('name') != '') value="{{ old('name') }}" @else value="{{ Auth::user()->name }}" @endif>
                                                    @error('name')
                                                        <span class="invalid">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-label" for="Phone">Phone</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="Phone" name="phone"  @if (old('phone') != '') value="{{ old('phone') }}" @else value="{{ Auth::user()->phone }}" @endif>
                                                    @error('phone')
                                                        <span class="invalid">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
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
                </div>
                <x-profile-nav/>
            </div>
        </div>
    </div>
@endsection