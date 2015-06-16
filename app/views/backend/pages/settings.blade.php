@extends('backend.layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('/assets/plugins/font-awesome-animation/font-awesome-animation.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/plugins/dropzone/dropzone.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/plugins/jcrop/jquery.Jcrop.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/profile.min.css') }}">
@stop

@section('content')

<div id="main-content">
    @include('backend.partials.alert')
    <div class="row">
        <div class="col-md-12">
            <form action="/settings" method="post" class="form-horizontal" role="form" id="settings">
                <!-- BEGIN TABS -->
                <div class="tabbable tabbable-custom form">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#payments" data-toggle="tab">Pagos</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="space20"></div>


                        <div class="tab-pane active" id="payments">
                            <div class="row profile">
                                <div class="col-md-12">

                                    <div class="row profile-classic">
                                        <div class="col-md-12">
                                            <div class="panel">
                                                <div class="panel-title line">
                                                    <div class="caption"><i class="fa fa-dollar c-gray m-r-10"></i> PayPal</div>
                                                </div>
                                                <div class="panel-body">


                                                    <div class="row">
                                                        <div class="control-label col-md-3">Client ID:</div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" name="paypal_client-id" value="{{ Setting::key('paypal_client-id')->first()->value }}">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="control-label col-md-3">Secret:</div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" name="paypal_secret" value="{{ Setting::key('paypal_secret')->first()->value }}">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="control-label col-md-3"></div>
                                                        <div class="col-md-6">
                                                            <label>
                                                                {{ Form::radio('paypal_mode', 'sandbox', (Setting::key('paypal_mode')->first()->value == 'sandbox')) }} Sandbox
                                                            </label>

                                                            <label>
                                                                {{ Form::radio('paypal_mode', 'live', (Setting::key('paypal_mode')->first()->value == 'live')) }} Live
                                                            </label>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="control-label col-md-3">Costo plugin:</div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" name="plugin_cost" value="{{ Setting::key('plugin_cost')->first()->value }}">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-12">
                                        <div class="align-center">
                                            <button class="btn btn-primary m-r-20 save-profile">Guardar</button>
                                            <a href="/" class="btn btn-default">Cancelar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--END TABS-->
            </form>
        </div>
    </div>



    <div class="modal fade" id="modal-view" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="#">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel"><strong>Recortar imagen</strong> </h4>
                    </div>
                    <div class="modal-body ">

                        <div class="row">
                            <div class="col-md-12 text-center" id="image-body">

                            </div>
                        </div>

                    </div>
                    <input type="hidden" id="x" name="x" />
                    <input type="hidden" id="y" name="y" />
                    <input type="hidden" id="w" name="w" />
                    <input type="hidden" id="h" name="h" />
                    <div class="modal-footer text-center">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="save-crop">Recortar y guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>

@stop

@section('javascript')
<script src="{{ asset('/assets/plugins/dropzone/dropzone.min.js') }}"></script>
<script src="{{ asset('/assets/js/animations.js') }}"></script>

<script src="{{ asset('/assets/plugins/jcrop/jquery.Jcrop.min.js') }}"></script>

<script type="text/javascript">
$(document).on("ready", function() {
    $("#avatar, #avatar figcaption, #avatar p").dropzone({
        url: "/dashboard/logo",
        createImageThumbnails: false,
        init: function() {
            this.on("success", function(file) {
                $.get('/dashboard/logo', function(data) {
                   $("#avatar img").prop('src', data.logo + '?nocahe=' + Math.random());
                   $("a.navbar-brand").css('background', "url('"+data.logo + '?nocahe=' + Math.random()+"') no-repeat center");
               }, 'json');
            });

            this.on("addedfile", function(file) {
                $(".font-animation").css('display', 'inline-block');
            });

            this.on("complete", function(file) {
                $(".font-animation").css('display', 'none');
            });

            this.on("addedfile", function(file, uploadprogress) {
                console.log(uploadprogress);
            });
        }
    });

    /* RELAOD */
    var hash = window.location.hash;
    hash && $('ul.nav a[href="' + hash + '"]').tab('show');



    $('.nav-tabs a').click(function (e) {
        $(this).tab('show');
        var scrollmem = $('body').scrollTop();
        window.location.hash = this.hash;
        $('html,body').scrollTop(scrollmem);
    });


});
</script>
@stop