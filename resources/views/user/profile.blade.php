@extends('layouts.user')

@section('content')

	<div class="container" style="overflow: scroll; overflow-x: scroll;">

		<div class="row">

			<div class="col-md-12">

				<div class="panel">

					<div class="panel-heading">Perfil</div>



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

                                <div class="form-control has-success">

                                    <span style="border-color: #c01d1d; color: #c01d1d; text-align: center">{{ Session::get('wrong') }}</span>

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

								<label for='email'>Correo</label>

								<input id='email' type="email" value="{{ $user->email }}" class="form-control" disabled>

							</div>

							<div class="col-md-10 col-md-offset-1 mt-1">
								
								<div class="col-md-10">
									
									<label for="contact">Contacto</label>

									<input id='contact' type="text" value="{{ (!$user->contact) ? ' ' : $user->contact }}" class="form-control" disabled>

								</div>

								<div class="col-md-2">

									<label> </label>

									<br>

									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#phoneModal">Editar</button>

									<form method="post" action="/user/profile/update">

										@csrf

										<div class="modal fade bd-example-modal-sm" id="phoneModal" tabindex="-1" role="dialog" aria-labelledby="phone" aria-hidden="true">

											<div class="modal-dialog" role="document">

												<div class="modal-content">

													<div class="modal-header">

														<h5 class="modal-title" id="exampleModalLabel">Como contactarte?</h5>

														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

													</div>

													<div class="modal-body">

														<label for='mobile'>Ingrese número de telefono / Usuario de telegram</label>

														<input id='mobile' type="text" name="contact" value="{{ (!$user->contact) ? ' ' : $user->contact }}" class="form-control">

													</div>

													<div class="modal-footer">

														<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

														<button type="submit" class="btn btn-primary">Guardar cambios</button>

													</div>

												</div>

											</div>

										</div>

									</form>

								</div>

							</div>

							<div class="col-md-10 col-md-offset-1 mt-1" style="overflow: scroll; overflow-x: scroll;">

								<div class="col-md-12 mt-1">

									<label for='bank'>Cuentas bancarias afiliadas: </label>

								</div>

								<div class="col-md-12 mt-1">

									<table class="table">

										<tr>

											<th>Banco</th>

											<th>Titular de la cuenta</th>

											<th>Cédula</th>

											<th>Número de cuenta    /    Número de telefono</th>

											<th>U-MEMO</th>

											<th>Tipo de cuenta</th>

											<th>Editar</th>

										</tr>								

										@foreach ($bankaccounts as $bankaccount)

											<tr>

												<td style="width: 10%">{{ $bankaccount->bank->bankname }}</td>

												<td style="width: 20%">{{ $bankaccount->user_name }}</td>

												<td style="width: 10%">{{ $bankaccount->dni }}</td>

												<td style="width: 40%">

													<input id='bank' type="text" value="{{ $bankaccount->account }}" class="form-control" disabled>

												</td>

												<td>{{ $bankaccount->memo }}</td>

												<td style="width: 10%">{{ $bankaccount->account_type }}</td>

												<td><a href="/user/profile/update/{{ $bankaccount->id }}" class="btn btn-primary">Editar</a></td>

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

		                                <div class="panel">

		                                	<div class="panel-heading"><label>Agregar nueva cuenta bancaria</label></div>
		                                	
		                                	<div class="panel-body">
		                                		
		                                		<div class="col-md-10 col-md-offset-1 mt-1">
				                                	
			                                		<label for="account_type">Tipo de cuenta</label>

				                                	<select id='account_type' class="form-control" name="account_type" onchange="switch_acc()">

				                                		<option value="Ahorro">Ahorro</option>

				                                		<option value="Corriente">Corriente</option>

				                                		<option value="Juridica">Juridica</option>

				                                		<option value="Pago Movil">Pago Movil</option>

				                                	</select>

				                                </div>

				                                <div class="col-md-10 col-md-offset-1 mt-1">

			                                		<label for="user_name">Titular de la cuenta</label>

			                                		<input id='user_name' type="text" class="form-control" name="user_name">

				                                </div>


				                                <div class="col-md-10 col-md-offset-1 mt-1">

				                                	<div class="col-md-12">

				                                		<label for="dni">Cédula</label>

				                                	</div>

				                                	<div class="col-md-12">

					                                	<select name="na" class="form-control">
					                                		
					                                		<option value="V">V</option>

					                                		<option value="E">E</option>

					                                		<option value="J">J</option>
					                                		
					                                		<option value="P">P</option>

					                                		<option value="G">G</option>

					                                	</select>

					                                </div>

					                                <div class="col-md-12">

				                                		<input id='dni' type="text" class="form-control" name="dni">

				                                	</div>

				                                </div>

				                                <div id="wrap">

				                                	<div class='col-md-10 col-md-offset-1 mt-1'>
                                                        <label for="bank" class="mt-1">bankaccount</label>
                                                        <select name='bank' class='form-control'>

				                                			@foreach ($banks as $bank)

				                                				<option value='{{ $bank->id }}'>{{ $bank->bankname }}</option>

				                                			@endforeach

				                                		</select>
				                                		<div class="col-md-12">
				                                			<label id='account_label' for="account" class="mt-1">Número de cuenta</label>
			                                			</div>

				                                		<div id='prefix' class="col-md-3" style="display: none">
					                                		<select class='form-control' name='prefix'>
					                                			<option value="0416">0416</option>
					                                			<option value="0426">0426</option>
					                                			<option value="0414">0414</option>
					                                			<option value="0424">0424</option>
					                                			<option value="0412">0412</option>
					                                		</select>
														</div>

														<div class="col-md-9">
				                                			<input id='account' type="text" name="account" class="form-control">
				                                		</div>

										            </div>

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

<script type="text/javascript">
	window.onload = function() { switch_acc(); };
	
	function switch_acc() {
		$("#prefix").hide();
        console.log($("#account_type").val());
        if ($("#account_type").val() == 'Pago Movil') {
			$('#account_label').html('Número de teléfono');
            $("#prefix").show();
        } else
        	$('#account_label').html('Número de cuenta');
	}
</script>

@endsection