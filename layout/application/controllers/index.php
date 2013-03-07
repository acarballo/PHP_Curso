<?php
/**
 * User index
 * @version 1.0
 *
 */

switch ($route['action']){
	
	case 'index':
		$content = renderView($config,'index/index.php'); //.phtml
	break;

}


$layout = renderlayout($config,'home.php');
echo $layout;