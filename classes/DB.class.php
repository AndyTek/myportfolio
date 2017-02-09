<?php

class DB {
	
	protected $db_name = 'andreaonline';
	protected $db_user = 'root';
	protected $db_pass = '';
	protected $db_host = 'localhost';
	
	//open a connection to the database. Make sure this is called 
	//on every page that needs to use the database.
	public function connect() {
		
		$connection = mysql_connect($this->db_host, $this->db_user, $this->db_pass);
		mysql_select_db($this->db_name);
		
		return true;
	}
	
	//takes a mysql row set and returns an associative array, where the keys
	//in the array are the column names in the row set. If singleRow is set to
	//true, then it will return a single row instead of an array of rows.
	public function processRowSet($rowSet, $singleRow = false)
	{
		$resultArray = array();
		while($row = mysql_fetch_assoc($rowSet))
		{
			array_push($resultArray, $row);
		}
		if($singleRow === true)
			return $resultArray[0];
		return $resultArray;
	}
	
	//Select rows from the database.
	//returns a full row or rows from $table using $where as the where clause.
	//return value is an associative array with column names as keys.
	public function selectAll($table) {
		$sql = "SELECT * FROM $table";
		$result = mysql_query($sql);
		if(mysql_num_rows($result) == 1)
			return $this->processRowSet($result, true);
		
		return $this->processRowSet($result);
	}

	//Select rows from the database.
	//returns a full row or rows from $table using $where as the where clause.
	//return value is an associative array with column names as keys.
	public function select($table, $where) {
		$sql = "SELECT * FROM $table WHERE $where";
		$result = mysql_query($sql);
		if(mysql_num_rows($result) == 1)
			return $this->processRowSet($result, true);
		
		return $this->processRowSet($result);
	}
	
	//Select rows from the database.
	//returns a full row or rows from $table using $where as the where clause.
	//return value is an associative array with column names as keys.
	public function selectFirst($table, $where) {
		$sql = "SELECT * FROM $table WHERE $where LIMIT 1";
		$result = mysql_query($sql);

		return $this->processRowSet($result, true);

	}

	//Select rows from the database ordered by desc.
	//returns a full row or rows from $table using order by desc // TODO $desc.
	//return value is an associative array with column names as keys.
	public function selectAllOrdered($table) {
		$sql = "SELECT * FROM $table ORDER BY posizione_work DESC";
		$result = mysql_query($sql);
		if(mysql_num_rows($result) == 1)
			return $this->processRowSet($result, true);
		
		return $this->processRowSet($result);
	}


	//Updates a current row in the database.
	//takes an array of data, where the keys in the array are the column names
	//and the values are the data that will be inserted into those columns.
	//$table is the name of the table and $where is the sql where clause.
	public function update($data, $table, $where) {
		foreach ($data as $column => $value) {
			$valueclean = $this->cleanString($value);
			$sql = "UPDATE $table SET $column = '$valueclean' WHERE $where";
			mysql_query($sql) or die(mysql_error());
		}
		return true;
	}

	
	//Inserts a new row into the database.
	//takes an array of data, where the keys in the array are the column names
	//and the values are the data that will be inserted into those columns.
	//$table is the name of the table.
	public function insert($data, $table) {
		
		foreach ($data as $column => $value) {
			$data[$column] = $this->cleanString($value);
		}

		$columns = "";
		$values = "";
		
		foreach ($data as $column => $value) {
			$columns .= ($columns == "") ? "" : ", ";
			$columns .= $column;
			$values .= ($values == "") ? "" : ", ";
			$values .= "'".$value."'";
		}
		
		$sql = "insert into $table ($columns) values ($values)";

		mysql_query($sql) or die(mysql_error());
		
		//return the ID of the user in the database.
		return mysql_insert_id();
		
	}

	//Get next row.
	//takes an array of data, where the keys in the array are the column names
	//$table is the name of the table and $where is the sql where clause.
	public function getNext($select, $table, $var1, $var2) {
		
		$sql = "SELECT * FROM $table WHERE $var2 = (SELECT min($var2) from $table where $var2 > $var1)";
		$result = mysql_query($sql);

		if(mysql_num_rows($result) == 1)
			return $this->processRowSet($result, true);
		
		return $this->processRowSet($result);
	}

	//Get prev row 
	//takes an array of data, where the keys in the array are the column names
	//$table is the name of the table and $where is the sql where clause.
	public function getPrev($select, $table, $var1, $var2) {
		
		$sql = "SELECT * FROM $table WHERE $var2 = (SELECT max($var2) from $table where $var2 < $var1)";
		$result = mysql_query($sql);
		
		if(mysql_num_rows($result) == 1)
			return $this->processRowSet($result, true);
		
		return $this->processRowSet($result);

	}

	//Clean string.
	//$string is the value to clean.
	public function cleanString($dirty) {
		
		$clean = mysql_real_escape_string($dirty);
		
		return $clean;
	}

	//Select rows from the database.
	//returns a full row or rows from $table using $where as the where clause.
	//return value is an associative array with column names as keys.
	public function deleteRow($table, $where) {
		$sql = "DELETE FROM $table WHERE $where";
		$result = mysql_query($sql);
		if(mysql_num_rows($result) == 1)
			return $this->processRowSet($result, true);
		
		return $this->processRowSet($result);
	}

		//Select rows from the database.
	//returns a full row or rows from $table using $where as the where clause.
	//return value is an associative array with column names as keys.
	public function deleteAll($table) {
		$sql = "DELETE FROM $table";
		$result = mysql_query($sql);
		if(mysql_num_rows($result) == 1)
			return $this->processRowSet($result, true);
		
		return $this->processRowSet($result);
	}

	
}

?>