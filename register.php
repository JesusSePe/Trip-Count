<?php
  $servername = "localhost";
  $username = "adrian";
  $password = "Hakantor";
  $dbname = "tripcount";
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
      echo "Connection failed: " . $e->getMessage();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/register.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="icon" href="img/coin.png" type="image/png">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <title>Register</title>
</head>
<?php
$messages = [];
$errors = false;
if (isset($_POST['mail'], $_POST['pwd'], $_POST['name'], $_POST['pwd2'])){
  if (empty($_POST['pwd']) && empty($_POST['pwd2'])) {
    if (empty($_POST['pwd'])) {
      $errors = true;
      array_push($messages, '<b>ERROR:</b> No se ha proporcionado el campo de contraseña.');
    }
    if (empty($_POST['pwd2'])) {
      $errors = true;
      array_push($messages, '<b>ERROR:</b> No se ha confirmado la segunda  contraseña.');
    }
  } else {
  if ($_POST['pwd'] != $_POST['pwd2']) {
    $errors = true;
    array_push($messages, '<b>ERROR:</b> Las contraseñas no coinciden.');
  }
}
if (empty($_POST['name'])) {
  $errors = true;
  array_push($messages, '<b>ERROR:</b> No se un ha proporcionado un nombre de usuario.');
} 
}

if (empty($_POST['mail'])) {
  $errors = true;
  array_push($messages, '<b>ERROR:</b> No se ha proporcionado el campo de correo electrónico.');
}

if (!$errors) {
  $sentencia = $conn->prepare("SELECT * FROM users WHERE mail = ? ");
  $sentencia->bindParam(1, $email);
  $sentencia->execute();
  if ($sentencia->rowCount() == 0) {
  $password = hash('sha256', filter_var($_POST['pwd'], FILTER_SANITIZE_STRING)); // 
  $query = $conn->prepare("INSERT INTO users (name, pwd, mail) VALUES (?, ?, ?)");
  $query->bindParam(1, $_POST['name']);
  $query->bindParam(3, $email);
  $query->bindParam(2, $password);
  $query->execute();
  $msg = 'Nuevo usuario creado correctamente, redireccionando...';
  header("refresh:1;url=index.php");
} else {
  $errors = true;
  array_push($message, "<b>ERROR:</b>Hay otro usuario con este nombre.");
}
}
unset($_POST['mail'], $_POST['pwd'], $_POST['pwd2']);
}
?>
<body>
  <?php include_once(dirname(__DIR__).'/Trip-Count/static/php/functions.php'); ?>
  <?php include_once(dirname(__DIR__) . "/Trip-Count/static/header.php");?>
  <div><?php systemMSG('info', 'Se te ha redirigido al register')?></div>
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
            if ($has_errors) {
              echo '<div class=\'message error-message\'>';
                foreach ($messages as $key => $error) {
                    echo $error . "</br>";
                }
                echo '</div>';
            } else {
                echo '<div class=\'message\'>';
                echo '<p></p>';
                echo '</div>';
            }
            ?>
          <form action="register2.php" method="post" name="submit" class="form formlogin">
            <div class="formfield">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="userName">
            </div>
            <div class="formfield">
              <label for="userMail">Correo electrónico</label>
              <input type="text" name="mail" id="userMail" placeholder="user@mail.com">
            </div>
            <div class="formfield">
                <label for="userPass">Contraseña</label>
                <input type="password" name="pwd" id="userPass">
                </div>
            <div class="formfield">
                <label for="userPass2">Confirmar contraseña</label>
                <input type="password" name="pwd2" id="userPass2">
            </div>
            <div class="formfield">
                <button class="button-primary" type="submit" accesskey="r"><u>R</u>EGISTRAR</button>
            </div>
            </form>
         </div>
      </div>
    </div>

      <?php include_once(dirname(__DIR__) . "/Trip-Count/static/footer.php");?>
</body>

</html>