@extends('layouts.admin')

@section('content')
	<div class="container" style="overflow-x: scroll;">
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
                        <div class="col-md-12">
                            <form method="GET" accept-charset="UTF-8" role="search">
                                <div class="input-group">
                                    <div class="col-md-6">
                                        <label for="from_date">Desde: </label>
                                        <input type="date" name="from_date" id="from_date" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="to_date">Hasta: </label>
                                        <input type="date" name="to_date"   id="to_date"   class="form-control">
                                    </div>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default mt-1" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </form>

                            <hr>
                            <form method="post" onsubmit="return confirm('Está seguro que desea aplicar las tasas a los elementos seleccionados?');">>
                                @csrf
                                <table class="table">
                                    <tr>
                                        <th></th>
                                        <th>Usuario</th>
                                        <th>Cantidad</th>
                                        <th>Gastado</th>
                                        <th>Generado</th>
                                        <th>Ganancia</th>
                                        <th>ROI</th>
                                        <th>Fecha</th>
                                        <th>Editar</th>
                                    </tr>
                                    @forelse ($finances as $finance)
                                        <tr>
                                            <td class="checkbox"><input type="checkbox" name="checked[]" value="{{ $finance->id }}"></td>
                                            <td class="{{ (($loop->iteration % 2) == 0) ? '' : 'color-blue'}}">{{ $finance->payment->user->name }}</td>
                                            <td class="{{ (($loop->iteration % 2) == 0) ? '' : 'color-blue'}}">{{ $finance->payment->amount }} {{ $finance->payment->currency }}</td>
                                            <td class="{{ (($loop->iteration % 2) == 0) ? '' : 'color-blue'}}"><?= rtrim(sprintf('%.8F', $finance->btc_spent), '0') ?> BTC</td>
                                            <td class="{{ (($loop->iteration % 2) == 0) ? '' : 'color-blue'}}"><?= rtrim(sprintf('%.8F', $finance->btc_won), '0') ?> BTC</td>
                                            <td class="{{ (($loop->iteration % 2) == 0) ? '' : 'color-blue'}}"><?php
                                                echo (rtrim(sprintf('%.8F', $finance->btc_won - $finance->btc_spent), '0'));
                                            ?> BTC</td>
                                            <td class="{{ (($loop->iteration % 2) == 0) ? '' : 'color-blue'}}"><?=
                                                ($finance->btc_won == 0) ? '0%' : rtrim(sprintf('%.2F', (($finance->btc_won - $finance->btc_spent) / $finance->btc_won)*100) ,'0')
                                            ?>%</td>
                                            <td class="{{ (($loop->iteration % 2) == 0) ? '' : 'color-blue'}}">{{ date('d-m-Y H:i:s', strtotime($finance->created_at)) }}</td>
                                            <td class="{{ (($loop->iteration % 2) == 0) ? '' : 'color-blue'}}"><a href="/admin/finances/{{ $finance->id }}" class="btn btn-primary">Editar</a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td></td>
                                            <td>No hay finanzas en este momento.</td>
                                        </tr>
                                    @endforelse
                                </table>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reference">
                                  Procesar
                                </button>
                                <div class="modal fade" id="reference">
                                    <div class="modal-dialog modal-md">
                                      <div class="modal-content">
                                      
                                        <div class="modal-header">
                                          <h4 class="modal-title"></h4>
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        
                                        <div class="modal-body">
                                          <div class="col-md-12">
                                            <div class="modal-body">
                                              <div class="col-md-12">
                                                <div class="col-md-4 mt-1">
                                                <input id='btcwon' type="text" class="form-control" name="btcrate" placeholder="Tasa BTC">
                                              </div>
                                              <div class="col-md-4 mt-1">
                                                <input id='btcspent' type="text" class="form-control" name="btcrateves" placeholder="Tasa BTC ves">
                                              </div>
                                              <div class="col-md-4 mt-1">
                                                <input type="text" class="form-control" name="cfactor" placeholder="Factor de correción">
                                              </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        
                                        <div class="modal-footer">
                                          <button type="submit" class="btn btn-primary mt-1" onsubmit="alert('')">Procesar</button>
                                          <button type="button" class="btn btn-secondary mt-1" data-dismiss="modal">Cancelar</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                            </form>
                            Ganancias totales <?= rtrim(sprintf('%.8F', $winning), '0') ?> BTC
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection