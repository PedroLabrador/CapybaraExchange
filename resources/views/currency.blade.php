@extends('layouts.admin')
@section('content')
	<div class="container">
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
                            <div class="col-md-10 col-md-offset-1">
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
                                    <input id='price' class='form-control' type="text" name="price_bs" placeholder="Ejemplo: 0.350bs">
                                </div>
                                <div class="col-md-10 col-md-offset-1 mt-1">
                                    <input class='btn btn-primary' type="submit" value="Crear">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection