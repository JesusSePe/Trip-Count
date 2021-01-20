<?php  
 session_start();  
 ?>  
<?php
            $hostname = "localhost";
            $dbname = "tripcount";
            $username = "adrian";
            $pw = "Hakantor";
            $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $pw);
            if(!$pdo){
                systemMSG('error', 'No se ha conectado a la base de datos!');
            }
            ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/register.css">
    <link rel="stylesheet" href="styles/main.css">
    <?php include_once(dirname(__DIR__).'/Trip-Count/static/php/functions.php'); ?>
    <link rel="icon" href="img/coin.png" type="image/png">
    <title>Payments</title>
</head>
<body>
<?php include_once(dirname(__DIR__).'/Trip-Count/static/php/functions.php'); ?>
<?php include_once(dirname(__DIR__) . "/Trip-Count/static/header.php");?>
<div><?php systemMSG('info', 'Se te ha redirigido a la pagina de payments');?></div>
<ul class="breadcrumb">
    <li><a href="index.php">Inicio</a></li>
    <li><a href="login.php">Login</a></li>
    <li><a href="home.php">Travels</a></li>
    <li>Payment</li>
</ul>
<?php
    foreach($_FILES["archivo"]['tmp_name'] as $key => $tmp_name)
    {
        if($_FILES["archivo"]["name"][$key]) {
            $filename = $_FILES["archivo"]["name"][$key];
            $source = $_FILES["archivo"]["tmp_name"][$key];
            $directorio = 'MultiFotos/';
            if(!file_exists($directorio)){
                mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");    
            }
            
            $dir=opendir($directorio);
            $target_path = $directorio.'/'.$filename;
            if(move_uploaded_file($source, $target_path)) { 
                echo "El archivo $filename se ha almacenado en forma exitosa.<br>";
                } else {    
                echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
            }
            closedir($dir);
        }
    }
?>
<div class="main-content">
    <div class="container">
        <div></div>
        <div class="logo">Payment</div>
        <div class="loginitem">
     <form name="form1" id="form1" action="" method="post" name="submit" class="form formlogin" enctype="multipart/form-data">
            <div class="formfield">
              <label class="user" for="loginuname"><span class="hidden"> Pago</span></label>
              <input id="loginuname" type="text" class="forminput" name="pago" placeholder="Dinero" required>
            </div>
            <div class="formfield">
              <label class="user" for="loginemail"><span class="hidden"> Users</span></label>
              <select name="users">
                <option value="0">Seleccione:</option>
                 <select name="lst_exam" id="lst_exam">
                    <?php
                    $query = $pdo->prepare("SELECT * FROM user_expenses");
                    $query->execute();
                    while ($row = $query->fetch()){
                        echo "<option>" . $row["id_user"] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <h4 class="text-center">Cargar Multiple Archivos</h4>
            <div class="form-group">
                <label class="col-sm-2 control-label">Archivos</label>
                <input type="file" class="form-control" id="archivo[]" name="archivo[]" multiple="">                            
                <button type="submit" class="btn btn-primary">Cargar</button>
            </div>
          </form>
        </div>
      </div>
</div>
<?php include_once(dirname(__DIR__) . "/Trip-Count/static/footer.php");?>

</body>
</html>
