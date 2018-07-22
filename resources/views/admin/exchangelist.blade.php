@extends('layouts.admin')
@section('content')
	<div class="container">
        <div class="row">
            <div class="col-md-11" style="margin: 3%;">
                <div class="panel">
                    <div class="panel-header"></div>

                    <div class="panel-body">
                        <div class="col-md-10 col-md-offset-1">
                            <table class="table">
                                <tr>
                                    <th>#</th>
                                    <th>Usuario</th>
                                    <th>Cuenta Bancaria</th>
                                    <th>Enlace</th>
                                    <th>Aprovar</th>
                                </tr>
                                @foreach ($payments as $payment)
                                    <tr>
                                        <td>{{ $loop->iterator }}</td>
                                        <td>{{ $payment->user->name }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection