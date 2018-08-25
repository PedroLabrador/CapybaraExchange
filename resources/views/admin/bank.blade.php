@extends('layouts.admin')

@section('content')

	<div class="container" style="overflow-x: scroll;">

        <div class="row">

            <div class="col-md-11" style="margin: 3%;">

                <div class="panel">

                    <div class="panel-header">Habilita un nuevo banco</div>



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

                                    <th style="width: 10%">#</th>

                                    <th style="width: 30%">Nombre del banco</th>

                                    <th style="width: 20%">Prefijo del banco</th>

                                    <th style="width: 20%"></th>

                                    <th style="width: 10%">Editar</th>

                                    <th style="width: 10%"></th>

                                </tr>

                                @foreach ($banks as $bank)

                                    <tr>

                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $bank->bankname }}</td>

                                        <td>{{ $bank->accountcode }}</td>

                                        <td>{{ $bank->url }}</td>

                                        <td><a class='btn btn-primary' href="/admin/bank/{{ $bank->id }}">Editar</a></td>

                                        @if (!$bank->status)

                                            <td><a class='btn btn-danger' href="/admin/bank/deactivate/{{ $bank->id }}">Desactivar</a></td>

                                        @else

                                            <td><a class='btn btn-success' href="/admin/bank/activate/{{ $bank->id }}">Activar</a></td>

                                        @endif

                                    </tr>

                                @endforeach

                            </table>
                            {{ $banks->links() }}
                        </div>

                    </div>

                    <div class="col-md-12 col-md-offset-1">

                        <button class="btn btn-primary" data-toggle="modal" data-target="#newbank">Habilitar nuevo banco</button>

                    </div>

                    <div class="modal fade" id="newbank" tabindex="-1" role="dialog" aria-labelledby="newBank" aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered" role="document">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title" id="exampleModalLongTitle">Habilitar nuevo banco</h5>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                        <span aria-hidden="true">&times;</span>

                                    </button>

                                </div>

                                <div class="modal-body">

                                    <form method="post">

                                        {{ csrf_field() }}

                                        <div class="col-md-12">

                                            <div class="col-md-12">

                                                <label for="bankname">Nombre del banco</label>

                                            </div>

                                            <div class="col-md-12">

                                                <input id='bankname' type="text" name="bankname" class="form-control" placeholder="ejemplo: Mercantil">

                                            </div>

                                            <div class="col-md-12 mt-1">

                                                <label for='accountcode'>Prefijo del banco</label>

                                            </div>

                                            <div class="col-md-12">

                                                <input id='accountcode' type="text" name="accountcode" class="form-control" placeholder="ejemplo: 0105">

                                            </div>

                                            <div class="col-md-12 mt-1">

                                                <label for='url'>Url de la imagen del banco</label>

                                            </div>

                                            <div class="col-md-12">

                                                <input id='url' type="text" name="url" class="form-control" placeholder="no olvides poner la extensión '.jpg' ejemplo mercantil.jpg">

                                            </div>

                                            <div class="col-md-12 mt-1">

                                                <button class="btn btn-primary">Habilitar</button>

                                            </div>

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

@endsection