@extends('layouts.admin')

@section('content')
	<div class="container" style="overflow-x: scroll;">
        <div class="row">
            <div class="col-md-11" style="margin: 3%;">
                <div class="panel">
                    <div class="panel-heading">Editar Finanza</div>

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
                        <div class="row">
                            <form method="post">
                                {{ csrf_field() }}
                                <div class="col-md-6 col-md-offset-3 mt-1">
                                	<label>Banco: </label>
                                    <input class='form-control' type="text" value="{{ $bank->bankname }}" name="bankname">
                                </div>
                                <div class="col-md-6 col-md-offset-3 mt-1">
                                	<label>Prefijo: </label>
                                    <input class='form-control' type="text" value="{{ $bank->accountcode }}" name="accountcode">
                                </div>
                                <div class="col-md-6 col-md-offset-3 mt-1">
                                	<label>Nombre de la imagen: </label>
                                    <input class='form-control' type="text" value="{{ $bank->url }}" name="url">
                                </div>                                
                                <div class="col-md-10 col-md-offset-1 mt-1">
                                    <input class='btn btn-primary' type="submit" value="Actualizar">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <a class="btn btn-primary" href="/admin/bank">Atras</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection