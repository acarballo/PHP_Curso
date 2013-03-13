<?php

class controllers_frontController{
	
	protected $config;
	
	public function __construct($router){

		/*
		echo('<pre>');
		echo(print_r($router));
		echo('<br/>');
		echo('</pre>');
		*/

		
		$route = $router->getRoute();

		//FIXME ÑAPA 
		if(!isset($route['controller'])||$route['controller']==''){
			$route['controller']='index';
		}
		if(!isset($route['action'])||$route['action']==''){
			$route['action']='index';
		}
		
		/*
		echo('<pre>');
		echo(print_r($route));
		echo('<br/>');
		echo('</pre>');
		die;*/
		
		$this->config = $_SESSION['register']['config'];
		
		$controller = "controllers_".$route['controller']."controller";
		$action = $route['action']."Action";
		
		/*echo('<pre>');
		echo($controller);
		echo('<br/>');
		echo($action);
		echo('</pre>');*/
		//die;
		
		$controller = new $controller;
		$controller->$action();		
		$controller->render();
	}

	public function __destruct(){
		//poner el render aqui, tengo que poner el $controller como  
		//cuando se destruye el objeto ???
	}
	
}