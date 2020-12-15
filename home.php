<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
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
		<h1>TRIP-COUNT</h1>
		<div class="background-image"></div>
		<div class="container espaciotabla">
		<div class="container">
            <?php
            $hostname = "localhost";
            $dbname = "tripcount";
            $username = "root";
            $pw = "";
            $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $pw);
            if(!$pdo){
                systemMSG('error', 'Failed to coonect to database!');
            }
            ?>
            <table>
                <thead class="alert-info">
                    <tr>
                        <th>destination</th>
                        <th>origin</th>
                        <th>leaving_day</th>
                        <th>back_day</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(ISSET($_POST['leaving_day'])){
                        $query = $pdo->prepare("SELECT * FROM `travels` ORDER BY `leaving_day` ASC");
                        $query->execute();
                        while($row = $query->fetch()){
                           echo "<tr>
                            <td>".$row['destination']."</td>
                            <td>".$row['origin']."</td>
                            <td>".$row['leaving_day']."</td>
                            <td>".$row['back_day']."</td>
                            </tr>";
                        }
                    }else if(ISSET($_POST['back_day'])){
                        $query = $pdo->prepare("SELECT * FROM `travels` ORDER BY `back_day` DESC");
                        $query->execute();
                while($row = $query->fetch()){
                   echo "<tr>
                            <td>".$row['destination']."</td>
                            <td>".$row['origin']."</td>
                            <td>".$row['leaving_day']."</td>
                            <td>".$row['back_day']."</td>
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
                    </tr>";
                }
            }
        ?></p>
<p> </tbody><br />
</table></p>
            <form method="POST" action=""><br/>
                <button  class="btn" name="leaving_day">Order leaving_day</button>
                <button  class="btn" name="back_day">Order back_day</button>
            </form>
        </div>
    <button class="button aviaje" onclick="wraper()" id="btnAñadirViaje"> <span>AÑADIR VIAJE</span></button>
   <div id="+"></div>
  </section>
  <?php include_once(dirname(__DIR__) . "/Trip-Count/static/footer.php");?>
</body>
</html>

<script>
   function insertAfter(node, element) {
    element.parentNode.insertBefore(node, element.nextElementSibling);
}
   var newform = '<div class="formDinamic"><form action=""><h2>Viaje</h2><label>Nombre: </label><input type="text"><label>Descripcion: </label><input type="text"><label>Moneda: </label><select name=""><option>example</option><option>example2</option></select></form></div>';
   var el = document.createElement("form");
   el.innerHTML = newform;
   var div = document.getElementById("+");



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