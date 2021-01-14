<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/edit_trip.css">
    <link rel="stylesheet" href="styles/main.css">
    <?php include_once(dirname(__DIR__).'/Trip-Count/static/php/functions.php'); ?>
    <link rel="icon" href="img/coin.png" type="image/png">
    <title>Edit Trip</title>
</head>
<body>
<?php include_once(dirname(__DIR__) . "/Trip-Count/static/header.php");?>
<div><?php systemMSG('info', 'Se te ha redirigido a la pagina de Edit Trip');
            systemMSG('warning', 'Esta pagina esta en construccion');?></div>
<ul class="breadcrumb">
    <li><a href="index.php">Inicio</a></li>
    <li><a href="login.php">Login</a></li>
    <li><a href="home.php">Home</a></li>
    <li>Edit Trip</li>
</ul>
<div class="main-content">
     <div class="container">
        <div></div>
        <div class="logo">Edit Trip</div>
        <div class="loginitem">
 <?php  
          session_start();  
          $host = "localhost";  
          $username = "adrian";  
          $password = "Hakantor";  
          $database = "tripcount";  
          $message = "";  
          try{
            $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

            if(isset($_POST['actualizar'])){
              $id=trim($_POST['id']);
              $nombres=trim($_POST['nombres']);
              $apellidos=trim($_POST['descripcion']);

              $consulta = "UPDATE travels SET `t_name`= :nombres, `t_description` = :descripcion WHERE `id_travel` = :id";
              $sql = $connect->prepare($consulta);
              $sql->bindParam(':nombres',$nombres,PDO::PARAM_STR, 25);
              $sql->bindParam(':description',$apellidos,PDO::PARAM_STR, 25);
              $sql->bindParam(':id',$id,PDO::PARAM_INT);
              $sql->execute();

              if($sql->rowCount() > 0){
                $count = $sql -> rowCount();
                echo "<div class='content alert alert-primary' > 
                OK: $count registro ha sido actualizado  </div>";
              }else{
                echo "<div class='content alert alert-danger'> No se pudo actulizar el registro  </div>";
                print_r($sql->errorInfo()); 
              }
              }
            }
            catch(PDOException $error){
              $message = $error->getMessage();
            }
            ?>
            
        <form action="" method="post" name="submit" class="form formlogin">
            <div class="formfield">
              <label class="user" for="Usuario"><span class="hidden"> Usuario</span></label>
              <input id="usuario" type="text" class="forminput" name="usuario" placeholder="Usuario">
            </div>
            <div class="formfield">
              <label class="lock" for="Descripcion"><span class="hidden">Descripcion</span></label>
              <input name="descripcion" type="text" class="form-control" id="descripcion" placeholder="Descripcion">

            </div>
            <div class="formfield">
              <input type="submit" name="submit" value="Edit" class="button">
              <span></span>
            </div>
          </form>
        </div>
      </div>
    </div>
      <?php include_once(dirname(__DIR__) . "/Trip-Count/static/footer.php");?>
  </body>
</html>
</div>
<?php include_once(dirname(__DIR__) . "/Trip-Count/static/footer.php");?>

</body>
</html>