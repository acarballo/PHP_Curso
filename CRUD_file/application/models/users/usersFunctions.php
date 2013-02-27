<?php


///no se usa de momento
/*
function readUser($id, $dataArray){

	$userData=array();
	if(isset($id)){
		// Leer posicion id del array
		$usuario=$dataArray[$id];
	
		//Convertir en array
		$usuario=explode("|",$usuario);
	}
	
	return $userData;
}*/

/**
 * Update user photo
 * @param string $tmpfile
 * @param string $oldname
 * @param string $pathUpload
 * @return string
 */
function updatePhoto($tmpfile, $oldname, $pathUpload){
	// Sobreescibir imagen si hay nueva
	if(isset($_FILES["photo"]["tmp_name"]) && $_FILES["photo"]["tmp_name"]!=''){
		$tmp_name = $_FILES["photo"]["tmp_name"];
		$name = $_FILES["photo"]["name"];
		$ruta = $_SERVER['DOCUMENT_ROOT'].$pathUpload;
		$url = $pathUpload;
		$name=uploadFile($_FILES,$pathUpload);
	
		// Borrar imagen anterior
		unlink($ruta."/".$oldname);
	}
	else{
		// Usar imagen anterior
		$name=$oldname;
	}
	
	return $name;
}

/**
 * 
 * @param unknown $imageName
 * @return string
 */
function prepateDataUser($imageName){
	// Convertir datos del update en string
	$updateUser=cambiaArray($_POST);
	$updateUser=implode('|',$updateUser);
	$updateUser.="|".$imageName;

		
	return $updateUser;
}

function prepareDataUser2($dataUser){
	$array2=array();
	foreach ($dataUser as $key => $value){
		if(is_array($value))
			$array2[]=implode(',', $value);
		else
			$array2[]=$value;
	}
	return $array2;
	
}


function array2dToPipes($array){
	$array2=array();
	foreach ($array as $key => $value){
		if(is_array($value))
			$array2[]=implode(',', $value);
		else
			$array2[]=$value;
	}
	return $array2;
}

function writeDataToFile($userFilename, $data, $rewrite=FALSE){
		
	if($rewrite===TRUE){
		foreach ($data as $key => $value)
			$pipes[]=array2dToPipes($value);
		$data=implode('\r',$pipes);
		file_put_contents($userFilename, $data);
	}else{
		$data=array2dToPipes($data);
		$data.="\n";
		file_put_contents($userFilename, $data,FILE_APPEND);
	}
		
	return;
}
