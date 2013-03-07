<?php   //tmp in the public folder

/**
 * User controller
 * @version 1.0
 * 
 */


//include Models
include_once '../application/models/users/usersFunctions.php';

//select action.
switch ($route['action']){
	case 'insert':
		if($_POST){
			//debug('',$_POST,TRUE);
			insertUser($config,$_POST);
			header('Location: /users/select');
			exit;
		}
		else {//entrada en insert, leo y pongo los datos
			//ob_start();//buffer
			
			//$pets=array();
			//$sports=array();
		//	$user=initUser();
		//	include_once('../application/views/forms/user.php');
			
		//	$content=ob_get_clean();
		//	ob_end_flush();
			
			$user=initUser();
			$viewVars=array('user'=>$user,
					'title'=>"usuarios");
			$content = renderView($config,'forms/user.php',$viewVars);
		}		
	break;
	
	case 'update':
		if($_POST){
			//debug('user',$_POST,TRUE);
			updateUser($config,$_POST['id'],$_POST);
			header('Location: /users/select');
			exit;
		}
		else {//entrada en update, leo y pongo los datos
			//ob_start();//buffer
			
			$user=initUser();
			$user=readUser($config,$_REQUEST['id']);
			//$pets=$user[8];
			//$sports=$user[9];	
			//$pets=commaToArray($user[8]);
			//$sports=commaToArray($user[9]);
			//debug('user',$user,TRUE);
		//	include_once('../application/views/forms/user.php');
			
		//	$content=ob_get_clean();
		//	ob_end_flush();
			
			$viewVars=array('user'=>$user,
					'title'=>"usuarios");
			$content = renderView($config,'forms/user.php',$viewVars);
		}
		
	break;
	
	case 'delete':
		if(!$_POST){ //inicio, pregunta Si o no 
			//ob_start();//buffer
		
			//include_once('../application/views/users/delete.php');
			
			//$content=ob_get_clean();
			//ob_end_flush();
			//debug('',$_REQUEST,TRUE);
			$content = renderView($config,'users/delete.php');
		}
		else{
			
			if($_POST['submit']=='Si'){
				deleteUser($config,$_REQUEST['id']);
			}
			header('Location: /users/select');
			exit;
		}
	break;
	
	case 'index':
	case 'select':
		//ob_start();//buffer 
		//$users=readUsers($config);
		//include_once('../application/views/users/select.php');
		//$content=ob_get_clean();
		//ob_end_flush();
		$users=readUsers($config);
		$viewVars=array('users'=>$users,
						'title'=>"usuarios");
		$content = renderView($config,'users/select.php',$viewVars);
	break;
		
	default:
		echo('this is default');
	break;		
}

//render layout (postdispatch)

//include_once '../application/layout/layout.php';
$layoutVars=array('content'=>$content,
				  'title'=>"Mi aplicacion");
$layout = renderlayout($config,'layout.php',$layoutVars);
echo $layout;