<?php

/**
 * Read data from file
 * @return array|boolean
 */
function readUsers($config){
	$userFilename = $config['userFilename'];
	try{
		$users=readDataFromFile($userFilename);
		return $users;
	}catch(Exception $e){
		echo 'catch Exception: ',  $e->getMessage(), "\n";
		return FALSE;
	}
}

/**
 * Read user data
 * @param integer $id
 * @return array
 */
function readUser($config,$id){
	
	try{
		$users=readUsers($config);
		$user=$users[$_GET['id']];
		return $user;
	}catch(Exception $e){
		echo 'catch Exception: ',  $e->getMessage(), "\n";
		return FALSE;
	}
	
}

/**
 * insert user data
 * @param unknown $data
 * @return Ambigous <void, number>|boolean
 */
function insertUser($config,$data){
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

/**
 * update user data
 * @param unknown $id
 * @param unknown $data
 * @return boolean
 */
function updateUser($config,$id, $data){
	$userFilename = $config['userFilename'];
	$pathUpload = $config['uploadDirectory'];
	
	try{
		$users=readUsers($config);
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

/**
 * delete user data
 * @param unknown $id
 * @return boolean
 */
function deleteUser($config,$id){
	$userFilename = $config['username'];
	$pathUpload = $config['password'];
	
	try{
		$users=readUsers($config);
		$user=readUser($config,$id);//no lo tengo en el POST ya que he quitado el imput hidden del id en la view
		deleteFile($user[11],$pathUpload);
		unset($users[$id]);
		writeDataToFile($userFilename, $users, TRUE);
		return TRUE;
	}catch(Exception $e){
		echo 'catch Exception: ',  $e->getMessage(), "\n";
		return FALSE;
	}
	
}