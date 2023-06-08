<!doctype html>
<html lang="en">

<head>
    <?= get_favicon(); ?>
    <meta charset="<?= SITE_CARSET ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?= SITE_DESC ?>">
    <meta name="author" content="System-SCDS Control de Accesos">
    <meta name="generator" content="<?= SITE_VERSION ?>">
    <title><?= SITE_NAME ?></title>

    <link href="<?= CSS ?>/bootstrap.min.css" rel="stylesheet">
    <link href="<?= FONTS ?>/css/font-awesome.min.css" rel="stylesheet">
    <!-- plugin alertas -->
    <link href="<?= PLUGINS ?>/noty/noty.css" rel="stylesheet">

    <link href="<?= CSS ?>/signin.css" rel="stylesheet">
</head>
<!-- Logo central login -->

<body class="text-center">

    <form id="loginForm" method="POST" class="form-signin" novalidate>
        <img class="mb-4" src="<?= get_logo() ?>" alt="" width="180" height="180">


        <h1 class="h3 mb-3 font-weight-normal">Bienvenido </h1>

        <label for="email" class="sr-only">Correo</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Ingrese su correo" required autofocus>
        <br>
        <label for="password" class="sr-only">Contraseña</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Ingrese una contraseña" required>



        <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
        <p class="mt-5 mb-3 text-muted">&copy; Control de Seguridad 2022</p>

        <a href="<?= base_url ?>/Register">Registrate</a>

    </form>
    <script>
        const base_url = "<?php echo base_url; ?>";
    </script>
    <!-- plugin alertas javascript -->
    <script src="<?= PLUGINS ?>/noty/noty.min.js"></script>

    <script src="<?= ASSETS ?>/app/js/<?= $data['function_js']; ?>"></script>
</body>


</html>