<?php
/**
 * Index Controller
 * @version 1.0
 *
 */

switch ($route['action']){
	
	case 'index':
		$content = renderView($config,'index/index.php'); //.phtml
	break;

}

$layoutVars=array('content'=>$content,
				  'title'=>"Mi aplicacion");
$layout = renderlayout($config,'home.php',$layoutVars);
echo $layout;