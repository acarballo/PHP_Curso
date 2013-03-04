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

function printDataPreformated($data){
	echo("<pre>");
	print_r($data);
	echo("</pre>");
}

