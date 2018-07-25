@extends('layouts.user')

@section('content')

    <?php $temp = false; ?>

	<div class="container" onload="init();">

        <div class="row">

            <div class="col-md-11" style="margin: 3%;">

                <div class="panel">

                    <div class="panel-header">Venta</div>

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

                            <div class="col-md-10 col-md-offset-1">

                                <div class="col-md-10 col-md-offset-1">

                                    <div class="col-md-9 mt-1">

                                        <input id='from' class='form-control' type="text" name='money_from' value="0" onkeyup="calculate()">

                                    </div>

                                    <div class="col-md-3 mt-1">

                                        <select id='money_from' name='from' class="form-control" onchange="calculate()">

                                            @foreach ($currencies as $currency)

                                                @if ($currency->status == 0)

                                                    <option value="{{ $currency->id }}">{{ $currency->name }}</option>

                                                @endif

                                            @endforeach

                                        </select>

                                    </div>

                                </div>

                                <div class="col-md-10 col-md-offset-1">

                                    <div class="col-md-9 mt-1">

                                        <input id='to' class='form-control' type="text" name='money_to' value="0" onkeyup="calculate2()">

                                    </div>

                                    <div class="col-md-3 mt-1">

                                        <select id='money_to' name='to' class="form-control" onchange="calculate2()">

                                            <option value="1">BS</option>

                                        </select>

                                    </div>

                                </div>

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

                                                <div class="modal-body">

                                                    <div class="form-group">

                                                        <div class="col-md-12">

                                                            <div class="col-md-12">

                                                                <div class="col-md-12">

                                                                    <div class="col-md-3">
                                                                        
                                                                        <label>Por favor deposita aquí:</label>

                                                                    </div>

                                                                    <div class="col-md-9">
                                                                        
                                                                        <span id='deposit' class="form-control"></span>

                                                                    </div>

                                                                </div>

                                                                <div class="col-md-12">

                                                                    <label for="bankaccount">Seleccione la cuenta bancaria: </label>

                                                                </div>

                                                                <div class="col-md-12">

                                                                    <select id='bankaccount' name="bankaccount" class="form-control">

                                                                        @forelse ($bankaccounts as $bankaccount)

                                                                            <option value='{{ $bankaccount->id }}'>{{ $bankaccount->bank->bankname }} -- {{ $bankaccount->account }}</option>

                                                                        @empty

                                                                            <option disabled>No hay bancos asociados a su cuenta</option>

                                                                            <?php $temp = true; ?>

                                                                        @endforelse

                                                                    </select>

                                                                </div>

                                                                @if ($temp)

                                                                    <div class="col-md-10 col-md-offset-1">

                                                                        <div class="mt-1">

                                                                            <a class='form-control btn btn-success' href="/user/profile">Por favor accede aqui para asociar una cuenta bancaria.</a>

                                                                        </div>

                                                                    </div>

                                                                @endif

                                                            </div>

                                                            <div class="col-md-12 mt-1">

                                                                <div class="col-md-12">

                                                                    <label for="url">Inserte el link del pago: </label>

                                                                </div>

                                                                <div class="col-md-12">

                                                                    <input id='url' type="url" name="link" class="form-control">

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

        if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}

    }

    document.onkeypress = stopRKey;

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

                    echo "$('#deposit').html('$currency->deposit');";

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

                    echo "$('#deposit').html('$currency->deposit');";

                    echo "var to   = $('#to').val();";

                    echo "var res  = parseFloat(to) / price_bs;";

                    echo "var from = $('#from').val(res);";

                    echo "}";

                ?>
                
            <?php endforeach ?>

        }

    </script>

@endsection