<?php
      if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["username"]) and isset($_POST["password"])) {
        $hostname = "localhost";
        $dbname = "Usuarios";
        $username = "adrian";
        $pw = "Hakantor";
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $pw);

        $_username = $_POST["username"];
        $_password = $_POST["password"];

        $query = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = '$_username' and password = '$_password'");
        $query -> execute();
        $row = $query -> fetch();
        if ($row !== false) {
          echo "<p class='success'>Entraste</p>";
        } else {
          echo "<p class='fail'>ERROR</p>";
        }
      }
     ?>