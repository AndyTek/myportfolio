<?php
//login.php
$dir = dirname(__FILE__);
require_once $dir.'/../includes/global.inc.php';

$ipaddress = $_SERVER['REMOTE_ADDR']; // 82.13.217.193 / ::1

$error = "";
$username = "";
$password = "";


//check to see if they've submitted the login form
if(isset($_POST['submit-login'])) { 

	$mytool = new MyTools();
	$referer = "/admin/";
	$mytool->validateRequest($referer, $_POST['token']);

	$db = new DB;
	$username = $db->cleanString($_POST['username']);
	$password = $db->cleanString($_POST['password']);
	$ip = $db->cleanString($_POST['ipuserlogin']);

	$UserTools = new UserTools();
	if($UserTools->login($username, $password, $ip)){ 
		//successful login, redirect them to a page

		$user = unserialize($_SESSION['user']);

		$UserTools->updateLastSession();

		$db->deleteAll("ip_whitelist");

		header("Location: index.php");
	}else{
		$error = "error login";
		$table = "ip_whitelist";
		$result = $db->deleteAll($table);

		header("Location: isolation.html");
	}
}

?>
<html>

<head>
    <link href="../public/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../public/css/style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="../public/lib/font-awesome45/css/font-awesome.min.css">
	<title>Login</title>
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
				<form action="login.php" method="post">
				        <div class="form-group">
                            <label for="name--contact-form">Username *</label>
                            <input type="text" name="username" class="form-control" id="name-contact-form" placeholder="Your Name" value="<?php echo $username; ?>" required="required">
                        </div>
                        <div class="form-group">
                            <label for="name--contact-form">Password *</label>
                            <input type="password" name="password" class="form-control" id="name-contact-form" placeholder="Your Name" value="<?php echo $password; ?>" required="required">
                        </div>
				    <input type="hidden" value="<?php echo $_SESSION['token']; ?>" name="token" id="token-login-form">
	                <input type="hidden" value="<?php echo $ipaddress ?>" name="ipuserlogin" id="ip-login-form">
				    <input type="submit" value="Login" class="btn btn-default btn-hire btn-bg" name="submit-login" />
				</form>
			</div>
		</div>
	</div>
</section>

<img src="../public/images/images/youshallnotpass.gif"  style="display: none" alt="You Shall Not Pass">

</body>
</html>