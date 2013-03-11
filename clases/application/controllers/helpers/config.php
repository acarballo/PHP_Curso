<?php

class controllers_helpers_config{
	
	private $configPath;
	
	public function __construct($configPath){
		$this->configPath=$configPath;
	}

	/**
	 * Read ini file section with inheritance
	 * @param string $filename
	 * @param string $section
	 */
	public function readConfig($env){
		$result=array();
		$config = parse_ini_file($this->configPath,true);
		foreach ($config as $key => $value){
			$keyH = explode(":",$key);
			if($keyH[0]==$env){
				if(isset($keyH[1])){
					$result=$this->readConfig($this->configPath,$keyH[1]);
				}
				$result=array_merge($result,$value);
			}
		}
		return $result;
	}
}