<?php  
 session_start();  
 ?> 
<?php
$servername = 'localhost';
$dbname = 'tripcount';
$username = 'adrian';
$password = 'Hakantor';
 
try {
    $dbConn = new PDO("mysql:host={$servername};dbname={$dbname}", $username, $password);
    
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
}
 
?>
<?php
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    $name=$_POST['name'];
    $description=$_POST['description'];
    
    if(empty($name) || empty($description)) {    
            
        if(empty($name)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }
        
        if(empty($description)) {
            echo "<font color='red'>Age field is empty.</font><br/>";
        }     
    } else {    
        $sql = "UPDATE travels SET t_name=:name, t_description=:description WHERE id_travel=:id";
        $query = $dbConn->prepare($sql);
                
        $query->bindparam(':id', $id);
        $query->bindparam(':name', $name);
        $query->bindparam(':description', $description);
        $query->execute();
        header("Location: home.php");
    }
}
?>
<?php
$id = $_GET['id_travel'];
 
$sql = "SELECT * FROM travels WHERE id_travel=:id";
$query = $dbConn->prepare($sql);
$query->execute(array(':id' => $id));
 
while($row = $query->fetch(PDO::FETCH_ASSOC))
{
    $name = $row['t_name'];
    $description = $row['t_description'];
}
?>
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
    <title>Editar</title>
</head>
<body>
<?php include_once(dirname(__DIR__).'/Trip-Count/static/php/functions.php'); ?>
<?php include_once(dirname(__DIR__) . "/Trip-Count/static/header.php");?>
<div><?php systemMSG('info', 'Se te ha redirigido a la pagina de Editar Viaje');?></div>
<ul class="breadcrumb">
    <li><a href="index.php">Inicio</a></li>
    <li><a href="login.php">Login</a></li>
    <li><a href="home.php">Travels</a></li>
    <li>Edit Trip</li>
</ul>
  <div class="menu main-content">
          <div class="container">
              <div class="logo">Editar</div>
              <div class="loginitem">
          <form name="form1" method="post" action="edit_trip.php" class="form formlogin">
            <div class="formfield">
              <label class="user" for="loginemail"><span class="hidden"> <u>N</u>ombre</span></label>
              <input id="loginemail" type="text" class="forminput" name="name" placeholder="Nombre" accesskey="n" value="<?php echo $name;?>">
            </div>
            <div class="formfield">
              <label class="lock" for="loginpassword"><span class="hidden"> <u>D</u>escripcion</span></label>
              <input id="loginpassword" name="description" type="text" class="forminput" placeholder="Descripcion" accesskey="d" value="<?php echo $description;?>">
            </div>
            <div class="formfield">
              <input type="hidden" name="id" value=<?php echo $_GET['id_travel'];?>>
              <input type="submit" name="update" value="Update"> 
              <!--preguntar a xavi como subrayar la l de login para el acceso directo-->
              <span></span>
            </div>
          </form>
        </div>
      </div>
    </div>
      <?php include_once(dirname(__DIR__) . "/Trip-Count/static/footer.php");?>
  </body>
</html>