<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/login.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="icon" href="img/coin.png" type="image/png">
  </head>
  <body>
    <?php include_once(dirname(__DIR__).'/Trip-Count/static/php/functions.php'); ?>
    <?php include_once(dirname(__DIR__) . "/Trip-Count/static/header.php");?>
    <div><?php systemMSG('info', 'Se te ha redirigido al login')?></div>
    <ul class="breadcrumb">
      <li><a href="index.php">Inicio</a></li>
      <li>Login</li>
</ul>
          <?php  
          session_start();  
          $host = "localhost";  
<<<<<<< HEAD
          $username = "php";  
          $password = "Php_1c4J8";  

          $database = "tripcount";  
          $message = "";  
          try{
            $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            if(isset($_POST["submit"])){
              if(empty($_POST["mail"]) || empty($_POST["pwd"])){
                $message = systemMSG('info', 'All fields are required');}
                else{
                  $usernameEmail = $_POST["mail"];
                  $pwd = $_POST["pwd"];
                  $hash_password= hash("sha256", $pwd); //Password encryption
                  $query = "SELECT * FROM users WHERE mail = '$usernameEmail'  AND pwd = '$hash_password'";
                  $statement = $connect->prepare($query);
                  $statement->bindParam("mail", $usernameEmail) ;
                  $statement->bindParam("hash_password", $hash_password) ;
                  /*$statement->bindParam("pwd", $pwd) ;*/
                  $statement->execute(
                    array(
                      'mail'     =>     $_POST["mail"],
                      'pwd'     =>     $_POST["pwd"]
                    )
                  );
                  $row = $statement->fetch();
                  $count = $statement->rowCount();
                  if($count > 0)
                  { 
                    while ($row) {
                      $uname = $row["uname"];
                      $user_id = $row["id_user"];
                      $_SESSION["uname"] = $uname;
                      $_SESSION["user_id"] = $user_id;
                      $row = $statement->fetch();
                    }
                    /*$_SESSION["mail"] = $_POST["mail"];*/
                    header("location:home.php");

                  }
                  else
                  {
                    $message = systemMSG('error', 'Wrong Data');
                  }
                }
              }
            }
            catch(PDOException $error){
              $message = $error->getMessage();
            }
            ?>
            
          <div class="menu main-content">
          <div class="container">
              <div class="logo">LOGIN</div>
              <div class="loginitem">
          <form action="" method="post" class="form formlogin">
            <div class="formfield">
              <label class="user" for="loginemail"><span class="hidden"> <u>E</u>mail</span></label>
              <input id="loginemail" type="text" class="forminput" name="mail" placeholder="Email" accesskey="e" required>
            </div>
            <div class="formfield">
              <label class="lock" for="loginpassword"><span class="hidden"> <u>P</u>assword</span></label>
              <input id="loginpassword" name="pwd" type="password" class="forminput" placeholder="Password" accesskey="p" required>
            </div>
            <div class="formfield">
              <input type="submit" name="submit" value="Login" class="button" accesskey="l"> 
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

<?php
function Redirect($url, $permanent = false)
{
    sleep(3);
    header('Location: ' . $url, true, $permanent ? 301 : 302);

    exit();
}
?>