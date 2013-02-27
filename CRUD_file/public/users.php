<?php
//tmp in the public folder

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
//hacer funcion readConfig($filename,$section)
$config = parse_ini_file('../application/configs/config.ini',true);
$userFilename = $config['production']['userFilename'];
$pathUpload = $config['production']['uploadDirectory'];

//include Models
include_once '../application/models/functions.php';
include_once '../application/models/filesFunctions.php';
include_once '../application/models/users/usersFunctions.php';

//select action.
switch ($action){
	case 'insert':
		echo('this is insert');
		include_once('../application/views/forms/users.php');
	break;
	
	case 'update':
		if($_POST){
			echo "agregar datos";
			
			$arrayDatos=readDataFromFile($userFilename);
			$user = $arrayDatos[$_GET['id']];
			$imageName=updatePhoto($_FILES["photo"]["tmp_name"],$user[11],$pathUpload);
			$_POST[]=$name; //last position

			$arrayDatos[$_POST['id']] = $_POST;			
			writeDataToFile($userFilename,$arrayDatos,TRUE);
					
			header('Location: /users.php');
			exit;
		}
		else{
			$arrayDatos=readDataFromFile($userFilename);
			$usuario = $arrayDatos[$_GET['id']];
			$pets = commaToArray($usuario[8]);
			$sports = commaToArray($usuario[9]);
		}

		include_once('../application/views/forms/users.php');
	break;
	
	case 'delete':
		$arrayDatos=readDataFromFile($userFilename);
		$usuario = $arrayDatos[$_GET['id']];		
		include_once('../application/views/users/delete.php');
	break;
	
	case 'select':
		echo('this is select');
		$arrayLine=readDataFromFile($userFilename);
		include_once('../application/views/users/select.php');
	break;
		
	default:
		echo('this is default');
	break;		
}