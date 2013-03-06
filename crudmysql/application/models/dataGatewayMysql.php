<?php

function connectDB($config){
	//leer configuracion
	$dbserver = $config["db.server"];
	$dbdatabase = $config["db.database"];
	$dbuser = $config["db.user"];
	$dbpassword = $config["db.password"];
	$cnx = mysqli_connect($dbserver,$dbuser,$dbpassword);
	mysqli_select_db($cnx,$dbdatabase);
	
	return $cnx;
}

/**
 * Connect to Mysql
 * @param array $config
 * @return resource $cnx
 */
function connectDBoriginal($config)
{
	// Conectar al servidor de DB
	$cnx = mysqli_connect($config['db.server'],$config['db.user'],
			$config['db.password'],$config['db.database']);
	// Conectar a la BD
	//mysqli_select_db($config['db.database']);

	return $cnx;
}

/**
 * Disconnect from Mysql
 * @param unknown $cnx
 */
function disconnectDB($cnx)
{
	mysqli_close($cnx);
	return;
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
		$query = "SELECT a.iduser,a.name,a.email,a.password,a.direccion,a.descripcion,c.gender,b.city,a.pets,'sports','Su',a.photo ";
		$query .= "FROM users a, cities b, genders c where a.genders_idgender = c.idgender and  a.cities_idcity = b.idcity order by a.iduser";
		$result=mysqli_query($cnx,$query);

		//devolver array
		while($row = mysqli_fetch_assoc($result)){
			//printDataPreformated($row);
			//die;
			$querySports = "SELECT a.sports_idsport, b.sport FROM users_has_sports a, sports b WHERE a.sports_idsport = b.idsport and a.users_iduser = ". $row['iduser'];
			$resultSport=mysqli_query($cnx,$querySports);
			$sport= array();
			while($rowSport = mysqli_fetch_assoc($resultSport)){
				$sport[]=$rowSport['sport'];
			}
			//$row['sports']=implode(',',$sport);
			$row['sports']=$sport;
			
			
			if($row['pets']!=''){
				$mispets=explode(',',$row['pets']);
				$petsName= array();
				foreach($mispets as $key=>$value){
					$queryPets = "SELECT * FROM pets WHERE idpet = ". $value;
					//debug('',$queryPets,FALSE);
					$resultPets=mysqli_query($cnx,$queryPets);
					$rowPet = mysqli_fetch_assoc($resultPets);
					//debug('',$resultPets,FALSE);
					$petsName[]=$rowPet['pet'];
				}
				//debug('',$petsName,FALSE);
				$row['pets']=$petsName;
			}
			
			$users[]=$row;
			
		}
		//printDataPreformated($sport);
		//printDataPreformated($users);
		//die;
		//read Sports
		
		return $users;
	}catch(Exception $e){
		echo 'catch Exception: ',  $e->getMessage(), "\n";
		return FALSE;
	}
	die;
}

/**
 * Read user data
 * @param integer $id
 * @return array
 */
function readUser($config,$id){
	
	try{
		$cnx = connectDB($config);
		
		//leer usuarios de la tabla
		$query = "SELECT * FROM users WHERE iduser=".$id;
		$result=mysqli_query($cnx,$query);

		//devolver array
		if($row = mysqli_fetch_assoc($result)){
			$querySports = "SELECT a.sports_idsport, b.sport FROM users_has_sports a, sports b WHERE a.sports_idsport = b.idsport and a.users_iduser = ". $row['iduser'];
			$resultSport=mysqli_query($cnx,$querySports);
			$sport= array();
			while($rowSport = mysqli_fetch_assoc($resultSport)){
				$sport[]=$rowSport['sport'];
			}
			$row['sports']=$sport;			
			$user=$row;			
		}
		
		// FIXME: 
		$user['pets']=explode(',',$user['pets']);
		
		//debug('',$user,TRUE);
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
		//$query .=(isset($data['sex'])?getGender($data['sex']):NULL).",";
		//$query .=(isset($data['city'])?getCity($data['city']):NULL);		
		$query .=(isset($data['sex'])?$data['sex']:NULL).",";
		$query .=(isset($data['city'])?$data['city']:NULL);
		$query .=")";
				
		if (!mysqli_query($cnx,$query)) {
			echo('Mysql Error: '.mysqli_error($cnx));
			die;
		}
		$id = mysqli_insert_id($cnx);
		
		/*
		printDataPreformated($data['sex']);
		printDataPreformated(getCity($data['sex']));
		printDataPreformated($data);
		echo($query);
		die;*/
		//insert sports
		if(isset($data['sports'])){
			foreach($data['sport'] as $key => $value){
				$query = "INSERT INTO users_has_sports VALUES(".$id.",".getSport($value).")";
				if (!mysqli_query($cnx,$query)) {
					echo('Mysql Error: '.mysqli_error($cnx));
					die;
				}
			}
		}
		
		//echo($query);
		//die;
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
	$pathUpload = $config['uploadDirectory'];
	
	try{
		//$users=readUsers($config);
		$user=readUser($config,$id);
		$name=updatePhoto($user['photo'], $pathUpload);
		$data[]=$name;
		//$users[$id]=$data;
		$IdKey = $user['iduser'];
		//debug('',$id,FALSE);
		//debug('',$user,TRUE);
		//conectar al servidor
		$cnx = connectDB($config);
		$query = "DELETE FROM users_has_sports WHERE users_iduser = ".$IdKey;
		if (!mysqli_query($cnx,$query)) {
			echo('Mysql Error: '.mysqli_error($cnx));
		}
		//debug('',$data,TRUE);
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
		$query .=" genders_idgender = ".$data['sex'].",";
		$query .=" cities_idcity = ".$data['city'];		
		$query .=" WHERE iduser = ".$IdKey;
		
		//debug('',$data,TRUE);
		
		if (!mysqli_query($cnx,$query)) {
			echo('Mysql Error: '.mysqli_error($cnx));
			die;
		}
		//$id = mysql_insert_id($cnx);
		//printDataPreformated($query);
		//die; 
		
		//insert sports
		if(isset($data['sports'])){
			foreach($data['sports'] as $key => $value){
				$query = "INSERT INTO users_has_sports VALUES(".$id.",".$value.")";
				
				if (!mysqli_query($cnx,$query)) {
					echo('Mysql Error: '.mysqli_error());
					die;
				}
			}
		}
		
		
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
	$pathUpload = $config['uploadDirectory'];
	
	try{
		$user=readUser($config,$id);
		deleteFile($user['photo'],$pathUpload);
		unset($user['photo']);
		$IdKey = $user['iduser'];
		
		//conectar al servidor
		$cnx = connectDB($config);
		$query = "DELETE FROM users_has_sports WHERE users_iduser = ".$IdKey;
		if (!mysqli_query($cnx,$query)) {
			echo('Mysql Error: '.mysqli_error());
			die;
		}
		$query = "DELETE FROM users WHERE iduser = ".$IdKey;
		if (!mysqli_query($cnx,$query)) {
			echo('Mysql Error: '.mysqli_error());
			die;
		}

		
		return TRUE;
	}catch(Exception $e){
		echo 'catch Exception: ',  $e->getMessage(), "\n";
		return FALSE;
	}
	
}

/**
 * Initialize user
 *
 * @return array $user
 */
function initUser(){
	$user=array(
			'name'=>'',
			'email'=>'',
			'password'=>'',
			'descripcion'=>'',
			'direccion'=>'',
			'pets'=>array(),
			'sports'=>array(),
			'genders_idgender'=>'',
			'cities_idcity'=>''
	);
	return $user;
}