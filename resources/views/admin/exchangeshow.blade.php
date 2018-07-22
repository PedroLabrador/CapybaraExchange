@extends('layouts.admin')
@section('content')
	<div class="container">
        <div class="row">
            <div class="col-md-11" style="margin: 3%;">
                <div class="panel">
                    <div class="panel-header"></div>

                    <div class="panel-body">
                        <div class="col-md-12" style="font-size: 24px">
                            <table class="table">
                                <tr>
                                    <td><strong>Nombre: </strong></td>
                                    <td>{{ $payment->user->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Correo</strong></td>
                                    <td>{{ $payment->user->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Banco</strong></td>
                                    <td>{{ $payment->bankaccount->bank->bankname }} {{ $payment->bankaccount->account }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Moneda: </strong></td>
                                    <td>{{ $payment->amount }} {{ $payment->currency }}</td>
                                </tr>        
                                <tr>
                                    <td><strong>a pagar: </strong></td>
                                    <td>{{ $payment->to_pay }} Bs</td>
                                </tr>
                                <tr>
                                    <td><strong>Enlace: </strong></td>
                                    <td><a href="{{ $payment->link }}" class="btn btn-info" target="_blank">Enlace</a></td>
                                </tr>
                            </table>
                                @if ($payment->done != 1)
                                    <form action="/admin/exchange/aprove/{{ $payment->id }}" onsubmit="return confirm('Está apunto de aprovar esta venta');">
                                        <td>
                                            <button type="submit" class="btn btn-success">Aprovar</button>
                                        </td>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <a href="/admin/exchange/list" class="btn btn-primary">Atras</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection