<?php 

// Configuracion
$file = "usuarios.txt";

// Leer el fichero de datos
$content=file_get_contents($file);
$arrayFile=explode("\r",$content);

//echo "<pre>";
//print_r($arrayFile);
//echo "</pre>";
// die ("hasta aqui");

echo "
	<a href=\"form.php\">Add</a>
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
	</tr>";

// Mostrar en la tabla
// Recorrer para cada linea
foreach($arrayFile as $key => $line)
{
	echo "<tr>";
		$arrayLine = explode('|', $line);
		// Recorrer para cada elemento	
		foreach($arrayLine as $key1 => $value)
		{
			echo "<td>";
				echo $value;
			echo "</td>";
		}
	echo "<td><a href=\"form.php?id=".$key."\">update</a>
				&nbsp;
			  <a href=\"confirmar_borrar.php?id=".$key."\">delete</a>
		  </td>";		
	echo "</tr>";
}

echo "</table>";





