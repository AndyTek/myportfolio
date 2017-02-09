<?php
//welcome.php

$dir = dirname(__FILE__);
require_once '../includes/global.inc.php'; 

require_once '../classes/MyTools.class.php';

//generate token


//check to see if they're logged in
if(!isset($_SESSION['logged_in'])) {
	header("Location: login.php");
}

//get the user object from the session
$user = unserialize($_SESSION['user']);

//validate token adn request
$mytool = new MyTools();
$referer = "/admin/";
$mytool->validateRequest($referer, $_POST['token']);


?>

<html>
	<head>

	    <link href="../public/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	    <link href="../public/css/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="../public/lib/font-awesome45/css/font-awesome.min.css">
		<title>Admin</title>

	</head>
<body>

<?php include '../sections/back/header.php'; ?>

<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12 ">
				<div class="row">

					<div class="col-md-12 text-center">

					<?php 
					if(isset( $_POST['workId'] )) {
						$id_work = $_POST['workId'];
						$succes = true;

						$portfolio = new PortfolioTools();
					    $allportfolio = $portfolio->getSinglePortfolio($_POST['workId']);
					  
					    $allworks = $portfolio->getAllWorks();
						$pos = count($allworks);

				    	$album = new AlbumTools();
						$albumall = $album->getAllPictures();
						$nalbum = count($albumall);

						if(isset($_FILES['multiuploadfile'])){

							$portfolio->uploadMultiFilePortfolio($_FILES['multiuploadfile'], $nalbum, $id_work);

						} //if multiuploadfile

						if($succes) {

							if( isset($_POST['name-modwork-work']) || isset($_POST['desc-modwork-work']) || isset($_POST['link-modwork-work']) ) { 
								
								$data['name_work'] = $_POST['name-modwork-work'];
							    $data['desc_work'] = $_POST['desc-modwork-work'];
							    $data['link_work'] = $_POST['link-modwork-work'];
							    $data['id_category'] = $_POST['category-modwork-work'];

							    $where = "id_work = '$id_work'";
							    
							    $db->update($data, 'works', $where);

						    	$portfolio = new PortfolioTools();
							    $allportfolio = $portfolio->getSinglePortfolio($_POST['workId']);

						    	$album = new AlbumTools();
								$albumall = $album->getAllPictures();
								$nalbum = count($albumall);

							}

							// reset $_POST
							$_POST = array();
	
						}

						?>

						<form id="update-work" href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype='multipart/form-data'>
							<input type="hidden" name="workId" value="<?php echo $id_work; ?>">
							<input type="hidden" name="category-modwork-work" value="<?php echo $allportfolio['id_category']; ?>" class="cathidden">

							<div class="row">
	                           
	                            <div id="" class="col-md-12 text-center">
	                            <h1>	
	                               <input name="name-modwork-work" type="text" value="<?php echo $allportfolio['name_work']; ?>"></h1>
	                            </h1>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div id="desc-work-modal" class="col-md-12 text-center">
	                            <p>
								  <textarea name="desc-modwork-work" type="text" value=""><?php echo $allportfolio['desc_work']; ?></textarea>
	                           </p>
	                            </div>
	                        </div>
	                        <div class="row">
	                        	<div class="col-md-12">
	                        		<input type="text" class="linkmodwork" name="link-modwork-work" value="<?php echo $allportfolio['link_work']; ?>">
	                        	</div>
	                        </div>
							<div class="row">
								<div class="col-md-12">
								 Add new photo
									<input type="file" name="multiuploadfile[]" multiple="multiple">
								</div>
							</div>
	                        <div class="row">
	                            <div id="cont-pic-modal" class="col-md-12">
									<?php foreach ($allportfolio['pics'] as $key => $value): ?>
										<img src="../public/<?php echo $value ?>" alt="">
										
									<?php endforeach ?>
	                            </div>
	                        </div>
	                        <input type="hidden" value="<?php echo $_SESSION['token']; ?>" name="token">
	                        <input type="submit" value="update">

						</form>
					<?php 
					}
					?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script src="../public/lib/jquery-1.12.4.min.js"></script>
<script src="../public/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="../public/lib/parallax.min.js"></script>
<script src="../public/js/ajax.js"></script>
<script src="../public/js/andy.js"></script>
</body>
</html>


