<?php

class Bootstrap
{

	// Start Session
	// Read configuration
	
	// Include DataGateways
	// Include actionHelpers
	// Include viewHelpers
	// Include Models
	// Include Front functions
	// Route
	// Acl
	
	private $config;
	private $env;
	private $route;
	
	public function __construct($config, $env){
		$this->config=$config;
		$this->env=$env;
		
		$this->startRegister();
		$this->readConfig();
		$this->router($this->config);
		$this->route=$this->acl($this->route);
		
		return $this->route;
	}
	
	protected function startRegister(){
		session_start();
		$_SESSION['register']=array();
		$_SESSION['app']=array();
	}
	
	protected function readConfig(){

		include_once '../application/controllers/helpers/actionHelpersFunctions.php';
		$config = readConfig($this->config,$this->env);
		//$typeDataSave=$config['typeDataSave']; //production/development/googlepru/mysql]
		$_SESSION['register']['config']=$config();
		
	}
	
	protected function router(){
		$this->route=router($this->config);
	}
	
	protected function acl(){
		
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

	/**
	 * @param field_type $route
	 */
	public function setRoute($route) {
		$this->route = $route;
	}
	
	
}