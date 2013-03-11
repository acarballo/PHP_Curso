<?php   

class controllers_users{

	protected $config;
	private $route;
	
	public function __construct($route){
		//include Models
		include_once '../application/models/users/usersFunctions.php';
		
		$this->route = $route;
		$this->config = $_SESSION['register']['config'];
		
		$this->miswitch();
		$this->render();
	}
	
	public function miswitch(){

		switch ($this->route['action']){
			case 'insert':
				$this->insertAction();
				break;	
			case 'update':
				$this->updateAction();
				break;
			case 'delete':
				$this->deleteAction();
				break;
			case 'index':
			case 'select':
				$this->selectAction();
				break;
			default:
				echo('this is default');
				break;
		}
	}
	
	public function selectAction(){
		$users=readUsers($config);
		$viewVars=array('users'=>$users,
				'title'=>"usuarios");
		$content = renderView($config,'users/select.php',$viewVars);
	}
	
	public function insertAction(){
		if($_POST){
			insertUser($config,$_POST);
			header('Location: /users/select');
			exit;
		}
		else {
			$user=initUser();
			$viewVars=array('user'=>$user,
					'title'=>"usuarios");
			$content = renderView($config,'forms/user.php',$viewVars);
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

	function render(){
		$layoutVars=array('content'=>$content,
				'title'=>"Mi aplicacion");
		$layout = renderlayout($config,'layout.php',$layoutVars);
		echo $layout;	
	}

}