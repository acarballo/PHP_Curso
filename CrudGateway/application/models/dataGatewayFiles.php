<?php

include_once '../application/models/files/functions.php';
include_once '../application/models/files/filesFunctions.php';
$config = readConfig('../application/configs/config.ini','production');
$userFilename = $config['userFilename'];

/**
 * Read data from file
 * @return array|boolean
 */
function readUsers(){
	$config = readConfig('../application/configs/config.ini','production');
	$userFilename = $config['userFilename'];
	try{
		$users=readDataFromFile($userFilename);
		return $users;
	}catch(Exception $e){
		echo 'catch Exception: ',  $e->getMessage(), "\n";
		return FALSE;
	}
}

function readUser($id){
	
	try{
		$users=readUsers();
		$user=$users[$_GET['id']];
		return $user;
	}catch(Exception $e){
		echo 'catch Exception: ',  $e->getMessage(), "\n";
		return FALSE;
	}
	
}

function insertUser($data){
	$config = readConfig('../application/configs/config.ini','production');
	$userFilename = $config['userFilename'];
	$pathUpload = $config['uploadDirectory'];
	
	try{
		$name=updatePhoto('', $pathUpload);
		$data[]=$name;
		$id=writeDataToFile($userFilename, $data, FALSE);
		return $id;
	}catch(Exception $e){
		echo 'catch Exception: ',  $e->getMessage(), "\n";
		return FALSE;
	}
}

function updateUser($id, $data){
	$config = readConfig('../application/configs/config.ini','production');
	$userFilename = $config['userFilename'];
	$pathUpload = $config['uploadDirectory'];
	
	try{
		$users=readUsers();
		$user=$users[$id];
		$name=updatePhoto($user[11], $pathUpload);
		$data[]=$name;
		$users[$id]=$data;
		writeDataToFile($userFilename, $users, TRUE);
	}catch(Exception $e){
		echo 'catch Exception: ',  $e->getMessage(), "\n";
		return FALSE;
	}

}

function deleteUser($id){
	$config = readConfig('../application/configs/config.ini','production');
	$userFilename = $config['userFilename'];
	$pathUpload = $config['uploadDirectory'];
	
	try{
		$users=readUsers();
		$user=readUser($id);//no lo tengo en el POST ya que he quitado el imput hidden del id en la view
		deleteFile($user[11],$pathUpload);
		unset($users[$id]);
		writeDataToFile($userFilename, $users, TRUE);
		return TRUE;
	}catch(Exception $e){
		echo 'catch Exception: ',  $e->getMessage(), "\n";
		return FALSE;
	}
	
}

