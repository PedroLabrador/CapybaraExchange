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
                        <form id='exchange' method="post">
                            {{ csrf_field() }}
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-10 mt-1">
                                        <div class="row">
                                            <div class="col-md-10 mt-1 reset">
                                                <input autocomplete="off" id='money_from' class='form-control form-calc' type="text" name='money_from' value="1" onkeyup="calculate(1)" onkeypress="return validateFloatKeyPress(this, event, 1);">
                                            </div>
                                            <div class="col-md-2 mt-1 reset">
                                                <select id='from_id' name='from' class="form-control form-calc s-picker" onchange="checkdecimals(1)" onclick="">
                                                    @foreach ($currencies as $currency)
                                                        @if ($currency->status == 0)
                                                            <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-10 mt-1 reset">
                                                <input autocomplete="off" id='money_to' class='form-control form-calc' type="text" name='money_to' value="0" onkeyup="calculate(0)" onkeypress="return validateFloatKeyPress(this, event, 0);">
                                            </div>
                                            <div class="col-md-2 mt-1 reset">
                                                <select id='to_id' name='to' class="form-control form-calc s-picker" onchange="calculate(0)">
                                                    <option value="1">Bs.S</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-1 v-algn-m">
                                        <button type="button" class="btn btn-capy" data-toggle="modal" data-target=".exchange-window">Proceder</button>
                                    </div>
                                    <div id='rates' class='col-md-10 mt-1' style='padding-left:0; display: none'>
                                        <div class='col-md-4' style='margin-left: 0; padding-left: 0'>
                                            <label for="minrate">Tasa mínima</label>
                                            <input readonly id='minrate' type="text" class='form-control form-calc'>
                                        </div>
                                        <div class='col-md-4' style='margin-left: 0; padding-left: 0'>
                                            <label for="rate">Tasa actual</label>
                                            <input readonly id='rate' type="text" class='form-control form-calc'>
                                        </div>
                                        <div class='col-md-4' style='margin-left: 0; padding-left: 0'>
                                            <label for="maxrate">Tasa máxima</label>
                                            <input readonly id='maxrate' type="text" class='form-control form-calc'>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-10 col-md-offset-1 mt-1">
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
                                                                <input id='link' type="url" name="link" class="form-control">
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
                                                                    <div class="modal-content" style="text-align: center">
                                                                      <div class="modal-header">
                                                                        <h4 class="modal-title">Paga con SteemConnect</h4>
                                                                      </div>
                                                                      <div class="modal-body">
                                                                        <div class="col-md-12">
                                                                            <h3 style="color:blue">Vas a ser redirigido a SteemConnect, no olvides regresar a esta pestaña para registrar tu pago en nuestra plataforma despues de darle al boton cerrar.</h3>
                                                                            <img alt="" src="https://www.capybaraexchange.com/img/Instrucciones.jpg" /> 
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <input id='btn-transfer' type="submit" class='btn btn-primary mt-1' value="Transferir">
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

        function stopRKey(evt) {
            var evt  = (evt) ? evt : ((event) ? event : null);
            var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
            let isShown = ($("#confimation").data('bs.modal') || {isShown: false}).isShown;
            
            if (evt.keyCode == 27 && isShown) $("#confimation").modal('toggle');
            if ((evt.keyCode == 13) && (node.type=="text")) return false;
        }
        document.onkeypress = stopRKey;
    </script> 

    <script type="text/javascript">
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
            let currencies      =  <?= ($currencies) ? $currencies : 'undefined' ?>;
            let memo            = "<?= $memo ?>";
            
            currencies.forEach((currency) => {
                if (from_id == currency.id && to_id == 1) {
                    var price_cu = currency.price_cu;
                    var price_bs = currency.price_bs;

                    $('#deposit')  .html(currency.deposit);
                    $('#fixedmemo').html(currency.fixedmemo);

                    if (!currency.fixedmemo)
                        $('#fixedshow').hide();
                    else
                        $('#fixedshow').show();
                    
                    var from = $('#money_from').val();
                    var to   = $('#money_to').val();
                    
					var minrate = parseFloat(price_bs);
                    var increment = parseFloat(currency.increment);
                    var lmin = parseFloat(currency.lmin);
                    var lmax = parseFloat(currency.lmax);
                    var X = 0;
                    var rate = parseFloat(from) * price_bs;
                    var maxrate = 0;
                    
                    if (lmin && lmax && increment && minrate) {
                        if (from >= lmin && from <= lmax)
                            X = parseFloat(from / parseFloat(lmax));
                        else if (from >= lmax)
                            X = 1;
                        
                        $('#minrate').val(minrate.toFixed(2));
                        rate = (minrate + (minrate * increment * X));
                        $('#rate').val(rate.toFixed(2));
                        maxrate = minrate + (minrate * increment * 1);
                        $('#maxrate').val(maxrate.toFixed(2));
						rate *= parseFloat(from);

                        $("#rates").show();
                    } else {
                        $("#rates").hide();
                    }

                    var res  = (op) ? (rate) : (parseFloat(to) / price_bs);

                    modifyValues(op, res, 2, 8);

                    if (currency.memo == 'on') {
                        $('#memo').hide();
                        $('#memo2').show();

                        if (currencyList.includes(currency.name)) {
                            from = parseFloat($('#money_from').val()).toFixed(3);

                            modifyValues(op, res, 2, 3);

                            let transfer_to = "capybaraexchange";
                            let amount = `${from}%20${currency.name}`;
                            let redirect = `https://capybaraexchange.com/user/payment/${memo}`;

                            let route = `https://steemconnect.com/sign/transfer?to=${transfer_to}&amount=${amount}&memo=${memo}&redirect_uri=${redirect}`;

                            $('#btn-transfer').click(function() {
                                $('#exchange').attr('action', '/user/exchange/steem');
                            });

                            $('#link').attr('value', route);
                            $('#steemconnect').show();
                        } else {
                            $('#exchange').attr('action', '');
                        }
                    } else {
                        $('#exchange').attr('action', '');
                        $('#memo2').hide();
                        $('#memo').show();
                        $('#steemconnect').hide();
                    }
                    if (!currencyList.includes(currency.name))
                        $('#link').attr('value', '');
                    
                }
            });
        }
    </script>
@endsection