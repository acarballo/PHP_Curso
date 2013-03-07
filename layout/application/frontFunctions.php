<?php

/**
 * Router
 * @param array $config
 * @return array
 */
function router($config){
	
	//manual array to set actions enabled in each controller
	$controllerActions=array('users'=>array('insert','update','delete','select'),
							'index'=>array('index'),
							'author'=>array('login','logout'));
	
	$parse=explode('/',$_SERVER['REQUEST_URI']);
//debug('mac', $parse,TRUE);
	//read Controller / action
	$route['controller']=isset($parse[1])?($parse[1]):'index';
	$route['action']=isset($parse[2])?($parse[2]):'index';
	
	//Check Controller / action
	if(file_exists($config['path.controllers']."/".$route['controller'].".php"))
		if(in_array($route['action'],$controllerActions[$route['controller']])){
			for($i=3;$i<sizeof($parse);$i+=2){
				$_REQUEST[$parse[$i]]=$parse[$i+1];
			}
		} 
		else {
			$route['controller']='error';
			$route['action']=NO_ACTION;
		} 
	else {
		$route['controller']='index';
		$route['action']='index';
	}

	return $route;
}