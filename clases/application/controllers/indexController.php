<?php

class controllers_indexController extends controllers_abstractController{

	protected $content;

	public function __construct(){
	}

	public function indexAction(){
		$render = new controllers_helpers_render();
		$this->content = $render->renderView('index/index.php'); 
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