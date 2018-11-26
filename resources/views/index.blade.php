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
		    background-color: #545454;
		}
		.opaque-2 {
			background-color: rgba(102,153,153,0.8) !important;
		}
		.opaque-8 {
			background-color: rgba(200, 200, 200, 0.8) !important; 
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
		            <li><a href="/howto" style="color:black">Tutorial Bytes/Crypto</a></li>
	                <li><a href="/howdeposit" style="color:black">Tutorial SBD/Steem</a></li>
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

	<p style="text-align: center; margin-top: 5%"><a href="/"><style>img {max-width: 230px; width: 35%;height: auto;}</style><img src="/img/capybara_logo-27.png" width="230px" maxheight="230px"></p></a>
<div class="col-md-11" style="margin: 3%;">
				<div class="panel">
                    <div class="panel-body opaque-8 opaque-radius">
	<p style="text-align: center;"><font color="#000000"><strong><span style="font-size:36px;">Capybara Exchange</span></strong><br />
	<span style="font-size:18px;">Casa de cambio de Bytes y criptomonedas en general a Bol&iacute;vares, en construcci&oacute;n.</span></p>


	<p style="text-align: center;"><font color="#000000"><span style="font-size:16px;">Bienvenido a la versi&oacute;n beta de Capybara Exchange, aqu&iacute; podr&aacute;s cambiar tus Bytes y otras cryptomonedas a Bol&iacute;vares f&aacute;cilmente.</br>
	Si vas a cambiar por favor siempre cont&aacute;ctanos primero para poder verificar la disponibilidad.
	<br />

	<div class="container" id="calculadora">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel">
                    <div class="panel-body opaque-2 opaque-radius">
        				<h1 class="text-center" style="color: black; font-family: 'Raleway'"><strong>Calculadora</strong></h1>
						<div class="mt-1">
							{{ csrf_field() }}
							<div class="container">
								<div class="row">
									<div class="col-md-11 mt-1">
										<div class="row">
											<div class="col-md-10 mt-1">
												<input autocomplete="off" id='money_from' class='form-control form-calc' type="text" name='money_from' value="1" onkeyup="calculate(1)" onkeypress="return validateFloatKeyPress(this, event, 1);">
											</div>
											<div class="col-md-2 mt-1">
												<select id='from_id' name='from' class="form-control form-calc s-picker" onchange="checkdecimals(1)" style="margin-left: -30%">
													@foreach ($currencies as $currency)
														@if ($currency->status == 0)
															<option value="{{ $currency->id }}">{{ $currency->name }}</option>
														@endif
													@endforeach
												</select>
											</div>
										</div>
										<div class="row">
											<div class="col-md-10 mt-1">
												<input autocomplete="off" id='money_to' class='form-control form-calc' type="text" name='money_to' value="0" onkeyup="calculate(0)" onkeypress="return validateFloatKeyPress(this, event, 0);">
											</div>
											<div class="col-md-2 mt-1">
												<select id='to_id' name='to' class="form-control form-calc s-picker" onchange="calculate(0)" style="margin-left: -30%">
													<option value="1">Bs.S</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-1 mt-1 v-algn-m">
										<button type="button" class="btn btn-capy" data-toggle="modal" data-target=".exchange-window" style="position: absolute; top: 30%; left: -25%">Proceder</button>
									</div>
								</div>
							</div>
				            @guest
					        	<div class="col-md-10 col-md-offset-1 mt-1">
					        		<div class="col-md-12">
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
<p style="text-align: center;"><span style="font-size:16px;"><strong>Disponibilidad:</strong></p></span>
	<div class="panel">
		<div class="panel-body">
			<p style="text-align: center;">
				@foreach ($banks as $bank)
					<img src='{{ asset("img/$bank->url") }}' style="max-width: 90px; width: 15%; height: auto;"/>
				@endforeach
			</p>

			<p style="text-align: center;"><br /><span style="font-size:16px;">
			Cont&aacute;ctanos a traves de Telegram <a href="http://t.me/capybaraexchange">@capybaraexchange</a>&nbsp;o nuestro <a href="https://discord.gg/zFPWeVK">Discord</a> y pregunta la liquidez al momento ya que siempre tratamos de ofrecer la mejor tasa y se nos agota rápido.</p></span>
			<p style="text-align: center;"><a href="http://t.me/capybaraexchange" target="_blank"><img alt="" src="https://upload.wikimedia.org/wikipedia/commons/8/82/Telegram_logo.svg" style="width: 90px; height: 90px;" /></a><a href="https://discord.gg/zFPWeVK" target="_blank"><img alt="" src="https://www.shareicon.net/data/512x512/2017/06/21/887435_logo_512x512.png" style="width: 100px; height: 100px;" /></a></p>
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
		function validateFloatKeyPress(el, evt, hlpr) {
            let charCode       = (evt.which) ? evt.which : evt.keyCode;
            let key            = evt.key;
            let numbers        = el.value.split('.');
            let validCharCodes = [8, 35, 36, 37, 39, 46];
            let currencyList   = ['SBD', 'STEEM'];
            let caratPos       = getSelectionStart(el);
            let dotPos         = el.value.indexOf(".");
            let currency       = $("#from_id option:selected").text();
            let currencyLength = (!hlpr) ? 1 : ((currencyList.includes(currency)) ? 2 : 7);
            
            if (numbers.length > 1 && (charCode == 46 && key == '.'))
                return false;
            if (validCharCodes.includes(charCode))
                return true;
            if (charCode < 46 || charCode > 57)
                return false;
            if ((caratPos > dotPos && dotPos>-1 && (numbers[1].length > currencyLength)) && (charCode != 8 || (charcode != 46 && key != '.')))
                return false;
            return true;
        }

	    function getSelectionStart(o) {
            if (o.createTextRange) {
                var r = document.selection.createRange().duplicate()
                r.moveEnd('character', o.value.length)
                if (r.text == '') return o.value.length
                return o.value.lastIndexOf(r.text)
            } else return o.selectionStart
        }

		window.onload = () => { 
            calculate(1); 
            $("#btnCancelConfimation").click(function(){
                $("#confimation").modal('toggle');
            });
        };

		function checkdecimals(op) {
            let c_selected         = $("#from_id option:selected").text();
            let numbers            = $("#money_from").val().split('.');
            let currencyList       = ['SBD', 'STEEM'];
            let output             = parseFloat(numbers[0] + '.' + ((numbers[1]) ? ((currencyList.includes(c_selected) && numbers[1].toString().length > 3) ? (numbers[1].toString().substr(0,3)) : (numbers[1].toString()) ): '0'));
            
            $('#money_from').val(output);
            calculate(op);
        }

		function modifyValues(op, res, a, b) {
            if (op)
                $('#money_to').val(res.toFixed(a));
            else
                $('#money_from').val(res.toFixed(b));
        }
        
        function calculate(op) {
			let currencyList    = ['SBD', 'STEEM'];

            var from_id         = $("#from_id").val();
            var to_id           = $("#to_id").val();
            let currencies      = <?= ($currencies) ? $currencies : 'undefined' ?>;
			
            currencies.forEach((currency) => {
                if (from_id == currency.id && to_id == 1) {
                    var price_cu = currency.price_cu;
                    var price_bs = currency.price_bs;

					var from = $('#money_from').val();
                    var to   = $('#money_to').val();
                    var res  = (op) ? (parseFloat(from) * price_bs) : (parseFloat(to) / price_bs);

					modifyValues(op, res, 2, 8);

					if (currencyList.includes(currency.name)) {
						from = parseFloat($('#money_from').val()).toFixed(3);
						modifyValues(op, res, 2, 3);
					}
				}
			});
        }
    </script>
</body>
</html>
