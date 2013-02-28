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

//Include DataGateways
include_once '../application/models/dataGatewayFiles.php';

//include Models
include_once '../application/models/files/functions.php';
include_once '../application/models/files/filesFunctions.php';
include_once '../application/models/users/usersFunctions.php';


//read configuration
$config = readConfig('../application/configs/config.ini','production');
//$config = parse_ini_file('../application/configs/config.ini',true);
$userFilename = $config['userFilename'];
$pathUpload = $config['uploadDirectory'];

//select action.
switch ($action){
	case 'insert':
		if($_POST){
			$name=updatePhoto('', $pathUpload);
			$_POST[]=$name;
			writeDataToFile($userFilename, $_POST, FALSE);
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
			$users=readUsers();
			$user=$users[$_POST['id']];
			$name=updatePhoto($user[11], $pathUpload);
			$_POST[]=$name;
			$users[$_POST['id']]=$_POST;	
					
			writeDataToFile($userFilename, $users, TRUE);			
			header('Location: /users.php');
			exit;
		}
		else {//entrada en update, leo y pongo los datos
			//$dataArray=readDataFromFile($userFilename);
			//$usuario=$dataArray[$_GET['id']];		
			$user=readUser($_GET['id']);
			$pets=commaToArray($user[8]);
			$sports=commaToArray($user[9]);
				
			include_once('../application/views/forms/user.php');
		}
	break;
	
	case 'delete':
		if(!$_POST){ //inicio, pregunta Si o no 
			//$user=readUser($_GET['id']);
			include_once('../application/views/users/delete.php');
		}
		else{
			if($_POST['submit']=='Si'){
				//$users=readDataFromFile($userFilename);	
				//$userdata=$dataFileArray[$_GET['id']];//no lo tengo en el POST ya que he quitado el imput hidden del id en la view
				//$user=readUser($_GET['id']);//no lo tengo en el POST ya que he quitado el imput hidden del id en la view
				//deleteFile($user[11],$pathUpload);
				//unset($dataFileArray[$_GET[id]]);
				//writeDataToFile($userFilename, $users, TRUE);	
				deleteUser($_GET['id']);
			}
			header('Location: /users.php');
			exit;
		}
	break;
	
	case 'select':
		$users=readUsers();
		include_once('../application/views/users/select.php');
	break;
		
	default:
		echo('this is default');
	break;		
}