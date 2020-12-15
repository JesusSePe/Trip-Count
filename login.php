<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/login.css">
    <link rel="stylesheet" href="styles/main.css">
    <?php include_once(dirname(__DIR__).'/Trip-Count/static/php/functions.php'); ?>
  </head>
    <body>
    <?php include_once(dirname(__DIR__) . "/Trip-Count/static/header.php");?>
    <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["username"]) and isset($_POST["userPass"])) {
        $hostname = "localhost";
        $dbname = "tripcount";
        $username = "root";
        $pw = "";
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $pw);

        $_username = $_POST["username"];
        $_password = $_POST["userPass"];
          
        $query = $pdo->prepare("SELECT * FROM users WHERE uname = ? AND pwd = ?");
        $query->bindParam(1, $_username);
        $query->bindParam(2, $_password);
        $query->execute();
        $row = $query -> fetch();
        if ($row != false) {
          systemMSG('success', 'Usuario correcto'); //NO LO MUESTRA PORQUE SE PASA DIRECTAMENTE
          Redirect('home.php');
        } else {
          systemMSG('error', 'Usuario incorrecto');
        }
      }
     ?>
  <body>
    <?php include_once(dirname(__DIR__) . "/Trip-Count/static/header.php");?>
    <div class="menu main-content">
    <div class="container">
        <div></div>
        <div class="logo">LOGIN</div>
        <div class="loginitem">
          <form action="" method="post" class="form formlogin">
            <div class="formfield">
              <label class="user" for="loginemail"><span class="hidden"> Email</span></label>
              <input id="loginemail" type="text" class="forminput" name="username" placeholder="Email" required>
            </div>
            <div class="formfield">
              <label class="lock" for="loginpassword"><span class="hidden"> Password</span></label>
              <input id="loginpassword" name="userPass" type="password" class="forminput" placeholder="Password" required>
            </div>
            <div class="formfield">
              <input type="submit" value="Login" class="button">
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