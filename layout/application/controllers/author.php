<?php

/**
 * Author Controller
 * 
 * @version 1.0 
 * 
 */


// Include model
include_once('../application/models/author/authorFunctions.php');

switch ($route['action']){
	
	case 'login':
		if($_POST){
			$login=loginUser($config,$_POST);
			if($login===TRUE){
				header('Location: /users/select');
				exit;
			}			
		}			
		$content=renderView($config, 'author/login.php', $viewVars);
		
	break;
	
	case 'logout':
		//unset($_SESSION['iduser']);
		session_destroy();
		header('Location: /index/index');
		exit;
		
	break;
	
}


$layoutVars=array('content'=>$content,
		'title'=>'Mi application');
$layout=renderLayout($config, "login.php",$layoutVars);

echo $layout;