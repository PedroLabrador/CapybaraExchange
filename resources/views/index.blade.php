<html>
<head>
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
<body data-gramm="true" data-gramm_editor="true" data-gramm_id="30e6f27f-b069-9116-a676-5fdc0f5d0846">

	<nav class="navbar navbar-default navbar-fixed-top opaque-8 opaque-border">

	      <ul class="nav navbar-nav navbar-right">
	        @guest
		        <li><a href="/login">Entrar</a></li>
		        <li><a href="/register">Registrarse</a></li>
	        @else
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ \Auth::user()->email }}<span class="caret"></span></a>
		          <ul class="dropdown-menu opaque-8">
		            <li><a href="/user/profile" style="color:black">Perfil</a></li>
		            <li><a href="/user" style="color:black">Panel de usuario</a></li>
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

	<p style="text-align: center; margin-top: 5%"><img alt="" src="{{ asset('img/Test4.png') }}"style="width: 228px; height: 300px;" /></p>
<div class="col-md-11" style="margin: 3%;">
				<div class="panel">
                    <div class="panel-body opaque-8 opaque-radius">
	<p style="text-align: center;"><font color="#000000"><strong><span style="font-size:36px;">Capybara Exchange</span></strong><br />
	<span style="font-size:18px;">Casa de cambio de Bytes a Bol&iacute;vares, en construcci&oacute;n.</span></p>


	<p style="text-align: center;"><span style="font-size:16px;">Bienvenido a la version beta de Capybara Exchange, aqu&iacute; podr&aacute;s cambiar tus Bytes a Bol&iacute;vares f&aacute;cilmente.<br />
	<br />
    <strong>Orden m&iacute;nima:</strong><br />
	<strong>25,000,000Bs</strong></p></span>

	<div class="container" id="calculadora">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel">
                    <div class="panel-body opaque-2 opaque-radius">
        				<h1 class="text-center" style="color: black; font-family: 'Raleway'"><strong>Calculadora</strong></h1>
						<div class="mt-1">
					        {{ csrf_field() }}
				            <div class="col-md-10 col-md-offset-1">
				            	<div class="form-group">
				            		<div class="col-md-9 mt-1">
                                        <input id='from' class='form-control' type="text" name='money_from' value="0" onkeyup="calculate()">
                                    </div>
				                    <div class="col-md-2">
											<select id='money_from' name='from' class="form-control" onclick="calculate()">
                                            @foreach ($currencies as $currency)
                                                @if ($currency->status == 0)
                                                    <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
				                    </div>
				                </div>
				            </div>
				            <div class="col-md-10 col-md-offset-1">
				                <div class="col-md-9 mt-1">
                                    <input id='to' class='form-control' type="text" name='money_to' value="0" onkeyup="calculate2()">
                                </div>
				                <div class="col-md-2 mt-1">
				                    <select id='money_to' name='to' class="form-control" onclick="calculate2()">
                                        <option value="1">BS</option>
                                    </select>
				                </div>
				            </div>
				            @guest
					        	<div class="col-md-10 col-md-offset-1 mt-1">
					        		<div class="col-md-12">
	                                	<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".exchange-window">Proceder</button>

		                                <div class="modal fade exchange-window" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		                                    <div class="modal-dialog modal-md">
		                                        <div class="modal-content">
		                                            <div class="modal-header">
		                                            	<h3 id='title' style="color: #262626; float: left">Entrar</h3>
		                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                                                    <span aria-hidden="true">&times;</span>
		                                                </button>
		                                            </div>
		                                            <div class="modal-body">
		                                            	<div class="first-content">
			                                                <div class="container">
															    <div class="row justify-content-center">
															        <div class="col-md-12">
															            <div class="panel">
															                <div class="panel-body" style="color: #262626">
															                    <form method="POST" action="{{ route('login') }}">
															                        {{ csrf_field() }}
															                        <div class="form-group row">
													                            		<label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Correo electrónico') }}</label>
														                            	<div class="col-md-6 col-md-offset-1">
															                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

															                                @if ($errors->has('email'))
															                                    <span class="invalid-feedback">
															                                        <strong>{{ $errors->first('email') }}</strong>
															                                    </span>
															                                @endif
															                            </div>
															                        </div>

															                        <div class="form-group row">
															                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

															                            <div class="col-md-6 col-md-offset-1">
															                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

															                                @if ($errors->has('password'))
															                                    <span class="invalid-feedback">
															                                        <strong>{{ $errors->first('password') }}</strong>
															                                    </span>
															                                @endif
															                            </div>
															                        </div>

															                        <div class="form-group row">
															                            <div class="col-md-6 offset-md-4">
															                                <div class="checkbox">
															                                    <label>
															                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Recordarme') }}
															                                    </label>
															                                </div>
															                            </div>
															                        </div>

															                        <div class="form-group row mb-0">
															                            <div class="col-md-8 md-offset-4">
															                                <button type="submit" class="btn btn-primary">
															                                    {{ __('Entrar') }}
															                                </button>
															                            </div>
															                        </div>
															                    </form>
															                    <div>
															                    	<a href='#calculadora' class="first-button">Aún no estás registrado?</a>
															                    </div>
															                </div>
															            </div>
															        </div>
															    </div>
															</div>
														</div>
		                                            	<div class="second-content" style="display: none">
		                                            		<div class="container">
															    <div class="row justify-content-center">
															        <div class="col-md-12">
															            <div class="panel">
															                <div class="panel-body" style="color: #262626">
															                    <form method="POST" action="{{ route('register') }}">
															                        @csrf

															                        <div class="form-group row">
															                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

															                            <div class="col-md-6 col-md-offset-1">
															                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

															                                @if ($errors->has('name'))
															                                    <span class="invalid-feedback">
															                                        <strong>{{ $errors->first('name') }}</strong>
															                                    </span>
															                                @endif
															                            </div>
															                        </div>

															                        <div class="form-group row">
															                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo electrónico') }}</label>

															                            <div class="col-md-6 col-md-offset-1">
															                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

															                                @if ($errors->has('email'))
															                                    <span class="invalid-feedback">
															                                        <strong>{{ $errors->first('email') }}</strong>
															                                    </span>
															                                @endif
															                            </div>
															                        </div>

															                        <div class="form-group row">
															                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

															                            <div class="col-md-6 col-md-offset-1">
															                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

															                                @if ($errors->has('password'))
															                                    <span class="invalid-feedback">
															                                        <strong>{{ $errors->first('password') }}</strong>
															                                    </span>
															                                @endif
															                            </div>
															                        </div>

															                        <div class="form-group row">
															                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar contraseña') }}</label>

															                            <div class="col-md-6 col-md-offset-1">
															                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
															                            </div>
															                        </div>

															                        <div class="form-group row mb-0">
															                            <div class="col-md-6 offset-md-4">
															                                <button type="submit" class="btn btn-primary">
															                                    {{ __('Registrar') }}
															                                </button>
															                            </div>
															                        </div>
															                    </form>
															                </div>
															            </div>
															        </div>
															    </div>
															</div>
															<a href='#calculadora' class="second-button" style="margin-top: -5%; padding: 0">Ya tienes cuenta?</a>
		                                            	</div>
		                                            </div>
		                                            <div class="modal-footer">
		                                                <button type="button" class="btn btn-secondary mt-1" data-dismiss="modal">Cerrar</button>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
	                                </div>
	                            </div>
		        			@else
					        	<div class="col-md-10 col-md-offset-1 mt-1">
		        					<div class="col-md-12">
		        						<a href="/user/exchange" class="btn btn-primary">Proceder</a>
		        					</div>
		        				</div>
		        			@endguest
					    </div>
					</div>
				</div>
			</div>
	    </div>
	</div>

	<div class="panel">
		<div class="panel-body">
			<p style="text-align: center;"><img alt="" src="{{ asset('img/banesco.png') }}" style="width: 150px; height: 84px;" /><img alt="" src="{{ asset('img/LogoMercantil.png') }}" style="width: 150px; height: 84px;" /><img alt="" src="{{ asset('img/provincial.png') }}" style="width: 150px; height: 84px;" /><img alt="" src="{{ asset('img/LogoBOD.png') }}" style="width: 150px; height: 84px;" /></a></p>

			<p style="text-align: center;"><span style="font-size:16px;">Trabajamos con Banesco, Mercantil, Provincial y BOD pero puedes preguntar por tu banco.&nbsp;</p>

			<p style="text-align: center;"><span style="font-size:16px;">Tambi&eacute;n compramos montos inferiores a la orden m&iacute;nima, solo necesitas preguntar.</span></p>

			<p style="text-align: center;"><br /><span style="font-size:16px;">
			Contactanos a traves de Telegram <a href="http://t.me/capybaraexchange">@capybaraexchange</a>&nbsp;y pregunta la tasa al momento ya que siempre tratamos de ofrecer la mejor tasa.</p></span>
		</div>
	</div>

	<p style="text-align: center;"><a href="http://t.me/capybaraexchange"><img alt="" src="https://upload.wikimedia.org/wikipedia/commons/8/82/Telegram_logo.svg" style="width: 100px; height: 100px;" /></a></p>

	<p style="text-align: center;"></p>

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
		$(function () {
		  $(".openModal").click(function(){
		    setTimeout(function(){
		      var h=$(".modal-body .first-content p").height();
		      $(".modal-body").css('height',h+80+'px');
		      $(".modal-body .first-content p").css('height',h+'px');
		    },250);
		  });
		  $('.first-button').on('click', function () {
		    $('.first-content').animate({width:"toggle"}, function(){
		      $('.second-content').animate({width:"toggle"});
		        var h=$(".modal-body .second-content p").height() + 100;
		        $(".modal-body").css('height',h+80+'px');
		        $(".modal-body .second-content p").css('height',h+'px');
		      });
		    $("#title").html("Registro");
		  });
		  $('.second-button').on('click', function () {
		    $('.second-content').animate({width:"toggle"},function(){
		      $('.first-content').animate({width:"toggle"});
		        var h=$(".modal-body .first-content p").height();
		        $(".modal-body").css('height',h+80+'px');
		        $(".modal-body .first-content p").css('height',h+'px');
		    });
		    $("#title").html("Entrar");
		  });
		});

		$(function() {
			FastClick.attach(document.body);
		});
	</script>

	<script type="text/javascript">
        
        function calculate() {
            var money_from = $("#money_from").val();
            var money_to   = $("#money_to").val();
            <?php foreach ($currencies as $currency): ?>
                <?php 
                    echo "if (money_from == $currency->id && money_to == 1) {";

                    echo "var price_cu = $currency->price_cu;";
                    echo "var price_bs = $currency->price_bs;";

                    echo "var from = $('#from').val();";

                    echo "var res  = parseFloat(from) * price_bs;";

                    echo "var to   = $('#to').val(res);";

                    echo "}";
                ?>
            <?php endforeach ?>
        }

        function calculate2() {
            var money_from = $("#money_from").val();
            var money_to   = $("#money_to").val();
            <?php foreach ($currencies as $currency): ?>
                <?php 
                    echo "if (money_from == $currency->id && money_to == 1) {";

                    echo "var price_cu = $currency->price_cu;";
                    echo "var price_bs = $currency->price_bs;";

                    echo "var to   = $('#to').val();";

                    echo "var res  = parseFloat(to) / price_bs;";

                    echo "var from = $('#from').val(res);";

                    echo "}";
                ?>
            <?php endforeach ?>
        }
    </script>
</body>
</html>