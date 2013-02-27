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

//include Models
include_once '../application/models/filesFunctions.php';

//select action.
switch ($action){
	case 'insert':
		echo('this is insert');
		include_once('usersForm.php');
	break;
	
	case 'update':
		echo('this is update');
		
		$arrayDatos=readDataFromFile($userFilename);

		
		if(isset($_GET['id']))
		{
			// Leer posicion id del array
			$usuario=$arrayDatos[$_GET['id']];
		
			//Convertir en array
			$usuario=explode("|",$usuario);
		}
		
		// echo "<pre>";
		// print_r($usuario);
		// echo "</pre>";
		
		
		if(!empty($usuario[8]))
			$pets=explode(',',$usuario[8]);
		else
			$pets=array();
		
		if(!empty($usuario[9]))
			$sports=explode(',',$usuario[9]);
		else
			$sports=array();
		
		include_once('usersForm.php');
	break;
	
	case 'delete':
		echo('this is delete');
	break;
	
	case 'select':
		echo('this is select');
		$arrayLine=readDataFromFile($userFilename);
		include_once('usersSelect.php');
	break;
		
	default:
		echo('this is default');
	break;		
}