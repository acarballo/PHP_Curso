<?php

require_once "Zend/Loader.php";
Zend_Loader::loadClass('Zend_Gdata_AuthSub');
Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
Zend_Loader::loadClass('Zend_Gdata_Spreadsheets');
Zend_Loader::loadClass('Zend_Gdata_Docs');

/**
 * Return connection to google
 * @param unknown $config
 * @return string|boolean
 */
function getClient($config){
	try{
		$username = $config['username'];
		$password = $config['password'];		
		$service = Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME;
		$client = Zend_Gdata_ClientLogin::getHttpClient($username, $password, $service);
		return $client;
	}catch(Exception $e){
		echo 'catch Exception: ',  $e->getMessage(), "\n";
		return FALSE;
	}
}

/**
 * Read data from file
 * @return array|boolean
 */
function readUsers($config){
	$spreadsheetKey = $config['spreadsheetKey'];
	try{	
		$spreadsheetService = new Zend_Gdata_Spreadsheets(getClient($config));
		$query = new Zend_Gdata_Spreadsheets_DocumentQuery();
		$query->setSpreadsheetKey($spreadsheetKey);
		$feed = $spreadsheetService->getWorksheetFeed($query);
		$entries = $feed->entries[0]->getContentsAsRows();
		$users=$entries;
		return $users;
	}catch(Exception $e){
		echo 'catch Exception: ',  $e->getMessage(), "\n";
		return FALSE;
	}
}

/**
 * Read user data
 * @param integer $id
 * @return array
 */
function readUser($config,$id){	
	try{
		$users=readUsers($config);
		$user=array_values($users[$_GET['id']]);
		return $user;
	}catch(Exception $e){
		echo 'catch Exception: ',  $e->getMessage(), "\n";
		return FALSE;
	}
	
}

/**
 * insert user data
 * @param unknown $data
 * @return Ambigous <void, number>|boolean
 */
function insertUser($config,$data){
	$pathUpload = $config['uploadDirectory'];
	$spreadsheetKey = $config['spreadsheetKey'];
	$worksheetId='od6';//dafault worksheet id
	
	try{
		$namePhoto=updatePhoto('', $pathUpload);
		$data[]=$namePhoto;

		//load colum names. key in each row.
		$spreadsheetService = new Zend_Gdata_Spreadsheets(getClient($config));
		$query = new Zend_Gdata_Spreadsheets_DocumentQuery();
		$query->setSpreadsheetKey($spreadsheetKey);
		$feed = $spreadsheetService->getWorksheetFeed($query);
		$entries = $feed->entries[0]->getContentsAsRows();
		$ColumnNames = array_keys($entries[0]);//keys of one of the rows
		$id=count($entries);
		
		//make an array associative columnName=>Value
		$dataRow=array();
		$data = array_values($data);//only need the values
		$data[0]=$id+1;//put real id number
		for($i=0;$i<count($ColumnNames);$i++){
			if(isset($data[$i])){
				if(is_array($data[$i]))
					$dataRow[$ColumnNames[$i]]=implode(',',$data[$i]);
				else
					$dataRow[$ColumnNames[$i]]=$data[$i];
			}
			else
				$dataRow[$ColumnNames[$i]]='';
		}
		
		//insert row
		$spreadsheetService->insertRow($dataRow, $spreadsheetKey, $worksheetId);
		
		return $id;
	}catch(Exception $e){
		echo 'catch Exception: ',  $e->getMessage(), "\n";
		return FALSE;
	}
}

/**
 * update user data
 * @param unknown $id
 * @param unknown $data
 * @return boolean
 */
function updateUser($config,$id, $data){
	$pathUpload = $config['uploadDirectory'];
	$spreadsheetKey = $config['spreadsheetKey'];
	$worksheetId='od6';//default worksheet id
	
	try{
		//Update photo
		$user=readUser($config,$id);
		$nameNewPhoto=updatePhoto($user[11], $pathUpload);
		$data[]=$nameNewPhoto;
		
		//update each cell
		$spreadsheetService = new Zend_Gdata_Spreadsheets(getClient($config));
		$values = array_values($data);
		for($i=0;$i<count($values);$i++){
			if(isset($values[$i])){
				if(is_array($values[$i])){
					$values[$i]=implode(',',$values[$i]);
				}
				//Excel initial pos 1,1. 1¼row is the header for zend gData
				$spreadsheetService->updateCell($id+2,$i+1,$values[$i],$spreadsheetKey,$worksheetId);
			}
		}
		return TRUE;
	}catch(Exception $e){
		echo 'catch Exception: ',  $e->getMessage(), "\n";
		return FALSE;
	}

}

/**
 * delete user data
 * @param array $config
 * @param integer $id
 * @return TRUE|FALSE
 */
function deleteUser($config,$id){
	$pathUpload = $config['uploadDirectory'];
	$spreadsheetKey = $config['spreadsheetKey'];
	$worksheetId='od6';//default worksheet id
	
	try{
		//delete photo
		$user=readUser($config,$id);
		deleteFile($user[11],$pathUpload);
		
		//delete row in spreadsheet
		$spreadsheetService = new Zend_Gdata_Spreadsheets(getClient($config));
		$query = new Zend_Gdata_Spreadsheets_ListQuery();
		$query->setSpreadsheetKey($spreadsheetKey);
		$query->setWorksheetId($worksheetId);
		$listFeed = $spreadsheetService->getListFeed($query);
		
		$entry = $spreadsheetService->deleteRow($listFeed->entries[$id]);
		return TRUE;
	}catch(Exception $e){
		echo 'catch Exception: ',  $e->getMessage(), "\n";
		return FALSE;
	}
	
}