@extends('backend.layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('/assets/plugins/wizard/wizard.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/plugins/jquery-steps/jquery.steps.css') }}">

<link href="{{ asset('/assets/plugins/datetimepicker/jquery.datetimepicker.css') }}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/pickadate/themes/default.css') }}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/pickadate/themes/default.date.css') }}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/pickadate/themes/default.time.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('/frontend/assets/css/iconos.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/plugins/dropzone/dropzone.css') }}">
<style>
[class^="icon-"], [class*=" icon-"] {
    font-size: 30px;
}

div#dropzone{
    text-align: center;
    border: 2px dashed #555;
    height: 350px;
}
div#dropzone:hover{
    background-color: #ddd;
}
</style>
@stop

@section('content')

<div id="main-content">
    <div class="row">
        <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading bg-blue">
                            <h3 class="panel-title"><strong>Ingresar</strong> libro</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">

                                    <form action="/libros" method="post" id="book" class="form-horizontal" data-parsley-validate>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Título:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name" data-parsley-minlength="1" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Autor: </label>
                                            <div class="col-sm-9">
                                                <input type="text" name="author" data-parsley-minlength="1" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Código:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="code" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-9 col-sm-offset-3">
                                            <div class="pull-right">
                                                <button type="submit" class="btn btn-primary m-b-10">Guardar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
</div>

