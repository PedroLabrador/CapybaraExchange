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
                                    <th>Usuario</th>
                                    <th>Cantidad</th>
                                    <th>Gastado</th>
                                    <th>Generado</th>
                                    <th>Ganancia</th>
                                </tr>
                                @forelse ($finances as $finance)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $finance->payment->user->name }}</td>
                                        <td>{{ $finance->payment->amount }} {{ $finance->payment->currency }}</td>
                                        <td>{{ $finance->btc_spent }} BTC</td>
                                        <td>{{ $finance->btc_won }} BTC</td>
                                        <td>{{ $finance->btc_won - $finance->btc_spent }} BTC</td>
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