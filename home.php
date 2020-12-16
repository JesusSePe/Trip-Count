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
  
  <?php include_once(dirname(__DIR__) . "/Trip-Count/static/header.php");?>

    
  <div><?php systemMSG('success', 'Has accedido con el usuario ' . $_SESSION["uname"])?></div>
  <section class="container main-content">
        <h1>TRIP-COUNT </h1>       
	    <div class="background-image"></div>
		<div class="container espacidotabla">
            <?php
            $hostname = "localhost";
            $dbname = "tripcount";
            $username = "php";
            $pw = "Php_1c4J8";
            $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $pw);
            if(!$pdo){
                systemMSG('error', 'No se ha conectado a la base de datos!');
            }
            ?>
            <table class='tabla'>
                <thead class="alert-info">
                    <tr>
                        <th>destination</th>
                        <th>origin</th>
                        <th>Dia de salida</th>
                        <th>Dia de vuelta</th>
                        <th>Fecha creacion</th>
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
                            <td>".$row['destination']."</td>
                            <td>".$row['origin']."</td>
                            <td>".$row['leaving_day']."</td>
                            <td>".$row['back_day']."</td>
                            <td>".$row['t_creation']."</td>
                            <td>".$row['t_update']."</td>
                            </tr>";
                        }
                    }else if(ISSET($_POST['t_update'])){
                        $query = $pdo->prepare("SELECT * FROM `travels` ORDER BY `t_update` DESC");
                        $query->execute();
                while($row = $query->fetch()){
                   echo "<tr>
                            <td>".$row['destination']."</td>
                            <td>".$row['origin']."</td>
                            <td>".$row['leaving_day']."</td>
                            <td>".$row['back_day']."</td>
                            <td>".$row['t_creation']."</td>
                            <td>".$row['t_update']."</td>

                    </tr>";
                }
            }else{
                $query = $pdo->prepare("SELECT * FROM `travels`ORDER BY `id_travel` ASC");
                $query->execute();
                while($row = $query->fetch()){
                    echo "<tr>
                            <td>".$row['destination']."</td>
                            <td>".$row['origin']."</td>
                            <td>".$row['leaving_day']."</td>
                            <td>".$row['back_day']."</td>
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
   <button  class="button aviaje" name="t_creation">Fecha creacion</button>
   <button  class="button aviaje" name="t_update">Fecha Modificacion</button>
            </form>
</div>
    <button class="button aviaje" onclick="wraper()" id="btnAñadirViaje"> <span>AÑADIR VIAJE</span></button>
   <form class='forminv' id="+" action="./invitaciones.php"></form>
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

    if (attributes){
        for (const attribute in attributes) {
            const value = attributes[attribute];
            element.setAttribute(attribute, value);
        }
    }

    parent.appendChild(element);

}

function wraper(){
    newElement('h2', 'VIAJE', newForm);
    newElement('label', 'Nombre: ', newForm);
    newElement('input', 'undefined', newForm, {'type': 'text', 'name': 'Nombre'});
    newElement('br', 'undefined', newForm);
    newElement('label', 'Descripción: ', newForm);
    newElement('input', 'undefined', newForm, {'type': 'text', 'name': 'Descripcion'});
    newElement('br', 'undefined', newForm);
    newElement('label', 'Moneda: ', newForm);
    newElement('select', 'undefined', newForm, {'name': 'currency', 'id': 'curList'});
    newElement('br', 'undefined', newForm);
    newElement('input', 'undefined', newForm, {'type': 'submit'});
    let optionsList = document.getElementById('curList');
    let currencies = ['EUR', 'USD', 'AFN', 'BBD'];
    addItems(currencies, optionsList);
   }

function addItems(items, list){
    for (let index = 0; index < items.length; index++) {
        const item = items[index];
        let option = document.createElement('option');
        option.appendChild(document.createTextNode(item));
        option.value = item;
        list.appendChild(option);

    }
}



</script>