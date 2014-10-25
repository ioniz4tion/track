<?php
	namespace WebDesign;
	
	//spl_autoload_register();
	//spl_autoload_extensions(".class.php,.php");

	spl_autoload_register(function ($class){   		
   		$class .= ".class.php";
   		$class = str_ireplace('\\', "/", $class);   		
        if(is_file($class)&&!class_exists($class)) require_once $class;
    });	

	$functions = new Functions();
	$tbAthlete = new Database("tb_athlete","ID");

	if (isset($_POST["formSubmit"])) {

		$first = $_POST['fname'];
		$last = $_POST['lname'];
		$phone = $_POST['phone'];
		if ($phone == "") { $phone = "None";}
		$phone = str_replace("-", "", $phone);
				
		if ($_POST['phone'] != "") {
			$carrier = $_POST['carrier'];
		} else {
			$carrier = "";
		}

		$email = $_POST['email'];
		if ($email == "") { $email = "None";}
		$sex = $_POST['sex'];
		$shirt = $_POST['shirt'];
		$sweatshirt = $_POST['sweatshirt'];
		$grade = $_POST['grade'];

		$tbAthlete->addSpecific(array(
			"first",
			"last",
			"phone",
			"carrier",
			"email",
			"sex",
			"shirt",
			"sweatshirt",
			"grade"),
		array(
			$first,
			$last,
			$phone,
			$carrier,
			$email,
			$sex,
			$shirt,
			$sweatshirt,
			$grade
		));
	}

?>

<!doctype html>

<html class="no-js">

	<head>

		<title>LCHS Track &amp; Field - Register</title>

		<meta charset="utf-8" />
		
		<link rel="stylesheet" type="text/css" href="css/universal.css">
		<link rel="stylesheet" type="text/css" href="fonts/fonts.css">
		<link rel="stylesheet" type="text/css" href="css/register3.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/navicon.css">
		<link rel="stylesheet" type="text/css" href="sass/style.scss">
		<link rel="stylesheet" type="text/css" href="css/codrops/normalize.css">
		<link rel="stylesheet" type="text/css" href="css/codrops/creativeLinkEffects.css">
		<!--<link rel="stylesheet" type="text/css" href="css/codrops/creativeButtons2.css">-->
		<link rel="stylesheet" type="text/css" href="css/codrops/slidePushMenus.css">
		<!--<link rel="stylesheet" type="text/css" href="css/codrops/minimalForm.css">-->

	</head>

	<body class="silver cbp-spmenu-push">

		<?php require_once "header.php"; ?>

		<header class="codrops-header">
			<h1>Athlete Registration</h1>

		</header>

		<?php if(isset($_POST["formSubmit"])) { echo '<h2 style="margin:0 auto;text-align:center;">Form Submitted</h2>'; } ?>

		<div id="register-div">

			<form id="registerForm" name="registerForm" method="post" action="register3.php">

				<ul>
					<li>
						<span>
							<label for="input1">First Name</label>
						</span>
						<input type="text" name="fname" required>
					</li>
				</ul>

			<ul>
					<li>
						<span>
							<label for="input2">Last Name</label>
						</span>
						<input type="text" name="lname" required>
					</li>
				</ul>

				<ul class="radio-button">
					<li>
						<span>
							<label for="input3">Sex</label>
						</span>
						<select name="sex" required>
							<option disabled="disabled" value="" selected="selected">--Select--</option>
							<option>Male</option>
							<option>Female</option>
						</select>
					</li>
				</ul>

				<ul class="radio-button">
					<li>
						<span>
							<label for="input4">Grade</label>
						</span>
						<select name="grade" required>
							<option value=""disabled selected>--Select--</option>
	  						<option>9th</option>
							<option>10th</option>
							<option>11th</option>
							<option>12th</option>
						</select>
					</li>
				</ul>

				<ul>
					<li>
						<span>
							<label for="input5">Email Address</label>
						</span>
						<input type="email" name="email">
					</li>
				</ul>

				<ul>
					<li>
						<span>
							<label for="input6">Phone Number</label>
						</span>
						<input type="tel" autocomplete="off" pattern="\d{3}[\-]\d{3}[\-]\d{4}" title="Phone Number (Format: 999-999-9999) You must have dashes and the area code." name="phone" onkeyup="checkCarrier()" id="phone" value="">
					</li>
				</ul>

				<ul class="radio-button">
					<li>
						<span>
							<label for="input7">Phone Carrier</label>
						</span>
						<select name="carrier" id="carrier" disabled required>
							<option value=""disabled selected>--Select--</option>
							<option value="vtext.com">Verizon</option>
							<option value="tmomail.net">T-Mobile</option>
						    <option value="messaging.sprintpcs.com">Sprint</option>
						    <option value="txt.att.net">AT&amp;T</option>
						    <option value="vmobl.com">Virgin Mobile</option>
						</select>
					</li>
				</ul>

				<ul class="radio-button">
					<li>
						<span>
							<label for="input8">Shirt Size</label>
						</span>
						<select required name="shirt">
	  						<option value="" disabled selected>--Select--</option>
	  						<option>Small</option>
							<option>Medium</option>
							<option>Large</option>
						</select>
					</li>
				</ul>

				<ul class="radio-button">
					<li>
						<span>
							<label for="input9">Sweatshirt Size</label>
						</span>
						<select name="sweatshirt" required>
							<option value=""disabled selected>--Select--</option>
	  						<option>Small</option>
							<option>Medium</option>
							<option>Large</option>
						</select>
					</li>
				</ul>

				<button id="login1" name="formSubmit" class="btn btn-3 btn-3e icon-arrow-right">Submit</button>
				
			</form>

		</div>

		<script src="js/modernizr.custom.js"></script>
		<script src="js/classie.js"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				menuRight = document.getElementById( 'cbp-spmenu-s2' ),
				menuTop = document.getElementById( 'cbp-spmenu-s3' ),
				menuBottom = document.getElementById( 'cbp-spmenu-s4' ),
				showLeft = document.getElementById( 'showLeft' ),
				showRight = document.getElementById( 'showRight' ),
				showTop = document.getElementById( 'showTop' ),
				showBottom = document.getElementById( 'showBottom' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				showRightPush = document.getElementById( 'showRightPush' ),
				body = document.body;

			showLeftPush.onclick = function() {
				classie.toggle( this, 'close' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};

			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>

		<script language="javascript">
		    	function checkCarrier() {
		    		
		    		if (document.getElementById("phone").value == "") {

		    			document.getElementById("carrier").disabled = true;
		    			//alert("test");
		    		} else {

		    			document.getElementById("carrier").disabled = false;

		    			//alert("test");

		    		}

		    	}


		</script>

	</body>
</html>

