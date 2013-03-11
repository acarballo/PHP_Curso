<?php

class controllers_frontController{
	
	protected $config;
	
	public function __construct($router){

		$route = $router->getRoute();
		$this->config = $_SESSION['register']['config'];
				
		//new controller etc .......		
		//include ($this->config['path.controllers']."/".$router['controller']."php");
		
		$controller = "controllers_".$route['controller']."controller";
		$action = $route['action']."Action";
		$controller = new $controller;
		$controller->$action();
		
	}

}