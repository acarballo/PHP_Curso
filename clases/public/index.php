<?php

require_once ('autoload.php');
$configPath="../application/configs/config.ini";

define('APPLICATION_ENV', getenv('APPLICATION_ENV'));
if(!defined('APPLICATION_ENV'))
	define('APPLICATION_ENV', 'production');

define ('NO_ACTION', 'no_action');
define ('NO_CONTROLLER', 'no_controller');

$application = new Application ($configPath, APPLICATION_ENV);
$application->Bootstrap()
			->frontController();