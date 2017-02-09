<?php
require_once 'Portfolio.class.php';
require_once 'Album.class.php';
require_once 'DB.class.php';


class PortfolioTools {

	//get single portfolio element
	//returns a Portfolio object. Takes the portfolio id as an input
	public function getSinglePortfolio($id)
	{
		$db = new DB();
		$table = "works";
		
		$idclean = $db->cleanString($id);
		$onework = $db->select($table, "id_work = ".$idclean);
		$album = new AlbumTools();
		$allPictures = $album->getPictures($idclean);

		$select = "id_work";
		$var = "posizione_work";
		$pos = $onework['posizione_work'];

		$next = $db->getNext($select, $table, $pos, $var);
		$prev = $db->getPrev($select, $table, $pos, $var);

		$prevNext = array(
                  'post_prev_id' => $prev,
                  'post_next_id'    => $next,
                );

		$onework['prevnext'] = $prevNext;

		$pics = array();

		if($this->is_multi($allPictures)){
			for ($i=0; $i < count($allPictures); $i++) { 
				array_push($pics, $allPictures[$i]['link_photo_album']);
			}
		}else{
			array_push($pics, $allPictures['link_photo_album']);
		}

	    $onework['pics'] = $pics;	
	    $result = $onework;

		return $result;

	}

	//get all portfolio elements
	//returns all Portfolios as object.
	public function getAllWorks()
	{
		$db = new DB();
		$table = "works";
		$result = $db->selectAll($table);

		return $result;

	}

	//get all portfolio elements
	//returns a User object. Takes the users id as an input
	public function getAllWorksOrdered()
	{
		$db = new DB();
		$table = "works";
		$result = $db->selectAllOrdered($table);

		return $result;

	}

	//get all portfolio elements
	//returns all Portfolios plus first pic as object.
	public function getAllFirstPicture()
	{
		$db = new DB();
		$album = new AlbumTools();
		$allworks = $this->getAllWorksOrdered();
		$c = 0;

		foreach($allworks as $key) {
		    $id =  $key['id_work'];
		    $firstPicRow = $album->getFirstPicture($id);
		    $allworks[$c]['firstpiclink'] = $firstPicRow;
		    $c++;
		}

		$result = $allworks;
	
		return $result;

	}

	public function is_multi($a) 
	{
	    $rv = array_filter($a,'is_array');
	    if( count($rv) > 0 ) return true;
	    return false;
	}

	public function uploadMultiFilePortfolio($files, $xx, $yy)
	{
		$db = new DB;
		$portfolio = new PortfolioTools;

		$x = $db->cleanString($xx);
		$y = $db->cleanString($yy);

		foreach($files['tmp_name'] as $key => $tmp_name ){
		    $file_name = $key.$_FILES['multiuploadfile']['name'][$key];
		    $file_size =$_FILES['multiuploadfile']['size'][$key];
		    $file_tmp = $_FILES['multiuploadfile']['tmp_name'][$key];
		    $file_type = $_FILES['multiuploadfile']['type'][$key];
		    $extensions = array("jpeg","jpg","png");    

		    $file_ext = explode('.',$_FILES['multiuploadfile']['name'][$key])	;
			$file_ext = end($file_ext);  
			$file_ext = strtolower(end(explode('.',$_FILES['multiuploadfile']['name'][$key])));  

			if(in_array($file_ext,$extensions ) === false){
				$errors[] = "extension not allowed";
			} 
			if($_FILES['multiuploadfile']['size'][$key] > 2097152){
				$errors[]='File size must be less tham 2 MB';
			}
			if(empty($errors) == true){
				$linkdirfile = "../public/images/portfolio/".$x."_anteprima_".$file_name.".".$file_ext;
		        move_uploaded_file($file_tmp, $linkdirfile);		 
				    //prep the data for saving in a new user object

					$datax['link_photo_album'] = $linkdirfile;
					$datax['id_work'] = $y;

					$db->insert($datax, 'album');

				    $allportfolio = $portfolio->getSinglePortfolio($y);

				    echo "<br>Portfolio updated ".$y."<br>file directory: ".$linkdirfile ;

				    // print_r($allportfolio);
			
		    }else{
		        print_r($errors);
		        $success = false;
		         echo "<br>There was an error please check the console <br>".$y;
		    }

		} //foreach
	}

	public function uploadSingleFilePortfolio($files, $xx, $yy)
	{
		$db = new DB;
		$errors= array();

		$x = $db->cleanString($xx);
		$y = $db->cleanString($yy);

	    $file_name = $_FILES['pic-newwork-work']['name'];
	    $file_namez = $y;
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
	    	$link = "../public/images/portfolio/".$x."_anteprima_".$file_namez.".".$file_ext;
	        move_uploaded_file($file_tmp, $link );
	        echo "Success";

	        $datax['link_photo_album'] = $link;
	    	$datax['id_work'] = $x;

			$db->insert($datax, 'album');
	    }else{
	        print_r($errors);
	        $success = false;
	    }
	}

}

?>