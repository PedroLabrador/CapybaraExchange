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
		    background-image: url(https://www.capybaraexchange.com/img/CapybaraDAG3-min.jpg);
		    background-position: center center;
		    background-repeat: no-repeat;
		    background-attachment: fixed;
		    background-size: cover;
		    background-color: #464646;
		}
		.opaque-2 {
			background-color: rgba(102,153,153,0.8) !important;
		}
		.opaque-8 {
			background-color: rgba(175, 175, 175, 0.8) !important; 
		} 
		.opaque-border {
			border: 1px solid rgba(175, 175, 175, 0.8) !important;
		}
		.opaque-radius {
			border-radius: 50px
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-default navbar-top-top opaque-8 opaque-border">

	      <ul class="nav navbar-nav navbar-right">
	        @guest
		        <li><a href="/login">Entrar</a></li>
		        <li><a href="/register">Registrarse</a></li>
		        <li><a href="/howdeposit">Tutorial</a></li>
		        
	        @else
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ \Auth::user()->email }}<span class="caret"></span></a>
		          <ul class="dropdown-menu opaque-8">
		            <li><a href="/user/profile" style="color:black">Perfil</a></li>
		            <li><a href="/user" style="color:black">Panel de usuario</a></li>
		            <li><a href="/howto" style="color:black">Tutorial</a></li>
		            @if (\Auth::user()->role == 'Admin')
		            	<li><a href="/admin" style="color:black">Panel de administrador</a></li>
		            @endif
		            <li role="separator" class="divider"></li>
		            <li><a href="/logout" style="color:black">Salir</a></li>
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
	<p style="text-align: center;"><font color="#000000"><strong><span style="font-size:36px;">Capybara Exchange</span></strong><br />
	<span style="font-size:18px;">Casa de cambio de Bytes a Bol&iacute;vares, en construcci&oacute;n.</span></p>

<div class="col-md-11" style="margin: 3%;">
				<div class="panel">
                    <div class="panel-body opaque-2 opaque-radius">
	<p style="text-align: center;"><span style="font-size:16px;">
	 Este es un tutorial b&aacute;sico.
	<br/>
    <strong>Paso 0:</strong><br />
    <img alt="" src="img/Paso0-min.jpg" style="width:100%; height: auto;"/></br>
    Despues de realizada una transferencia, ir a historial y extraer la unidad de la transacci&oacute;n haciendo click para entrar al navegador y copiar la url.</br>
    <strong>Paso 1:</strong><br />
    <img alt="" src="img/Paso1-min.jpg" style="width:100%; height: auto;"/></br>
    Hacer clic en proceder.</br>
    <strong>Paso 2:</strong><br />
    <img alt="" src="img/Paso2-min.jpg" style="width:100%; height: auto;"/></br>
    Colocar la cantidad de bytes a transferir tal y como aparecen en la transacci&oacute;n y darle proceder.</br>
    <strong>Paso 3:</strong><br />
    <img alt="" src="img/Paso3-min.jpg" style="width:100%; height: auto;"/></br>
    Transferir a la direcci&oacute;n indicada<strong> exactamente</strong> la cantidad de bytes previamente escrita en la calculadora, seleccionar cuenta bancaria para recibir los Bs, pegar link de la unidad y darle en registrar pago.</br>
    <strong>Paso 3Steem:</strong><br />
    <img alt="" src="img/Paso3S-min.jpg" style="width:100%; height: auto;"/></br>
    En el caso de transferir SBD o STEEM debes transferir a la direcci&oacute;n indicada con el memo aleatorio generado autom&aacute;ticamente.</br>
     <strong>Paso 4:</strong><br />
    <img alt="" src="img/Paso4-min.jpg" style="width:100%; height: auto;"/></br>
    Ten paciencia mientras tu orden se ejecuta autom&aacute;ticamente.</br>
     <strong>Paso 5(Opcional):</strong><br />
    <img alt="" src="img/Paso5-min.jpg" style="width:100%; height: auto;"/></br>
    Recibir&aacute;s un correo autom&aacute;tico notificando el resultado de tu operaci&oacute;n, en caso de ser aprobada te instamos a dejar tus comentarios en el canal o incluso hacer una review en Steemit, lo apreciamos mucho.</br>
         <strong>Paso 6(error):</strong><br />
    <img alt="" src="img/Paso5D-min.jpg" style="width:100%; height: auto;"/></br>
    Recibir&aacute;s un correo autom&aacute;tico notificando el resultado de tu operaci&oacute;n, en caso de no ser aprobada es tu deber comunicarte con nosotros en Telegram o el canal de Discord.</br></br>
    @guest
       	<a class="btn btn-primary" href="/">Atras</a>
    @else
    	@if (\Auth::user()->role == 'Admin')
        	<a class="btn btn-primary" href="/admin">Panel de administrador</a>
        @else
        	<a class="btn btn-primary" href="/user">Entrar</a>
    	@endif
    @endguest
    </div>
    
    
    
    
    
    
    
    
    </p>

	<p style="text-align: center;"><a href="http://t.me/capybaraexchange" target="_blank"><img alt="" src="https://upload.wikimedia.org/wikipedia/commons/8/82/Telegram_logo.svg" style="width: 90px; height: 90px;" /></a><a href="https://discord.gg/zFPWeVK" target="_blank"><img alt="" src="https://www.shareicon.net/data/512x512/2017/06/21/887435_logo_512x512.png" style="width: 100px; height: 100px;" /></a></p>


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