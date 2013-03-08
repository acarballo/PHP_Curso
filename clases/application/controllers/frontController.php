<?php

class controllers_frontController
{

	public function __construct($router){
		include ($config['path.controllers']."/".$router['controller']."php");
	}

}