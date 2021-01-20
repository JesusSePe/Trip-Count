<?php  
 session_start();  
 ?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/enter_payment.css">
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
<div class="main-content">
    <div>
     <form name="MiForm" id="MiForm" method="post" action="enter_payments.php" enctype="multipart/form-data">
        <h4 class="text-center">Seleccione imagen a cargar</h4>
        <div class="form-group">
          <label class="col-sm-2 control-label">Archivos</label>
          <div class="col-sm-8">
            <input type="file" class="form-control" id="image" name="image" multiple>
          </div>
          <button name="submit" class="btn btn-primary">Cargar Imagen</button>
        </div>
      </form>
    </div>
    <?php
if(isset($_POST["submit"])){
    $revisar = getimagesize($_FILES["image"]["tmp_name"]);
    if($revisar !== false){
        $image = $_FILES['image']['tmp_name'];
        $imgContenido = addslashes(file_get_contents($image));
        
        $Host = 'localhost';
        $Username = 'root';
        $Password = '';
        $dbName = 'tripcount';
        
        $db = new mysqli($Host, $Username, $Password, $dbName);
        
        if($db->connect_error){
            die("Connection failed: " . $db->connect_error);
        }
        
        
        //Insertar imagen en la base de datos
        $insertar = $db->query("INSERT into images_tabla (imagenes, creado) VALUES ('$imgContenido', now())");
        if($insertar){
            echo "Archivo Subido Correctamente.";
        }else{
            echo "Ha fallado la subida, reintente nuevamente.";
        } 
    }else{
        echo "Por favor seleccione imagen a subir.";
    }
}
?>
     
    <div class="container">
        <div></div>
    <form class="form" action="/enter_payments.php" method="post">
         <div class="loginitem">
            <div class="logo">Payment</div>
            </div>
  <div class="container">
    <label for="uname"><b>Precio</b></label>
    <input type="number" placeholder="Pago" name="uname" required>
    <br>
    <br>
    <label for="select"><b>Invitados</b></label>
    <select name="users">
        <option value="0">Seleccione:</option>
            <select name="lst_exam" id="lst_exam">
                <?php
                $query = $pdo->prepare("SELECT * FROM user_expenses");
                $query->execute();
                while ($row = $query->fetch()){
                    echo "<option>" . $row["id_user"] . "</option>";
                }?>
            </select>
        
    <button type="submit">Login</button>
  </div>

  <div class="container">
    <button type="button" class="avanzado">Pago Avanzado</button>
  </div>
</form>

        </div>
      </div>
</div>
<?php include_once(dirname(__DIR__) . "/Trip-Count/static/footer.php");?>

</body>
</html>
