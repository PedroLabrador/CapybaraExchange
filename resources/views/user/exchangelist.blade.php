@extends('layouts.user')

@section('content')

	<div class="container" style="overflow: scroll; overflow-x: scroll;">

        <div class="row">

            <div class="col-md-11">

                <div class="panel">

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

                                    <th>#</th>

                                    <th>Cuenta Bancaria</th>

                                    <th>Cantidad vendida</th>

                                    <th>Precio en Bs</th>

                                    <th>Estado</th>

                                    <th>Referencia</th>

                                    <th>Enlace</th>

                                </tr>

                                @forelse ($payments as $payment)

                                    <tr>

                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $payment->bankaccount->bank->bankname }}</td>

                                        <td>{{ $payment->amount }} {{ $payment->currency }}</td>

                                        <td>{{ $payment->to_pay }} Bs</td>

                                        <td>

                                        	@if ($payment->done == 0)

                                        		En proceso

                                        	@elseif ($payment->done == 1)

                                        		Aprobado

                                        	@else

                                        		No aprobado

                                        	@endif

                                        </td>

                                        <td>
                                            
                                            @if (!$payment->reference)

                                            @else

                                                {{ $payment->reference }}

                                            @endif

                                        </td>

                                        <td><a class="btn btn-info" target="_blank" href="{{ $payment->link }}">Click</a></td>

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