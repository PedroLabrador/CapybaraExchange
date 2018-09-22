<html>
<head>
    
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Capybara Exchange</title>

	<!-- Bootstrap -->
	<link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
	<!-- Custom Theme Style -->
	<link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">   

    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

	<style type="text/css">
		.mt-1 {
			margin-top: 1em
		}
		body {
		    background-position: center center;
		    background-repeat: no-repeat;
		    background-attachment: fixed;
		    background-size: cover;
		    background-color: #454545;
		    background-image: url(https://www.capybaraexchange.com/img/FondoDark.jpg);
		}
		.opaque-2 {
			background-color: rgba(54,54,54,0.8) !important;
		}
		.opaque-8 {
			background-color: rgba(45, 45, 45, 0.8) !important; 
		} 
		.opaque-border {
			border: 1px solid rgba(143, 143, 143, 0.8) !important;
		}
		.opaque-radius {
			border-radius: 50px
		}
	</style>
</head>
<body data-gramm="true" data-gramm_editor="true" data-gramm_id="30e6f27f-b069-9116-a676-5fdc0f5d0846">
    
	<nav class="navbar navbar-default navbar-top-top opaque-8 opaque-border">

	      <ul class="nav navbar-nav navbar-right" >
	        @guest
		        <li><a href="/login">Entrar</a></li>
		        <li><a href="/register">Registrarse</a></li>
		        <li><a href="/howto">Tutorial</a></li>
		        
	        @else
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ \Auth::user()->email }}<span class="caret"></span></a>
		          <ul class="dropdown-menu opaque-8">
		            <li><a href="/user/profile" style="color:#8f8f8f">Perfil</a></li>
		            <li><a href="/user" style="color:#8f8f8f">Panel de usuario</a></li>
		            <li><a href="/howto" style="color:#8f8f8f">Tutorial Bytes/Crypto</a></li>
	                <li><a href="/howdeposit" style="color:#8f8f8f">Tutorial SBD/Steem</a></li>
		            @if (\Auth::user()->role == 'Admin')
		            	<li><a href="/admin" style="color:#8f8f8f">Panel de administrador</a></li>
		            @endif
		            <li role="separator" class="divider"></li>
		            <li><a href="/logout" style="color:#8f8f8f">Salir</a></li>
		          </ul>
	        	</li>
	        @endguest
	      </ul>
	    </div>
	  </div>
	</nav>

	<p style="text-align: center; margin-top: 5%"><a href="/"><style>img {max-width: 230px; width: 35%;height: auto;}</style><img src="/img/Icono.png" width="230px" maxheight="230px"></p></a>
<div class="col-md-11" style="margin: 3%;">
		<div class="panel">
            <div class="panel-body opaque-8 opaque-radius">
				<p style="text-align: center;">
					<font color="#8f8f8f"><strong><span style="font-size:36px;">Capybara Exchange</span></strong>
						<br />
						<span style="font-size:18px;">Casa de cambio de Bytes y criptomonedas en general a Bol&iacute;vares, en construcci&oacute;n.</span></br></br>
				<div class="col-md-11" style="margin: 3%; color: black">
					<div class="panel">
				        <div class="panel-body opaque-2 opaque-radius">
				        	<font color="#747474"><div class="text-justify">Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text
				        	</div>
				        </div>
				    </div>
				</div>
					<p style="text-align: center;"><a href="http://t.me/capybaraexchange" target="_blank"><img alt="" src="https://upload.wikimedia.org/wikipedia/commons/8/82/Telegram_logo.svg" style="width: 90px; height: 90px;" /></a><a href="https://discord.gg/zFPWeVK" target="_blank"><img alt="" src="https://www.shareicon.net/data/512x512/2017/06/21/887435_logo_512x512.png" style="width: 100px; height: 100px;" /></a></p>
			</div>
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
</body>
</html>