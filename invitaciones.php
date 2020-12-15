<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/main.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <script src="static/js/functions.js"></script>
    <title>Invitaciones</title>
</head>
<body>
<?php include_once(dirname(__DIR__) . "/Trip-Count/static/header.php");?>
<?php $viaje = 'example'?>
<div class="main-content forminv">
    <h1><?php echo $viaje?></h1>
    <p>Introduce los correos para invitar a tus amigos:</p>
    <div">

        <div id="form" class="forminv">
            <form action="invitaciones.php" method="get">
                <input name="emails[]" type="email" placeholder="example@gmail.com">
            </div>
            <input class="button" type="submit">
        </form>
        <button onclick="crearInputInv()" id="emailsInv" class="button"><span>Añadir</span></button>
    </div>
</div>
<?
      print $_GET["emails"];
?>
<?php include_once(dirname(__DIR__) . "/Trip-Count/static/footer.php");?>

</body>
</html>