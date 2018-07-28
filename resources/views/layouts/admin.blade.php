<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>
	<link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/ico"/>

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Bootstrap -->
	<link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
	<!-- Custom Theme Style -->
	<link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">   

	<style type="text/css">
		.mt-1 {
			margin-top: 1em
		}

		.title {
			font-size: 2em
		}

		@media only screen and (max-width : 480px) {
 			.right_col table{
 				font-size: .5em !important	
 			}
		}
	</style>
</head>
<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">
					<div class="navbar nav_title" style="border: 0;">
						<a href="/" class="site_title"><span>{{ config('app.name', 'Laravel') }}</span></a>
					</div>

					<div class="clearfix"></div>

					<!-- menu profile quick info -->
					<div class="profile clearfix">
						<div class="profile_pic">
							<img class='img-responsive' src="{{ asset('img/main.png') }}">
						</div>
						<div class="profile_info">
							<span>Bienvenid@</span>
							@guest
								<h2>Usuario</h2>
							@else
								<h2>{{ Auth::user()->name }}</h2>
							@endguest
						</div>
					</div>
					<!-- /menu profile quick info -->

					<br/>

					<!-- sidebar menu -->
					<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
						<div class="menu_section">
							<br>
							<br>
							<br>
							<h3>Control</h3>
							<ul class="nav side-menu">
								<li>
									<a>
										<i class="fa fa-angle-right"></i>Usuarios<span class="fa fa-chevron-down"></span>
									</a>
									<ul class="nav child_menu">
										<li>
											<a href="/admin/users">Ver</a>
										</li>
									</ul>
								</li>
								<li>
									<a>
										<i class="fa fa-angle-right"></i>Opciones administrativas<span class="fa fa-chevron-down"></span>
									</a>
									<ul class="nav child_menu">
										<li>
											<a href="/admin/currency">Monedas</a>
										</li>
										<li>
											<a href="/admin/bank">Bancos</a>
										</li>
										<li>
											<a href="/admin/exchange/list">Listado de peticiones por aprobar</a>
										</li>
										<li>
											<a href="/admin/exchange/list/approved">Listado de peticiones aprobadas</a>
										</li>
										<li>
											<a href="/admin/exchange/list/disapproved">Listado de peticiones no aprobadas</a>
										</li>
									<!-- 	<li>
											<a href="#">Item</a>
										</li> -->
									</ul>
								</li>
								<li>
									<a>
										<i class="fa fa-angle-right"></i>Finanzas<span class="fa fa-chevron-down"></span>
									</a>
									<ul class="nav child_menu">
										<li>
											<a href="/admin/finances">ver</a>
										</li>
									</ul>
								</li>
							</ul>
						</div>
						<ul class="nav side-menu">
							<li>
								<a href="/user">Panel de usuario</a>
							</li>
						</ul>
					</div>
					<!-- /sidebar menu -->

					<!-- /menu footer buttons -->
					<div class="sidebar-footer hidden-small">
						<a data-toggle="tooltip" data-placement="top" title="Settings">
							<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
						</a>
						<a data-toggle="tooltip" data-placement="top" title="FullScreen">
							<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
						</a>
						<a data-toggle="tooltip" data-placement="top" title="Lock">
							<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
						</a>
						<a data-toggle="tooltip" data-placement="top" title="Logout" href="/logout">
							<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
						</a>
					</div>
				<!-- /menu footer buttons -->
				</div>
			</div>

			<!-- top navigation -->
			<div class="top_nav">
				<div class="nav_menu">
					<nav>
						<div class="nav toggle">
							<a id="menu_toggle"><i class="fa fa-bars"></i></a>
						</div >
						<div class='nav'>
							<h1 class="title">Administrador</h1>
						</div>
					</nav>
				</div> 
			</div>
			<!-- /top navigation -->

			<!-- page content -->
			<div class="right_col" role="main">
				@yield('content')
			</div>

			<!-- footer content -->
			<footer>
				<div class="pull-right">
					&copy; 2018
				</div>
				<div class="clearfix"></div>
			</footer>
			<!-- /footer content -->
		</div>
	</div>

	<!-- jQuery -->
	<script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
	<!-- Bootstrap -->
	<script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	<!-- FastClick -->
	<script src="{{ asset('vendors/fastclick/lib/fastclick.js') }}"></script>
	<!-- Custom Theme Scripts -->
	<script src="{{ asset('build/js/custom.min.js') }}"></script>
	<!-- Extras -->
	<script>
		$(function() {
			FastClick.attach(document.body);
		});
	</script>
</body>
</html>