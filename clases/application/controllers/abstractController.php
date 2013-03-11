<?php

abstract class controllers_abstractController implements toDebug
{
	abstract public function indexAction();
	abstract public function errorAction();
	public function debugAction(){
	}

}

interface toDebug{
	public function debugAction();
}