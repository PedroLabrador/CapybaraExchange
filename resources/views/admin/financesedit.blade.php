@extends('layouts.admin')

@section('content')
	<div class="container" style="overflow-x: scroll;">
        <div class="row">
            <div class="col-md-11" style="margin: 3%;">
                <div class="panel">
                    <div class="panel-heading">Editar Finanza</div>

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
                                <div class="form-control has-danger">
                                    <span style="border-color: #FF4136; color: #FF4136; text-align: center">{{ Session::get('wrong') }}</span>
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
                        <div class="row">
                            <form method="post">
                                {{ csrf_field() }}
                                <div class="col-md-6 col-md-offset-3 mt-1">
                                    <label>Pago hecho por: </label> {{ $finance->payment->user->name }}
                                </div>
                                <div class="col-md-6 col-md-offset-3 mt-1">
                                	<label>Banco: </label> {{ $finance->payment->bankaccount->bank->bankname }}
                                </div>
                                <div class="col-md-6 col-md-offset-3 mt-1">
                                	<label>Cantidad vendidad: </label> {{ $finance->payment->amount }} {{ $finance->payment->currency }}
                                </div>
                                <div class="col-md-6 col-md-offset-3 mt-1">
                                	<label>Precio: </label> {{ $finance->payment->to_pay }} Bs
                                </div>

                                <div class="col-md-6 col-md-offset-3 mt-1">
                                	<label for='btc_spent'>BTC Gastado</label>
                                	<input id='btc_spent' class='form-control' type="text" name="btc_spent" value='{{ $finance->btc_spent }}'>
                                </div>
                                <div class="col-md-6 col-md-offset-3 mt-1">
                                	<label for='btc_won'>BTC Generado</label>
                                	<input id='btc_won' class='form-control' type="text" name="btc_won" value='{{ $finance->btc_won }}'>
                                </div>

                                
                                <div class="col-md-10 col-md-offset-1 mt-1">
                                    <input class='btn btn-primary' type="submit" value="Actualizar">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <a class="btn btn-primary" href="/admin/finances">Atras</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection