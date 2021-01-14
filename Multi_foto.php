<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/main.css">
    <?php include_once(dirname(__DIR__).'/Trip-Count/static/php/functions.php'); ?>
    <link rel="icon" href="img/coin.png" type="image/png">
    <title>Multi Fotos</title>
</head>
<body>
<?php include_once(dirname(__DIR__) . "/Trip-Count/static/header.php");?>
<div><?php systemMSG('info', 'Se te ha redirigido a la pagina de Multi Foto');
            systemMSG('warning', 'Esta pagina esta en construccion');?></div>

<?php
	
	foreach($_FILES["archivo"]['tmp_name'] as $key => $tmp_name)
	{
		//Validamos que el archivo exista
		if($_FILES["archivo"]["name"][$key]) {
			$filename = $_FILES["archivo"]["name"][$key]; //Obtenemos el nombre original del archivo
			$source = $_FILES["archivo"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo
			
			$directorio = 'MultiFotos/'; //Declaramos un  variable con la ruta donde guardaremos los archivos
			
			//Validamos si la ruta de destino existe, en caso de no existir la creamos
			if(!file_exists($directorio)){
				mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
			}
			
			$dir=opendir($directorio); //Abrimos el directorio de destino
			$target_path = $directorio.'/'.$filename; //Indicamos la ruta de destino
			
			//Movemos y validamos que el archivo se haya cargado correctamente
			//El primer campo es el origen y el segundo el destino
			if(move_uploaded_file($source, $target_path)) {	
				echo "El archivo $filename se ha almacenado en forma exitosa.<br>";
				} else {	
				echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
			}
			closedir($dir);
		}
	}
?>
<div class="main-content">
		<form name="form1" id="form1" method="post" action="Multi_foto.php" enctype="multipart/form-data">
						
						<h4 class="text-center">Cargar Multiple Archivos</h4>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Archivos</label>
							<input type="file" class="form-control" id="archivo[]" name="archivo[]" multiple="">							
							<button type="submit" class="btn btn-primary">Cargar</button>
						</div>
						
					</form>
</div>
<?php include_once(dirname(__DIR__) . "/Trip-Count/static/footer.php");?>

</body>
</html>