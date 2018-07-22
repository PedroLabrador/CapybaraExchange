@extends('layouts.user')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel">
				<div class="panel-header">Perfil</div>

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
						<div class="row">
							<div class="col-md-10 col-md-offset-1 mt-1">
								<label for='name'>Nombre</label>
								<input id='name' type="text" value="{{ $user->name }}" class="form-control" disabled>
							</div>
							<div class="col-md-10 col-md-offset-1 mt-1">
								<label for='correo'>Correo</label>
								<input id='correo' type="text" value="{{ $user->email }}" class="form-control" disabled>
							</div>
							<div class="col-md-10 col-md-offset-1 mt-1">
								<div class="col-md-12 mt-1">
									<label for='bank'>Cuentas bancarias afiliadas: </label>
								</div>
								<div class="col-md-12 mt-1">
									<table class="table">
										<tr>
											<th>Banco</th>
											<th>Numero de cuenta</th>
											<th>Eliminar</th>
										</tr>								
										@foreach ($bankaccounts as $bankaccount)
											<tr>
												<td style="width: 10%">{{ $bankaccount->bank->bankname }}</td>
												<td style="width: 80%">
													<input id='bank' type="text" value="{{ $bankaccount->account }}" class="form-control" disabled>
												</td>
												<td style="width: 10%">
													<!-- <form action="/user/profile/delete/{{ $bankaccount->id }}" onsubmit="return confirm('Seguro que desea borrar el numero de cuenta?');">
				                                        <td>
				                                        	<button type="submit" class="btn btn-primary">Borrar</button>
				                                        </td>
				                                    </form> -->
												</td>
											</tr>
										@endforeach
									</table>
								</div>
							</div>
						</div>
						<form method="post">
						{{ csrf_field() }}
							<div class="row">
								<div class="col-md-10 col-md-offset-1 mt-1">
		                            <div class="form-group table-fields">
		                                <div class="col-md-10 col-md-offset-1 mt-1">
		                                    <label for="">Agregar nueva cuenta bancaria</label>
		                                </div>
		                                <div class="col-md-10 col-md-offset-1">

		                                </div>
		                                <div id="wrap">
		                                	<div class='col-md-10 col-md-offset-1 mt-1'>
		                                		<div class="col-md-4">
		                                			<select name='bank' class='form-control'>
			                                			@foreach ($banks as $bank)
			                                				<option value='{{ $bank->id }}'>{{ $bank->bankname }}</option>
			                                			@endforeach
			                                		</select>
		                                		</div>
		                                		<div class="col-md-8">
			                                		<input type="text" name="account" class="form-control">
			                                	</div>
								            </div>
		                                </div>
		                            </div>
								</div>
								<div class="col-md-10 col-md-offset-1 mt-1">
									<input type="submit" class="btn btn-primary" value="Actualizar datos">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection