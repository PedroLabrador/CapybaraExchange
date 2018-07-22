@extends('layouts.admin')
@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
				<div class="card-header">Lista</div>

					<div class="card-body">
						<div class='form-group row'>
							<div class='col-md-8 col-md-offset-2'>
								<table style='color:black; margin: 1em'>
									<tr>
										<th style='padding: 1em'>#</th>
										<th style='padding: 1em'>Monto</th>
										<th style='padding: 1em'>concepto</th>
										<th style='padding: 1em'>Aceptar</th>
										<th style='padding: 1em'>Declinar</th>
									</tr>
								@foreach($payments as $payment)
									<tr>
										<td>{{$loop->iteration}}</td>
										<td>{{$payment->amount}}</td>
										<td>{{$payment->concept}}</td>
										<td><a href="#">Aceptar</a></td>
										<td><a href="#">Declinar</a></td>
									</tr>
								@endforeach
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection