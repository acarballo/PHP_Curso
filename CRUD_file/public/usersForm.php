<?php 
echo "<pre>Post: ";
print_r($_POST);
echo "</pre>";

echo "<pre>Get: ";
print_r($_GET);
echo "</pre>";


// Configuracion
$userFilename="usuarios.txt";

// Leer datos del archivo de usuarios
$datos=file_get_contents($userFilename);

// Pasar datos a un array
$arrayDatos=explode("\r",$datos);


if(isset($_GET['id']))
{
	// Leer posicion id del array
	$usuario=$arrayDatos[$_GET['id']];

	//Convertir en array
	$usuario=explode("|",$usuario);
}

// echo "<pre>";
// print_r($usuario);
// echo "</pre>";


if(!empty($usuario[8]))
	$pets=explode(',',$usuario[8]);
else
	$pets=array();

if(!empty($usuario[9]))
	$sports=explode(',',$usuario[9]);
else
	$sports=array();


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

<form action="<?=(isset($_GET['id']))?'procesar_update.php':'procesar.php';?>" method="POST" 
	enctype="multipart/form-data">

	<ul>
		<li>Id: <input type="hidden" name="id" value="<?= (isset($_GET['id']))?$_GET['id']:'1';?>"/></li>
		<li>Name: <input type="text" name="name" value="<?= (isset($usuario[1])&&$usuario[1]!='')?$usuario[1]:'';?>" /></li>
		<li>Email: <input type="text" name="email" value="<?= (isset($usuario[2])&&$usuario[2]!='')?$usuario[2]:'';?>" /></li>
		<li>Password: <input type="password" name="password"/></li>
		<li>Dirección: <input type="text" name="address" value="<?= (isset($usuario[4])&&$usuario[4]!='')?$usuario[4]:'';?>"/></li>
		<li>Descripción: <textarea rows="10" cols="10" name="description"><?= (isset($usuario[5])&&$usuario[5]!='')?$usuario[5]:'';?></textarea></li>
		<li>Sexo: M: <input type="radio" name="sex" value="M" <?= (isset($usuario[6])&&$usuario[6]=='M')?'checked':'';?> /> 
		H: <input type="radio" name="sex" value="H" <?= (isset($usuario[6])&&$usuario[6]=='H')?'checked':'';?> />
		O: <input type="radio" name="sex" value="O" <?= (isset($usuario[6])&&$usuario[6]=='O')?'checked':'';?> />
		</li>
		<li>Ciudad: <select name="city">
					<option value="vigo" <?= (isset($usuario[7])&&$usuario[7]=='vigo')?'selected':'';?>>Vigo</option>
					<option value="bcn" <?= (isset($usuario[7])&&$usuario[7]=='bcn')?'selected':'';?>>Barcelona</option>
					<option value="bilbao" <?= (isset($usuario[7])&&$usuario[7]=='bilbao')?'selected':'';?>>Bilbao</option>
					</select></li>
		<li>Foto: <input type="file" name="photo"/>
		<?php 
		if(isset($usuario[11]))
		{
		?>
			<img src="<?="/uploads/".$usuario[11];?>" width=100px />
		<?php 
		}
		?>
		</li>
		<li>Mascotas: Tigre: <input type="checkbox" name="pets[]" value="tiger" <?= (in_array('tiger',$pets))?'checked':'';?>/>
		Tarantula: <input type="checkbox" name="pets[]" value="spider" <?= (in_array('spider',$pets))?'checked':'';?>/>
		Iguana: <input type="checkbox" name="pets[]" value="iguana" <?= (in_array('iguana',$pets))?'checked':'';?>/>
		</li>
		<li>Deportes: <select multiple name="sports[]">
					<option value="futbol" <?= (in_array('futbol',$sports))?'selected':'';?> >Futbol</option>
					<option value="beisbol" <?= (in_array('beisbol',$sports))?'selected':'';?>>Besisbol</option>
					<option value="natacion" <?= (in_array('natacion',$sports))?'selected':'';?>>Natacion</option>
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
