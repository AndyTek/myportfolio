<?php
//welcome.php

$dir = dirname(__FILE__);
require_once $dir.'/../includes/global.inc.php'; 
require_once '../classes/MyTools.class.php';

//check to see if they're logged in
if(!isset($_SESSION['logged_in'])) {
	header("Location: login.php");
}

//get the user object from the session
$user = unserialize($_SESSION['user']);

?>

<html>
<head>

    <link href="../public/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../public/css/style.css" rel="stylesheet" type="text/css">
	<title>Admin</title>

</head>
<body>

<?php include '../sections/back/header.php'; ?>

<?php 

//check to see that the form has been submitted
if( isset($_POST['name-newwork-work']) && isset($_POST['desc-newwork-work']) ) { 

	//validate token adn request
	$mytool = new MyTools();
	$referer = "/adminx/";
	$mytool->validateRequest($referer, $_POST['token']);

	//retrieve the $_POST variables
	// $id = $_POST['id-newwork-work'];
	$db = new DB;

	$name = $_POST['name-newwork-work'];
	$desc = $_POST['desc-newwork-work'];
	$link = $_POST['link-newwork-work'];
	$category = $_POST['category-newwork-work'];

	//initialize variables for form validation
	$success = true;
	
	$portfolio = new PortfolioTools();
	$allworks = $portfolio->getAllWorks();
	$pos = count($allworks);

	$album = new AlbumTools();
	$albumall = $album->getAllPictures();
	$nalbum = count($albumall);

	$nalbum++;

	if(isset($_FILES['pic-newwork-work'])){

	    $errors= array();
	    $file_name = $_FILES['pic-newwork-work']['name'];
	    $file_namez = $name;
	    $file_size =$_FILES['pic-newwork-work']['size'];
	    $file_tmp =$_FILES['pic-newwork-work']['tmp_name'];
	    $file_type=$_FILES['pic-newwork-work']['type'];
	    $file_ext=strtolower(end(explode('.',$_FILES['pic-newwork-work']['name'])));

	    $expensions= array("jpeg","jpg","png");
	    if(in_array($file_ext,$expensions)=== false){
	        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
	        $success = false;
	    }
	    if($file_size > 2097152){
	        $errors[]='File size must be excately 2 MB';
	        $success = false;
	    }
	    if(empty($errors)==true){
	        move_uploaded_file($file_tmp,"../public/images/portfolio/".$nalbum."_anteprima_".$file_namez.".".$file_ext);
	        echo "Success";
	    }else{
	        print_r($errors);
	        $success = false;
	    }
	}

	 if($success) {
	    //prep the data for saving in a new user object
	    $data['name_work'] = $name;
	    $data['desc_work'] = $desc; 
	    $data['link_work'] = $link;
	    $data['posizione_work'] = $pos;
	    $data['id_category'] = $category;

		$id_work = $db->insert($data, 'works');

		$link = "images/portfolio/".$nalbum."_anteprima_".$file_namez.".".$file_ext;

    	$datax['link_photo_album'] = $link;
    	$datax['id_work'] = $id_work;

		$db->insert($datax, 'album');

	    echo "<br>New Portfolio created".$id_work."<br>";

	    $oneportfolio = $portfolio->getSinglePortfolio($id_work);

	    // print_r($oneportfolio);
		
	 }
	 // reset $_POST
	 $_POST = array();

}
?>

<section>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<form id="new-work" href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype='multipart/form-data'>
					<div class="form-group">
						<label for="name-newwork-work">Project Name</label>
				    	<input type="text" name="name-newwork-work" class="form-control" id="name-newwork-work" placeholder="Name Project">
				  	</div>
				  	<div class="form-group">
				    	<label for="desc-newwork-work">Description</label>
				   	<textarea name="desc-newwork-work" class="form-control" id="desc-form-work" rows="3"></textarea>
				  	</div>
				  	<div class="form-group">
				    	<label for="pic-newwork-work">Choose Main Picture</label>
				    	<input name="pic-newwork-work" type="file" id="exampleInputFile">
				  	</div>
				  	<div class="form-group">
						<label for="link-newwork-work">Project link</label>
				    	<input type="text" name="link-newwork-work" class="form-control" id="link-newwork-work" placeholder="Project Link">
				  	</div>
				  	<label for="category-newwork-work">Category</label>
				  	<?php
				  	$category = new CategoryTools(); 
				  	$allcategories = $category->getAllCategories();
				  	?>
					<select id="category-newwork-work" name="category-newwork-work" class="form-control">
					<?php foreach ($allcategories as $key): ?>
					  	<option value="<?php echo $key['id_categoria']; ?>"><?php echo $key['nome_categoria'] ?></option>
					<?php endforeach ?>
					</select>
					<input type="hidden" name="id-nework-work" id="id-newwork-work" value="">
	                <input type="hidden" value="<?php echo $_SESSION['token']; ?>" name="token">

				  	<button type="submit" class="btn btn-default">Submit</button>
				</form>
			</div>
		</div>
	</div>
</section>

</body>
</html>


