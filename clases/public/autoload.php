<?php


function __autoload($className) {
		
	//classpath en config
	//echo('aqui');
	//die;

	try{
		$classPath = '../application/'.str_replace('_', '/', $className).'.php';
		if(file_exists($classPath)){
			require_once $classPath;
			//return TRUE;
		} else {
			throw  new Exception("File not found");
		}

	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}

}
