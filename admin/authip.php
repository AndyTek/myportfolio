<?php 

$servername = $_SERVER['SERVER_NAME']; 
$ipaddress = $_SERVER['REMOTE_ADDR']; 

//login.php
$dir = dirname(__FILE__);
require_once $dir.'/../includes/global.inc.php';

$error = "";

$secret = "";
$ipuser = "";
$messageValidation = "";

(isset($_GET['username'])) ? $username = $_GET['username'] : $username = "";

$db = new DB;

//check to see if they've submitted the login form

if(isset($_POST['submit-authip'])) { 

	//add token here and to form

	$username = $db->cleanString($_POST['username']);
	$secret = $_POST['secret'];
	$ip = $db->cleanString($_POST['ipuser']);

	//validate token adn request
	$mytool = new MyTools();
	$referer = "/admin/";
	($mytool->validateRequest($referer, $_POST['token'])) ? "": $error = "error token-ref";

	// $ipuser = $_SERVER['REMOTE_ADDR'];

 	if($mytool->validateUser($username, $secret)){
 		$mytool->authIp($username, $ip);
    	$messageValidation = "Should be all right mate... should be all right.."; 
 	}
    else{
        $messageValidation =  "Ops! Where are you going?";
    }

}else{
	$table = "ip_whitelist";

	$var = $db->selectAll($table);

	if(count($var) > 1){
		$db->deleteAll("ip_whitelist");
	}

}


?>


<html>

<head>

    <link href="../public/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../public/css/style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="../public/lib/font-awesome45/css/font-awesome.min.css">
	<title>Auth</title>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-59421060-1', 'auto');
	  ga('send', 'pageview');

	</script>
</head>

<body>

<?php include '../sections/back/header.php'; ?>
<?php
if($error != "")
{
    echo $error."<br/>";
}
?>

<section>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3 cont-login-admin">
			<div id="response">
				
			</div>
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="form-auth">
				        <div class="form-group">
                            <label for="name--contact-form">Username *</label>
                            <input type="text" name="username" class="form-control" id="name-auth-form" placeholder="Your Name" value="<?php echo $username; ?>" required="required">
                        </div>
                        <div class="form-group">
                            <label for="name--contact-form">Model and Name of Your Fist Car? *</label>
                            <input type="password" name="secret" class="form-control" id="secret-auth-form" placeholder="Civitavecchia" value="<?php echo $secret; ?>" required="required">
                        </div>
	                <input type="hidden" value="<?php echo $_SESSION['token']; ?>" name="token" id="token-auth-form">
	                <input type="hidden" value="<?php echo $ipaddress ?>" name="ipuser" id="ip-auth-form">
				    <input type="submit" value="Auth" class="btn btn-default btn-hire btn-bg" id="submit-authip" name="submit-authip" />
				    <?php echo $messageValidation; ?>
				</form>
			</div>
		</div>
	</div>
</section>

<script>

</script>
    <script src="../public/lib/jquery-1.12.4.min.js"></script>
</body>
</html>