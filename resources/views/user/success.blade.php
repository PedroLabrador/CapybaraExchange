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
                            <div class="col-md-6 col-md-offset-3">
                                <h3>Pago en proceso, será notificado via correo electrónico cuando su pago sea procesado. Muchas gracias</h3>
                            </div>
                        </div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
@endsection