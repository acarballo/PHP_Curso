<?php

class controller extends abstractController implements toOut {

	function  __construct(){
		$this->a();
	}
	
	function b(){
		
	}

	/* (non-PHPdoc)
	 * @see toOut::toArray()
	 */
	public function toArray() {
		// TODO Auto-generated method stub
		
	}

	/* (non-PHPdoc)
	 * @see toOut::toString()
	 */
	public function toString() {
		// TODO Auto-generated method stub
		
	}
	
	//Puede estar en la clase padre

}

abstract class abstractController{
	function a(){
		
	}
	
	abstract function b(){
		echo ("asd");
	}
}

interface toOut{
	public function toArray();
	public function toString();
} 