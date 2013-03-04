<?php

function connectDB($config){
	//leer configuracion
	$dbserver = $config["db.server"];
	$dbdatabase = $config["db.database"];
	$dbuser = $config["db.user"];
	$dbpassword = $config["db.password"];
	$cnx = mysql_connect($dbserver,$dbuser,$dbpassword);
	mysql_select_db($dbdatabase);
	
	return $cnx;
}


/**
 * Read data from file
 * @return array|boolean
 */
function readUsers($config){
	
	try{
		$cnx = connectDB($config);
		
		//leer usuarios de la tabla
		$query = "SELECT * FROM users";
		$result=mysql_query($query,$cnx);
		//devolver array
		while($row = mysql_fetch_assoc($result)){
			//echo("<pre>");
			//print_r($row);
			//echo("</pre>");
			$users[]=$row;
		}
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
	$pathUpload = $config['uploadDirectory'];
	$dbserver = $config["db.server"];
	$dbdatabase = $config["db.database"];
	$dbuser = $config["db.user"];
	$dbpassword = $config["db.password"];
	
	try{
		$name=updatePhoto('', $pathUpload);
		$data[]=$name;

		//conectar al servidor
		$cnx = connectDB($config);
		
		$query = "insert into users values (";
		(isset($data[0]))?$query .=$data[0].',':',';
		(isset($data[1]))?$query .='"'.$data[1].'"",':'"",';
		
		echo($query);
		die;
		
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