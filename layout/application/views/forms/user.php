<?php 
$user=$viewVars['user'];
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

<form method="POST" enctype="multipart/form-data">

	<ul>
		<li>Id: <input type="hidden" name="id" value="<?= (isset($user['iduser']))?$user['iduser']:'';?>"/></li>
		<li>Name: <input type="text" name="name" value="<?= (isset($user['name'])&&$user['name']!='')?$user['name']:'';?>" /></li>
		<li>Email: <input type="text" name="email" value="<?= (isset($user['email'])&&$user['email']!='')?$user['email']:'';?>" /></li>
		<li>Password: <input type="password" name="password"/></li>
		<li>Dirección: <input type="text" name="address" value="<?= (isset($user['direccion'])&&$user['direccion']!='')?$user['direccion']:'';?>"/></li>
		<li>Descripción: <textarea rows="10" cols="10" name="description"><?= (isset($user['descripcion'])&&$user['descripcion']!='')?$user['descripcion']:'';?></textarea></li>
		<li>Sexo: <?=createRadioCheckFromDb($config, 'genders', 'sex','idgender', 'gender', array($user['genders_idgender']), FALSE);?>
		</li>
		<li>Ciudad:
	     	<?=createSelectFromDb($config, 'cities', 'city','idcity', 'city', array($user['cities_idcity']), FALSE);?>
		</li>
		<li>Foto: <input type="file" name="photo"/>
		<?php 
		if(isset($user['photo']))
			//FIXME
		{
		?>
			<img src="<?="/uploads/".$user['photo'];?>" width=100px />
		<?php 
		}
		?>
		</li>
		<li>Mascotas:
		<?=createRadioCheckFromDb($config, 'pets', 'pets', 'idpet', 'pet', array($user['pets']), TRUE);?>
		</li>
		<li>Deportes:<?=createSelectFromDb($config, 'sports', 'sports', 'idsport', 'sport', $user['sports'], TRUE);?></li>
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
