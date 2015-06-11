@extends('backend.layouts.master')

@section('css')
<link href="/assets/plugins/datetimepicker/jquery.datetimepicker.css" rel="stylesheet">
<link href="/assets/plugins/pickadate/themes/default.css" rel="stylesheet">
<link href="/assets/plugins/pickadate/themes/default.date.css" rel="stylesheet">
<link href="/assets/plugins/pickadate/themes/default.time.css" rel="stylesheet">
@endsection

@section('content')

<div id="main-content" class="dashboard">
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                            <h2>Hola {{ Auth::user()->name() }}!, Bienvenido a Licenser.</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="panel no-bd bd-9 panel-stat">
                    <div class="panel-body bg-dark">
                        <div class="icon"><i class="fa fa-barcode"></i>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="stat-num">{{ count(License::all()) }}</div>
                                <a href="/licenses"><h3>Licencias</h3></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="panel no-bd bd-9 panel-stat">
                    <div class="panel-body bg-blue">
                        <div class="icon"><i class="fa fa-user"></i>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="stat-num"> {{ count(User::all()) }} </div>
                                <a href="/users"><h3>Usuarios</h3></a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


    </div>

@endsection

@section('javascript')

<script src="{{ asset('assets/plugins/metrojs/metrojs.min.js') }}"></script>

<script src="{{ asset('assets/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>
<script src="{{ asset('assets/js/dashboard.angular.js') }}"></script>


<script src="{{ asset('assets/plugins/bootstrap-switch/bootstrap-switch.js')}}"></script>
<script src="{{ asset('assets/plugins/bootstrap-progressbar/bootstrap-progressbar.js')}}"></script>

@stop

