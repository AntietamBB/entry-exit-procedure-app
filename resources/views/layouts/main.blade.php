<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Antietam Broadband</title>
		<link rel="icon" href="images/favicon-32x32.png" type="image/x-icon">
		<meta name=viewport content="width=device-width, initial-scale=1">
		<meta name=description content="">
		<meta name=keyword content="">
		<link rel="stylesheet" href="{{ asset('css/frontend/bootstrap.min.css') }}">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="{{ asset('css/frontend/custom.css') }}">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script type="text/javascript" src="{{ asset('js/frontend/bootstrap.min.js') }}"></script>  
		<script type="text/javascript" src="{{ asset('js/frontend/app.js') }}"></script>
	</head>
	
	<style>
		@media only screen and (min-width: 700px) {
			.hamburger {
				display:none !important;
			}
		}
		@media only screen and (max-width: 699px) {
			#main_menu {
				display:none !important;
			}
		}
		#myLinks {
			display:none;
		}
		#myLinks a {
			color:#001e50 !important;
		}
	</style>
	
	<body>
		<!-- navigation -->
		<header class=" container mb-5 ect_head">
			<nav class="navbar navbar-expand">
				<a class="navbar-brand" href="{{ url('/') }}" style="padding:0px;"><img src="images/logo.jpg" alt="" style="width:150px;"></a>
				<!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>-->
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul id="main_menu" class="navbar-nav ml-auto">
						<li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
							<a href="{{ url('/') }}" class="nav-link text-uppercase font-weight-bold">Home</span></a>
						</li>
						@auth
							<li class="nav-item">
								<a href="<?= url('sign-out') ?>" class="nav-link text-uppercase font-weight-bold">Logout</a>
							</li>
						@else
							<li class="nav-item {{ Request::is('sign-in') ? 'active' : '' }}">
								<a href="{{ url('sign-in') }}" class="nav-link text-uppercase font-weight-bold">Login</a>
							</li>
						@endif
					</ul>
				</div>
				
				<a href="javascript:void(0);" class="icon hamburger" onClick="myFunction()" style="margin-top:3px;">
					<i class="fa fa-bars" style="font-size:25px;"></i>
				</a>
			</nav>
			
			<div id="myLinks" style="font-family: 'Montserrat', sans-serif;border-top: 1px solid rgb(0, 30, 80);">
				<a href="{{ url('/') }}" class="nav-link text-uppercase font-weight-bold">Home</span></a>
				@auth
					<a href="<?= url('sign-out') ?>" class="nav-link text-uppercase font-weight-bold">Logout</a>
				@else
					<a href="{{ url('sign-in') }}" class="nav-link text-uppercase font-weight-bold">Login</a>
				@endif
			</div>
		</header>
		<!-- /navigation -->
		
		@yield('content')

		<!-- footer -->
		<footer class="container-fluid">
			<!--<div class="row mt-5">
				<div class="col-12">
					<ul class="sm social-icons">
						<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
						<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li><a href="#"><i class="fa fa-google" aria-hidden="true"></i></a></li>
					</ul>
				</div>
			</div>-->
			<div class="row mt-4">
				<div class="col-12 text-center">
					<p style="color:#526484;padding-bottom:20px;">© Antietam Broadband <?php echo date('Y')?></p>
				</div>
			</div>
		</footer>
		
		<script>
			
		</script>
	</body>
</html>