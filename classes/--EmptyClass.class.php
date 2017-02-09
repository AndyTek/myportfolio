<?php
require_once 'EmptyTools.class.php';
require_once 'DB.class.php';

class Model {

	public $id;
	public $name;

	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		$this->id_work = (isset($data['id_work'])) ? $data['id_work'] : "";
		$this->name_work = (isset($data['name_work'])) ? $data['name_work'] : "";
	}

}

?>