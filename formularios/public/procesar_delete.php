<?php
echo "<pre>Post: ";
print_r($_POST);
echo "</pre>";

echo "<pre>Get: ";
print_r($_GET);
echo "</pre>";

//si no no borrar
//if(){
//	header();
//	exit();
//}

//Borrar imagen
//unlink($_SERVER['DOCUMENT_ROOT'].$uploads_dir.$nombrefichero);


$file = "usuarios.txt";
$datosUsu = file_get_contents($file);
$datosUsuArray = explode('\r',$datosUsu);

unset($datosUsuArray[$_POST[id]]);

$datosFinal= implode('\r',$datosUsuArray);

//Reescribir el fichero
file_put_contents($file, $datosFinal);
