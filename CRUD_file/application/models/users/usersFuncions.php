<?php

function readPets($Pets){
	if(!empty($Pets))
		$pets=explode(',',$Pets);
	else
		$pets=array();
	return $pets;
}

function readSport($Sports){
	if(!empty($Sports))
		$sports=explode(',',$Sports);
	else
		$sports=array();
	return $sports;
}