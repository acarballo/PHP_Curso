<?php

/**
 * Users Controller
 * 
 * @version 1.0 
 */
class controllers_usersController extends controllers_abstractController{
	
	protected $config;
	protected $content;
	
	public function __construct(){
		
		$this->config=$_SESSION['register']['config'];

	}

	public function selectAction(){
		$gateway=new models_dataGatewayMysql();
		$users=$gateway->readUsers();
		$viewVars=array('users'=>$users,
						'title'=>"usuarios");
		$render = new controllers_helpers_render();
		$this->content = $render->renderView('users/select.php',$viewVars);
	}

	public function insertAction(){
		$gateway=new models_dataGatewayMysql();
	
		if(!$_POST){
			$user=$gateway->initUser();
			$viewVars=array('user'=>$user,
					'title'=>"usuarios");
			$render = new controllers_helpers_render();
			$this->content = $render->renderView('forms/user.php',$viewVars);
		}
		else {
			$gateway->insertUser($_POST);
			header('Location: /users/select');
			exit;
		}
	}
	
	public function updateAction(){
		if($_POST){
			updateUser($config,$_POST['id'],$_POST);
			header('Location: /users/select');
			exit;
		}
		else {
			$user=initUser();
			$user=readUser($config,$_REQUEST['id']);
	
			$viewVars=array('user'=>$user,
					'title'=>"usuarios");
			$content = renderView($config,'forms/user.php',$viewVars);
		}
	}
	
	public function deleteAction(){
		if(!$_POST){ //inicio, pregunta Si o no
			$content = renderView($config,'users/delete.php');
		}
		else{
	
			if($_POST['submit']=='Si'){
				deleteUser($config,$_REQUEST['id']);
			}
			header('Location: /users/select');
			exit;
		}
	}
	
	public function indexAction(){

	}

	public function errorAction(){

	}

	public function debugAction(){

	}

	public function render(){
		$layoutVars=array('content'=>$this->content,
				'title'=>"Mi aplicacion");
		$render = new controllers_helpers_render();
		$layout = $render->renderlayout('layout.php',$layoutVars);
		echo $layout;
	}
	
}