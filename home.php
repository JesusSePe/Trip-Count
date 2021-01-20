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
    <link rel="icon" href="img/coin.png" type="image/png">
    <script src="static/js/functions.js"></script>
    <?php include_once(dirname(__DIR__).'/Trip-Count/static/php/functions.php'); ?>
</head>
<body>
<?php include_once(dirname(__DIR__).'/Trip-Count/static/php/functions.php'); ?>
  <?php include_once(dirname(__DIR__) . "/Trip-Count/static/header.php");?>

    
  <div><?php systemMSG('success', 'Has accedido con el usuario ' . $_SESSION["uname"])?></div>
  <ul class="breadcrumb">
    <li><a href="index.php">Inicio</a></li>
    <li><a href="login.php">Login</a></li>
    <li>Travels</li>
</ul>
  <section class="container main-content">
        <h1>TRIP-COUNT </h1>       
      <div class="background-image"></div>
    <div class="container espacidotabla">
            <?php
            $hostname = "localhost";
            $dbname = "tripcount";
            $username = "root";
            $pw = "";
            $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $pw);
            if(!$pdo){
                systemMSG('error', 'No se ha conectado a la base de datos!');
            }
            ?>
            <table class='tabla'>
                <thead class="alert-info">
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Fecha de creación</th>
                        <th>Última actualización</th>
                        <th>Moneda</th>
                        <th>Detalles</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(ISSET($_POST['t_creation'])){
                        // LISTA DE VIAJES
                        $query = $pdo->prepare("SELECT id_travel, t_name, t_description, t_creation, t_update, code FROM travels tra LEFT JOIN currency cur ON tra.id_currency = cur.id_currency WHERE id_travel IN (SELECT id_travel FROM users_travels WHERE id_user = :id_user) ORDER BY `t_creation` ASC");
                        $query->bindParam(':id_user', $_SESSION['user_id']);
                        $query->execute();
                        systemMSG('info', 'Se ha ordenado por fecha de creacion ');
                        while($row = $query->fetch()){
                           echo "<tr onclick='details(".$row['id_travel'].")' id='".$row['id_travel']."'>
                            <td>".$row['t_name']."</td>
                            <td>".$row['t_description']."</td>
                            <td>".$row['t_creation']."</td>
                            <td>".$row['t_update']."</td>
                            <td>".$row['code']."</td>
                            <td><a href='edit_trip.php?id_travel=".$row['id_travel']."'>Edit</a></td>

                            </tr>";

                            // DETALLES DE PAGOS DE LOS DIFERENTES VIAJES. 
                            $details_query = $pdo->prepare("SELECT expense_date, amount, name FROM expenses exp LEFT JOIN user_expenses ue ON exp.id_expense = ue.id_expense LEFT JOIN users u ON ue.id_user = u.id_user WHERE id_travel = :id ORDER by 1");
                            $details_query->bindParam(':id', $row['id_travel']);
                            $details_query->execute();
                            while($details_row = $details_query->fetch()){
                                echo "<tr class = 'details details".$row['id_travel']."'>
                                <td>Data despesa: ".$details_row['expense_date']."</td>
                                <td>Quantitat: ".$details_row['amount']."</td>
                                <td>Usuari: ".$details_row['name']."</td>
                                </tr>";
                            }
                            // BOTONES E INFORMACIÓN EXTRA.
                            $total_query = $pdo->prepare("SELECT sum(amount) FROM expenses WHERE id_travel = :id GROUP BY id_travel");
                            $total_query->bindParam(':id', $row['id_travel']);
                            $total_query->execute();
                            while($total = $total_query->fetch()){
                                echo "
                                <tr class = 'details details".$row['id_travel']."'>
                                <td>Despesa total: ".$total['sum(amount)']."</td>
                                <td><a href='./enter_payments.php'>Afegir pagament</a></td>
                                <td><a href=''>Gestionar usuaris</a></td>
                                <td><a href='./balanç.php'>Balanç</a></td>
                                </tr>";
                            }
                        }
                    }else if(ISSET($_POST['t_update'])){
                        $query = $pdo->prepare("SELECT id_travel, t_name, t_description, t_creation, t_update, code FROM travels tra LEFT JOIN currency cur ON tra.id_currency = cur.id_currency WHERE id_travel IN (SELECT id_travel FROM users_travels WHERE id_user = :id_user) ORDER BY t_update DESC");
                        $query->bindParam(':id_user', $_SESSION['user_id']);
                        $query->execute();
                        systemMSG('info', 'Se ha ordenado por fecha de actualizacion ');
                        while($row = $query->fetch()){
                           echo "<tr onclick='details(".$row['id_travel'].")' id='".$row['id_travel']."'>
                            <td>".$row['t_name']."</td>
                            <td>".$row['t_description']."</td>
                            <td>".$row['t_creation']."</td>
                            <td>".$row['t_update']."</td>
                            <td>".$row['code']."</td>
                            <td><a href='edit_trip.php?id_travel=".$row['id_travel']."'>Edit</a></td>
                            </tr>";

                            // DETALLES DE PAGOS DE LOS DIFERENTES VIAJES. 
                            $details_query = $pdo->prepare("SELECT expense_date, amount, name FROM expenses exp LEFT JOIN user_expenses ue ON exp.id_expense = ue.id_expense LEFT JOIN users u ON ue.id_user = u.id_user WHERE id_travel = :id ORDER by 1");
                            $details_query->bindParam(':id', $row['id_travel']);
                            $details_query->execute();
                            while($details_row = $details_query->fetch()){
                                echo "<tr class = 'details details".$row['id_travel']."'>
                                <td>Data despesa: ".$details_row['expense_date']."</td>
                                <td>Quantitat: ".$details_row['amount']."</td>
                                <td>Usuari: ".$details_row['name']."</td>
                                </tr>";
                            }
                          
                            // BOTONES E INFORMACIÓN EXTRA.
                            $total_query = $pdo->prepare("SELECT sum(amount) FROM expenses WHERE id_travel = :id GROUP BY id_travel");
                            $total_query->bindParam(':id', $row['id_travel']);
                            $total_query->execute();
                            while($total = $total_query->fetch()){
                                echo "
                                <tr class = 'details details".$row['id_travel']."'>
                                <td>Despesa total: ".$total['sum(amount)']."</td>
                                <td><a href='./enter_payments.php'>Afegir pagament</a></td>
                                <td><a href=''>Gestionar usuaris</a></td>
                                <td><a href='./balanç.php'>Balanç</a></td>
                                </tr>";
                            }
                        }
                    }else{
                        $query = $pdo->prepare("SELECT id_travel, t_name, t_description, t_creation, t_update, code FROM travels tra LEFT JOIN currency cur ON tra.id_currency = cur.id_currency WHERE id_travel IN (SELECT id_travel FROM users_travels WHERE id_user = :id_user) ORDER BY `id_travel` ASC");
                        $query->bindParam(':id_user', $_SESSION['user_id']);
                        $query->execute();
                        while($row = $query->fetch()){
                           echo "<tr onclick='details(".$row['id_travel'].")' id='".$row['id_travel']."'>
                            <td>".$row['t_name']."</td>
                            <td>".$row['t_description']."</td>
                            <td>".$row['t_creation']."</td>
                            <td>".$row['t_update']."</td>
                            <td>".$row['code']."</td>
                            <td><a href='edit_trip.php?id_travel=".$row['id_travel']."'>Edit</a></td>
                            </tr>";

                            // DETALLES DE PAGOS DE LOS DIFERENTES VIAJES. 
                            $details_query = $pdo->prepare("SELECT expense_date, amount, name FROM expenses exp LEFT JOIN user_expenses ue ON exp.id_expense = ue.id_expense LEFT JOIN users u ON ue.id_user = u.id_user WHERE id_travel = :id ORDER by 1");
                            $details_query->bindParam(':id', $row['id_travel']);
                            $details_query->execute();
                            while($details_row = $details_query->fetch()){
                                echo "<tr class = 'details details".$row['id_travel']."'>
                                <td>Data despesa: ".$details_row['expense_date']."</td>
                                <td>Quantitat: ".$details_row['amount']."</td>
                                <td>Usuari: ".$details_row['name']."</td>
                                </tr>";
                            }
                            // BOTONES E INFORMACIÓN EXTRA.
                            $total_query = $pdo->prepare("SELECT sum(amount) FROM expenses WHERE id_travel = :id GROUP BY id_travel");
                            $total_query->bindParam(':id', $row['id_travel']);
                            $total_query->execute();
                            while($total = $total_query->fetch()){
                                echo "
                                <tr class = 'details details".$row['id_travel']."'>
                                <td>Despesa total: ".$total['sum(amount)']."</td>
                                <td><a href='./enter_payments.php'>Afegir pagament</a></td>
                                <td><a href=''>Gestionar usuaris</a></td>
                                <td><a href='./balanç.php'>Balanç</a></td>
                                </tr>";
                            }
                        }
                    }
        ?></p>
<p> </tbody><br />
</table></p>
</div>
<div>

   <form method="POST" action=""><br/>
        <button  class="button aviaje" name="t_creation" accesskey="c">Fecha <u>C</u>reacion</button>
        <button  class="button aviaje" name="t_update" accesskey="m">Fecha <u>M</u>odificacion</button>
    </form>
</div>
    <button class="button aviaje" onclick="wraper()" id="btnAÃ±adirViaje" accesskey="v"> <span>AÑADIR <u>V</u>IAJE</span></button>
   <form class='forminv' id="+" action="./invitaciones.php"></form>
  </section>
  <?php include_once(dirname(__DIR__) . "/Trip-Count/static/footer.php");?>
</body>
</html>

<?php
    // Get all currency IDs
    $hostname = "localhost";
    $dbname = "tripcount";
    $username = "php";
    $pw = "Php_1c4J8";
    try {
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $pw);
    } catch (PDOException $e){
        echo $e->getMessage();
    }
    if ($pdo == null) {
        echo('error: Base de datos no encontrada');
    }
    // Query to get currency codes
    $codes = [];
    $stmt = $pdo->prepare("SELECT distinct(code) FROM currency ORDER BY code");
    $stmt->execute();
    $stmt_result = $stmt-> fetchAll(PDO::FETCH_ASSOC);
    foreach ($stmt_result as $result){
        array_push($codes, $result['code']);
    }
?>

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
    if (newForm.length < 1) {
        newElement('h2', 'VIAJE', newForm);
        newElement('label', 'Nombre: ', newForm);
        newElement('input', 'undefined', newForm, {'type': 'text', 'name': 'Nombre'});
        newElement('br', 'undefined', newForm);
        newElement('label', 'Descripcion: ', newForm);
        newElement('input', 'undefined', newForm, {'type': 'text', 'name': 'Descripcion'});
        newElement('br', 'undefined', newForm);
        newElement('label', 'Moneda: ', newForm);
        newElement('select', 'undefined', newForm, {'name': 'currency', 'id': 'curList'});
        newElement('br', 'undefined', newForm);
        newElement('input', 'undefined', newForm, {'type': 'submit', 'value' : 'ENVIAR' ,'class' : 'button', 'accesskey' : 'e'});
        let optionsList = document.getElementById('curList');
        let currencies = [<?php
            foreach($codes as $code){
                echo( '"'.$code.'", ');
            }?>];
        addItems(currencies, optionsList);
    }
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