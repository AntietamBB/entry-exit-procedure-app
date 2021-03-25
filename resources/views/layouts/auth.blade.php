<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<meta name="description" content="@@page-discription">
	<link rel="icon" href="/images/favicon-32x32.png" type="image/x-icon">
	<title>Antietam Broadband</title>

	<link rel="stylesheet" type="text/css" href="{{ asset('css/dashlite.css') }}" >
	<link rel="stylesheet" type="text/css" href="{{ asset('css/theme.css') }}" >
</head>
<body>
	<body class="nk-body npc-crypto ui-clean pg-auth">
    <div class="nk-app-root">
        <div class="nk-split nk-split-page nk-split-md">
            <div class="nk-split-content nk-block-area nk-block-area-column">
                <!--<div class="absolute-top-right d-lg-none p-3 p-sm-5">
                    <a href="#" class="toggle btn-white btn btn-icon btn-light" data-target="athPromo"><em class="icon ni ni-info"></em></a>
                </div>-->
                <div class="nk-block nk-block-middle nk-auth-body" style="text-align:center;">
                    <div class="brand-logo pb-5">
                        <a href="<?= url('/') ?>" class="logo-link">
                            <img class="logo-light logo-img logo-img-lg" src="/images/logo.jpg" srcset="/images/logo.jpg 2x" alt="logo">
                            <img class="logo-dark logo-img logo-img-lg" src="/images/logo.jpg" srcset="/images/logo.jpg 2x" alt="logo-dark">
                        </a>
                    </div>
                    @yield('content')
                </div>
                <div class="nk-block nk-auth-footer">
                    <!--<div class="nk-block-between">
                        <ul class="nav nav-sm">
                            <li class="nav-item">
                                <a class="nav-link" href="#">Terms & Condition</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Privacy Policy</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Help</a>
                            </li>
                        </ul>
                    </div>-->
                    <div class="mt-3" style="text-align:center;">
                        <p>&copy; Antietam Broadband <?php echo date("Y"); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/bundle.js?ver=1.4.0') }}"></script>
    <script src="{{ asset('js/scripts.js?ver=1.4.0') }}"></script>
</body>
</html>