<?php 
echo "<pre>Post: ";
print_r($_POST);
echo "</pre>";

echo "<pre>Get: ";
print_r($_GET);
echo "</pre>";

if(array_key_exists('id', $_GET)){
	$filename = "usuarios.txt";
	$datos = file($filename);
	$datosFila = $datos[$_GET['id']];
	$datosColumna = explode('|',$datosFila); 
	
	if(!empty($datosColumna[8]))
		$pets = explode(',',$datosColumna[8]);
	else 
		$pets = array();
	
	if(!empty($datosColumna[9]))
		$sport = explode(',',$datosColumna[9]);
	else
		$sport = array();
	
	echo($datosFila);
	echo "<pre>Get: ";	
	print_r($datosColumna);
	echo "</pre>";

	echo("/uploads/".$datosColumna[11]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Formularios</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="robots" content="noarchive,noindex">
	<meta name="description" content="Formulario">
	<meta name="keywords" content="Formulario">
</head>
<body>

<div id="wrapper">

<form action="<?=(isset($_GET['id'])?'processUpdate.php':'process.php')?>" method="POST" enctype="multipart/form-data">
	<ul>
		<li>Id: <input type="hidden" name="id" value='<?=(isset($_GET['id'])?$_GET['id']:'1')?>'/></li>
		<li>Name: <input type="text" name="name" value='<?= ($datosColumna[1]!='')?$datosColumna[1]:''?>'/></li>
		<li>Email: <input type="text" name="email" value='<?= ($datosColumna[2]!='')?$datosColumna[2]:''?>'/></li>
		<li>Password: <input type="password" name="password" value='<?= ($datosColumna[3]!='')?$datosColumna[3]:''?>'/></li>
		<li>Dirección: <input type="text" name="address" value='<?= ($datosColumna[4]!='')?$datosColumna[4]:''?>'/></li>
		<li>Descripción: <textarea rows="10" cols="10" name="description"><?= ($datosColumna[5]!='')?$datosColumna[5]:''?></textarea></li>
		<li>Sexo: M: <input type="radio" name="sex" value="M" <?= ($datosColumna[6]=='M')?'checked':''?> /> 
				  H: <input type="radio" name="sex" value="H" <?= ($datosColumna[6]=='H')?'checked':''?> />
		          O: <input type="radio" name="sex" value="O" <?= ($datosColumna[6]=='O')?'checked':''?> />
		</li>
		<li>Ciudad: <select name="city">
					<option value="vigo">Vigo</option>
					<option value="bcn">Barcelona</option>
					<option value="bilbao">Bilbao</option>
					</select></li>
		<li>Foto: <input type="file" name="photo"/>
		<?php if(isset($datosColumna[11])): //? (en una linea) ?>
		<img src=<?= "/uploads/".$datosColumna[11]  ?> width=100px />
		<?php endif; //; (endwhile, endfor, end... (en una linea) ?>
		</li>
		
		<li>Mascotas: Tigre: <input type="checkbox" name="pets[]" value="tiger" <?= in_array('tiger', $pets)?'checked':'' ?> />
		Tarantula: <input type="checkbox" name="pets[]" value="spider" <?= in_array('spider', $pets)?'checked':'' ?> />
		Iguana: <input type="checkbox" name="pets[]" value="iguana" <?= in_array('iguana', $pets)?'checked':'' ?> />
		</li>
		<li>Deportes: <select multiple name="sports[]">
					<option value="futbol" <?= in_array('futbol', $sport)?'selected':'' ?>>Futbol</option>
					<option value="beisbol" <?= in_array('beisbol', $sport)?'selected':'' ?>>Beisbol</option>
					<option value="natacion" <?= in_array('natacion', $sport)?'selected':'' ?>>Natacion</option>
					</select></li>
		<li>Submit: <input type="submit" name="submit" value="Enviar"/></li>
		<li>Button: <input type="button" name="button" value="Boton"/></li>
		<li>Reset: <input type="reset" name="reset" value="Reset"/></li>
	</ul>
</form>

</div>

<div class="bottom">
</div>
</body>
</html>
