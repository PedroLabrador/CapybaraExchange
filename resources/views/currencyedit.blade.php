@extends('layouts.admin')

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

                            <form method="post">

                                {{ csrf_field() }}

                                <div class="col-md-10 col-md-offset-1 mt-1">

                                    <label for='name'>Nombre de la moneda: </label>

                                </div>

                                <div class="col-md-10 col-md-offset-1">

                                    <input id='name' class='form-control' type="text" value='{{ $currency->name }}' name="name">

                                </div>

                                <div class="col-md-10 col-md-offset-1 mt-1">

                                    <label for='coin'>Cantidad: </label>

                                </div>

                                <div class="col-md-10 col-md-offset-1">

                                    <input id='coin' class='form-control' type="text" name="price_cu" placeholder="Ejemplo: 1" value="{{ $currency->price_cu }}">

                                </div>

                                <div class="col-md-10 col-md-offset-1 mt-1">

                                    <label for='price'>Precio (Bs): </label>

                                </div>

                                <div class="col-md-10 col-md-offset-1">

                                    <input id='price' class='form-control' type="text" name="price_bs" placeholder="Ejemplo: 0.360" value="{{ $currency->price_bs }}">

                                </div>

                                <div class="col-md-10 col-md-offset-1 mt-1">

                                    <label for='deposit'>Cuenta deposito:</label>

                                </div>

                                <div class="col-md-10 col-md-offset-1">

                                    <input id='deposit' class='form-control' type="text" value='{{ $currency->deposit }}' name="deposit">

                                </div>
                            
                                <div class="col-md-10 col-md-offset-1 mt-1">

                                    <label for='fixedmemo'>MEMO:</label>

                                </div>

                                <div class="col-md-10 col-md-offset-1">

                                    <input id='fixedmemo' class='form-control' type="text" value='{{ $currency->fixedmemo }}' name="fixedmemo">

                                </div>
                            
                                <div class="col-md-10 col-md-offset-1 mt-1">

                                    <div class="col-md-10 col-md-offset-1 mt-1">

                                        <div class="checkbox">

                                          <label><input type="checkbox" name='memo' {{ ($currency->memo == 'on') ? 'checked' : '' }}>Generar memos</label>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-10 col-md-offset-1 mt-1">

                                    <input class='btn btn-primary' type="submit" value="Actualizar">

                                </div>

                            </form>

                        </div>

                    </div>

                    <div class="col-md-12">

                        <a class="btn btn-primary" href="/admin/currency">Atras</a>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection