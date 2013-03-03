<?php
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