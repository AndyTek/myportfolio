<?php
require_once 'User.class.php';
require_once 'DB.class.php';

class UserTools {

	//Log the user in. First checks to see if the 
	//username and password match a row in the database.
	//If it is successful, set the session variables
	//and store the user object within.
	public function login($username, $password, $ip)
	{

		$hashedPassword = md5($password);

		$query = "SELECT * FROM users, (SELECT ip_whitelist FROM ip_whitelist WHERE ip_whitelist = '$ip') as sessionip WHERE username = '$username' AND password = '$hashedPassword'";

		$result = mysql_query($query);

		if(mysql_num_rows($result) == 1)
		{
			$_SESSION["user"] = serialize(new User(mysql_fetch_assoc($result)));
			$_SESSION["login_time"] = time();
			$_SESSION["logged_in"] = 1;
			return true;
		}else{
			return false;
		}
	}
	
	//Log the user out. Destroy the session variables.
	public function logout() 
	{
		unset($_SESSION["user"]);
		unset($_SESSION["login_time"]);
		unset($_SESSION["logged_in"]);
		session_destroy();
	}
	
	//get a user
	//returns a User object. Takes the users id as an input
	public function get($id)
	{
		$db = new DB();
		$result = $db->select('users', "id = $id");
		
		return new User($result);
	}

	//updated date of last login
	//returns true
	public function updateLastSession()
	{
		$db = new DB();

		$table = 'users';

		$data['last_access'] = date("Y-m-d H:i:s");

		$user = unserialize($_SESSION['user']);
		$userid = $user->id;
		$where = "id = '$userid'";
		$result = $db->update($data, $table, $where);
		
		return true;
	}

	function protect(){
		global $REMOTE_ADDR;
		$time_limit = 10; // seconds
		$check = mysql_query("SELECT * FROM protect WHERE id='0'");
		$check_ip = mysql_fetch_array($check);
		if(($check_ip[ip] == $REMOTE_ADDR) && ((time() - $check_ip[time]) < $time_limit)){
		echo"You must wait $time_limit seconds before trying again.";
		return 0;
		} else{
		return 1;
		}
	}
	


	//Check to see if a username exists.
	//This is called during registration to make sure all user names are unique.
	public function checkUsernameExists($username) {
		$result = mysql_query("select id from users where username='$username'");
 	   	if(mysql_num_rows($result) == 0)
 	   	{
			return false;
	   	}else{
	   		return true;
		}
	}
	
}

?>