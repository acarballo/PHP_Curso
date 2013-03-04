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
		//$query = "SELECT * FROM users";
		$query = "SELECT iduser,name,email,password,direccion,descripcion,genders_idgender,cities_idcity,pets,'Sp','Su',photo FROM users";
		$result=mysql_query($query,$cnx);
		//devolver array
		while($row = mysql_fetch_assoc($result)){
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
	
/*	try{
		$cnx = connectDB($config);
		
		//leer usuarios de la tabla
		$query = "SELECT iduser,name,email,password,direccion,descripcion,genders_idgender,cities_idcity,pets,'Sp','Su',photo FROM users ";
		$query .= " WHERE iduser = ".$id;
		$result=mysql_query($query,$cnx);
		//devolver array
		$row = mysql_fetch_assoc($result);
		$user = array_values($row);

		return $user;
	}catch(Exception $e){
		echo 'catch Exception: ',  $e->getMessage(), "\n";
		return FALSE;
	}
	*/
	
	try{
		$users=readUsers($config);
		$user=array_values($users[$_GET['id']]);
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
	
	try{
		$name=updatePhoto('', $pathUpload);
		$data[]=$name;

		//conectar al servidor
		$cnx = connectDB($config);
		$query = "INSERT INTO users";
		$query .="(name,email,password,direccion,descripcion,pets,photo,genders_idgender,cities_idcity) VALUES (";
		$query .="'".(isset($data['name'])?$data['name']:"")."',";
		$query .="'".(isset($data['email'])?$data['email']:"")."',";
		$query .="'".(isset($data['password'])?$data['password']:"")."',";
		$query .="'".(isset($data['address'])?$data['address']:"")."',";
		$query .="'".(isset($data['description'])?$data['description']:"")."',";
		$query .="'".(isset($data['pets'])?implode(',',$data['pets']):"")."',";
		$query .="'".(isset($data[0])?$data[0]:"")."',";
		$query .=(isset($data['sex'])?getCity($data['sex']):NULL).",";
		$query .=(isset($data['city'])?getGender($data['city']):NULL);
		$query .=")";
		if (!mysql_query($query,$cnx)) {
			echo('Mysql Error: '.mysql_error());
		}
		$id = mysql_insert_id($cnx);

		//insert sports
		if(isset($data['sports'])){
			foreach($data['sports'] as $key => $value){
				$query = "INSERT INTO users_has_sports VALUES(".$id.",".getSport($value).")";
				if (!mysql_query($query,$cnx)) {
					echo('Mysql Error: '.mysql_error());
				}
			}
		}
		
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
		$name=updatePhoto($user['photo'], $pathUpload);
		$data[]=$name;
		//$users[$id]=$data;
		$IdKey = $user['iduser'];
		
		//conectar al servidor
		$cnx = connectDB($config);
		$query = "DELETE FROM users_has_sports WHERE users_iduser = ".$IdKey;
		if (!mysql_query($query,$cnx)) {
			echo('Mysql Error: '.mysql_error());
		}
		
		//printDataPreformated($user);
		
		$cnx = connectDB($config);
		$query = "UPDATE users set ";
		$query .=" name = '".$data['name']."',";
		$query .=" email = '".$data['email']."',";
		$query .=" password = '".$data['password']."',";
		$query .=" direccion = '".$data['address']."',";
		$query .=" descripcion = '".$data['description']."',";
		$query .=" pets = '".implode(',',$data['pets'])."',";
		$query .=" photo = '".$data[11]."',";
		//$query .=" gender = ".getGender($data['genders_idgender']).",";
		//$query .=" city = ".getCity($data['cities_idcity']);		
		$query .=" genders_idgender = 1,";
		$query .=" cities_idcity = 1";
		$query .=" WHERE iduser = ".$IdKey;
		
		if (!mysql_query($query,$cnx)) {
			echo('Mysql Error: '.mysql_error());
		}
		//$id = mysql_insert_id($cnx);
		//printDataPreformated($query);
		//die; 
		return TRUE;
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
	
	try{
		$user=readUser($config,$id);
		deleteFile($user[11],$pathUpload);
		unset($users[$id]);
		$IdKey = $user[0];
		
		//conectar al servidor
		$cnx = connectDB($config);
		$query = "DELETE FROM users_has_sports WHERE users_iduser = ".$IdKey;
		if (!mysql_query($query,$cnx)) {
			echo('Mysql Error: '.mysql_error());
		}
		$query = "DELETE FROM users WHERE iduser = ".$IdKey;
		if (!mysql_query($query,$cnx)) {
			echo('Mysql Error: '.mysql_error());
		}

		
		return TRUE;
	}catch(Exception $e){
		echo 'catch Exception: ',  $e->getMessage(), "\n";
		return FALSE;
	}
	
}