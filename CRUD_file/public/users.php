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

//select action.
switch ($action){
	case 'insert':
		echo('this is insert');
		include_once('usersForm.php');
	break;
	
	case 'update':
		echo('this is update');
	break;
	
	case 'delete':
		echo('this is delete');
	break;
	
	case 'select':
		echo('this is select');
		include_once('usersSelect.php');
	break;
		
	default:
		echo('this is default');
	break;		
}