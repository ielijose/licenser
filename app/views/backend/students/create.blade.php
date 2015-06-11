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
                <div class="panel-heading bg-green">
                    <h3 class="panel-title"><strong>Nuevo</strong> estudiante</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <form action="/estudiantes" method="post" id="student" class="form-horizontal" data-parsley-validate>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nombre:</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" data-parsley-minlength="1" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">CI:</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="ci" data-parsley-minlength="1" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Sección:</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="section" data-parsley-minlength="1" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Genero:</label>
                                    <div class="col-sm-10">
                                        <select name="gender" id="">
                                            <option value="male">Masculino</option>
                                            <option value="female">Femenino</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Dirección:</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="address" data-parsley-minlength="1" class="form-control" required>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Télefono:</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="phone" data-parsley-minlength="1" class="form-control" required>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Correo:</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="email" data-parsley-minlength="1" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-sm-9 col-sm-offset-3">
                                    <div class="pull-right">
                                        <a href="/estudiantes" class="btn btn-danger m-b-10">Cancelar</a>
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

@stop