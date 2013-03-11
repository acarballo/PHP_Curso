<?php

class Application{

	private $config;
	private $env;
	private $route;
	
	public function __construct($config, $env){
		$this->config=$config;
		$this->env=$env;
		
		return $this;
	}
	
	public function Bootstrap(){
		$this->route = new Bootstrap($this->config, $this->env);
		
		return $this;
	}
	
	public function frontController(){
		new controllers_frontController($this->route);
	}
	
}

