<?php

class models_dataGatewayMysql {

	protected $config;
	private $instance;
	public $link;
	
	private function __construct(){	
		$this->config=$_SESSION['register']['config'];
		$this->link=$this->connectDB();
	}	

	static public function getInstance(){
		if(isset($self->instance)){
			return $self->instance;
		} else {
			$self->instance = new models_dataGatewayMysql();
			return $self->instance;
		} 
		
	}
	
	/**
	 * Connect to Mysql
	 * @param array $config
	 * @return resource $cnx
	 */
	function connectDB(){
		//leer configuracion
		$dbserver = $this->config["db.server"];
		$dbdatabase = $this->config["db.database"];
		$dbuser = $this->config["db.user"];
		$dbpassword = $this->config["db.password"];
		$cnx = mysqli_connect($dbserver,$dbuser,$dbpassword);
		mysqli_select_db($cnx,$dbdatabase);
		//$cnx = mysqli_connect($dbserver,$dbuser,$dbpassword,$dbdatabase);
		
		return $cnx;
	}	

	/**
	 * Disconnect from Mysql
	 * @param unknown $cnx
	 */
	function disconnectDB($cnx)
	{
		mysqli_close($cnx);
		return;
	}
			
}