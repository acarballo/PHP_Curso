<?php

function debug($label, $data){
	//echo("<pre>".__FILE__.$label);
	//echo("<pre>".$_SERVER[PHP_SELF].$label);
	echo("<pre>".$label);
	print_r($data);
	echo("</pre>");
}


//poner aqui el readconfig ahora esta en configs/configFunctions.php