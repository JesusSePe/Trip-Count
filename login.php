<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="styles/login.css">
  </head>
<?php
      if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["username"]) and isset($_POST["userPass"])) {
        $hostname = "localhost";
        $dbname = "Usuarios";
        $username = "adrian";
        $pw = "Hakantor";
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $pw);

        $_username = $_POST["username"];
        $_password = $_POST["userPass"];
          
        $query = $pdo -> prepare("SELECT * FROM usuarios WHERE usuario = ? AND password = ?");
        $query->bindParam(1, $_username);
        $query->bindParam(2, $_password);
        $query->execute();
        $row = $query -> fetch();
        if ($row != false) {
          echo "<p class='success'>Entraste</p>";
        } else {
          echo "<p class='fail'>ERROR</p>";
        }
      }
     ?>
  <body>
    <?php include_once(dirname(__DIR__) . "/Trip-Count/static/header.php");?>
    <div class="menu">
    <div class="container">
        <div></div>
        <div class="logo">LOGIN</div>
        <div class="loginitem">
          <form action="" method="post" class="form formlogin">
            <div class="formfield">
              <label class="user" for="loginemail"><span class="hidden">Email</span></label>
              <input id="loginemail" type="text" class="forminput" name="username" placeholder="Email" required>
            </div>
            <div class="formfield">
              <label class="lock" for="loginpassword"><span class="hidden">Password</span></label>
              <input id="loginpassword" name="userPass" type="password" class="forminput" placeholder="Password" required>
            </div>
            <div class="formfield">
              <input type="submit" value="Login">
            </div>
          </form>
        </div>
      </div>
    </div>
      <?php include_once(dirname(__DIR__) . "/Trip-Count/static/footer.php");?>
  </body>
</html>