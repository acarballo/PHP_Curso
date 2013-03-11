<?php

require_once ('autoload.php');
$config="../application/configs/config.ini";

define('APPLICATION_ENV', getenv('APPLICATION_ENV'));
if(!defined('APPLICATION_ENV'))
	define('APPLICATION_ENV', 'production');


define ('NO_ACTION', 'no_action');
define ('NO_CONTROLLER', 'no_controller');


/*
if(isset(getenv('APPLICATION_ENV')))
	define('APPLICATION_ENV', getenv('APPLICATION_ENV'));
else 
	define('APPLICATION_ENV', 'production');
*/

$application = new Application ($config, APPLICATION_ENV);
$application->Bootstrap()
			->frontController();
//$application->Bootstrap();
//			->run  

//2013
//$bootstrap = new Bootstrap();
//$frontControllers = new controllers_frontController($bootstrap);


//$frontController = new controllers_frontController();