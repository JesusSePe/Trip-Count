<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link rel="stylesheet" href="styles/home.css">
    <link rel="stylesheet" href="styles/main.css">

<body>
  <div></div>
  <?php include_once(dirname(__DIR__) . "/Trip-Count/static/header.php");?>
	<section class="container">
		<div class="background-image"></div>
		<h1>TRIP-COUNT</h1>
		<div class="container">
			<?php
      $hostname = "localhost";
      $dbname = "Usuarios";
      $username = "adrian";
      $pw = "Hakantor";
      $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $pw);
      $busqueda=$pdo->prepare("Select * from usuarios ORDER BY id");
      $busqueda->execute();
      $resultado = $busqueda->fetchAll();
      ?>
      <table class="table table-bordered">
        <tr>
          <th class="bg-primary" scope="col">Id</th>
          <th class="bg-primary" scope="col">Nombres</th>
          <th class="bg-primary" scope="col">Usuarios</th>
          <th class="bg-primary" scope="col">Password</th>
        </tr>
        <?php
        foreach($resultado as $res){
          echo "<tr>";
          echo "<td>".$res["id"]."</td>";
          echo "<td>".$res["nombres"]."</td>";
          echo "<td>".$res["usuario"]."</td>";
          echo "<td>".$res["password"]."</td>";
          echo "</tr>";
        }   
        ?>
      </table>
		</div>
  </section>
  <?php include_once(dirname(__DIR__) . "/Trip-Count/static/footer.php");?>
</body>

</html>
