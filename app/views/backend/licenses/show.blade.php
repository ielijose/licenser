@extends('backend.layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('/assets/plugins/magnific/magnific-popup.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/plugins/datatables/dataTables.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/plugins/datatables/dataTables.tableTools.css') }}">
<link rel="stylesheet" href="{{ asset('/frontend/assets/css/iconos.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/plugins/jnotify/jNotify.jquery.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/plugins/dropzone/dropzone.css') }}">

<style>
[class^="icon-"], [class*=" icon-"] {
    font-size: 30px;
}
</style>
@stop

@section('content')
<div id="main-content">
    <div class="page-title">
        <i class="icon-custom-left"></i>
        <h3>{{ $license->name }}</h3>
        <br>

        @include('backend.layouts.alert')

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tabcordion">
                <ul id="myTab" class="nav nav-tabs">
                    <li class="active"><a href="#general" data-toggle="tab">Datos</a></li>

                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="general">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="/libros/update/{{ $license->id }}" method="POST" id="license-update" class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Título:</label>
                                        <div class="col-sm-7">
                                            <input type="text" name="name" class="form-control" value="{{ $license->name }}" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Licencia:</label>
                                        <div class="col-sm-7">
                                            <textarea name="" id="license" cols="30" rows="3" class="form-control" disabled> {{ $license->license }} </textarea>
                                        </div>
                                        <div class="col-sm-2">
                                            <button id="copy" type="button" class="btn btn-primary" data-clipboard-text="Copy Me!" title="Click to copy me."> <span class="fa fa-clipboard"></span> Copiar</button>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Status:</label>
                                        <div class="col-sm-7">
                                            {{ $license->getStatus() }}
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
    <div class="row">
        <div class="col-md-12 m-t-20 m-b-40 align-center">
            <a href="/licenses" class="btn btn-default m-r-10 m-t-10"><i class="fa fa-reply"></i> Volver</a>
            <a href="/licenses/delete/{{ $license->id }}" class="btn btn-danger delete-ad m-r-10 m-t-10"><i class="fa fa-times"></i> Eliminar</a>
        </div>
    </div>



</div>

@stop

@section('javascript')

<script src="{{ asset('/assets/plugins/magnific/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/bootstrap-switch/bootstrap-switch.js') }}"></script>
<script src="{{ asset('/assets/plugins/bootstrap-progressbar/bootstrap-progressbar.js') }}"></script>
<script src="{{ asset('/assets/js/ecommerce.js') }}"></script>
<script src="{{ asset('/assets/plugins/zeroclipboard/dist/ZeroClipboard.min.js') }}"></script>

<script>
"use strict";
(function(){

    $(".delete-ad").on('click', function(event) {
        event.preventDefault();

        if (confirm("Desea eliminar la licencia? \nNo se puede revertir.")) {
            location.href = $(this).attr('href');
        }
    });

    // main.js
    var client = new ZeroClipboard( document.getElementById("copy") );

    client.on( "ready", function( readyEvent ) {

        client.on( "copy", function( event ) {
            client.setData("text/plain", $("#license").val());
        });

        client.on( "aftercopy", function( event ) {
            $("#copy").text('Copiado!...');
        });
    } );
})();

</script>

@stop