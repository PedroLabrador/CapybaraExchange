@extends('layouts.admin')
@section('content')
	<div class="container" style="overflow-x: scroll;">
        <div class="row">
            <div class="col-md-11" style="margin: 3%;">
                <div class="panel">
                    <div class="panel-header"></div>

                    <div class="panel-body">
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
                                    <td>{{ $payment->user->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Correo</strong></td>
                                    <td>{{ $payment->user->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Banco</strong></td>
                                    <td>{{ $payment->bankaccount->bank->bankname }} - {{ $payment->bankaccount->account_type }} - {{ $payment->bankaccount->account }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Titular de la cuenta</strong></td>
                                    <td>{{ $payment->bankaccount->user_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Cedula</strong></td>
                                    <td>{{ $payment->bankaccount->dni }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Moneda: </strong></td>
                                    <td>{{ $payment->amount }} {{ $payment->currency }}</td>
                                </tr>        
                                <tr>
                                    <td><strong>a pagar: </strong></td>
                                    <td>{{ $payment->to_pay }} Bs</td>
                                </tr>
                                <tr>
                                  @if ($payment->memo == '')
                                    <td><strong>Enlace: </strong></td>
                                    <td><span>{{ $payment->link }} -> </span><a href="{{ $payment->link }}" class="btn btn-info" target="_blank">Acceder</a></td>
                                  @else
                                    <td><strong>Memo: </strong></td>
                                    <td><strong>{{ $payment->memo }}</strong></td>
                                  @endif
                                </tr>
                            </table>
                                @if ($payment->done == 0)
                                    <div class="col-md-2">
                                        <form method='post' action="/admin/exchange/approve/{{ $payment->id }}" onsubmit="return confirm('Está apunto de aprobar esta venta');">
                                          @csrf
                                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reference">
                                              Aprobar
                                          </button>
                                          <div class="modal fade" id="reference">
                                            <div class="modal-dialog modal-md">
                                              <div class="modal-content">
                                              
                                                <div class="modal-header">
                                                  <h4 class="modal-title">Inserte número de referencia:</h4>
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                
                                                <div class="modal-body">
                                                  <div class="col-md-12">
                                                    <div class="col-md-4 mt-1" style="font-size: 16px">
                                                      <small>Número de referencia</small>
                                                    </div>
                                                    <div class="col-md-8">
                                                      <input id='reference' type="text" class="form-control" name="reference">
                                                    </div>
                                                  </div>
                                                  <div class="col-md-6 mt-1">
                                                    <input id='btcwon' type="text" class="form-control" name="btcwon" placeholder="BTC ganado">
                                                  </div>
                                                  <div class="col-md-6 mt-1">
                                                    <input id='btcspent' type="text" class="form-control" name="btcspent" placeholder="BTC gastado">
                                                  </div>
                                                </div>
                                                
                                                <div class="modal-footer">
                                                  <button type="submit" class="btn btn-primary mt-1">Aprobar</button>
                                                  <button type="button" class="btn btn-secondary mt-1" data-dismiss="modal">Cancelar</button>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </form>
                                    </div>
                                    <div class="col-md-2">
                                        <form method="post" action="/admin/exchange/disapprove/{{ $payment->id }}" onsubmit="return confirm('Está apunto de no aprobar esta venta');">
                                            @csrf
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#reference2">
                                              No aprobar
                                            </button>
                                            <div class="modal fade" id="reference2">
                                              <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                              
                                                  <div class="modal-header">
                                                    <h4 class="modal-title">Razón de no aprobarlo?</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  </div>
                                                
                                                  <div class="modal-body">
                                                    <input type="text" class="form-control" name="reference">
                                                  </div>
                                                
                                                  <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger">No aprobar</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <a href="/admin/exchange/list" class="btn btn-primary">Atras</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection