<?php
require_once 'Album.class.php';
require_once 'DB.class.php';


class AlbumTools {
	
	//get all pictures elements
	//returns a Picture object. Takes the users id as an input
	public function getAllPictures()
	{
		$db = new DB();
		$table = "album";
		$result = $db->selectAll($table);
		return $result;

	}

	//get all picture elements
	//returns a Picture object. Takes the users id as an input
	public function getPictures($id)
	{
		$db = new DB();

		$table = "album";
		$where = "id_work = $id";
		$result = $db->select($table, $where);
		return $result;

	}

	//get all portfolio elements
	//returns a User object. Takes the users id as an input
	public function getFirstPicture($id)
	{
		$db = new DB();

		$table = "album";
		$where = "id_work = $id";
		$limit = 1;
		$result = $db->selectFirst($table, $where);

		return $result;

	}

}

?>