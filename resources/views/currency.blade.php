@extends('layouts.admin')

@section('content')

	<div class="container" style="overflow-x: scroll;">

        <div class="row">

            <div class="col-md-11" style="margin: 3%;">

                <div class="panel">

                    <div class="panel-heading"></div>



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

                        <div class="col-md-10 col-md-offset-1">

                            <table class="table">

                                <tr>

                                    <th style='width: 10%'>#</th>

                                    <th style='width: 30%'>Nombre de la moneda</th>

                                    <th style='width: 20%'>Cantidad minima natural</th>

                                    <th style='width: 20%'>Precio en Bs</th>

                                    <th style='width: 10%'>Editar</th>

                                    <th style='width: 10%'></th>

                                </tr>

                                @forelse ($currencies as $currency)

                                    <tr>

                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $currency->name }}</td>

                                        <td>{{ $currency->price_cu }}</td>

                                        <td>{{ $currency->price_bs }}</td>

                                        <td><a href="/admin/currency/edit/{{ $currency->id }}" class="btn btn-info">Editar</a></td>

                                        @if (!$currency->status)

                                            <form action="/admin/currency/deactivate/{{ $currency->id }}" onsubmit="return confirm('Seguro que desea desactivar la moneda?');">

                                                <td>

                                                    <button type="submit" class="btn btn-danger">Desactivar</button>

                                                </td>

                                            </form>

                                        @else

                                            <form action="/admin/currency/activate/{{ $currency->id }}" onsubmit="return confirm('Seguro que desea desactivar la moneda?');">

                                                <td>

                                                    <button type="submit" class="btn btn-success">Activar</button>

                                                </td>

                                            </form>

                                        @endif

                                    </tr>

                                @empty

                                    <td></td>

                                    <td>No hay monedas aún</td>

                                @endforelse

                            </table>

                        </div>

                        <div class="col-md-12 col-md-offset-1">

                            <button class="btn btn-primary" data-toggle="modal" data-target="#newcoin">Crear nueva moneda</button>

                        </div>

                        <div class="modal fade" id="newcoin" tabindex="-1" role="dialog" aria-labelledby="newcoin" aria-hidden="true">

                            <div class="modal-dialog modal-dialog-centered" role="document">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="exampleModalLongTitle">Crear nueva moneda</h5>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                            <span aria-hidden="true">&times;</span>

                                        </button>

                                    </div>

                                    <div class="modal-body">

                                        <form method="post">

                                            {{ csrf_field() }}

                                            <div class="col-md-10 col-md-offset-1 mt-1">

                                                <label for='name'>Nombre de la moneda: </label>

                                            </div>

                                            <div class="col-md-10 col-md-offset-1">

                                                <input id='name' class='form-control' type="text" name="name">

                                            </div>

                                            <div class="col-md-10 col-md-offset-1 mt-1">

                                                <label for='coin'>Cantidad: </label>

                                            </div>

                                            <div class="col-md-10 col-md-offset-1">

                                                <input id='coin' class='form-control' type="text" name="price_cu" placeholder="Ejemplo: 1">

                                            </div>

                                            <div class="col-md-10 col-md-offset-1 mt-1">

                                                <label for='price'>Precio (Bs): </label>

                                            </div>

                                            <div class="col-md-10 col-md-offset-1">

                                                <input id='price' class='form-control' type="text" name="price_bs" placeholder="Ejemplo: 0.360">

                                            </div>

                                            <div class="col-md-10 col-md-offset-1 mt-1">
                                                
                                                <label for='deposit'>Dirección de deposito: </label>
                                                
                                            </div>

                                            <div class="col-md-10 col-md-offset-1">

                                                <input id='deposit' class='form-control' type="text" name="deposit">

                                            </div>

                                            <div class="col-md-10 col-md-offset-1 mt-1">
                                                
                                                <label for='fixedmemo'>Si la moneda posee memo fijo: (dejar en blanco si no lo posee) </label>
                                                
                                            </div>

                                            <div class="col-md-10 col-md-offset-1">

                                                <input id='fixedmemo' class='form-control' type="text" name="fixedmemo">

                                            </div>

                                            <div class="col-md-10 col-md-offset-1 mt-1">

                                                <div class="checkbox">

                                                  <label><input type="checkbox" name='memo'>Generar memos</label>

                                                </div>

                                            </div>

                                            <div class="col-md-10 col-md-offset-1 mt-1">

                                                <input class='btn btn-primary' type="submit" value="Crear">

                                            </div>

                                        </form>

                                    </div>

                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection