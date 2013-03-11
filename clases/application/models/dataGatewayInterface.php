<?php

interface models_dataGatewayInterface{
	function readUsers();
	function readUser($id);
	function insertUser($data);
	function updateUser($id,$data);
	function deleteUser($id);
}

