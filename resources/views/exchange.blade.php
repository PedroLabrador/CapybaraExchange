@extends('layouts.user')

@section('content')

    <?php $temp = false; ?>

	<div class="container">

        <div class="row">

            <div class="col-md-11" style="margin: 3%;">

                <div class="panel">

                    <div class="panel-heading">Venta</div>

                    <div class="panel-body">

                        @if (Session::has('success'))

                            <div class="col-md-10 col-md-offset-1">

                                <div class="form-control has-success">

                                    <span style="border-color: #3c763d; color: #3c763d; text-align: center">{{ Session::get('success') }}</span>

                                </div>

                            </div>

                        @endif

                        @if (Session::has('wrong'))

                            <div class="col-md-10 col-md-offset-1">

                                <div class="form-control has-success">

                                    <span style="border-color: #c01d1d; color: #c01d1d; text-align: center">{{ Session::get('wrong') }}</span>

                                </div>

                            </div>

                        @endif

                        @if ($errors->any())

                            <div class="col-md-10 col-md-offset-1">

                                <div class="form-group @if ($errors->any()) has-danger @endif">

                                    @foreach ($errors->all() as $error)

                                        <div class="form-control" style="border-color: #FF4136; color: #FF4136;">{{ $error }}</div>

                                    @endforeach

                                </div>

                            </div>

                        @endif

                        <form method="post">

                            {{ csrf_field() }}

                            <div class="container">

                                <div class="row">

                                    <div class="col-md-9 mt-1">

                                        <input id='from' class='form-control' type="text" name='money_from' value="1" onkeyup="calculate()">

                                    </div>

                                    <div class="col-md-3 mt-1">

                                        <select id='money_from' name='from' class="form-control" onclick="calculate()">

                                            @foreach ($currencies as $currency)

                                                @if ($currency->status == 0)

                                                    <option value="{{ $currency->id }}">{{ $currency->name }}</option>

                                                @endif

                                            @endforeach

                                        </select>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-9 mt-1">

                                        <input id='to' class='form-control' type="text" name='money_to' value="0" onkeyup="calculate2()">

                                    </div>

                                    <div class="col-md-3 mt-1">

                                        <select id='money_to' name='to' class="form-control" onclick="calculate2()">

                                            <option value="1">Bs.S</option>

                                        </select>

                                    </div>
                                
                                </div>
                                
                                <div class="panel"><strong>Nota:</strong> Todos los precios estan marcados en Bs.S o bolívares soberanos, 1Bs.S=100.000Bs antiguos.</div>
                                
                                <div class="col-md-10 col-md-offset-1 mt-1">

                                    <!-- <button class="btn btn-primary">Proceder</button> -->

                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".exchange-window">Proceder</button>

                                    <div class="modal fade exchange-window" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

                                        <div class="modal-dialog modal-lg">

                                            <div class="modal-content">

                                                <div class="modal-header">

                                                    <h3 class="modal-title" id="exampleModalLabel">Datos</h3>

                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                                        <span aria-hidden="true">&times;</span>

                                                    </button>

                                                </div>

                                                <div class="modal-body" style="overflow-x: scroll; text-align: center">

                                                    <div class="form-group">

                                                        <div class="col-md-12">

                                                            <div class="col-md-12">

                                                                <div class="col-md-12 mt-1">

                                                                    <label>Por favor deposita aquí:</label>
                                                                        
                                                                    <span id='deposit' class="form-control"></span>

                                                                    <div id='fixedshow' style="display: none;">
                                                                        <label>No olvides usar este memo al depositar</label>

                                                                        <span id='fixedmemo' class="form-control"></span>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="col-md-12 mt-1">

                                                                    <label for="bankaccount">Seleccione la cuenta bancaria: </label>

                                                                    <select id='bankaccount' name="bankaccount" class="form-control">

                                                                        @forelse ($bankaccounts as $bankaccount)
                                                                            @if ($bankaccount->bank->status == 0)
                                                                            <option value='{{ $bankaccount->id }}'>{{ $bankaccount->user_name }} -- {{ $bankaccount->bank->bankname }} -- {{ $bankaccount->account_type }} -- {{ $bankaccount->account }}</option>
                                                                            @endif
                                                                        @empty

                                                                            <option disabled>No hay bancos asociados a su cuenta</option>

                                                                            <?php $temp = true; ?>

                                                                        @endforelse

                                                                    </select>

                                                                @if ($temp)

                                                                    <div class="mt-1">

                                                                        <a class='form-control btn btn-success' href="/user/profile">Asocia una cuenta aqui</a>

                                                                    </div>

                                                                @endif

                                                            </div>

                                                            <div id='memo' class="col-md-12 mt-1">

                                                                <label for="url">Inserte el link del pago: </label>

                                                                <input id='url' type="url" name="link" class="form-control">

                                                            </div>

                                                            <div id='memo2' class="col-md-12 mt-1" style="display: none">

                                                                <label>Antes de proceder, por favor usa este codigo para realizar tu transferencia</label>
                                                                <span class="form-control">{{ $memo }}</span>


                                                            </div>

                                                            <div id='steemconnect' class="col-md-12 mt-1" style="display: none">

                                                                <div class="col-md-12">
                                                                    <label class="mt-1">También puedes pagar con steemconnect: </label>
                                                                </div>

                                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confimation">Pagar con SteemConnect</button>

                                                                <div id="confimation" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                                                  <div class="modal-dialog modal-md">

                                                                    <div class="modal-content">
                                                                      <div class="modal-header">
                                                                        <h4 class="modal-title">Paga con SteemConnect</h4>
                                                                      </div>
                                                                      <div class="modal-body">
                                                                        <div class="col-md-12">
                                                                            <h3 style="color:blue">Vas a ser redirigido a SteemConnect, no olvides regresar a esta pestaña para registrar tu pago en nuestra plataforma despues de darle al boton cerrar.</h3>
                                                                            <img alt="" src="https://www.capybaraexchange.com/img/Instrucciones.jpg" /> 
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <a id='steemlink' target="_blank" class="btn btn-primary mt-1" href="">Transferir</a> 
                                                                        </div>
                                                                      </div>
                                                                      <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" id='btnCancelConfimation'>Cerrar</button>
                                                                      </div>
                                                                    </div>

                                                                  </div>
                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="modal-footer">

                                                    <button type="button" class="btn btn-secondary mt-1" data-dismiss="modal">Cerrar</button>

                                                    <button type="submit" class="btn btn-primary mt-1">Registrar pago</button>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>
                            <input type="hidden" value="{{ $memo }}" name="memo">
                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script type="text/javascript">

    function stopRKey(evt) {
        var evt = (evt) ? evt : ((event) ? event : null);

        var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);

        if (evt.keyCode == 27) $("#confimation").modal('toggle');

        if ((evt.keyCode == 13) && (node.type=="text")) return false;
    }

    document.onkeypress = stopRKey;

    </script> 

    <script type="text/javascript">
    window.onload = function() { 
        calculate(); 

        $("#btnCancelConfimation").click(function(){
            $("#confimation").modal('toggle');
        });
    };

        function calculate() {

            var money_from = $("#money_from").val();

            var money_to   = $("#money_to").val();

            <?php foreach ($currencies as $currency): ?>

                <?php 

                    echo "if (money_from == $currency->id && money_to == 1) {";

                    echo "var price_cu = $currency->price_cu;";
                    echo "var price_bs = $currency->price_bs;";

                    echo "$('#deposit').html('$currency->deposit');";
                    echo "$('#fixedmemo').html('$currency->fixedmemo');";

                    echo "if ('$currency->fixedmemo' == '') {";

                    echo "$('#fixedshow').hide();";

                    echo "} else {";

                    echo "$('#fixedshow').show();";

                    echo "}";

                    echo "var from = $('#from').val();";

                    echo "if ('$currency->memo' == 'on') {";

                    echo "$('#memo').hide();";

                    echo "$('#memo2').show();";

                    echo "if ('$currency->name' == 'SBD' || '$currency->name' == 'STEEM') {";

                    echo "var route = 'https://steemconnect.com/sign/transfer?to=capybaraexchange&amount='+from+'%20$currency->name&memo=$memo';";

                    echo "$('#steemlink').attr('href', route);";
                    echo "$('#steemconnect').show();";

                    echo "}";

                    echo "} else {";

                    echo "$('#memo2').hide();";

                    echo "$('#memo').show();";

                    echo "$('#steemconnect').hide();";

                    echo "}";

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

                    echo "$('#deposit').html('$currency->deposit');";
                    echo "$('#fixedmemo').html('$currency->fixedmemo');";

                    echo "if ('$currency->fixedmemo' == '') {";

                    echo "$('#fixedshow').hide();";

                    echo "} else {";

                    echo "$('#fixedshow').show();";

                    echo "}";

                    echo "var to   = $('#to').val();";

                    echo "if ('$currency->memo' == 'on') {";

                    echo "$('#memo').hide();";

                    echo "$('#memo2').show();";

                    echo "if ('$currency->name' == 'SBD' || '$currency->name' == 'STEEM')";

                    echo "var route = 'https://steemconnect.com/sign/transfer?to=capybaraexchange&amount='+from+'%20$currency->name&memo=$memo';";

                    echo "$('#steemlink').attr('href', route);";
                    echo "$('#steemconnect').show()";

                    echo "} else {";

                    echo "$('#memo2').hide();";
                    
                    echo "$('#memo').show();";

                    echo "$('#steemconnect').hide()";

                    echo "}";

                    echo "var res  = parseFloat(to) / price_bs;";

                    echo "var from = $('#from').val(res);";

                    echo "}";

                ?>
                
            <?php endforeach ?>

        }

    </script>

@endsection