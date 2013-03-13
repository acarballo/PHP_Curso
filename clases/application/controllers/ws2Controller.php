<?php

class controllers_ws2Controller extends controllers_abstractController{

	protected $model;

	public function __construct(){
		$model = new models_users_users();
		$users = $model->readUsers();
		
	}

	public function indexAction(){
		include ('../library/Zend/Rest/Server.php');
		//echo("esto sera el servidor REST");
		
		
		
		$server = new Zend_Rest_Server();
		//$server->addFunction($this->getUsers);
		$server->setClass('models_users_users');
		//$server->returnResponse(TRUE);
		$server->handle();
		//die;
		
		///
		/*
		$gateway=models_dataGatewayMysql::getInstance();
		$gateUser= new models_users_users(); 
		
		//$users=$gateway->readUsers();
		$users=$gateUser->readUsers();
		$users=$gateUser->readUsersFromWS();
		
		
		$viewVars=array('users'=>$users,
						'title'=>"usuarios");
		$render = new controllers_helpers_render();
		$this->content = $render->renderView('users/select.php',$viewVars);*/
	}

	
	public function clientAction(){
		include ('../library/Zend/Rest/Client.php');
		//$server='http://10.0.3.121:8080/ws/index';
		$server='http://10.0.3.122:8081/ws2/index';

		$client = new Zend_Rest_Client($server);
		try{
		//$users = $client->readUsers()->get();
		//$users = $client->__call('readUsers');
			//$client->getHttpClient();
			//$users = $client->getHttpClient();
			$users =$client->readUsers()->post();
		}
		catch(Exception $e){
			echo($e);
		}
		
		echo('<br/>');
		echo('------');
		echo('<pre>');
		print_r($client);
		echo('<br/>');
		print_r($users);
		echo('</pre>');
		echo('------');
		echo('<br/>');
		
		foreach ($users as $key=>$value){
			$html='';
			
			
		}
		
		//echo $html;
		$myUser = $users; //lo que viene esta protegido
		return $myUser;
	}
	
	public function getUsers(){
		echo("esto es getUsers en el servidor REST");
	}
	
	public function errorAction(){

	}

	public function debugAction(){

	}

	public function render(){
	}

}