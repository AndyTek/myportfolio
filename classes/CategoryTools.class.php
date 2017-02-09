<?php
require_once 'Category.class.php';
require_once 'DB.class.php';


class CategoryTools {
	
	//get all gategories 
	//returns a category object.
	public function getAllCategories()
	{
		$db = new DB();
		$table = "category";
		$result = $db->selectAll($table);
		return $result;

	}

}

?>