<?php
require_once 'CategoryTools.class.php';
require_once 'DB.class.php';


class Category {

	public $id_cateogria;
	public $name_categoria;

	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		$this->id_wcategoria = (isset($data['id_categoria'])) ? $data['id_categoria'] : "";
		$this->name_categoria = (isset($data['name_categoria'])) ? $data['name_categoria'] : "";
	}
	
}

?>