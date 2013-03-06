<?php
//render view functions

/**
 * Render view
 * @param unknown $config
 * @param unknown $view
 * @param string $viewVars
 * @return string
 */
function renderView($config, $view, array $viewVars=null){

	ob_start();//buffer
		include_once($config['path.views']."/".$view);
	
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
function renderlayout($config, $layout=null, array $layoutVars=null){
	
	if($layout===NULL){
		$layout=$config['default.layout'];
	}
	//debug('',$config['path.layout']."/".$layout,TRUE);
	ob_start();//buffer
		include_once($config['path.layout']."/".$layout);
		$layoutOut=ob_get_contents();
		//$layoutOut=ob_end_clean_all();
		ob_end_clean();
	//ob_end_flush();
	
	return $layoutOut;
}

function ob_end_clean_all()
{
	$s = "";
	do
	{
		$s = ob_get_contents() . $s;
	} while(ob_end_clean());
	return $s;
}