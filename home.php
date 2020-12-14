<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link rel="stylesheet" href="styles/home.css">
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>
  <div></div>
  <?php include_once(dirname(__DIR__) . "/Trip-Count/static/header.php");?>
	<section class="container main-content">
		<div class="background-image"></div>
		<h1>TRIP-COUNT</h1>
		<div class="container">
      <?php
      $family = "";
      if(isset($_POST['family'])) {
         $family = $_POST['family'];
      }

      try {
         $con= new PDO('mysql:host=localhost;dbname=tripcount', "adrian", "Hakantor");
         $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         if(!empty($family)) {
          $query = "SELECT * FROM travels where id_travel ORDER BY '.$sort'";
         }
         else {
        $query = "SELECT * FROM travels";
         }

         print "<table>";
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
   </p>
    <form action="home.php" method="post">
      <select name="sort">
         <option value="" selected="selected">Any Order</option>
         <option value="ASC">Ascending</option>
         <option value="DESC">Descending</option>
      </select>
      <input name="search" type="submit" value="Search"/>
   </form>
		</div>
  </section>
  <?php include_once(dirname(__DIR__) . "/Trip-Count/static/footer.php");?>
</body>
</html>
