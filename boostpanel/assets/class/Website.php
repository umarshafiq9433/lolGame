<?php

/**
 * Website Name for document title etc..
 */

class Website{

	private $name;

	public function __construct(){
		$this->setName('SmurfBuddy');
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getName(){
		return $this->name;
	}

}
?>