<a href="users.php?action=insert">Add</a>
<table border=1>
	<tr>
		<th>id</th>
		<th>name</th>
		<th>email</th>
		<th>password</th>
		<th>address</th>
		<th>description</th>
		<th>sex</th>
		<th>city</th>
		<th>pets</th>
		<th>sports</th>
		<th>submit</th>
		<th>photo</th>
		<th>options</th>
	</tr>
<?php 

// Configuracion
$file = "usuarios.txt";

// Leer el fichero de datos
$content=file_get_contents($file);
$arrayFile=explode("\r",$content);

// Mostrar en la tabla
// Recorrer para cada linea
foreach($arrayFile as $key => $line):?>
<tr>
<?php
		$arrayLine = explode('|', $line);
		// Recorrer para cada elemento	
		foreach($arrayLine as $key1 => $value):?>
			<td><?=$value;?></td>
		<?php endforeach;?>
	<td><a href=\"formulario.php?id=".$key."\">update</a>
				&nbsp;
			  <a href=\"confirmar_borrar.php?id=".$key."\">delete</a>
		  </td>";		
	</tr>";

<?php endforeach; ?>

</table>;
