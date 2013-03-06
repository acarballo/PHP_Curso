<?php

/**
 * Debug. Show information formated. Optional break the execution
 * @param string $label
 * @param unknown $data
 * @param boolean $die
 */
function debug($label, $data, $die=FALSE){
	echo("<pre>");
	echo("file:".__FILE__."<br/>");
	echo("line:".__LINE__."<br/>");
	echo("function:".__FUNCTION__."<br/>");
	echo("data:".$label."<br/>");
	print_r($data);
	echo("</pre>");
	if($die) die;
}

/**
 * Read ini file section with inheritance
 * @param string $filename
 * @param string $section
 */
function readConfig($filename,$section){
	$result=array();
	$config = parse_ini_file($filename,true);
	foreach ($config as $key => $value){
		$keyH = explode(":",$key);
		if($keyH[0]==$section){
			if(isset($keyH[1])){
				$result=readConfig($filename,$keyH[1]);
			}
			$result=array_merge($result,$value);
		}
	}
	return $result;
}