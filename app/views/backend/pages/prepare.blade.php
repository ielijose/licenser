<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js sidebar-large lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js sidebar-large lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js sidebar-large lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js sidebar-large">
<!--<![endif]-->

<head>
    <!-- BEGIN META SECTION -->
    <meta charset="utf-8">
    <title>{{ Setting::key('app_name')->first()->value }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="" name="description" />
    <meta content="themes-lab" name="author" />
    <!-- END META SECTION -->
    <!-- BEGIN MANDATORY STYLE -->
    <link href="/assets/css/icons/fontawesome/font-awesome.css" rel="stylesheet">
    <link href="/assets/css/icons/flaticons/flaticon.css" rel="stylesheet">
    <link href="/assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/style-frontend.css" rel="stylesheet">
    <!-- END  MANDATORY STYLE -->
    <script src="/assets/plugins/modernizr/modernizr-2.6.2-respond-1.1.0.min.js"></script>
</head>

<body>
    <!-- BEGIN PRELOADER -->
    <section class="preloader">
        <div id="loading-animation">
            <ul class="spinner">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </section>
    <!-- END PRELOADER -->

    <section class="section-top">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="align-center">
                        <i class="glyph-icon flaticon-shopping102 fa-5x m-b-20"></i>
                        <h1 class="slogan">Ya Casi Terminas</h1>
                        <p>Por favor confirma tu compra con los siguientes datos:</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white">
        <div class="container">
            <div class="row">
                <div class="span12 p-t-10 p-b-40">
                    <div id="testimonials" class="owl-carousel">
                        <div class="item">
                            <div class="col-md-6  col-md-offset-3">

<form action="/payment" method="post" accept-charset="utf-8">


                                <p class="text">
                                    <strong></strong>
                                    <br> Se debitará de tu cuenta el monto de: <strong>{{ Setting::key('plugin_cost')->first()->value }} U$D</strong>
                                    <br>
                                    <br>

                                    Ingresa el correo electronico donde deseas recibir la licencia:

                                        <input type="email" class="form-control" placeholder="yo@dominio.com" name="email" required>



                                        <button type="submit" class="btn btn-blue pull-right m-t-10"><i class="fa fa-dollar m-r-10"></i> Comprar Ahora</button>
                                        </p>

                                        </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BEGIN PRICING TABLE ->
    <section id="section-pricing" class="section appear clearfix">
        <div class="container">
            <div class="row">

                <div class="col-sm-4 col-sm-offset-4">
                    <div class="panel panel-default text-center border-blue">
                        <div class="panel-heading tile-hot">


                            <h3>{{ Setting::key('app_name')->first()->value }}</h3>
                            <h3 class="panel-title price"></h3>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item">Con un registro de ${{ Setting::key('payment_register-cost')->first()->value }}</li>

                            <li class="list-group-item m-b-20">


                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- END PRICING TABLE -->
    <input type="hidden" id="uid" value="{{ Input::get('ref') }}">
    <!-- BEGIN FOOTER -->

    <a href="#header" class="scrollup"><i class="fa fa-chevron-up"></i></a>
    <!-- END FOOTER -->
    <!-- BEGIN MANDATORY SCRIPTS -->
    <script src="/assets/plugins/jquery-1.11.js"></script>
    <script src="/assets/plugins/bootstrap.min.js"></script>
    <script src="/assets/plugins/owl-carousel/owl.carousel.min.js"></script>
    <script src="/assets/plugins/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="/assets/plugins/skrollr/skrollr.min.js"></script>
    <script src="/assets/plugins/jquery-scrollto/jquery.scrollTo-1.4.3.1-min.js"></script>
    <script src="/assets/plugins/jquery-appear/jquery.appear.js"></script>
    <!-- END MANDATORY SCRIPTS -->
    <script src="/assets/js/main.js"></script>
</body>

</html>