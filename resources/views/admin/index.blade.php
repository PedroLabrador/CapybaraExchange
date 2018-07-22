@extends('layouts.admin')
@section('content')
	<div class="container">
        <div class="row">
            <div class="col-md-11" style="margin: 3%;">
                <div class="panel">
                    <div class="panel-header"></div>

                    <div class="panel-body">
                        <form>
                            <div class="col-md-10 col-md-offset-1">
                                <div class="col-md-10 col-md-offset-1 mt-1">
                                    <input class='form-control' type="text" name="amount1">
                                </div>
                                <div class="col-md-10 col-md-offset-1 mt-1">
                                    <input class='form-control' type="text" name="amount2">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection