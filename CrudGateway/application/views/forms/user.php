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
		<li>Id: <input type="hidden" name="id" value="<?= (isset($_GET['id']))?$_GET['id']:'1';?>"/></li>
		<li>Name: <input type="text" name="name" value="<?= (isset($user[1])&&$user[1]!='')?$user[1]:'';?>" /></li>
		<li>Email: <input type="text" name="email" value="<?= (isset($user[2])&&$user[2]!='')?$user[2]:'';?>" /></li>
		<li>Password: <input type="password" name="password"/></li>
		<li>Dirección: <input type="text" name="address" value="<?= (isset($user[4])&&$user[4]!='')?$user[4]:'';?>"/></li>
		<li>Descripción: <textarea rows="10" cols="10" name="description"><?= (isset($user[5])&&$user[5]!='')?$user[5]:'';?></textarea></li>
		<li>Sexo: M: <input type="radio" name="sex" value="M" <?= (isset($user[6])&&$user[6]=='M')?'checked':'';?> /> 
		H: <input type="radio" name="sex" value="H" <?= (isset($user[6])&&$user[6]=='H')?'checked':'';?> />
		O: <input type="radio" name="sex" value="O" <?= (isset($user[6])&&$user[6]=='O')?'checked':'';?> />
		</li>
		<li>Ciudad: <select name="city">
					<option value="vigo" <?= (isset($user[7])&&$user[7]=='vigo')?'selected':'';?>>Vigo</option>
					<option value="bcn" <?= (isset($user[7])&&$user[7]=='bcn')?'selected':'';?>>Barcelona</option>
					<option value="bilbao" <?= (isset($user[7])&&$user[7]=='bilbao')?'selected':'';?>>Bilbao</option>
					</select></li>
		<li>Foto: <input type="file" name="photo"/>
		<?php 
		if(isset($user[11]))
		{
		?>
			<img src="<?="/uploads/".$user[11];?>" width=100px />
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
