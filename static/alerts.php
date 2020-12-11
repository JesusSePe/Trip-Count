<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style><?php include_once(dirname(__DIR__).'/styles/alerts.css'); ?></style>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <?php include_once(dirname(__DIR__).'/static/php/functions.php'); ?>
</head>
<body> <!-- DOCUMENTO DE PRUEBAS -->
    <?php systemMSG('info', 'Se ordenado por la fecha de creacion')?>
    <?php systemMSG('warning', 'Se va a salir de la sesion')?>
    <?php systemMSG('success', 'Se ha registrado correctamente')?>
    <?php systemMSG('error', 'Contraseña mal introducida')?>
</body>
</html>

