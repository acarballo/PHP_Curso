<?php

$alumno = array(
	'nombre' => 'Andr&eacutes',
	'apellidos' => 'Carballo', 
	'edad' => 40,
		'algo',
	FALSE => 'cosa',
		'algomas',
		1.7 => 'trunca',
		array('rojo','verde','azul','negro','marron')	
);

echo("<pre>");
print_r($alumno);
foreach($alumno as $key => $value){
	echo $key.": ".$value;
	echo"</br>";
}
echo("</pre>");

require_once 'functions.php'; 

mostrar_array($alumno);

echo("<hr/>");

$hoy = getdate();
$semana = round($hoy['yday']/7);
echo 'Hoy, semana'.$semana.' del '. $hoy['year'].', '. $hoy['mday'].' dias del mes '. $hoy['mon'].', '. $hoy['month'];
//echo($hoy);
//mostrar_array($hoy);

//hacer con date


echo("<hr/>");


phpinfo();