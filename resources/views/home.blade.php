@extends('layouts.user')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="panel">
				<div class="panel-header">Dashboard</div>

					<div class="panel-body">
						@if (session('status'))
							<div class="alert alert-success">
								{{ session('status') }}
							</div>
						@endif

						Bienvenido
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection