<?php

class UsersController  extends Zend_Controller_Action{
    
    public function init()
    {
    	/* Initialize action controller here */
    }
    
    public function indexAction()
    {
        $users = new Application_Model_DbTable_Users();
        $this->view->users = $users->fetchAll();
    }
    
    public function addAction()
    {
        $form = new Application_Form_user();
        $form->submit->setLabel('Add');
        $this->view->form = $form;
         
        if ($this->getRequest()->isPost()) {
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        	    
        	    $name = $form->getValue('name');
        		$email = $form->getValue('email');
        		$password = $form->getValue('password');
        		$direccion = $form->getValue('direccion');
        		$descripcion = $form->getValue('descripcion');
        		$genders_idgender = $form->getValue('genders_idgender');
        		$cities_idcity = $form->getValue('cities_idcity');
        		$sports = $form->getValue('sports');
        		$pets = $form->getValue('pets');
        		
        		$users = new Application_Model_DbTable_Users();
        		$users->addUser($name, $email, $password, $direccion, $descripcion, $genders_idgender,$cities_idcity, $sports,$pets);
        		
        		$this->_helper->redirector('index');
        	} else {
        		$form->populate($formData); //llena el formulario con lo puesto por el usuario
        	}
        }
    }
    
    public function editAction()
    {
        
        $form = new Application_Form_user();
        $form->submit->setLabel('Save');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        	    
        		$id = (int)$form->getValue('iduser');
        	    $name = $form->getValue('name');
        		$email = $form->getValue('email');
        		$password = $form->getValue('password');
        		$direccion = $form->getValue('direccion');
        		$descripcion = $form->getValue('descripcion');
        		$genders_idgender = $form->getValue('genders_idgender');
        		$cities_idcity = $form->getValue('cities_idcity');
        		$sports = $form->getValue('sports');
        		$pets = $form->getValue('pets');
        		
        		$users = new Application_Model_DbTable_Users();
        		$users->updateUser($id, $name, $email, $password, $direccion, $descripcion, $genders_idgender,$cities_idcity, $sports,$pets);
        		
        		$this->_helper->redirector('index');
        	} else {
        		$form->populate($formData);
        	}
        } else {
        	$id = $this->_getParam('id', 0);
        	if ($id > 0) {
        		$users = new Application_Model_DbTable_Users();
        		$form->populate($users->getUser($id));
        	}
        }
        
    }
    
    public function deleteAction()
    {
        if ($this->getRequest()->isPost()) {
        	$del = $this->getRequest()->getPost('del');
        	if ($del == 'Yes') {
        		$id = $this->getRequest()->getPost('id');
        		$users = new Application_Model_DbTable_Users();
        		$users->deleteUser($id);
        	}
        	$this->_helper->redirector('index');
        } else {
        	$id = $this->_getParam('id', 0);
        	$users = new Application_Model_DbTable_Users();
        	$this->view->user = $users->getUser($id);
        }
    }
    
}