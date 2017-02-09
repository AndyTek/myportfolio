<?php

$dir = dirname(__FILE__);

require_once '../includes/global.inc.php'; 

//generate token
$mytool = new MyTools();
$token = $mytool->generateToken();

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
	<link rel="stylesheet" href="../public/lib/font-awesome45/css/font-awesome.min.css">
	<title>Admin</title>

</head>
<body>

<?php include '../sections/back/header.php'; ?>

<section >
	<div class="container">
		<div class="row">
			<div class="col-md-12 ">
            <div class="row">
                <div class="col-md-12">
                     <p>Ciao <?php echo $user->username; ?>, your last acces was on <?php echo $user->last_access; ?> isn't it?</p>
                    <div class="col-md-12 text-center mg-bottom-20">
                        <a href="newwork.php" id="button-add-new-work" class="btn btn-default btn-hire" type="submit">Add New</a>
                    </div>
                </div>
            </div>
				<div class="row">
                   
					<div class="col-md-12 text-center">

    					<table class="table table-striped">
                        	<tr>
                        		<td>
                        			ID
                        		</td>
                        		<td>
                        			NAME
                        		</td>
                        		<td>
                        			DESC
                        		</td>
                        		<td>
                        			LINK
                        		</td>
                        		<td>
                        			THUMB
                        		</td>
                        		<td>
                        			POS
                        		</td>
                        		<td>
                        			CAT
                        		</td>
                        		<td>
                        			x
                        		</td>
                        	</tr>
                        	<tr>

    						 <?php 
                                $portfolio = new PortfolioTools();
                                $allportfolios = $portfolio->getAllFirstPicture();
                      
                                foreach ($allportfolios as $key) {
                                	?>
                                <tr>
                                	<td class="td-idwork">
                                		<span meta-work-id="<?php echo $key['id_work']; ?>"><?php echo $key['id_work']; ?></span>
                                	</td>
                                	<td class="td-namework">
                                		<span meta-work-name="<?php echo $key['name_work']; ?>"><?php echo $key['name_work']; ?></span>
                                	</td>
                                	<td class="td-descwork">
                                		<span meta-work-desc="<?php echo $key['desc_work']; ?>"><?php echo $key['desc_work']; ?></span>
                                	</td>
                                	<td class="td-linkwork">
                                		<span meta-work-link=""><?php echo $key['link_work']; ?></span>
                                	</td>
                                	<td class="td-fisrtimgwork">
                                		<img width="80px" src="../public/<?php echo $key['firstpiclink']['link_photo_album']; ?>" alt="">
                                		
                                	</td>
                                	<td class="td-posizionework">
                                		<span meta-work-pos=""><?php echo $key['posizione_work']; ?></span>
                                	</td>
                                	<td class="td-categorywork">
                                		<span meta-work-cat=""><?php echo $key['id_category']; ?></span>
                                	</td>
                                	<td>
                                	<i class="fa fa-pencil mod-single-work" meta-work-id="<?php echo $key['id_work']; ?>" aria-hidden="true"></i>
                                		
                                		<form id="form-mod-single-work-<?php echo $key['id_work']; ?>" method="POST" action="modsinglework.php">
                                            <input type="hidden" name="workId" value="<?php echo $key['id_work']; ?>">
                                            <input type="hidden" name="token" value="<?php echo $token ?>">
                                            
                                            <!-- <i " class="fa fa-pencil" aria-hidden="true"></i> -->
                                        </form>
                                		
                                		</a>
                                	</td>

                            	</tr>
                     			<?php 
                                } 
                                ?>
                        </table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<?php include '../sections/modal.php'; ?>

<script src="../public/lib/jquery-1.12.4.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../public/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="../public/lib/parallax.min.js"></script>
<script src="../public/js/ajax.js"></script>
<script src="../public/js/andy.js"></script>
</body>
</html>


