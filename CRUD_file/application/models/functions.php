<?php

/**
 * Read comma separated string to array
 * @param unknown $comaValue
 * @return multitype:
 */
function commaToArray($comaValue){
	$array=array();
	if(!empty($comaValue))
		$array=explode(',',$comaValue);
	else
		$array=array();
	return $array;
}

/**
 * Upload a file to directory with counter rename
 * @param array $arrayFiles
 * @return string $name
 */
function uploadFile($arrayFiles, $pathUpload){

	$tmp_name = $arrayFiles["photo"]["tmp_name"];
	$name = $arrayFiles["photo"]["name"];
	$ruta = $_SERVER['DOCUMENT_ROOT'].$pathUpload;

	if($name==NULL)
		return '';

	// Comprobar si el nombre existe en el diretorio
	$a=0;
	$path_parts = pathinfo($ruta."/".$name);
	while(file_exists($ruta."/".$name)){
		// Aumento contador
		$a++;
		// Cambiar el nombre y volver a intenter
		$name=$path_parts['filename']."-".$a.".".$path_parts['extension'];
	}

	move_uploaded_file($tmp_name, $ruta."/".$name);

	return $name;
}


/**
 * Recibe un array, de máximo dos dimensiones,
 * y lo separa por comas.
 *
 * @param array array de entrada
 * @return array comma separated
 */
function cambiaArray($array){
	$array2 = array();

	foreach ($array as $key => $value){
		if(is_array($value))
			$array2[]=implode(',', $value);
		else
			$array2[]=$value;
	}
	return $array2;
}


