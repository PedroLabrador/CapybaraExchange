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
                        <div class="col-md-12" style="font-size: 24px">
                            <table class="table">
                                <tr>
                                    <td><strong>Nombre: </strong></td>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Correo</strong></td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <form method="post">
                                        @csrf
                                        <td>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name='admin' {{ ($user->role == 'User') ? '' : 'checked' }}>Administrador?</label>
                                            </div>
                                        </td>
                                        <td><input type="submit" class="btn btn-primary" value="Enviar"></td>
                                    </form>
                                </tr>
                                <tr>
                                    <td><strong>Bancos</strong></td>
                                    <td>
                                      <tr>
                                        <th>#</th>
                                        <th>Banco</th>
										<th>Titular de la cuenta</th>
										<th>Cédula</th>
										<th>Número de cuenta    /    Número de telefono</th>
                                        <th>Tipo de cuenta</th>
										<th>U-MEMO</th>
                                        <th></th>
                                        @foreach ($user->bankaccounts as $bankaccount)
                                        <tr>
                                          <td>{{ $loop->iteration }}</td>
                                          <td>{{ $bankaccount->bank->bankname }}</td>
                                          <td>{{ $bankaccount->user_name }}</td>
                                          <td>{{ $bankaccount->dni }}</td>
                                          <td>{{ $bankaccount->account }}</td>
                                          <td>{{ $bankaccount->account_type }}</td>
                                          <td>{{ $bankaccount->memo }}</td>
                                            <form action="/user/profile/delete/{{ $bankaccount->id }}"onsubmit="return confirm('Seguro que desea borrar el numero de cuenta?, recuerde que esta acción también eliminará todas los pagos asociados a este número de cuenta, proceda bajo su propio riesgo.');">
                                                <td>
                                                    <button type="submit" class="btn btn-danger">Borrar</button>
                                                </td>
                                            </form>
                                          </td>
                                          </tr>
                                        @endforeach
                                        
                                      </tr>
                                    </td>
                                </tr>
                                <tr><td></td><td></td></tr>
                                <tr>
                                    <th>Borrar usuario</th>
                                    <form action="/admin/users/delete/{{ $user->id }}" onsubmit="return confirm('Está a punto de borrar este usuario, RECUERDE que todos los campos asociados a este serán permanentemente borrados y no hay vuelta atras, Seguro que desea borrar el usuario?');">
                                        <td>
                                            <button type="submit" class="btn btn-danger">Borrar</button>
                                        </td>
                                    </form>
                                </tr>
                            </table>
                          </div>
                        </div>
                        <a href="/admin/users" class="btn btn-primary">Atras</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection