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
                        <form method="post">
                            {{ csrf_field() }}
    						<div class="row">
                                <div class="col-md-10 col-md-offset-1 mt-1">
                                                        
                                    <label for="account_type">Tipo de cuenta</label>

                                    <select id='account_type' class="form-control" name="account_type" onchange="switch_acc()">

                                        <option value="Ahorro" {{ ($bankaccount->account_type == 'Ahorro') ? 'selected' : '' }}>Ahorro</option>

                                        <option value="Corriente" {{ ($bankaccount->account_type == 'Corriente') ? 'selected' : '' }}>Corriente</option>

                                        <option value="Juridica" {{ ($bankaccount->account_type == 'Juridica') ? 'selected' : '' }}>Juridica</option>

                                        <option value="Pago Movil" {{ ($bankaccount->account_type == 'Pago Movil') ? 'selected' : '' }}>Pago Movil</option>

                                    </select>

                                </div>

                                <div class="col-md-10 col-md-offset-1 mt-1">

                                    <label for="user_name">Titular de la cuenta</label>

                                    <input id='user_name' type="text" class="form-control" name="user_name" value="{{ $bankaccount->user_name }}">

                                </div>


                                <div class="col-md-10 col-md-offset-1 mt-1">

                                    <label for="dni">Cédula</label>

                                    <select name="na" class="form-control">
                                        
                                        <option value="V">V</option>

                                        <option value="E" {{ ($nationality == 'E') ? 'selected' : '' }}>E</option>

                                        <option value="J" {{ ($nationality == 'J') ? 'selected' : '' }}>J</option>
                                        
                                        <option value="P" {{ ($nationality == 'P') ? 'selected' : '' }}>P</option>

                                        <option value="G" {{ ($nationality == 'G') ? 'selected' : '' }}>G</option>

                                    </select>

                                    <input id='dni' type="text" class="form-control" name="dni" value="{{ $dni }}">

                                </div>

                                <div id="wrap">

                                    <div class='col-md-10 col-md-offset-1 mt-1'>
                                        <label for="bank" class="mt-1">Banco</label>
                                        <select name='bank' class='form-control'>
                                            @foreach ($banks as $bank)
                                                @if (!$bank->status)
                                                    <option value='{{ $bank->id }}' {{ ($bankaccount->bank_id == $bank->id) ? 'selected' : '' }}>{{ $bank->bankname }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <br>
                                        <label id='account_label' for="account" class="mt-1">Número de cuenta</label>

                                        <input id='account' type="text" name="account" class="form-control" value="{{ $bankaccount->account }}">
                                    </div>
                                </div>
                                <div class="col-md-10 col-md-offset-1 mt-1">
                                    <input type="submit" value="Actualizar" class="btn btn-primary">
                                </div>
                            </div>
                        </form>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
@endsection