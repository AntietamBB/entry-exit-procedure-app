<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<meta name="description" content="@@page-discription">
	<link rel="icon" href="images/favicon-32x32.png" type="image/x-icon">
	<title>Antietam Broadband</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/dashlite.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('css/theme.css') }}" >
	<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<style>
    .pending_count .badge-dim.badge-danger {
        color: #fff;
        background-color: #bb6d68;
        border-color: #bb6d68;
    }
</style>

<body class="nk-body bg-lighter npc-general has-sidebar">
	<div class="nk-app-root">
		<div class="nk-main ">
			<div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-sidebar-brand" style="text-align:center; width:100%;">
                        <a href="<?= url('dashboard') ?>" class="logo-link nk-sidebar-logo" style="margin-top:7px;">
                            <img class="logo-light logo-img" src="/images/logo.jpg" srcset="/images/logo.jpg 2x" alt="logo" style="max-height:50px;">
                            <img class="logo-dark logo-img" src="/images/logo.jpg" srcset="/images/logo.jpg 2x" alt="logo-dark" style="max-height:50px;">
                        </a>
                    </div>
                    <div class="nk-menu-trigger mr-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                    </div>
                </div>
                <div class="nk-sidebar-element">
                    <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>
                            <ul class="nk-menu">
                                <li class="nk-menu-item">
                                    <a href="{{ url('dashboard') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                                        <span class="nk-menu-text">Dashboard</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item pending_count">
                                    <a href="{{ url('employee') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                                        <span class="nk-menu-text">Manage Employees </span>
                                        <span class="badge badge-pill badge-danger badge-dim">3</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ url('user') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-user-list-fill"></em></span>
                                        <span class="nk-menu-text">Admin Users</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ url('category') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-table-view"></em></span>
                                        <span class="nk-menu-text">Categories</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nk-wrap ">
            	<div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ml-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-brand d-xl-none">
                                <a href="<?= url('dashboard') ?>" class="logo-link">
                                    <img class="logo-light logo-img" src="./images/logo.jpg" srcset="./images/logo.jpg 2x" alt="logo">
                                    <img class="logo-dark logo-img" src="./images/logo.jpg" srcset="./images/logo.jpg 2x" alt="logo-dark">
                                </a>
                            </div>
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                                <div class="user-info d-none d-md-block">
                                                    <div class="user-status">{{ ucwords(str_replace('_', ' ', Auth::user()->user_type)) }}</div>
                                                    <div class="user-name dropdown-indicator">{{ Auth::user()->name }}</div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                        <em class="icon ni ni-user-alt"></em>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="lead-text">{{ Auth::user()->name }}</span>
                                                        <span class="sub-text">{{ Auth::user()->email }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="{{ url('profile') }}"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                                    <li><a href="{{ url('change-password') }}"><em class="icon ni ni-shield-star-fill"></em><span>Change Password</span></a></li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="<?= url('sign-out') ?>"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dropdown notification-dropdown mr-n1">
                                        <a href="/" target="_blank" class="nk-quick-nav-icon">
                                            <em class="icon ni ni-home"></em>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                            	@yield('content')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-footer">
                    <div class="container-fluid">
                        <div class="nk-footer-wrap">
                            <div class="nk-footer-copyright"> &copy; Antietam Broadband <?php echo date("Y"); ?></a>
                            </div>
                            <!--<div class="nk-footer-links">
                                <ul class="nav nav-sm">
                                    <li class="nav-item"><a class="nav-link" href="#">Terms</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Privacy</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Help</a></li>
                                </ul>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
    
	<script src="{{ asset('js/bundle.js?ver=1.4.0') }}"></script>
    <script src="{{ asset('js/scripts.js?ver=1.4.0') }}"></script>
    <script src="{{ asset('js/charts/gd-general.js?ver=1.4.0') }}"></script>
</body>
</html>