<?php

/**
 * Read comma separated string to array
 * @param unknown $comaValue
 * @return multitype:
 */
function commaToArray($comaValue){
	$array=array();
	if(!empty($comaValue))
		$array=explode(',',$comaValue);
	else
		$array=array();
	return $array;
}

/**
 * Convert an array, máx two dimensions,
 * in an string separated by comma and pipes.
 *
 * @param array array de entrada
 * @return array comma separated
 */
function arrayToPipes($array){
	$result = array();
	foreach ($array as $key => $value){
		if(is_array($value))
			$result[]=implode(',', $value);
		else
			$result[]=$value;
	}
	$result=implode('|',$result);
	return $result;
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