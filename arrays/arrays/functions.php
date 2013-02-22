<?php

/**
 * Recibe un array de 2 dimensiones max y lo muestra por pantalla
 * @param array $array
 * @return true
 */
function mostrar_array($array){
	foreach($array as $key => $value){
		echo $key.": ";
		if(is_array($value)){
			//	foreach($value as $value2){
			//		echo $value2.",";
			//	}
			echo implode(',',$value);
		}
		else
			echo $value;
		echo"</br>";
	}
	echo"</br>";
	return TRUE;
}