<?php

class controllers_helpers_render{
	
	protected $config;
	
	public function __construct(){	
		$this->config=$_SESSION['register']['config'];
	}
//se pueden hacer estaticos para no instanciar -- ver	
	/**
	 * Render view
	 * @param unknown $view
	 * @param string $viewVars
	 * @return string
	 */
	function renderView($view, array $viewVars=null){	
		ob_start();
		include_once($this->config['path.views']."/".$view);
	
		$content=ob_get_clean();
		ob_end_flush();
	
		return $content;
	}
	
	/**
	 *
	 * @param unknown $config
	 * @param string $layout
	 * @param array $layoutVars
	 * @return string
	 */
	function renderlayout($layout=null, array $layoutVars=null){
	
		if($layout===NULL){
			$layout=$this->config['default.layout'];
		}
		ob_start();//buffer
		include_once($this->config['path.layout']."/".$layout);
		$layoutOut=ob_get_contents();
		ob_end_clean();
	
		return $layoutOut;
	}
	
	function ob_end_clean_all(){
		$s = "";
		do{
			$s = ob_get_contents() . $s;
		} while(ob_end_clean());
		return $s;
	}
	
}
