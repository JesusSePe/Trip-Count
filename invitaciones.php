<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/main.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <script src="static/js/functions.js"></script>
    <?php include_once(dirname(__DIR__).'/TripCount/static/php/functions.php'); ?>
    <title>Invitaciones</title>
</head>
<body>
<?php include_once(dirname(__DIR__) . "/TripCount/static/header.php");?>
<?php $viaje = 'example'
//div para los systemMSG

?>

<div></div>
<div class="main-content forminv">
    <h1><?php echo $viaje?></h1>
    <p>Introduce los correos para invitar a tus amigos:</p>
    <div">
        <div class="forminv">
            <form action="invitaciones.php" method="get">
                <input name="emails[]" type="email" placeholder="example@gmail.com">
                <div id="form" class="forminv"></div>
            </div>
            <input class="button" type="submit">
        </form>
        <button onclick="crearInputInv()" id="emailsInv" class="button"><span>AÃ±adir</span></button>
    </div>
</div>
<?php
    //CONEXION A BD
    $hostname = "localhost";
    $dbname = "tripcount";
    $username = "tripcount";
    $pw = "password";
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $pw);
    if ($dbname !== 'tripcount') {
        systemMSG('error', 'Base de datos no encontrada');
    }
    
    $query = $pdo->prepare("SELECT * FROM `users`");
    $query->execute();
    //array para los correos que se les enviara correo de inv al viaje
    $inv = [];
    //array para los correos que se les enviara correo de registro
    $reg = [];
    if ( !empty($_GET["emails"]) && is_array($_GET["emails"]) ) {
        while($row = $query->fetch()){
            foreach ( $_GET["emails"] as $emails ) {
                if ($emails == $row['mail']) {
                    if (!in_array($emails, $inv)) {
                        array_push($inv, $emails) ;
                    }
                } else {
                    if (!in_array($emails, $reg)) {
                        array_push($reg, $emails) ;
                    }
                }
        }
        $count = 0;
            //elimina aquellos correos que estan en inv[] de $reg[] 
            foreach ($reg as $temp) {
                if (in_array($temp, $inv)) {
                    unset($reg[$count]);
                }
                $count += 1;
            } 
        }     
        

        $tituloInv = 'INVITACION A UN VIAJE NUEVO';
        $mensajeInv = 'Has sido invitado a ' . $viaje;
        $cabecerasInv  = 'MIME-Version: 1.0' . "\r\n";
        $cabecerasInv .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $cabecerasInv .= 'From: TripCount <TripCount@tripcount.dchcobra.cf>' . "\r\n";
        $para .= 'davidcasthen@gmail.com';
        foreach ($inv as $invitado) {
            mail($invitado, $tituloInv, $mensajeInv, $cabecerasInv);
            
        }
        $tituloReg = 'REGISTRATE A TripCount';
        $mensajeReg = 'Has de registrarte en TripCount para poder ser invitado' ;
        $cabecerasReg  = 'MIME-Version: 1.0' . "\r\n";
        $cabecerasReg .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $cabecerasReg .= 'From: TripCount <trip-count@mail.dchcobra.cf>' . "\r\n";
        foreach ($reg as $registrar) {
            mail($registrar, $tituloReg, $mensajeReg, $cabecerasReg);
            
        }
    }

?>
<?php include_once(dirname(__DIR__) . "/TripCount/static/footer.php");?>

</body>
</html>