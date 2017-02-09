<?php
require_once 'AlbumTools.class.php';
require_once 'DB.class.php';


class Album {

	public $id_album;
	public $link_photo_album;
	public $id_work;

	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		$this->id_work = (isset($data['id_work'])) ? $data['id_work'] : "";
		$this->id_album = (isset($data['id_album'])) ? $data['id_album'] : "";
		$this->link_photo_album = (isset($data['link_photo_album'])) ? $data['link_photo_album'] : "";
	}

	
}

?>