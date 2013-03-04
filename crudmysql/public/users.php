<?php   //tmp in the public folder

/**
 * User controller
 * @version 1.0
 * 
 */

if(isset($_GET['action']))
	$action=$_GET['action'];
else
	$action='select';	



//read configuration 
include_once '../application/configs/configFunctions.php';
$config = readConfig('../application/configs/config.ini','mysql');
$typeDataSave=$config['typeDataSave']; //production/development/googlepru/mysql]

//include DataGateways
if($typeDataSave=='google'){
	include_once '../application/models/dataGatewayGoogle.php';
} else if($typeDataSave=='mysql'){
	include_once '../application/models/dataGatewayMysql.php';
} else {
	include_once '../application/models/dataGatewayFiles.php';
}

//include Models
include_once '../application/models/files/functions.php';
include_once '../application/models/files/filesFunctions.php';
include_once '../application/models/users/usersFunctions.php';


//select action.
switch ($action){
	case 'insert':
		if($_POST){
			insertUser($config,$_POST);
			header('Location: /users.php');
			exit;
		}
		else {//entrada en insert, leo y pongo los datos
			$pets=array();
			$sports=array();
			include_once('../application/views/forms/user.php');
		}		
	break;
	
	case 'update':
		if($_POST){
			updateUser($config,$_POST['id'],$_POST);
			header('Location: /users.php');
			exit;
		}
		else {//entrada en update, leo y pongo los datos
			$user=readUser($config,$_GET['id']);
			//$pets=$user[8];
			//$sports=$user[9];	
			$pets=commaToArray($user[8]);
			$sports=commaToArray($user[9]);
			
			include_once('../application/views/forms/user.php');
		}
	break;
	
	case 'delete':
		if(!$_POST){ //inicio, pregunta Si o no 
			include_once('../application/views/users/delete.php');
		}
		else{
			if($_POST['submit']=='Si'){
				deleteUser($config,$_GET['id']);
			}
			header('Location: /users.php');
			exit;
		}
	break;
	
	case 'select':
		$users=readUsers($config);
		include_once('../application/views/users/select.php');
	break;
		
	default:
		echo('this is default');
	break;		
}