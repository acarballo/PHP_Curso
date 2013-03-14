<?php
class Application_Form_User extends Zend_Form
{

	public function init()
	{
		$this->setName('user');
		
		$iduser = new Zend_Form_Element_Hidden('iduser');
		$iduser->addFilter('Int');
		
		$name = new Zend_Form_Element_Text('name');
		$name->setLabel('name')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');
		
		$email = new Zend_Form_Element_Text('email');
		$email->setLabel('email')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('EmailAddress');
		
		$password = new Zend_Form_Element_Password('password');
		$password->setLabel('password')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');
		
		$direccion = new Zend_Form_Element_Textarea('direccion',10);
		$direccion->setLabel('direccion')
		->setAttrib('rows', 2)
		->setRequired(false)
		->addFilter('StripTags')
		->addFilter('StringTrim');
		
		$descripcion = new Zend_Form_Element_Textarea('descripcion',10);
		$descripcion->setLabel('descripcion')
		->setAttrib('rows', 2)
		->setRequired(false)
		->addFilter('StripTags')
		->addFilter('StringTrim');
		
		$genders_idgender = new Zend_Form_Element_Radio('genders_idgender');
		$genders_idgender->setLabel('Gender')
		->setRequired(true)
		->setMultiOptions(array('1' => "Hombre", '2' => 'mujer', '3' => 'otros'));
		
		$cities_idcity = new Zend_Form_Element_Select('cities_idcity');
		$cities_idcity->setLabel('City')
		->setRequired(true)
		->setMultiOptions(array('1' => "SCQ", '2' => 'BCN', '3' => 'VGO'))
		->addValidator('NotEmpty');
		
		$sports = new Zend_Form_Element_Text('sports');
		$sports->setLabel('sports')
		->setRequired(false)
		->addFilter('StripTags')
		->addFilter('StringTrim');
		
		$pets = new Zend_Form_Element_MultiCheckbox('pets');
		$pets->setLabel('pets')
		->setRequired(false)
		->setMultiOptions(array('1' => "Tarantula", '2' => 'Tigre', '3' => 'Iguana'));
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton');
		$this->addElements(array($iduser, $name, $email, $password, $direccion, $descripcion, $genders_idgender, $cities_idcity, $sports, $pets, $submit));
	}

}