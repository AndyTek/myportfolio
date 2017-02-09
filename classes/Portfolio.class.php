<?php
require_once 'PortfolioTools.class.php';
require_once 'DB.class.php';

class Portfolio {

	public $id_work;
	public $name_work;
	public $desc_work;
	public $link_work;
	public $posizione_work;
	public $id_category;

	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		$this->id_work = (isset($data['id_work'])) ? $data['id_work'] : "";
		$this->name_work = (isset($data['name_work'])) ? $data['name_work'] : "";
		$this->desc_work = (isset($data['desc_work'])) ? $data['desc_work'] : "";
		$this->link_work = (isset($data['link_work'])) ? $data['link_work'] : "";
		$this->posizione_work = (isset($data['posizione_work'])) ? $data['posizione_work'] : "";
		$this->id_category = (isset($data['id_category'])) ? $data['id_category'] : "";
	}


}

?>