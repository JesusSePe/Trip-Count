<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/register.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="icon" href="img/coin.png" type="image/png">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <title>Register</title>
</head>
<body>
<?php include_once(dirname(__DIR__).'/Trip-Count/static/php/functions.php'); ?>
<?php include_once(dirname(__DIR__) . "/Trip-Count/static/header.php");?>
<div><?php systemMSG('info', 'La pagina esta en produccion construccion ')?></div>
<ul class="breadcrumb">
      <li><a href="index.php">Inicio</a></li>
      <li>Register</li>
</ul>
<div class="menu main-content">
    <div class="container">
        <div></div>
        <div class="logo">REGISTER</div>
        <div class="loginitem">
<?php
$servername = "localhost";
$username = "adrian";
$password = "Hakantor";
$dbname = "tripcount";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }


    if(isset($_POST['submit'])){

    $user_name = $_POST['uname'];
    $user_pass = $_POST['pwd'];
    $user_passCon = $_POST['pwdcom'];
    $clave_cifrada = password_hash($user_pass, PASSWORD_DEFAULT, array("cost"=>15));

    $user_email = $_POST['mail'];

        if($user_name==''){
        echo "<script>alert('Please enter your name!')</script>";
        exit();
        }

        if($user_pass==''){
        echo "<script>alert('Please enter a password!')</script>";
        exit();
        }

        if($user_email==''){
        echo "<script>alert('Please enter your email!')</script>";
        exit();
        }

        if($user_pass!=$user_passCon){
        echo "<script>alert('The two passwords match')</script>";
        exit();
        }

    $stmt = $conn->prepare("SELECT * FROM users WHERE mail=?");
    $stmt->execute(array($user_email));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if(count($rows)>0){
        echo "<script>alert('Email $user_email already exist!')</script>";
        exit();
    }

    $query = "insert into users(`name`,`mail`,`pwd`) values (?,?,?)";
    $sql_query = $conn->prepare($query);
     if($sql_query->execute(array($user_name,$user_email,$clave_cifrada))){
      header("location:index.php");
    } 

    }
?>
          <form action="" method="post" name="submit" class="form formlogin">
            <div class="formfield">
              <label class="user" for="loginuname"><span class="hidden"> Usuario</span></label>
              <input id="loginuname" type="text" class="forminput" name="uname" placeholder="Usuario" required>
            </div>
            <div class="formfield">
              <label class="user" for="loginemail"><span class="hidden"> Email</span></label>
              <input id="loginemail" name="mail" type="text" class="forminput" placeholder="email" required>
            </div>
            <div class="formfield">
              <label class="lock" for="loginpassword"><span class="hidden"> Password</span></label>
              <input id="loginpassword" name="pwd" type="password" class="forminput" placeholder="Password" required>
            </div>
            <div class="formfield">
              <label class="lock" for="loginpassword"><span class="hidden"> Confirm Password</span></label>
              <input id="loginpassword" name="pwdcom" type="password" class="forminput" placeholder="Password" required>
            </div>
            <div class="formfield">
              <input type="submit" name="submit" value="Login" class="button">
              <span></span>
            </div>
          </form>
        </div>
      </div>
    </div>
      <?php include_once(dirname(__DIR__) . "/Trip-Count/static/footer.php");?>
  </body>
</html>