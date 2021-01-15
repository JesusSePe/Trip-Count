<?php  
 session_start();  
 ?>  
<!DOCTYPE html>
<html lang="es">
<?php
    $hostname = "localhost";
    $dbname = "tripcount";
    $username = "php";
    $pw = "Php_1c4J8";
    try {
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $pw);
    } catch (PDOException $e){
        echo $e->getMessage();
    }
    if ($pdo == null) {
        echo('error: Base de datos no encontrada');
    }
    // Query to get currency ID
    $cur = $_GET['currency']; 
    $stmt = $pdo->prepare("SELECT id_currency FROM currency WHERE code = :cur LIMIT 1");
    $stmt->bindParam(':cur', $cur);
    $stmt->execute();
    $stmt_result = $stmt-> fetch(PDO::FETCH_OBJ);
    foreach ($stmt_result as $result){
    $curid = strval($result);
}

    // Query to add new travel to database
    $insert = $pdo->prepare("INSERT INTO travels (t_name, t_description, t_creation, t_update, id_currency) VALUES (:nombre, :desc, :date, :date, :cur)");
    $nombre = $_GET['Nombre'];
    $desc = $_GET['Descripcion'];
    $date = date("Y-m-d");
    $insert->bindParam(':nombre', $nombre);
    $insert->bindParam(':desc', $desc);
    $insert->bindParam(':date', $date);
    $insert->bindParam(':cur', $curid);
    $insert->execute();
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/main.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="icon" href="img/coin.png" type="image/png">
    <script src="static/js/functions.js"></script>
    <?php include_once(dirname(__DIR__).'/Trip-Count/static/php/functions.php'); ?>
    <title>Invitaciones</title>
</head>
<body>
<?php include_once(dirname(__DIR__) . "/Trip-Count/static/header.php");?>

<?php $viaje = $_GET['Nombre'];

//div para los systemMSG

 
?>

<div><?php systemMSG('success', 'se ha creado el viaje ' . $_GET['Nombre'])?></div>

<?php
    //CONEXION A BD
    $hostname = "localhost";
    $dbname = "tripcount";
    $username = "php";
    $pw = "Php_1c4J8";
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
        $mensajeInv = 'Has sido invitado a un viaje';
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
        Redirect('home.php');
    }

?>
<div class="main-content forminv">
    <h1><?php echo 'Viaje ' . $viaje?></h1>
    <p>Introduce los correos para invitar a tus amigos:</p>
    <div">
        <div class="forminv">
            <form action="invitaciones.php" method="get">
                <input name="emails[]" type="email" placeholder="example@gmail.com">
                <div id="form" class="forminv"></div>
            </div>
            <input class="button" type="submit">
        </form>
        <button onclick="crearInputInv()" id="emailsInv" class="button"><span>Anadir</span></button>
        <button onclick="eliminarInputInv()" id="emailsInvDel" class="button"><span>Eliminar</span></button>
    </div>
</div>
<?php include_once(dirname(__DIR__) . "/Trip-Count/static/footer.php");?>
<?php
function Redirect($url, $permanent = false)
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);

    exit();
}
?>
</body>
</html>