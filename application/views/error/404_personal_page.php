<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en"> <!--<![endif]-->

<head>
    <meta charset="utf-8" />
    <title>404 No encontrado</title>
    <meta name="author" content="Starlglob Soluciones Informaticas" />
    <meta name="keywords" content="pagina 404, mono, css3, html5" />
    <meta name="description" content="404 - Pagina No Encontrada" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    
    <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    
    <!-- Libs CSS -->
    <!--<link type="text/css" media="all" href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />-->
    <!-- Template CSS -->
    <link type="text/css" media="all" href="<?= base_url() ?>css/style_error.css" rel="stylesheet" />
    <!-- Responsive CSS -->
    <link type="text/css" media="all" href="<?= base_url() ?>css/respons_error.css" rel="stylesheet" />

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="144x144" href="<?= base_url() ?>dist/error/favicon144x144.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="<?= base_url() ?>dist/error/favicon114x114.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="<?= base_url() ?>dist/error/favicon72x72.png" />
    <link rel="apple-touch-icon" href="<?= base_url() ?>dist/error/favicon57x57.png" />
    <link rel="shortcut icon" href="<?= base_url() ?>dist/error/favicon.png" />
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>

</head>
<body>

    <!-- Load page -->
    <div class="animationload">
        <div class="loader">
        </div>
    </div>
    <!-- End load page -->


    <!-- Content Wrapper -->
    <div id="wrapper">
        <div class="container">
            <div class="col-xs-12 col-sm-7 col-lg-7">
                <!-- Info -->
                <div class="info">
                    <h1>404</h1>
                    <h2>P&aacute;gina no encontrada</h2>
                    <p>La p&aacute;gina que est&aacute;s buscando ha sido movida, eliminada, renombrada o quiz&aacute; nunca existi&oacute;</p>
                    <a href="<?= base_url() ?>" class="btn">Pagina Principal</a>
                    <!--<a href="#" class="btn btn-brown">Contact Us</a>-->
                </div>
                <!-- end Info -->
            </div>

            <div class="col-xs-12 col-sm-5 col-lg-5 text-center">
                <!-- Monkey -->
                <div class="monkey">
                    <img src="<?= base_url() ?>dist/error/mono.gif" alt="Mono" />
                </div>
                <!-- end Monkey -->
            </div>

        </div>
        <!-- end container -->
    </div>
    <!-- end Content Wrapper -->


    <!-- Scripts -->
    <!--<script src="assets/js/jquery-2.1.1.min.js" type="text/javascript"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
    <!--<script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>-->
    <script src="<?= base_url() ?>js/modernizr.custom_error_page.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>js/jquery.nicescroll_error_page.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>js/scripts_error_page.js" type="text/javascript"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</body>
</html>