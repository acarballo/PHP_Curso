<?php

class Application_Model_DbTable_Users extends Zend_Db_Table_Abstract
{
	protected $_name = 'users';

	public function getUser($id)
	{
		$id = (int)$id;
		$row = $this->fetchRow('iduser = ' . $id);
		if (!$row) {
			throw new Exception("Could not find row $id");
		}
		return $row->toArray();
	}
	public function addUser($name, $email, $password,$descripcion,$direccion,$genders_idgender,$cities_idcity,$sports,$pets)
	{
		$data = array(
				'name' => $name,
				'email' => $email,
		        'password' => $password,
		        'password' => $password,
		        'direccion' => $direccion,
		        'descripcion' => $descripcion,
		        'genders_idgender' => $genders_idgender,
		        'cities_idcity' => $cities_idcity,
		        'sports' => $sports,
		        'pets'=>$pets,
		        'roles_idrole' => 1,
 		        
		);
		$this->insert($data);
	}
	public function updateUser($id, $name, $email, $password,$descripcion,$direccion,$genders_idgender,$cities_idcity,$sports,$pets)
	{
		$data = array(
				'name' => $name,
				'email' => $email,
		        'password' => $password,
		        'password' => $password,
		        'direccion' => $direccion,
		        'descripcion' => $descripcion,
		        'genders_idgender' => $genders_idgender,
		        'cities_idcity' => $cities_idcity,
		        'sports' => $sports,
		        'pets'=>$pets,
		        'roles_idrole' => 1,
		);
		$this->update($data, 'iduser = '. (int)$id);
	}
	public function deleteUser($id)
	{
		$this->delete('iduser =' . (int)$id);
	}
}