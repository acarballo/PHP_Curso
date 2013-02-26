<?php
echo "<pre>Post: ";
print_r($_POST);
echo "</pre>";

echo "<pre>File: ";
print_r($_FILES);
echo "</pre>";

include_once 'functions.php';

$file = "usuarios.txt";
$datosUsu = file_get_contents($file);
$datosUsuArray = explode('\r',$datosUsu);

muestraArray($_POST);
//toma imagen anterior
$User=explode('|',$datosUsuArray[$_POST['id']]);
if(isset($_FILES["photo"]["tmp_name"]) && $_FILES["photo"]["tmp_name"]!=''){
	$uploads_dir = "/uploads";
	$tmp_name = $_FILES["photo"]["tmp_name"];
	$name = $_FILES["photo"]["name"];
	$ruta = $_SERVER['DOCUMENT_ROOT'].$uploads_dir;
	//$withoutVHost = "/formularios/public";
	$withoutVHost = "";
	$url = $withoutVHost.$uploads_dir;
	$name=SubirArchivo($_FILES);
	
	//tmb hay que borrar la imagen anterior
	//unlink(la imagen anterior)
}
else
{
	
	$name=$User[11];
	
}

// Show image
/*if($name!=null){
	echo "<img src=\"".$url."/".$name."\" width=100px />";
}*/




$contentLinea=implode('|',cambiaArray($_POST));
$contentLinea.="|".$name."\r\n";

$datosUsuArray[$_POST['id']]=$contentLinea;
$datosFinal= implode('\r',$datosUsuArray);

//Reescribir el fichero
file_put_contents($file, $datosFinal);
