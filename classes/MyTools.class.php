<?php
require_once 'DB.class.php';

class MyTools {
	
	//generate token
	//returns all Portfolio as object.
	public function generateToken()
	{  
	    $token = md5(rand(1000,9999)); //you can use any encryption
	    $_SESSION['token'] = $token; //store it as session variable

	    return $token;
	}

	//generate token
	//returns all Portfolio as object.
	public function validateRequest($referer)
	{  
		
		$origin = $_SERVER['HTTP_ORIGIN'];

		$myorigin = $origin.$referer;
		if(!@isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != $myorigin)
		  {
		  	 echo "error referer";
		     // header("Location: ".$referer);
		  }
		  else {

		    if($_POST['token'] != $_SESSION['token']) {
		    	 echo "error tok";
		    	 // header("Location: ".$myorigin);
		    }
		    
		}

	     return true;
	}

	//Log the user in. First checks to see if the 
	//username and password match a row in the database.
	//If it is successful, set the session variables
	//and store the user object within.
	public function validateUser($username, $secret)
	{

		$hashedSecret = md5($secret);

		// echo "SELECT * FROM users WHERE username = '$username' AND password = '$hashedPassword'";
		$result = mysql_query("SELECT * FROM users WHERE username = '$username' AND secret_question = '$hashedSecret'");
		if(mysql_num_rows($result) == 1)
		{
			return true;
		}else{
			return false;
		}
	}

	//Log the user in. First checks to see if the 
	//username and password match a row in the database.
	//If it is successful, set the session variables
	//and store the user object within.
	public function authIp($username, $ipuser)
	{
		$data = array(
                  'ip_whitelist' => $ipuser,
                  'id_user'    => $username,
                );

		$db = new DB;
		$table = 'ip_whitelist';

		$db->insert($data, $table);


	}


}

?>