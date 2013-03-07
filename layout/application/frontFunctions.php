<?php

function router($config)
{
	$controllerActions=array('users'=>array('insert','update','delete','select'),
							'index'=>array('index'),
							'author'=>array('login','logout'));
	$parse=explode('/',$_SERVER['REQUEST_URI']);

	$route['controller']=$parse[1];
	$route['action']=$parse[2];

	if(file_exists($config['path.controllers']."/".$route['controller'].".php"))
		if(in_array($route['action'],$controllerActions[$route['controller']]))
		{
			for($i=3;$i<sizeof($parse);$i+=2)
			{
				$_REQUEST[$parse[$i]]=$parse[$i+1];
			}
		}
		else
		{
			$route['controller']='error';
			$route['action']=NO_ACTION;
		}
	else
	{
		$route['controller']='index';
		$route['action']='index';
	}

// 	debug($route);
// 	debug($_REQUEST);

// 	die;
	return $route;
}