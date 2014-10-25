<?php
	namespace WebDesign;
	//spl_autoload_extensions(".class.php");
	//spl_autoload_register();
	//require_once "functions.class.php"

	spl_autoload_register(function ($class){   		
   		$class .= ".class.php";
   		$class = str_ireplace('\\', "/", $class);   		
        if(is_file($class)&&!class_exists($class)) require_once $class;
    });	

	$functions = new Functions();

 	if (isset($_POST["createGallery"])) {
 		$name = "galleries/" . $_POST["year"] . "/" . $_POST["gallery-name"] . "/";
 		$thumbnail = "thumbnail/" . $_POST["year"] . "/" . $_POST["gallery-name"] . "/";
 		if (file_exists($name)) {
 			$create = false;
 		} else {
    		$create = mkdir($name, 0777);
    		mkdir($thumbnail, 0777);
    		$_POST["gallery"] = $_POST["gallery-name"];

    	}
    }

    if (isset($_POST["createYear"])) {
 		$name = "galleries/" . $_POST["year-name"] . "/";
 		$thumbnail = "thumbnail/" . $_POST["year-name"] . "/";
 		if (file_exists($name)) {
 			$create = false;
 		} else {
    		$create = mkdir($name, 0777);
    		mkdir($thumbnail, 0777);
    		$_POST["year"] = $_POST["year-name"];

    	}
    }

    if (isset($_POST["upload"])) {
    	$path = "galleries/" . $_POST["year"] . "/" . $_POST["gallery"] . "/";
    	$thumbnailPath = "thumbnail/" . $_POST["year"] . "/" . $_POST["gallery"] . "/";
    	//echo "WHKJHGDKJHGSKJ";
		
    	$functions->uploadThumbnail("file",$path,$thumbnailPath,true);
    }

    if (isset($_POST["deleteGallery"])) {
 		$name = "galleries/" . $_POST["year"] . "/" . $_POST["gallery"];
 		$thumbnail = "thumbnail/" . $_POST["year"] . "/" . $_POST["gallery"];
 		if (file_exists($name)) { 			
 			$delete = $functions::deleteDir($name);
 			$functions::deleteDir($thumbnail);
 		} else {
    		$delete = false;
    	}
    }

    if (isset($_POST["deleteYear"])) {
 		$name = "galleries/" . $_POST["year"];
 		$thumbnail = "thumbnail/" . $_POST["year"];
 		if (file_exists($name)) { 			
 			$delete = $functions::deleteDir($name);
 			$functions::deleteDir($thumbnail);
 		} else {
    		$delete = false;
    	}
    }

    if (isset($_POST["yes-selected"])) {
 		//$path = "galleries/" . $_POST["gallery"];
 		foreach ($_POST["delete-select"] as $image) {
 			unlink($image);
 			$image = str_replace("galleries", "thumbnail", $image);
 			unlink($image);
 		}
    }


	//scans the galleries file for the years
	$years = preg_grep('/^([^.])/', scandir("galleries"));

	rsort($years);

	//checks if there are any years, if not then set dir as false
	if (isset($_POST["year"]) && (!isset($_POST["deleteYear"]))) {

		$dir = $_POST["year"];
		if (array_key_exists(0, $years)) {
			$dir = $_POST["year"];
		} else {
			$dir = false;
		}

	} else {
		if (array_key_exists(0, $years)) {
			$dir = $years[0];		
			
		} else {
			
			$dir = false;
		}
	}


	//scans the year that is selected and saves the lists of subDirs in $galleries
	$galleries = preg_grep('/^([^.])/', scandir("galleries/" . $dir));

	//checks if a gallery is selected, and if it is set subDir to its name
	if (isset($_POST["gallery"]) && (!isset($_POST["deleteGallery"])) && (!isset($_POST["deleteYear"]))){
		
		if (array_key_exists(2, $galleries)) {
			$subDir = $_POST["gallery"];
		} else {
			$subDir = false;
		}

	//if no sub gallery exists,then set the value as false
	} else {
		
		if (array_key_exists(2, $galleries)) {
			$subDir = $galleries[2];
			$_POST["gallery"] = $galleries[2];
			
		} else {
			$subDir = false;
		}
	}

	//checks fi it is false, if not list its contents, if it is print no Galleries
	if (!$subDir === false) {
		$subDir2 = "galleries/" . $dir ."/" . $subDir . "/";
		$thumbnailPath = "thumbnail/" . $dir ."/" . $subDir . "/";
	    $list = $functions->listFolderContent($subDir2,$subDir2);
	    $listThumbnail = $functions->listFolderContent($thumbnailPath,$thumbnailPath);
	} else {
		$galleries[0] = "No Galleries";
		
	}

	if ($dir === false) {
		$years[0] = "No Galleries";
	}
?>

<html>

	<head>

		<title>LCHS Track &amp; Field - State Champions</title>

		<meta charset="utf-8">

		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
		<link rel="stylesheet" href="css/bootstrap-image-gallery.min.css">
		<link rel="stylesheet" type="text/css" href="css/universal.css">
		<link rel="stylesheet" type="text/css" href="css/index.css">
		<link rel="stylesheet" type="text/css" href="fonts/fonts.css">
		<link rel="stylesheet" type="text/css" href="css/forms.css">
		<link rel="stylesheet" type="text/css" href="css/champions.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/navicon.css">
		<link rel="stylesheet" type="text/css" href="sass/style.scss">
		<link rel="stylesheet" type="text/css" href="css/codrops/creativeButtons.css">
		<link rel="stylesheet" type="text/css" href="css/codrops/normalize.css">
		<link rel="stylesheet" type="text/css" href="css/codrops/creativeLinkEffects.css">
		<link rel="stylesheet" type="text/css" href="css/codrops/slidePushMenus.css">
		<link rel="stylesheet" type="text/css" href="css/basicform.css">
		<link rel="stylesheet" type="text/css" href="css/gallery.css">

	</head>

	<body class="cbp-spmenu-push navy">

	<?php require_once "header.php"; ?>

		<form method="post" action="gallery.php" enctype="multipart/form-data" id="form">

		<div class="blackout"></div>

		<div class="center">
			<div class="new-gallery" id="new-year">
				<div class="header">Create New Year</div>
				<div class="body">
				
					<label>Name of New Year:</label>
					<input type="text" name="year-name">
					<button name="createYear" class="btn btn-3 btn-3e create">Create</button>
				
				</div>
			</div>
		</div>

		<div class="center">
			<div class="new-gallery" id="new-gallery">
				<div class="header">Create New Gallery</div>
				<div class="body">
				
					<label>Name of New Gallery:</label>
					<input type="text" name="gallery-name">
					<button name="createGallery" class="btn btn-3 btn-3e create">Create</button>
				
				</div>
			</div>
		</div>

		<div class="center">
			<div class="new-gallery" id="check-delete-year">
				<div class="header">Are you sure?</div>
				<div>
				<p>Make sure that you have the correct year selected before clicking delete. This will delete the year and all of the galleries and images it contains permanently.</p>
				
					<button name="deleteYear" class="btn btn-3 btn-3e create">Yes</button>
					<button name="no" id="no" class="btn btn-3 btn-3e create">No</button>
				
				</div>
			</div>
		</div>

		<div class="center">
			<div class="new-gallery" id="check-delete">
				<div class="header">Are you sure?</div>
				<div>
				<p>Make sure that you have the correct gallery from the correct year that you want to delete before clicking yes (select one from the list before clicking delete gallery). The gallery will be deleted permanently.</p>
				
					<button name="deleteGallery" class="btn btn-3 btn-3e create">Yes</button>
					<button name="no" id="no" class="btn btn-3 btn-3e create">No</button>
				
				</div>
			</div>
		</div>

		<div class="center">
			<div class="new-gallery" id="upload-form">
				<div class="header">Upload Images</div>
				<div>
					<p class="upload-images">Allowed file types are .jpg, .png, .gif, and .zip. If you want to upload many images at a time, put them in a zip file and upload it. Make sure you are uploading to the right gallery (select one from the list before clicking upload images). The server might take some time to upload all files. Please reduce the filesize of the images before uploading so they will load faster.</p>
				
					<input type="file" name="file">
					<button name="upload" class="btn btn-3 btn-3e create">Go</button>
				
				</div>
			</div>
		</div>

		<div class="center">
			<div class="new-gallery" id="delete-selected-form">
				<div class="header">Are you sure?</div>
				<div>
				<p>Are you sure that you wish to delete all of selected images?</p>
				
					<button name="yes-selected" class="btn btn-3 btn-3e create">Yes</button>
					<button name="no" id="no" class="btn btn-3 btn-3e create">No</button>
				
				</div>
			</div>
		</div>

		<header class="codrops-header">
			<h1>Image Gallery</h1>			
		</header>

		<section class="everything navy">

		  <?php if (isset($create)) { ?>

			<div class="center-text">
			<h4>
			  <?php if ($create) { ?>

				Gallery Created!

			  <?php } else { ?>

				That gallery name is already used!

			  <?php } ?>

			</h4>
			</div>

		  <?php } ?>

		  <?php if (isset($delete)) { ?>

			<div class="center-text">
			<h4>
			  <?php if ($delete) { ?>

				Gallery Deleted!

			  <?php } else { ?>

				Gallery Deletion Failed.

			  <?php } ?>
			  
			</h4>
			</div>

		  <?php } ?>
		 
			<div class="center-text">				

				<label for="year">Choose a year: </label>				
				<select id="year" name="year">

					<?php foreach ($years as $year) { ?>

						<option <?php $functions->checkYear($year); ?> value="<?= $year ?>"><?= $year ?></option>

					<?php } ?>
					
				</select>

				<?php if ($functions->login) { ?>				
					<button id="newYear" name="create" class="btn btn-3 btn-3e">New Year</button>	
				<?php } ?>

				<?php if (!$dir === false && $functions->login === true) { ?>
					<button name="delete" id="delete-year" class="btn btn-3 btn-3e">Delete Year</button>
				<?php } ?>

			</div>

			<div class="center-text">

				<label for="gallery">Choose an image gallery: </label>				
				<select id="gallery" name="gallery">

					<?php foreach ($galleries as $gallery) { ?>

						<option <?php $functions->check($gallery); ?> value="<?= $gallery ?>"><?= $gallery ?></option>

					<?php } ?>
					
				</select>

				<?php if ($functions->login) { ?>				
					<button id="newGallery" name="create" class="btn btn-3 btn-3e">New Gallery</button>	
				<?php } ?>

				<?php if (!$dir === false && $functions->login === true) { ?>
					<button name="delete" id="delete-gallery" class="btn btn-3 btn-3e">Delete Gallery</button>
				<?php } ?>

			</div>

			<div class="center-text">

				<?php if ($functions->login) { ?>

				<?php if ((!$dir === false) && (!$subDir === false) ) { ?>
				<div class="center-text">
					<button id="upload" class="btn btn-3 btn-3e">Upload Images</button>
				</div>
				<?php } ?>

				<div class="center-text" id="delete-selected-container">
					<button id="delete-selected" class="btn btn-3 btn-3e">Delete Selected Images</button>
				</div>

				<?php } ?>

			</div>
			<!--</form>-->
		
			<article id="champions">

				<div class="stuff" id="links">

				<?php 
					if(isset($list["files"])) {
						$i = 0;
						foreach ($list['files'] as $image) {
					?>
						<div class="gallery-image tiny edit">
							<a href="<?= $image ?>" title="<?= $image ?>" data-gallery>
								<img src="<?= $listThumbnail["files"][$i] ?>" alt="<?= $image ?>">
							</a>
							<?php if ($functions->login) { ?>
							<input type="checkbox" class="delete-box" name="delete-select[]" value="<?= $image ?>">
							<?php } ?>
						</div>			    	

					<?php $i++;} } else { ?>

						No Images in this Gallery

					<?php } ?>			

				</div>

				<div id="blueimp-gallery" class="blueimp-gallery">
				    <!-- The container for the modal slides -->
				    <div class="slides"></div>
				    <!-- Controls for the borderless lightbox -->
				    <h3 class="title"></h3>
				    <a class="prev">‹</a>
				    <a class="next">›</a>
				    <a class="close">×</a>
				    <a class="play-pause"></a>
				    <ol class="indicator"></ol>
				    <!-- The modal dialog, which will be used to wrap the lightbox content -->
				    <div class="modal fade">
				        <div class="modal-dialog">
				            <div class="modal-content">
				                <div class="modal-header">
				                    <button type="button" class="close" aria-hidden="true">&times;</button>
				                    <h4 class="modal-title"></h4>
				                </div>
				                <div class="modal-body next"></div>
				                <div class="modal-footer">
				                    <button type="button" class="btn btn-default pull-left prev">
				                        <i class="glyphicon glyphicon-chevron-left"></i>
				                        Previous
				                    </button>
				                    <button type="button" class="btn btn-primary next">
				                        Next
				                        <i class="glyphicon glyphicon-chevron-right"></i>
				                    </button>
				                </div>
				            </div>
				        </div>
				    </div>
				</div>				

			</article>

		</section>

		</form>

		<script language="javascript" src="js/libs/jquery-2.1.1.js"></script>
		<script src="js/modernizr.custom.js"></script>
		<script src="js/classie.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
		<script src="js/bootstrap-image-gallery.min.js"></script>
		<script src="js/gallery.js"></script>
		<script>
			var menuLeft = document.getElementById( "cbp-spmenu-s1" ),
				menuRight = document.getElementById( "cbp-spmenu-s2" ),
				menuTop = document.getElementById( "cbp-spmenu-s3" ),
				menuBottom = document.getElementById( "cbp-spmenu-s4" ),
				showLeft = document.getElementById( "showLeft" ),
				showRight = document.getElementById( "showRight" ),
				showTop = document.getElementById( "showTop" ),
				showBottom = document.getElementById( "showBottom" ),
				showLeftPush = document.getElementById( "showLeftPush" ),
				showRightPush = document.getElementById( "showRightPush" ),
				body = document.body;

			showLeftPush.onclick = function() {
				classie.toggle( this, "close" );
				classie.toggle( body, "cbp-spmenu-push-toright" );
				classie.toggle( menuLeft, "cbp-spmenu-open" );
				disableOther( "showLeftPush" );
			};

			function disableOther( button ) {
				if( button !== "showLeftPush" ) {
					classie.toggle( showLeftPush, "disabled" );
				}
			}


		</script>

	</body>
	
</html>