<?php

class controllers_frontController{
	
	protected $config;
	
	public function __construct($router){

		$route = $router->getRoute();
		$this->config = $_SESSION['register']['config'];
		
		$controller = "controllers_".$route['controller']."controller";
		$action = $route['action']."Action";
		
		/*echo('<pre>');
		echo($controller);
		echo($action);
		echo('</pre>');
		die;*/
		
		$controller = new $controller;
		$controller->$action();		
		$controller->render();
	}

}