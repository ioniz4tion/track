<?php
	namespace WebDesign;
	//spl_autoload_extensions(".class.php");
	//spl_autoload_register();

	spl_autoload_register(function ($class){   		
   		$class .= ".class.php";
   		$class = str_ireplace('\\', "/", $class);   		
        if(is_file($class)&&!class_exists($class)) require_once $class;
    });	

	$functions = New Functions();
	$tbStateChampions = New Database("tb_state_champions","year");

	if ($functions->login) {

		if (isset($_POST["save"])) {
			$tbStateChampions->save(array("name","year","event","description"));		
		}

		if (isset($_POST["add"])) {
			$tbStateChampions->addSpecific(
			array(		
			"name",
			"year",
			"event",
			"image",
			"description"),
			array(		
			"Name",
			"Year",
			"Event",
			"wolf.png",
			"Description")
			);
		}

		if (isset($_POST["upload"])) {
			$tbStateChampions->saveFile(array("image"),"upload/");
		}

		for ($i=1; $i < $tbStateChampions->rowNumber + 1; $i++) { 
			if (isset($_POST["delete" . $i])) {
				$tbStateChampions->delete($i);
			}
		}
	}

?>

<html>

	<head>

		<title>LCHS Track &amp; Field - State Champions</title>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

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

	</head>

	<body class="cbp-spmenu-push navy">

		<?php require_once "header.php"; ?>

		<form action ="champions.php" method="post" enctype="multipart/form-data">

		<header style="position:relative;text-align:center"class="codrops-header">
			<h1>State Champions</h1>

			<?php if ($functions->login) { ?>
			<div style="position:absolute;bottom:0;text-align:center;margin:0 auto;width:94%">			
				<button class="btn btn-3 btn-3e add" name="add" onclick="position()">Add</button>
				<button class="btn btn-3 btn-3e save" name="save" onclick="position()">Save</button>
			</div>
			<?php } ?>

		</header>


		<section class="everything navy">

			<article id="champions">

				<div class="stuff">
		

				<?php for ($i = $tbStateChampions->rowNumber - 1; $i >= 0; $i--) { ?>

					<div class="champion">

						<?php if ($i % 2 == 0 ) { ?>

							<div class="left content">

						<?php } else { ?>

							<div class="right content">

						<?php } ?>

						<?php if ($functions->login) { ?>
				
							<p class="name">
								<textarea name = "<?= $tbStateChampions->tb ?>name<?= $tbStateChampions->ID[$i] ?>" rows="1" cols="22"><?= $tbStateChampions->name[$i] ?></textarea>
							</p>
							
							<img src="upload/<?= $tbStateChampions->image[$i] ?>" class="champion-img-mobile">
							
							<p>
								<textarea name = "<?= $tbStateChampions->tb ?>event<?= $tbStateChampions->ID[$i] ?>" rows="1" cols="17"><?= $tbStateChampions->event[$i] ?></textarea>
							</p>

							<p>
								<textarea name = "<?= $tbStateChampions->tb ?>year<?= $tbStateChampions->ID[$i] ?>" rows="1" cols="13"><?= $tbStateChampions->year[$i] ?></textarea>
							</p>

							<p>
								<textarea class="textarea-large" name = "<?= $tbStateChampions->tb ?>description<?= $tbStateChampions->ID[$i] ?>" rows="3" cols="40"><?= $tbStateChampions->description[$i] ?></textarea>
							</p>

						<?php } else { ?>

							<p class="name"><?= $tbStateChampions->name[$i] ?></p>

							<img src="upload/<?= $tbStateChampions->image[$i] ?>" class="champion-img-mobile">

							<p><?= $tbStateChampions->event[$i] ?></p>

							<p><?= $tbStateChampions->year[$i] ?></p>

							<p><?= $tbStateChampions->description[$i] ?></p>

						<?php } ?>

					</div>
			
					<?php if ($i % 2 == 0 ) { ?>

						<div style="margin-right:150px;" class="right champion-img-desktop">							

					<?php } else { ?>

						<div class="left champion-img-desktop">
							
					<?php } ?>

							<img src="upload/<?= $tbStateChampions->image[$i] ?>">

					<?php if ($functions->login) { ?>

						
							<input type="file"  name="<?= $tbStateChampions->tb ?>image<?= $tbStateChampions->ID[$i] ?>" id="image<?= $tbStateChampions->ID[$i] ?>"><br/>	
							<button  class="btn btn-3 btn-3e upload" name="upload" onclick="position()">Upload</button>
							<br/>
							<br/>
							<button class="btn btn-3 btn-3e delete" class="delete" name="delete<?= $tbStateChampions->ID[$i] ?>" onclick="position()">Delete</button>

					<?php } ?>

						</div>
					</div>

				<?php } ?>

			</form>

			</div>

			</article>

		</section>

		<script language="javascript" src="js/libs/jquery-2.1.1.js"></script>
		<script src="js/modernizr.custom.js"></script>
		<script src="js/classie.js"></script>
		<script>

			window.onload = function () {
				check();


			}
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

			$(".delete").click(function(evt){
			    //evt.preventDefault();
			    var result = confirm("Are you sure? This will delete this athlete.");
			    //alert(result);
			    if (result) {
			    	event.default();
			    	alert("test");
			    } else {
			    	evt.preventDefault();
			    }
			});

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

			function check() {
				//alert("testy");
				var scroll = localStorage.getItem("scroll");
				var check = localStorage.getItem("check");
				if (check == 1) {
					window.scrollTo(0,scroll);
					localStorage.setItem("check",0);
				}
				//alert("wors");

			}
			function position() {

				//alert("test");
				var scroll = document.body.scrollTop;
				localStorage.setItem("scroll",scroll);
				localStorage.setItem("check",1);
				//alert(scroll);
			}
		</script>

	</body>

</html>