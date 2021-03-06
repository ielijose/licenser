@extends('backend.layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('/assets/plugins/datatables/dataTables.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/plugins/datatables/dataTables.tableTools.css') }}">

@stop

@section('content')

<div id="main-content">
    @include('backend.layouts.alert')
    <div class="page-title"> <i class="icon-custom-left"></i>
        <h3 class="pull-left"><strong>Estudiantes</strong></h3>
        <a href="/estudiantes/create" class="btn btn-success pull-right m-t-10">Ingresar estudiante</a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading bg-blue">
                    <h3 class="panel-title"><strong>Listado</strong> de estudiantes</h3>

                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 table-responsive table-blue filter-right">

                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover table-dynamic">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>CI</th>                                                
                                        <th>Télefono</th>
                                        <th>Prestamos</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $key => $student)      
                                    <tr>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->ci }}</td>
                                        <td>{{ $student->phone }}</td>
                                        <td class="text-center">{{ count($student->prestamos)}}</td>
                                        <td><a href="/estudiantes/{{ $student->id }}" class="btn btn-info">Ver mas</a></td>
                                    </tr>
                                    @endforeach                                           

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

@stop

@section('javascript')
<script src="{{ asset('/assets/plugins/bootstrap-switch/bootstrap-switch.js') }}"></script>
<script src="{{ asset('/assets/plugins/bootstrap-progressbar/bootstrap-progressbar.js') }}"></script>
<script src="{{ asset('/assets/plugins/datatables/dynamic/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/datatables/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('/assets/plugins/datatables/dataTables.tableTools.js') }}"></script>
<script src="{{ asset('/assets/plugins/datatables/table.editable.js') }}"></script>
<script src="{{ asset('/assets/js/table_dynamic.js') }}"></script>
@stop