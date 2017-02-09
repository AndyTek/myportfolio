<?php

require_once 'includes/global.inc.php';

$origin = $_SERVER['HTTP_ORIGIN'];


if(isset($_POST['ipvalidate'])) {
  $myorigin = $origin."/andreacaravani-portfolio/admin/authip.php";
}else{
  $myorigin = $origin."/andreacaravani-portfolio/";
}

// server settings

/*
$origin = $_SERVER['HTTP_ORIGIN']."/";

if(isset($_POST['ipvalidate'])) {
  $myorigin = $origin."admin/authip.php";
}else{
  $myorigin = $origin;
}
*/

// end server settings



if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
  //Request identified as ajax request

  if(@isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] == $myorigin)
  {
      //HTTP_REFERER verification
      if($_POST['token'] == $_SESSION['token']) {

      	if(isset( $_POST['workId'] )) {
          $portfolio = new PortfolioTools();
  		    $allportfolios = $portfolio->getSinglePortfolio($_POST['workId']);
          $response = json_encode($allportfolios);

          echo $response;
  		}

  		if(isset( $_POST['mail']) && isset($_POST['name']) && isset($_POST['message'] )) {

  			$mailx = $_POST['mail'];
  			$name = $_POST['name'];
  			$message = $_POST['message'];
  			$tel = $_POST['tel'];

  			$mail = new MailTools();
  			$mail->sendMail($mailx, $name, $message, $tel);

  		}

      //HTTP_REFERER verification
      if(isset($_POST['usernamevalidate']) && isset($_POST['ipvalidate'])) {

          $ip = $_POST['ipvalidate'];
          $username = $_POST['usernamevalidate'];
          $secret = $_POST['secretvalidate'];

          $mytools = new MyTools();

          if($mytools->validateUser($username, $secret))
            $mytools->authIp($username, $ip);
          else
            echo "Ops! Where are you going?";
        }
  
    }
    else {
    	echo "error token";
		// header("Location: ".$myorigin);
    }
  }
  else {
  	echo "error referer";
    // header("Location: ".$myorigin);
  }
}
else {
	echo "error token";
  	// header("Location: ".$myorigin);
}




?>