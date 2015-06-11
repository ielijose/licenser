@extends('backend.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/assets/plugins/datatables/dataTables.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/plugins/datatables/dataTables.tableTools.css') }}">

@stop

@section('content')
<div id="main-content">

    @include('backend.layouts.alert')
    <div class="page-title"> <i class="icon-custom-left"></i>
        <h3 class="pull-left"><strong>Licencias</strong></h3>
        <a href="#" class="btn btn-success pull-right m-t-10 create">Generar Licencia</a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading bg-blue">
                    <h3 class="panel-title"><strong>Listado</strong> de licencias</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 table-responsive table-blue filter-right">

                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover table-dynamic no-sort">
                                <thead>
                                    <tr>
                                        <th>Título</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($licenses as $key => $license)
                                    <tr>
                                        <td>{{ $license->name }}</td>
                                        <td> {{ $license->getStatus(); }} </td>
                                        <td><a href="/licenses/{{ $license->id }}" class="btn btn-info">Ver mas</a></td>
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

    <div class="modal fade" id="modal-create" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="/licenses" method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel"><strong>Generar Licencia</strong> </h4>
                    </div>
                    <div class="modal-body ">

                        <div class="row" align="center">
                            <label class="control-label col-xs-3">Titulo:</label>
                            <div class="col-xs-9">
                                <input class="form-control" type="text" name="name" placeholder="SWM License"></input>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer text-center">
                        <button type="submit" class="btn btn-primary">Generar</button>
                    </div>
                </form>
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

    <script>
        $(document).on("ready", function(){
            $(".create").on("click", function(){
                $("#modal-create").modal();
            });
        });
    </script>
@stop