<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/main.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <title>Invitaciones</title>
</head>
<body>
<?php include_once(dirname(__DIR__) . "/Trip-Count/static/header.php");?>
<?php $viaje = 'example'?>
<div class="main-content">
    <h1><?php echo $viaje?></h1>

 </head>
 <body>
   <div id="form" class="form">
    <form action="">
        <input type="email">
    </div>
    <input type="submit">
</form>
<button onclick="crearInputInv()" id="btn_agregar">+</button>
</div>
<?php include_once(dirname(__DIR__) . "/Trip-Count/static/footer.php");?>

</body>
</html>

<script>
      function crearInputInv(){
         
         var div = document.getElementById("form");
         var input = document.createElement("INPUT");         
         input.type = 'email';

         div.appendChild(input);
      } 
      window.onload = function(){
         
         var btnAdd = document.getEmentById("btn_agregar");   
         btnAdd.onclick = crearDin;
      }      
   </script>