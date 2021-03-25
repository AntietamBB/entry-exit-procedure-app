@extends('layouts.admin')

@section('content')
    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-aside-wrap">
                <div class="card-inner card-inner-lg">
                    <div class="nk-block-head nk-block-head-lg">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title">Personal Information</h4>
                                <div class="nk-block-des">
                                    <p>Basic info, like your name and address.</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content align-self-start d-lg-none">
                                <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block">
                        @if (session('message'))
                            <div class="alert alert-pro alert-{{ session('alert_class') }} alert-dismissible">
                                <div class="alert-text">
                                    <h6>{{ session('message') }}</h6>
                                </div>
                                <button class="close" data-dismiss="alert"></button>
                            </div>
                        @endif
                        <div class="nk-data data-list">
                            <div class="data-head">
                                <h6 class="overline-title">Basics</h6>
                            </div>
                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                <div class="data-col">
                                    <span class="data-label">Full Name</span>
                                    <span class="data-value">{{ Auth::user()->name }}</span>
                                </div>
                                <div class="data-col data-col-end">
                                    <a href="{{ url('update-profile') }}"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></a>
                                </div>
                            </div>
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">Email</span>
                                    <span class="data-value">{{ Auth::user()->email }}</span>
                                </div>
                                <div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div>
                            </div>
                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                <div class="data-col">
                                    <span class="data-label">Phone Number</span>
                                    <span class="data-value text-soft">{{ Auth::user()->phone }}</span>
                                </div>
                                <div class="data-col data-col-end">
                                    <a href="{{ url('update-profile') }}"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></a>
                                </div>
                            </div>
                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                <div class="data-col">
                                    <span class="data-label">Role</span>
                                    <span class="data-value">
                                        {{ ucwords(str_replace('_', ' ', Auth::user()->user_type)) }}
                                    </span>
                                </div>
                                <div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <x-profile-nav/>
            </div>
        </div>
    </div>
@endsection