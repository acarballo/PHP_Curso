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
 * 
 * @param unknown $data
 */
function printDataPreformated($data){
	echo("<pre>");
	print_r($data);
	echo("</pre>");
}

/**
 * 
 * @param unknown $city
 * @return number|NULL
 */
function getCity($city){
	switch ($city){
		case 'vigo':
				return 3;
				break;
		case 'bcn':
				return 2;
				break;
		case 'bilbao':
				return 4;
				break;				
		default: return NULL;
	}
}

/**
 * 
 * @param unknown $gender
 * @return number|NULL
 */
function getGender($gender){
	switch ($gender){
		case 'H':
			return 1;
			break;
		case 'M':
			return 2;
			break;
		case 'O':
			return 3;
			break;
		default: return 4;
	}
}


function getSport($sport){
	switch ($sport){
		case 'futbol':
			return 2;
			break;
		case 'beisbol':
			return 1;
			break;
		case 'natacion':
			return 3;
			break;
		default: return NULL;
	}
}