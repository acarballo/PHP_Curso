<?php

/**
 * Update user photo
 * @param string $tmpfile
 * @param string $oldname
 * @param string $pathUpload
 * @return string
 */
function updatePhoto($lastname, $pathUpload){
	// Sobreescibir imagen si hay nueva
	if(isset($_FILES["photo"]["tmp_name"]) && 
			 $_FILES["photo"]["tmp_name"]!=''){
		
		$tmp_name = $_FILES["photo"]["tmp_name"];
		$name = $_FILES["photo"]["name"];
		$ruta = $_SERVER['DOCUMENT_ROOT'].$pathUpload;
		$url = $pathUpload;
		$name=uploadFile($_FILES,$pathUpload);
	
		// Borrar imagen anterior
		unlink($ruta."/".$lastname);
	}
	else{
		// Usar imagen anterior
		$name=$lastname;
	}
	
	return $name;
}