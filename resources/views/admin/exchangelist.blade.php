@extends('layouts.admin')

@section('content')

	<div class="container" style="overflow-x: scroll;">

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

                        <div class="col-md-12">

                            <table class="table">

                                <tr>

                                    <th>Usuario</th>

                                    <th>Cuenta Bancaria</th>

                                    <th>Cantidad vendida</th>

                                    <th>Precio a pagar</th>

                                    <th></th>

                                </tr>

                                @forelse ($payments as $payment)

                                    <tr>

                                        <td class="{{ (($loop->iteration % 2) == 0) ? '' : 'color-blue'}}">{{ $payment->user->name }}</td>

                                        <td class="{{ (($loop->iteration % 2) == 0) ? '' : 'color-blue'}}">{{ $payment->bankaccount->bank->bankname }}</td>

                                        <td class="{{ (($loop->iteration % 2) == 0) ? '' : 'color-blue'}}">{{ $payment->amount }} {{ $payment->currency }}</td>

                                        <td class="{{ (($loop->iteration % 2) == 0) ? '' : 'color-blue'}}">{{ $payment->to_pay }} Bs</td>

                                        <td class="{{ (($loop->iteration % 2) == 0) ? '' : 'color-blue'}}"><a href="/admin/exchange/list/{{ $payment->id }}" class="btn btn-primary">Detalles</a></td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td></td>

                                        <td>No hay peticiones en este momento.</td>

                                    </tr>

                                @endforelse

                            </table>

                        </div>

                        {{ $payments->links() }}

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection