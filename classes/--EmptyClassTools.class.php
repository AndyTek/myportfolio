<?php
require_once 'Empty.class.php';
require_once 'DB.class.php';


class PortfolioTools {
	
	//get all portfolio elements
	//returns all Portfolio as object.
	public function getAllWorks()
	{
		$db = new DB();
		$table = "works";
		$result = $db->selectAll($table);
		return $result;

	}


}

?>