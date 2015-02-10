<?php
	namespace WebDesign;
	//spl_autoload_extensions(".class.php");
	//spl_autoload_register();

	spl_autoload_register(function ($class){   		
   		$class .= ".class.php";
   		$class = str_ireplace('\\', "/", $class);   		
        if(is_file($class)&&!class_exists($class)) require_once $class;
    });	

	$functions = new Functions();
	$tbParent = new Database("tb_parent","ID");

	if (isset($_POST["formSubmit"])) {

		$kid = $_POST['kname'];
		$first = $_POST['fname'];
		$last = $_POST['lname'];
		$email = $_POST['email'];
		if ($email == "") { $email = "None";}
		$phone = $_POST['phone'];		
		$phone = str_replace("-", "", $phone);
		if ($phone == "") { $phone = "None";}

		if ($_POST['phone'] != "") {
			$carrier = $_POST['carrier'];
		}
		if (!isset($carrier)) {
			$carrier = "";
		}

		$tbParent->addSpecific(array(
			"kid",
			"first",
			"last",
			"email",
			"phone",
			"carrier"),
		array(
			$kid,
			$first,
			$last,
			$email,
			$phone,
			$carrier
		));
	}

?>

<!doctype html>

<html class="no-js">

	<head>

		<title>LCHS Track &amp; Field - Register</title>

		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
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

		<?php require_once "header.php" ?>

		<header class="codrops-header">
			<h1>Parent Registration</h1>
		</header>

		<?php if(isset($_POST["formSubmit"])) { echo '<h2 style="margin:0 auto;text-align:center;">Form Submitted</h2>'; } ?>

		<div id="register-div">

			<form id="registerForm" name="registerForm" method="post" action="parentregister.php">

				<ul>
					<li>
						<span>
							<label for="input1">Name of Your Athlete</label>
						</span>
						<input type="text" name="kname" required>
					</li>
				</ul>

				<ul>
					<li>
						<span>
							<label for="input1">Your First Name</label>
						</span>
						<input type="text" name="fname" required>
					</li>
				</ul>



			<ul>
					<li>
						<span>
							<label for="input2">Your Last Name</label>
						</span>
						<input type="text" name="lname" required>
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

				<p>*Email is neccesary for you to receive email updates</p>
				<p>*Phone number and carrier is neccesary for you to receive text updates</p>

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