<?php
	
	session_start("lchsTrackLogin");

	$user_name = "track";
	$password = "iOniz4tion";
	$database = "track";
	$server = "localhost";

	$db_handle = mysql_connect($server, $user_name, $password);
	$db_found = mysql_select_db($database);


	/*if ($db_found) {
		print "yes";
	} else {
		print "no";
	}*/

	$SQL = "SELECT * FROM tb_state_champions";
	$result = mysql_query($SQL);
	$numberOfRecords = mysql_num_rows($result);

	if (isset($_POST["save"])) {
		Save($numberOfRecords);

		

		$SQL = "SELECT * FROM tb_state_champions";
		$result = mysql_query($SQL);
		$numberOfRecords = mysql_num_rows($result);		
	}

	if (isset($_POST["add"])) {
		Save($numberOfRecords);

		$SQL = "INSERT INTO tb_state_champions (ID,Name,Year,Event,Description) VALUES ('" . ($numberOfRecords + 1) . "','Name','Year','Event','Description');";
		mysql_query($SQL);

		$SQL = "SELECT * FROM tb_state_champions";
		$result = mysql_query($SQL);
		$numberOfRecords = mysql_num_rows($result);		
	}

	for ($i = $numberOfRecords - 1; $i >= 0; $i--) {
		if (isset($_POST["imageUpload" . $i])) {

			Save($numberOfRecords);

			$allowedExts = array("gif", "jpeg", "jpg", "JPG", "x-png", "png", "pjpeg");
			$temp = explode(".", $_FILES["file" . $i]["name"]);
			$extension = end($temp);
			if ((($_FILES["file" . $i]["type"] == "image/gif")
			|| ($_FILES["file" . $i]["type"] == "image/jpeg")
			|| ($_FILES["file" . $i]["type"] == "image/jpg")
			|| ($_FILES["file" . $i]["type"] == "image/JPG")
			|| ($_FILES["file" . $i]["type"] == "image/pjpeg")
			|| ($_FILES["file" . $i]["type"] == "image/x-png")
			|| ($_FILES["file" . $i]["type"] == "image/png")
			|| ($_FILES["file" . $i]["type"] == "image/pjpeg")))
			//&& ($_FILES["file" . $i]["size"] < 90000000000000000)
			//&& in_array($extension, $allowedExts))
			  {
			  if ($_FILES["file" . $i]["error"] > 0)
			    {
			    //echo "Return Code: " . $_FILES["file" . $i]["error"] . "<br>";
			    }
			  else
			    {
			    //echo "Upload: " . $_FILES["file" . $i]["name"] . "<br>";
			    //echo "Type: " . $_FILES["file" . $i]["type"] . "<br>";
			    //echo "Size: " . ($_FILES["file" . $i]["size"] / 1024) . " kB<br>";
			    //echo "Temp file: " . $_FILES["file" . $i]["tmp_name"] . "<br>";

			    if (file_exists("upload/" . $_FILES["file" . $i]["name"]))
			      {
			      //echo $_FILES["file" . $i]["name"] . " already exists. ";
			      }
			    else
			      {
			      move_uploaded_file($_FILES["file" . $i]["tmp_name"],
			      "upload/" . $_FILES["file" . $i]["name"]);
			      //echo "Stored in: " . "upload/" . $_FILES["file" . $i]["name"];
			      }
			    }
			  }
			else
			  {
			  echo "Invalid file";
			  print($extension);
			  }

			$SQL = "UPDATE tb_state_champions SET Image = '" . $_FILES["file" . $i]["name"] . "' WHERE ID = '" . ($i + 1) . "'";	
			mysql_query($SQL); 

			$SQL = "SELECT * FROM tb_state_champions";
			$result = mysql_query($SQL);
			$numberOfRecords = mysql_num_rows($result);	
		}
	}

	for ($i = $numberOfRecords - 1; $i >= 0; $i--) {
		if (isset($_POST["delete" . $i])) {

			Save($numberOfRecords);

			$SQL = "DELETE FROM tb_state_champions WHERE ID = '" . ($i + 1) . "'";
			mysql_query($SQL);

			for ($j = $numberOfRecords - 1; $j >= 0; $j--) {
				$Name[$j] = mysql_real_escape_string($_POST["name" . $j]);
				$Year[$j] = mysql_real_escape_string($_POST["year" . $j]);
				$Event[$j] = mysql_real_escape_string($_POST["event" . $j]);

				//$image[$j] = $_POST["image" . $j];
				$Description[$j] = mysql_real_escape_string($_POST["description" . $j]);
			}

			$SQL = "SELECT Image FROM tb_state_champions";
			$resultImage = mysql_query($SQL);

			$j = 0;
			while ( $db_field = mysql_fetch_assoc($result) ) {

				$Image[$j] = $db_field['Image'];				
				$j++;
			}



			for ($j = $i; $j < $numberOfRecords - 1; $j++) {
				$SQL = "UPDATE tb_state_champions SET ID = '" . ($j + 1). "' WHERE ID = '" . ($j + 2) . "'";	
				mysql_query($SQL);
				$SQL = "UPDATE tb_state_champions SET Name = '" . $Name[$j + 1] . "' WHERE ID = '" . ($j + 1) . "'";	
				mysql_query($SQL);
				$SQL = "UPDATE tb_state_champions SET Year = '" . $Year[$j + 1] . "' WHERE ID = '" . ($j + 1) . "'";	
				mysql_query($SQL);
				$SQL = "UPDATE tb_state_champions SET Event = '" . $Event[$j + 1] . "' WHERE ID = '" . ($j + 1) . "'";	
				mysql_query($SQL);
				$SQL = "UPDATE tb_state_champions SET Description = '" . $Description[$j + 1] . "' WHERE ID = '" . ($j + 1) . "'";	
				mysql_query($SQL);
				$SQL = "UPDATE tb_state_champions SET Image = '" . $Image[$j + 1] . "' WHERE ID = '" . ($j + 1) . "'";	
				mysql_query($SQL);
				
			}

			//print $SQL;

			$SQL = "SELECT * FROM tb_state_champions";
			$result = mysql_query($SQL);
			$numberOfRecords = mysql_num_rows($result);		
		}
	}


	//print($numberOfRecords);

	$i = 0;
	while ( $db_field = mysql_fetch_assoc($result) ) {

		$ID[$i] = $db_field['ID'];
		$Name[$i] = $db_field['Name'];
		$Year[$i] = $db_field['Year'];
		$Event[$i] = $db_field['Event'];
		$Image[$i] = $db_field['Image'];
		$Description[$i] = $db_field['Description'];
		$i++;
	}





	


	if (!array_key_exists("lchsTrackLogin",$_SESSION)) {
		$_SESSION["lchsTrackLogin"] = 0;
	}
	//if (session["name"])

	if ($_SESSION["lchsTrackLogin"] == true) {

		//print the text boxes that allow for editing
		print('<html>

			<head>

				<title>LCHS Track &amp; Field - State Champions</title>

				<meta charset="utf-8">

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

				<button type="button" role="button" aria-label="Toggle Navigation" class="lines-button x" id="showLeftPush">
					<span class="lines"></span>
				</button>

				<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left cl-effect-10" id="cbp-spmenu-s1">
					<div id="nav-top"></div>
					<a href="basicform.php#top" class="scroll" data-hover="Home"><span>HOME</span></a>
					<a href="basicform.php#a-track-info" class="scroll" data-hover="Track"><span>TRACK</span></a>
					<a href="basicform.php#a-field-info" class="scroll" data-hover="Field"><span>FIELD</span></a>
					<a href="basicform.php#a-news" class="scroll" data-hover="News"><span>NEWS</span></a>
					<a href="basicform.php#a-schedule" class="scroll" data-hover="Schedule"><span>SCHEDULE</span></a>
					<a href="basicform.php#a-records" class="scroll" data-hover="Records"><span>RECORDS</span></a>
					<a href="basicform.php#a-coaches" class="scroll" data-hover="Coaches"><span>COACHES</span></a>
					<div class="divider"></div>
					<a href="champions.php" data-hover="State Champions"><span>State Champions</span></a>
					<a href="register3.php" data-hover="Athlete Register"><span>Athlete Register</span></a>
					<a href="parentregister.php" data-hover="Parent Register"><span>Parent Register</span></a>
					<a href="infoview.php" data-hover="Athlete Data"><span>Athlete Data</span></a>
					<a href="parentinfo.php" data-hover="Parent Data"><span>Parent Data</span></a>
					<a href="logout.php" data-hover="Logout"><span>Logout</span></a>
					
					
				</nav>

				<header style="position:relative;text-align:center"class="codrops-header">
					<h1>State Champions</h1>

					<div style="position:absolute;bottom:0;text-align:center;margin:0 auto;width:94%"><form action ="champions.php" method="post" enctype="multipart/form-data">
					<button class="btn btn-3 btn-3e add" name="add" onclick="position()">Add to Top</button>
					<button class="btn btn-3 btn-3e save" name="save" onclick="position()">Save</button>
				</div>					
				</header>


				<section class="everything navy">

					<article id="champions">

						<div class="stuff">');

		//print('<form action ="champions.php" method="post" enctype="multipart/form-data">');
			//print('<button class="btn btn-3 btn-3e add" name="add" onclick="position()">Add to Top</button>
			//<button class="btn btn-3 btn-3e save" name="save" onclick="position()">Save</button> ');

		for ($i = $numberOfRecords - 1; $i >= 0; $i--) {
			print('<div class="champion">');

			if ($i % 2 == 0 ) {
				print('<div class="left">');

			} else {

				print('<div class="right">');
			}
			
			print('<p class="name">' . '<textarea name = "name' . $i . '"' .  'rows="1" cols="22">' . $Name[$i] . '</textarea>' . '</p>');
			
			print('<img src="upload/' . $Image[$i] . '" class="champion-img-mobile">');
			
			print('<p>'. '<textarea name = "event' . $i . '"' .  'rows="1" cols="17">' . $Event[$i] . '</textarea>' . '</p>');
			print('<p>'. '<textarea name = "year' . $i . '"' .  'rows="1" cols="13">' . $Year[$i] . '</textarea>' . '</p>');
			print('<p>'. '<textarea class="textarea-large" name = "description' . $i . '"' .  'rows="3" cols="40">' . $Description[$i] . '</textarea>' . '</p>
				</div>');

			//print('<input type="file" class="btn btn-3 btn-3e upload" name="file' . $i . '" id="file' . $i . '"><br>	
				//<button  class="btn btn-3 btn-3e upload" name="imageUpload' . $i . '" onclick="position()">Upload</button>
			//<button class="btn btn-3 btn-3e delete" name="delete' . $i . '" onclick="position()">Delete</button>');

			if ($i % 2 == 0 ) {
				print('<div style="margin-right:150px;" class="right champion-img-desktop">
							<img src="upload/' . $Image[$i] . '">
							<input type="file" name="file' . $i . '" id="file' . $i . '"><br>	
				<button  class="btn btn-3 btn-3e upload" name="imageUpload' . $i . '" onclick="position()">Upload</button>
			<br/><br/><button class="btn btn-3 btn-3e delete" class="delete" name="delete' . $i . '" onclick="position()">Delete</button>
						</div>
					</div>');

			} else {

				print('<div class="left champion-img-desktop">
							<img src="upload/' . $Image[$i] . '">
							<input type="file"  name="file' . $i . '" id="file' . $i . '"><br>	
				<button  class="btn btn-3 btn-3e upload" name="imageUpload' . $i . '" onclick="position()">Upload</button>
			<br/><br/><button class="btn btn-3 btn-3e delete" class="delete" name="delete' . $i . '" onclick="position()">Delete</button>
						</div>
					</div>');
			}

			
			
			
		}

		print("</form>");

		print('</div>

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
			</html>');
		
	} else {

		print('<html>

			<head>

				<title>LCHS Track &amp; Field - State Champions</title>

				<meta charset="utf-8">

				<link rel="stylesheet" type="text/css" href="css/universal.css">
				<link rel="stylesheet" type="text/css" href="css/index.css">
				<link rel="stylesheet" type="text/css" href="fonts/fonts.css">
				<link rel="stylesheet" type="text/css" href="css/forms.css">
				<link rel="stylesheet" type="text/css" href="css/champions.css">
				<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
				<link rel="stylesheet" type="text/css" href="css/navicon.css">
				<link rel="stylesheet" type="text/css" href="sass/style.scss">
				<link rel="stylesheet" type="text/css" href="css/codrops/normalize.css">
				<link rel="stylesheet" type="text/css" href="css/codrops/creativeLinkEffects.css">
				<link rel="stylesheet" type="text/css" href="css/codrops/slidePushMenus.css">

			</head>

			<body class="cbp-spmenu-push navy">

				<button type="button" role="button" aria-label="Toggle Navigation" class="lines-button x" id="showLeftPush">
					<span class="lines"></span>
				</button>

				<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left cl-effect-10" id="cbp-spmenu-s1">
					<div id="nav-top"></div>
					<a href="index.html#top" class="scroll" data-hover="Home"><span>HOME</span></a>
					<a href="index.html#a-track-info" class="scroll" data-hover="Track"><span>TRACK</span></a>
					<a href="index.html#a-field-info" class="scroll" data-hover="Field"><span>FIELD</span></a>
					<a href="index.html#a-news" class="scroll" data-hover="News"><span>NEWS</span></a>
					<a href="index.html#a-schedule" class="scroll" data-hover="Schedule"><span>SCHEDULE</span></a>
					<a href="index.html#a-records" class="scroll" data-hover="Records"><span>RECORDS</span></a>
					<a href="index.html#a-coaches" class="scroll" data-hover="Coaches"><span>COACHES</span></a>
					<div class="divider"></div>
					<a href="champions.php" data-hover="State Champions"><span>State Champions</span></a>
					<a href="register3.php" data-hover="Athlete Register"><span>Athlete Register</span></a>
					<a href="parentregister.php" data-hover="Parent Register"><span>Parent Register</span></a>
					<a href="login2.php" data-hover="Login"><span>Login</span></a>
					<!--TrackEventText-->
				</nav>

				<header class="codrops-header">
					<h1>State Champions</h1>
				</header>

				<section class="everything navy">

					<article id="champions">

						<div class="stuff">');

		for ($i = $numberOfRecords - 1; $i >= 0; $i--) {
			print('<div class="champion">');

			if ($i % 2 == 0 ) {
				print('<div class="left">');

			} else {

				print('<div class="right">');
			}
			
			print('<p class="name">' . $Name[$i] . '</p>');
			

			print('<img src="upload/' . $Image[$i] . '" class="champion-img-mobile">');
			print('<p>'. $Event[$i] . '</p>');
			print('<p>'. $Year[$i] . '</p>');
			print('<p>'. $Description[$i] . '</p>
				</div>');

			if ($i % 2 == 0 ) {
				print('<div class="right champion-img-desktop">
							<img src="upload/' . $Image[$i] . '">
						</div>
					</div>');

			} else {

				print('<div class="left champion-img-desktop">
							<img src="upload/' . $Image[$i] . '">
						</div>
					</div>');
			}

		}

		print('</div>

					</article>

					</section>

					<script language="javascript" src="js/libs/jquery-2.1.1.js"></script>
					<script src="js/modernizr.custom.js"></script>
					<script src="js/classie.js"></script>
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
			</html>');

		//print the normal page
	}


	function Save($numberOfRecords) {
		for ($i = $numberOfRecords - 1; $i >= 0; $i--) {
			$Name[$i] = mysql_real_escape_string($_POST["name" . $i]);
			$Year[$i] = mysql_real_escape_string($_POST["year" . $i]);
			$Event[$i] = mysql_real_escape_string($_POST["event" . $i]);
			//$Image[$i] = $_POST["image" . $i];
			$Description[$i] = mysql_real_escape_string($_POST["description" . $i]);
		}

		for ($i = $numberOfRecords; $i >= 1; $i--) {
			$SQL = "UPDATE tb_state_champions SET Name = '" . $Name[$i - 1] . "' WHERE ID = '" . $i . "'";	
			mysql_query($SQL);
			$SQL = "UPDATE tb_state_champions SET Year = '" . $Year[$i - 1] . "' WHERE ID = '" . $i . "'";	
			mysql_query($SQL);
			$SQL = "UPDATE tb_state_champions SET Event = '" . $Event[$i - 1] . "' WHERE ID = '" . $i . "'";	
			mysql_query($SQL);
			$SQL = "UPDATE tb_state_champions SET Description = '" . $Description[$i - 1] . "' WHERE ID = '" . $i . "'";	
			mysql_query($SQL);
			//$SQL = "UPDATE tb_state_champions SET Name = '" . $Name[$i - 1] . "' WHERE ID = '" . $i . "'";	
			//mysql_query($SQL);
			
		}


	}

	function Upload($i) {


		$allowedExts = array("gif", "jpeg", "jpg", "JPG", "x-png", "png", "pjpeg");
		$temp = explode(".", $_FILES["file" . $i]["name"]);
		$extension = end($temp);
		if ((($_FILES["file" . $i]["type"] == "image/gif")
		|| ($_FILES["file" . $i]["type"] == "image/jpeg")
		|| ($_FILES["file" . $i]["type"] == "image/jpg")
		|| ($_FILES["file" . $i]["type"] == "image/JPG")
		|| ($_FILES["file" . $i]["type"] == "image/pjpeg")
		|| ($_FILES["file" . $i]["type"] == "image/x-png")
		|| ($_FILES["file" . $i]["type"] == "image/png")
		|| ($_FILES["file" . $i]["type"] == "image/pjpeg")))
		//&& ($_FILES["file" . $i]["size"] < 90000000000000000)
		//&& in_array($extension, $allowedExts))
		  {
		  if ($_FILES["file" . $i]["error"] > 0)
		    {
		    //echo "Return Code: " . $_FILES["file" . $i]["error"] . "<br>";
		    }
		  else
		    {
		    //echo "Upload: " . $_FILES["file" . $i]["name"] . "<br>";
		    //echo "Type: " . $_FILES["file" . $i]["type"] . "<br>";
		    //echo "Size: " . ($_FILES["file" . $i]["size"] / 1024) . " kB<br>";
		    //echo "Temp file: " . $_FILES["file" . $i]["tmp_name"] . "<br>";

		    if (file_exists("upload/" . $_FILES["file" . $i]["name"]))
		      {
		      //echo $_FILES["file" . $i]["name"] . " already exists. ";
		      }
		    else
		      {
		      move_uploaded_file($_FILES["file" . $i]["tmp_name"],
		      "upload/" . $_FILES["file" . $i]["name"]);
		      //echo "Stored in: " . "upload/" . $_FILES["file" . $i]["name"];
		      }
		    }
		  }
		else
		  {
		  echo "Invalid file";
		  print($extension);
		  }				
	
	}

	
	mysql_close($db_handle);
?>



<!--<html>

	<head>

		<title>LCHS Track &amp; Field - State Champions</title>

		<meta charset="utf-8">

		<link rel="stylesheet" type="text/css" href="css/universal.css">
		<link rel="stylesheet" type="text/css" href="css/index.css">
		<link rel="stylesheet" type="text/css" href="fonts/fonts.css">
		<link rel="stylesheet" type="text/css" href="css/forms.css">
		<link rel="stylesheet" type="text/css" href="css/champions.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/navicon.css">
		<link rel="stylesheet" type="text/css" href="sass/style.scss">
		<link rel="stylesheet" type="text/css" href="css/codrops/normalize.css">
		<link rel="stylesheet" type="text/css" href="css/codrops/creativeLinkEffects.css">
		<link rel="stylesheet" type="text/css" href="css/codrops/slidePushMenus.css">

	</head>

	<body class="cbp-spmenu-push navy">

		<button type="button" role="button" aria-label="Toggle Navigation" class="lines-button x" id="showLeftPush">
			<span class="lines"></span>
		</button>

		<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left cl-effect-10" id="cbp-spmenu-s1">
			<div id="nav-top"></div>
			<a href="#top" class="scroll" data-hover="Home"><span>HOME</span></a>
			<a href="#a-track-info" class="scroll" data-hover="Track"><span>TRACK</span></a>
			<a href="#a-field-info" class="scroll" data-hover="Field"><span>FIELD</span></a>
			<a href="#a-news" class="scroll" data-hover="News"><span>NEWS</span></a>
			<a href="#a-schedule" class="scroll" data-hover="Schedule"><span>SCHEDULE</span></a>
			<a href="#a-records" class="scroll" data-hover="Records"><span>RECORDS</span></a>
			<a href="#a-coaches" class="scroll" data-hover="Coaches"><span>COACHES</span></a>
			<div class="divider"></div>
			<a href="register3.php" data-hover="Register"><span>Register</span></a>
			<a href="login2.php" data-hover="Login"><span>Login</span></a>
			
		</nav>

		<header class="codrops-header">
			<h1>State Champions</h1>
		</header>

		<section class="everything navy">

			<article id="champions">

				<div class="stuff">

					<div class="champion">

						<div class="left">
							<p class="name">Insert Name Here</p>
							<img src="upload/" class="champion-img-mobile">
							<p>Insert event here</p>
							<p>Insert year here</p>
							<p>Insert description here</p>
						</div>

						<div class="right champion-img-desktop">
							<img src="upload/">
						</div>

					</div>

					<div class="champion">

						<div class="right">
							<p class="name">Insert Name Here</p>
							<img src="upload/" class="champion-img-mobile">
							<p>Insert event here</p>
							<p>Insert year here</p>
							<p>Insert description here</p>
						</div>

						<div class="left champion-img-desktop">
							<img src="upload/">
						</div>

					</div>

					<div class="champion">

						<div class="left">
							<p class="name">Insert Name Here</p>
							<img src="upload/" class="champion-img-mobile">
							<p>Insert event here</p>
							<p>Insert year here</p>
							<p>Insert description here</p>
						</div>

						<div class="right champion-img-desktop">
							<img src="upload/">
						</div>

					</div>

				</div>

			</article>

		</section>

		<script language="javascript" src="js/libs/jquery-2.1.1.js"></script>
		<script src="js/modernizr.custom.js"></script>
		<script src="js/classie.js"></script>
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