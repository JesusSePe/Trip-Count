<?php  
 session_start();  
 ?>  
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link rel="stylesheet" href="styles/home.css">
    <link rel="stylesheet" href="styles/main.css">
    <?php include_once(dirname(__DIR__).'/Trip-Count/static/php/functions.php'); ?>
</head>
<body>
  <div></div>
  <?php include_once(dirname(__DIR__) . "/Trip-Count/static/header.php");?>
  <section class="container main-content">

		<?php if(isset($_SESSION)){  
      echo '<h1>TRIP-COUNT'.$_SESSION["uname"].'</h1>';
    }
    else{
    }
    ?>
		<div class="background-image"></div>
		<div class="container espacidotabla">
            <?php
            $hostname = "localhost";
            $dbname = "tripcount";
            $username = "adrian";
            $pw = "Hakantor";
            $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $pw);
            if(!$pdo){
                systemMSG('error', 'Failed to coonect to database!');
            }
            ?>
            <table class='tabla'>
                <thead class="alert-info">
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Fecha Creacion</th>
                        <th>Fecha Modificacion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(ISSET($_POST['t_creation'])){
                        $query = $pdo->prepare("SELECT * FROM `travels` ORDER BY `t_creation` ASC");
                        $query->execute();
                        while($row = $query->fetch()){
                           echo "<tr>
                             <td>".$row['t_name']."</td>
                            <td>".$row['t_description']."</td>
                            <td>".$row['t_creation']."</td>
                            <td>".$row['t_update']."</td>
                            </tr>";
                        }
                    }else if(ISSET($_POST['t_update'])){
                        $query = $pdo->prepare("SELECT * FROM `travels` ORDER BY `t_update` DESC");
                        $query->execute();
                while($row = $query->fetch()){
                   echo "<tr>
                             <td>".$row['t_name']."</td>
                            <td>".$row['t_description']."</td>
                            <td>".$row['t_creation']."</td>
                            <td>".$row['t_update']."</td>
                    </tr>";
                }
            }else{
                $query = $pdo->prepare("SELECT * FROM `travels`ORDER BY `id_travel` ASC");
                $query->execute();
                while($row = $query->fetch()){
                    echo "<tr>
                            <td>".$row['t_name']."</td>
                            <td>".$row['t_description']."</td>
                            <td>".$row['t_creation']."</td>
                            <td>".$row['t_update']."</td>
                    </tr>";
                }
            }
        ?></p>
<p> </tbody><br />
</table></p>
</div>
<div>

   <form method="POST" action=""><br/>
   <button  class="button aviaje" name="t_creation">Ordenar dia de salida</button>
   <button  class="button aviaje" name="t_update">Ordenar dia de vuelta</button>
            </form>
</div>
    <button class="button aviaje" onclick="wraper()" id="btnAñadirViaje"> <span>AÑADIR VIAJE</span></button>
   <div id="+"></div>
  </section>
  <?php include_once(dirname(__DIR__) . "/Trip-Count/static/footer.php");?>
</body>
</html>

<script>
   
let newForm = document.getElementById('+');
let lastFormElement = forms.lastElementChild;

function newElement(tag, text, parent, attributes) {
   let element = document.createElement(tag);
   if(text) {
      let txtNode = document.createTextNode(text);
      element.appendChild(txtNode);
   }
   
   parent.appendChild(element);
   
   if (attributes) {
      element.setAttribute(key, value);
   }
   
}

function wraper(){
   
      newElement('h2', 'VIAJE', newForm);
      newElement('label', 'Nombre: ', newForm);
      newElement('input', 'undefined', newForm);
      newElement('br', 'undefined', newForm);
      newElement('label', 'Descripción: ', newForm);
      newElement('input', 'undefined', newForm);
      newElement('br', 'undefined', newForm);
      newElement('label', 'Moneda: ', newForm);
      newElement('select', 'undefined', newForm);
      newElement('br', 'undefined', newForm);

   }

</script>