<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link rel="stylesheet" href="styles/home.css">
    <link rel="stylesheet" href="styles/main.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
</head>
<body>
  <div></div>
  <?php include_once(dirname(__DIR__) . "/Trip-Count/static/header.php");?>
	<section class="container main-content">
		<h1>TRIP-COUNT</h1>
		<div class="background-image"></div>
		<div class="container espaciotabla">
      <?php
      $family = "";
      if(isset($_POST['family'])) {
         $family = $_POST['family'];
      }

      try {
         $con= new PDO('mysql:host=localhost;dbname=tripcount', "root", "");
         $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         if(!empty($family)) {
          $query = "SELECT * FROM travels where id_travel ORDER BY '.$sort'";
         }
         else {
        $query = "SELECT * FROM travels";
         }

         print "<table class='tabla'>";
         $result = $con->query($query);

         $row = $result->fetch(PDO::FETCH_ASSOC);
         print " <tr>";
         foreach ($row as $field => $value){
        print " <th>$field</th>";
         }
         print " </tr>";
         $data = $con->query($query);
         $data->setFetchMode(PDO::FETCH_ASSOC);
         foreach($data as $row){
        print " <tr>";
        foreach ($row as $name=>$value){
           print " <td>$value</td>";
        }
        print " </tr>";
         }
         print "</table>";
      } catch(PDOException $e) {
      echo 'ERROR: ' . $e->getMessage();
      }
   ?>
   </div>
   <div>
      <form action="home.php" method="post">
         <select name="sort">
            <option value="" selected="selected">Any Order</option>
            <option value="ASC">Ascending</option>
            <option value="DESC">Descending</option>
         </select>
         <input name="search" type="submit" value="Search"/>
      </form>
   </div>
   <button class="button aviaje" onclick="wraper()" id="btnAñadirViaje"> <span>AÑADIR VIAJE</span></button>
   <div id="+"></div>
  </section>
  <?php include_once(dirname(__DIR__) . "/Trip-Count/static/footer.php");?>
</body>
</html>

<script>
   /*
   function insertAfter(node, element) {
    element.parentNode.insertBefore(node, element.nextElementSibling);
}
   var newform = '<div class="formDinamic"><form action=""><h2>Viaje</h2><label>Nombre: </label><input type="text"><label>Descripcion: </label><input type="text"><label>Moneda: </label><select name=""><option>example</option><option>example2</option></select></form></div>';
   var el = document.createElement("form");
   el.innerHTML = newform;
   var div = document.getElementById("+");
*/


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
      newElement('button', 'ENVIAR', newForm);
   }

</script>

