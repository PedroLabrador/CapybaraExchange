@extends('layouts.main')

@section('content') 

	<div class="panel">
        <div class="panel-body opaque-2 opaque-radius">
        	<p style="text-align: center;">
                <span style="font-size:16px;">
        	       Este es un tutorial básico.
                </span>
        	    <br/>
                <strong>Paso 0:</strong>
                <br/>
                <img alt="" src="img/Paso0-min.jpg" style="width:100%; height: auto;"/></br>

                Despues de realizada una transferencia, ir a historial y extraer la unidad de la transacción haciendo click para entrar al navegador y copiar la url.</br>

                <strong>Paso 1:</strong>
                <br/>
                <img alt="" src="img/Paso1-min.jpg" style="width:100%; height: auto;"/></br>

                Hacer clic en proceder.</br>

                <strong>Paso 2:</strong>
                <br/>
                <img alt="" src="img/Paso2-min.jpg" style="width:100%; height: auto;"/></br>

                Colocar la cantidad de bytes a transferir tal y como aparecen en la transacción y darle proceder.</br>

                <strong>Paso 3:</strong>
                <br/>
                <img alt="" src="img/Paso3-min.jpg" style="width:100%; height: auto;"/></br>

                Transferir a la dirección indicada<strong> exactamente</strong> la cantidad de bytes previamente escrita en la calculadora, seleccionar cuenta bancaria para recibir los Bs, pegar link de la unidad y darle en registrar pago.</br>

                <strong>Paso 3Steem:</strong>
                <br/>
                <img alt="" src="img/Paso3S-min.jpg" style="width:100%; height: auto;"/></br>

                En el caso de transferir SBD o STEEM debes transferir a la dirección indicada con el memo aleatorio generado automáticamente.</br>

                <strong>Paso 4:</strong>
                <br/>
                <img alt="" src="img/Paso4-min.jpg" style="width:100%; height: auto;"/></br>

                Ten paciencia mientras tu orden se ejecuta automáticamente.</br>

                <strong>Paso 5(Opcional):</strong>
                <br/>
                <img alt="" src="img/Paso5-min.jpg" style="width:100%; height: auto;"/></br>

                Recibirás un correo automático notificando el resultado de tu operación, en caso de ser aprobada te instamos a dejar tus comentarios en el canal o incluso hacer una review en Steemit, lo apreciamos mucho.</br>

                <strong>Paso 6(error):</strong>
                <br/>
                <img alt="" src="img/Paso5D-min.jpg" style="width:100%; height: auto;"/></br>

                Recibirás un correo automático notificando el resultado de tu operación, en caso de no ser aprobada es tu deber comunicarte con nosotros en Telegram o el canal de Discord.</br></br>

                @guest
                   	<a class="btn btn-primary" href="/">Atras</a>
                @else
                	@if (\Auth::user()->role == 'Admin')
                    	<a class="btn btn-primary" href="/admin">Panel de administrador</a>
                    @else
                    	<a class="btn btn-primary" href="/user">Entrar</a>
                	@endif
                @endguest
            </p>
        </div>
    </div>
    
@endsection