<?php

class Application{

	private $configPath;
	private $env;
	private $route;
	
	public function __construct($configPath, $env){
		$this->configPath=$configPath;
		$this->env=$env;
		
		return $this;
	}
	
	public function Bootstrap(){
		$this->route = new Bootstrap($this->configPath, $this->env);
		
		return $this;
	}
	
	public function frontController(){
		new controllers_frontController($this->route);
	}
	
}

