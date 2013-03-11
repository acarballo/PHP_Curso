<?php

class Bootstrap{

	// Start Session
	// Read configuration
	
	// Include DataGateways
	// Include actionHelpers
	// Include viewHelpers
	// Include Models
	// Include Front functions
	// Route
	// Acl
	
	private $configPath;
	private $env;
	private $route;
	
	public function __construct($configPath, $env){
		$this->configPath=$configPath;
		$this->env=$env;
		
		$this->startRegister();
		$this->readConfig();
		$this->route=$this->router($this->configPath);
		$this->route=$this->acl($this->route);
		
		return $this->route;
	}
	
	protected function startRegister(){
		session_start();
		$_SESSION['register']=array();
		$_SESSION['app']=array();
	}
	
	protected function readConfig(){

		$configHeper = new controllers_helpers_config($this->configPath);
		$config = $configHeper->readConfig($this->env);
		$_SESSION['register']['config']=$config;
		
	}
	
	protected function router(){
		//$this->route=router($this->config);

		$config=$this->config;
		$controllerActions=array(
				'index'=>array('index'),
				'author'=>array('login','logout'),
				'users'=>array('insert','update','delete','select')
		);
		$parse=explode('/',$_SERVER['REQUEST_URI']);
		
		$route['controller']=$parse[1];
		@$route['action']=$parse[2];
		
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
			// 		$route['controller']='error';
			// 		$route['action']=NO_CONTROLLER;
		
			$route['controller']='index';
			$route['action']='index';
		}
		
		// 	debug($route);
		// 	debug($_REQUEST);
		
		// 	die;
		
		$this->route=$route;
	}
	
	protected function acl(){
		$route=$this->route;
		if(!isset($_SESSION['idrol']))
		{
			// FIXME: -8.03.2013-acl-: HARDCODE DEFAULT ROL
			$_SESSION['idrol']=4;
		}
		
		
		$permissions = array('1'=>
				array('index'.'.'.'index',
						'author'.'.'.'login',
						'author'.'.'.'logout',
						'users'.'.'.'select',
						'users'.'.'.'insert',
						'users'.'.'.'update',
						'users'.'.'.'delete'),
				'3'=>array('index'.'.'.'index',
						'author'.'.'.'login',
						'author'.'.'.'logout'),
				'4'=>array('index'.'.'.'index',
						'author'.'.'.'login',
						'author'.'.'.'logout')
		);
		
		
		if(isset($_SESSION['iduser']))
		{
			if(in_array($route['controller'].'.'.$route['action'],
					$permissions[$_SESSION['idrol']]))
			{
				return $route;
			}
		}
		elseif($_SESSION['idrol']===4)
		{
			if(in_array($route['controller'].'.'.$route['action'],
					$permissions[$_SESSION['idrol']]))
			{
				return $route;
			}
		
		}
		$route['controller']='users';
		$route['action']='select';
		
		
		$this->route=$route;
		return $this->route;
		
	}
	
/* pasarlos a clases 	
	if($typeDataSave=='google'){
		include_once '../application/models/dataGatewayGoogle.php';
		include_once '../application/models/files/functions.php';
		include_once '../application/models/files/filesFunctions.php';
	} else if($typeDataSave=='mysql'){
		include_once '../application/models/dataGatewayMysql.php';
		include_once '../application/models/mysql/functions.php';
		include_once '../application/models/mysql/filesFunctions.php';
	} else {
		include_once '../application/models/dataGatewayFiles.php';
		include_once '../application/models/files/functions.php';
		include_once '../application/models/files/filesFunctions.php';
	}
	include_once '../application/views/helpers/helpersFunctions.php';
	include_once '../application/controllers/helpers/viewsFunctions.php';
	
	include_once('../application/frontFunctions.php');
	*/
	/**
	 * @return the $route
	 */
	public function getRoute() {
		return $this->route;
	}	
	
}