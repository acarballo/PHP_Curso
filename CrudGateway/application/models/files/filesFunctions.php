<?php

/**
 * Read pipe separated file to array
 * @param string $fileName
 * @return array
 */
function readDataFromFile($fileName){
	$content=file_get_contents($fileName);
	$arrayFile=explode("\r",$content);
	foreach($arrayFile as $key => $line)
		$arrayLine[] = explode('|', $line);
	return $arrayLine;
}

/**
 * Write o reWrite array to file
 * @param string $filename
 * @param array $data
 * @param boolean $rewrite
 * @return void
 */
function writeDataToFile ($filename, $data, $rewrite=FALSE){
	if($rewrite===TRUE)
	{
		foreach($data as $key => $value)
			$pipes[]=arrayToPipes($value);
		$data=implode("\r",$pipes);
		file_put_contents($filename, $data);
	}
	else
	{
		$data=arrayToPipes($data);
		$data.="\r";
		file_put_contents($filename, $data, FILE_APPEND);
	}
	return;
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
	$url = $pathUpload;
	
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
 * Delete a file
 * @param string $filename
 * @param string $pathUpload
 */
function deleteFile($filename, $pathUpload){
	if($filename!=''){
		$ruta = $_SERVER['DOCUMENT_ROOT'].$pathUpload;
		unlink($ruta."/".$filename);
	}
	
	return;
}
