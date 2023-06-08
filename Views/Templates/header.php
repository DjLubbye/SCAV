<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="<?= SITE_CARSET ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?= get_favicon(); ?>
    <title><?= SITE_NAME ?></title>
    <!-- Instascan -->
    <script src="<?= JS ?>/instascan.min.js"></script>
    <script src="<?= JS ?>/vue.min.js"></script>
    <script src="<?= JS ?>/adapter.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
    <!-- phpqrcode -->

    <!-- Bootstrap -->
    <link href="<?= CSS ?>/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= FONTS ?>/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= CSS ?>/nprogress.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?= CSS ?>/custom.min.css" rel="stylesheet">
    <!--CSS datatable      -->
    <link href="<?= CSS ?>/datatables.min.css" rel="stylesheet">

    <!-- plugin alertas -->
    <link href="<?= PLUGINS ?>/noty/noty.css" rel="stylesheet">

    <!-- Mis estilos -->
    <link href="<?= ASSETS ?>/app/css/app.css" rel="stylesheet">

</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="<?= base_url ?>/Perfil" class="site_title"><i class="fa fa-expeditedssl"></i><span> System CDS</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="<?= IMG ?>img.jpg" alt="foto del perfil" class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Bienvenido:</span>
                            <!-<h2><?php echo $_SESSION['nombre']; ?></h2>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />
                    <?php
                    include_once "nav.php";
                    ?>