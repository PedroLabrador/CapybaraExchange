@extends('layouts.admin')
@section('content')
	<div class="container">
        <div class="row">
            <div class="col-md-11" style="margin: 3%;">
                <div class="panel">
                    <div class="panel-header"></div>

                    <div class="panel-body">
                        @if (Session::has('success'))
                            <div class="col-md-10 col-md-offset-1">
                                <div class="form-control has-success">
                                    <span style="border-color: #3c763d; color: #3c763d; text-align: center">{{ Session::get('success') }}</span>
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
                        <div class="col-md-12">
                            <table class="table">
                                <tr>
                                    <th>#</th>
                                    <th>Usuario</th>
                                    <th>Cuenta Bancaria</th>
                                    <th>Cantidad vendida</th>
                                    <th>Precio a pagar</th>
                                    <th>Enlace</th>
                                    <th></th>
                                </tr>
                                @forelse ($payments as $payment)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $payment->user->name }}</td>
                                        <td>{{ $payment->bankaccount->bank->bankname }}</td>
                                        <td>{{ $payment->amount }} {{ $payment->currency }}</td>
                                        <td>{{ $payment->to_pay }} Bs</td>
                                        <td><a class="btn btn-info" target="_blank" href="{{ $payment->link }}">Click</a></td>
                                        <td><a href="/admin/exchange/list/{{ $payment->id }}" class="btn btn-primary">Ver</a></td>
                                        @if ($payment->done != 1)
<!--                                             <form action="/admin/exchange/aprove/{{ $payment->id }}" onsubmit="return confirm('Está apunto de aprovar esta venta');">
                                                <td>
                                                    <button type="submit" class="btn btn-success">Aprovar</button>
                                                </td>
                                            </form> -->
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td></td>
                                        <td>No hay peticiones en este momento.</td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection