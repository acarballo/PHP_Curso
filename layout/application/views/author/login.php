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

<a href="/">home</a>
<form method="POST" enctype="multipart/form-data">

	<ul>
		<li>Email: <input type="text" name="email" value="<?= (isset($user['email'])&&$user['email']!='')?$user['email']:'';?>" /></li>
		<li>Password: <input type="password" name="password"/></li>
		<li>Submit: <input type="submit" name="submit" value="Enviar"/></li>
	</ul>
</form>

</div>

<div class="bottom">
</div>
</body>
</html>
