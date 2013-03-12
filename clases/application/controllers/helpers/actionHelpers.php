<?php

class controllers_helpers_actionHelpers{

	static function debug($label, $data, $die=FALSE){
		echo("<pre>");
		echo("file:".__FILE__."<br/>");
		echo("line:".__LINE__."<br/>");
		echo("function:".__FUNCTION__."<br/>");
		echo("data:".$label."<br/>");
		print_r($data);
		echo("</pre>");
		if($die) die;
	}
	
}


