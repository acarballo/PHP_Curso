<?php

/**
 * 
 * @param string $className
 * @throws Exception
 */
function __autoload($className) {
		
	try{
		$classPath = '../../application/'.str_replace('_', '/', $className).'.php';
		if(file_exists($classPath))
			require_once $classPath;
		else 
			throw new Exception("File not found");
	}catch(Exception $e){
		echo '--- exception: ', $e->getMessage(), "\n";
	}
		
}
