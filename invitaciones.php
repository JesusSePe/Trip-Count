<?php  
 session_start();  
 ?>  
<!DOCTYPE html>
<html lang="es">
<?php
    $hostname = "localhost";
    $dbname = "tripcount";
    $username = "root";
    $pw = "";
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

    // Add user to travel
    $insert_user = $pdo->prepare("INSERT INTO users_travels (id_travel, id_user) VALUES ((SELECT id_travel FROM travels WHERE t_name = :nombre AND t_description = :desc), :id)");
    $insert_user->bindParam(':nombre', $nombre);
    $insert_user->bindParam(':desc', $desc);
    $insert_user->bindParam(':id', $_SESSION['user_id']);
    $insert_user->execute();
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
<ul class="breadcrumb">
    <li><a href="index.php">Inicio</a></li>
    <li><a href="login.php">Login</a></li>
    <li><a href="home.php">Travels</a></li>
    <li>Invitation</li>
</ul>
<?php
    //CONEXION A BD
    $hostname = "localhost";
    $dbname = "tripcount";
    $username = "root";
    $pw = "";
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
        $mensajeInv = 'HAS SIDO INVITADO A UN VIAJE EN TRIPCOUNT
        Has sido invitado a un viaje en la plataforma TripCount.
        Para unirte inicia sesion en nuestra plataforma de
        TripCount ves a https://tripcount.dchcobra.cf/login.php y inicia sesion para poder ver el viaje.
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>Mi Plantilla para Mailing</title>
            </head>
            <body>
                <table bgcolor="#EEF3F6" cellspacing="1" cellpadding="3" width="600">
                    <tr>
                        <td width="600" style="text-align: center; color: #FF9000;"><h1>INICIA SESION EN TRIPCOUNT</h1> </td>
                    </tr>
                    <tr>
                        <td><hr width=500></td>
                    </tr>
                    <tr>
                        <td width="400" style="text-align:center">
                            <h4>Has sido invitado a un viaje en la plataforma TripCount.<br/>
                                Para unirte al viaje inicia sesion en nuestra plataforma de<br/>
                                TripCount dandole click en el boton de abajo
                            </h4>
                        </td>
                    </tr>
                    <tr>
                        <td style="height: 1rem;"></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;"><a style="text-decoration: none; background-color: #333334; color:white; padding:1rem;" href="https://tripcount.dchcobra.cf/login.php" class="button">INICIA SESION!</a></td>
                    </tr>
                    <tr>
                        <td style="height: 2rem;"></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;"><img width="225px" height="200px" src="https://tripcount.dchcobra.cf/img/tripcount.png" alt="TripCount"></td>
                    </tr>
                    <tr>
                        <td style="height: 2rem;"></td>
                    </tr>
                </table>
            </body>
        </html>' ;
        $cabecerasInv  = 'MIME-Version: 1.0' . "\r\n";
        $cabecerasInv .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $cabecerasInv .= 'From: TripCount <TripCount@tripcount.dchcobra.cf>' . "\r\n";
        $para .= 'davidcasthen@gmail.com';
        foreach ($inv as $invitado) {
            mail($invitado, $tituloInv, $mensajeInv, $cabecerasInv);
        }
        $tituloReg = 'REGISTRATE A TripCount';
        $mensajeReg = 'REGISTRATE EN TRIPCOUNT
        Has sido invitado a un viaje en la plataforma TripCount.
        Para unirte al viaje registrate en nuestra plataforma de
        TripCount ves a https://tripcount.dchcobra.cf/register.php y registrate para poder acceder al viaje.
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>Mi Plantilla para Mailing</title>
            </head>
            <body>
                <table bgcolor="#EEF3F6" cellspacing="1" cellpadding="3" width="600">
                    <tr>
                        <td width="600" style="text-align: center; color: #FF9000;"><h1>REGISTRATE EN TRIPCOUNT</h1> </td>
                    </tr>
                    <tr>
                        <td><hr width=500></td>
                    </tr>
                    <tr>
                        <td width="400" style="text-align:center">
                            <h4>Has sido invitado a un viaje en la plataforma TripCount.<br/>
                                Para unirte al viaje registrate en nuestra plataforma de<br/>
                                TripCount dandole click en el boton de abajo
                            </h4>
                        </td>
                    </tr>
                    <tr>
                        <td style="height: 1rem;"></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;"><a style="text-decoration: none; background-color: #333334; color:white; padding:1rem;" href="https://tripcount.dchcobra.cf/register.php" class="button">REGISTRATE!</a></td>
                    </tr>
                    <tr>
                        <td style="height: 2rem;"></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;"><img width="225px" height="200px" src="https://tripcount.dchcobra.cf/img/tripcount.png" alt="TripCount"></td>
                    </tr>
                    <tr>
                        <td style="height: 2rem;"></td>
                    </tr>
                </table>
            </body>
        </html>' ;
        $cabecerasReg  = 'MIME-Version: 1.0' . "\r\n";
        $cabecerasReg .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $cabecerasReg .= 'From: TripCount <trip-count@mail.dchcobra.cf>' . "\r\n";
        foreach ($reg as $registrar) {
            mail($registrar, $tituloReg, $mensajeReg, $cabecerasReg);
        }
        Redirect('home.php');

        //insert to database
        if(isset($_POST['submit'])){

            $user_name = $_POST['name'];
            $user_pass = $_POST['pwd'];
            $user_passCon = $_POST['pwdcom'];
            $clave_cifrada = password_hash($user_pass, PASSWORD_DEFAULT, array("cost"=>15));
        
            $user_email = $_POST['mail'];
        
            $stmt = $conn->prepare("SELECT * FROM users WHERE mail=?");
            $stmt->execute(array($user_email));
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
          if(count($rows)>0){
                echo "<script>alert('Email $user_email already exist!')</script>";
                exit();
            }
        
            $query = "insert into invitations(`name`,`mail`,`pwd`) values (?,?,?)";
            $sql_query = $conn->prepare($query);
             if($sql_query->execute(array($user_name,$user_email,$clave_cifrada))){
              header("location:index.php");
            } 
        
            }

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
            <input class="button" type="submit" accesskey="e">
        </form>
        <button onclick="crearInputInv()" id="emailsInv" class="button" accesskey="a"><span><u>A</u>nadir</span></button>
        <button onclick="eliminarInputInv()" id="emailsInvDel" class="button" accesskey="E"><span><u>E</u>liminar</span></button>
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