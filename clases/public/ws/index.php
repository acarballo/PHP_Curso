<?php

require_once ('autoload.php');
$configPath="../../application/configs/config.ini";

session_start();
$_SESSION['register']=array();
$_SESSION['app']=array();

$configHeper = new controllers_helpers_config($configPath);
$config = $configHeper->readConfig('mysql_dev');
$_SESSION['register']['config']=$config;

$gateUser= new models_users_users();
$users=$gateUser->readUsers();

echo('<pre>');
echo print_r($users);
echo('</pre>');