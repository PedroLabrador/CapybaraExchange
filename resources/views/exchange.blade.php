@extends('layouts.user')
@section('content')
	<div class="container" onload="init();">
        <div class="row">
            <div class="col-md-11" style="margin: 3%;">
                <div class="panel">
                    <div class="panel-header">Venta</div>

                    <div class="panel-body">
                        <form method="post">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="col-md-9 mt-1">
                                        <input id='from' class='form-control' type="text" name='money_from' value="1" onkeyup="calculate()">
                                    </div>
                                    <div class="col-md-3 mt-1">
                                        <select id='money_from' name='from' class="form-control">
                                            @foreach ($currencies as $currency)
                                                <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="col-md-9 mt-1">
                                        <input id='to' class='form-control' type="text" name='money_to' value="0" onkeyup="calculate2()">
                                    </div>
                                    <div class="col-md-3 mt-1">
                                        <select id='money_to' name='to' class="form-control">
                                            <option value="1">BS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-10 col-md-offset-1 mt-1">
                                    <button class="btn btn-primary">Vender</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        
        function calculate() {
            var money_from = $("#money_from").val();
            var money_to   = $("#money_to").val();

            if (money_from == 1 && money_to == 1 ) {
                var price_cu = 0;
                var price_bs = 0;
                <?php foreach ($currencies as $currency): ?>
                    <?php if ($currency->id == 1): ?>
                        price_cu = <?php echo $currency->price_cu; ?>;
                        price_bs = <?php echo $currency->price_bs; ?>;
                    <?php endif ?>
                <?php endforeach ?>

                var from = $("#from").val();
                var res  = parseFloat(from) * price_bs;
                var to   = $("#to").val(res); 
            }
        }

        function calculate2() {
            var money_from = $("#money_from").val();
            var money_to   = $("#money_to").val();

            if (money_from == 1 && money_to == 1) {
                var price_cu = 0;
                var price_bs = 0;
                <?php foreach ($currencies as $currency): ?>
                    <?php if ($currency->id == 1): ?>
                        price_cu = <?php echo $currency->price_cu; ?>;
                        price_bs = <?php echo $currency->price_bs; ?>;
                    <?php endif ?>
                <?php endforeach ?>
                
                var to   = $('#to').val(); 
                var res  = parseFloat(to) / 0.360;
                var from = $('#from').val(res);
            }
        }
    </script>
@endsection