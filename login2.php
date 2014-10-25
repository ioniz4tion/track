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

	if ((isset($_POST["password"])) && (isset($_POST["username"]))) {
		if (($_POST["password"] == "Michael23") && ($_POST["username"] == "kreed")) {
			$_SESSION["lchsTrackLogin"] = true;
			header("location: basicform.php");
		}
	}

	if ($functions->login == true) {
		header("location: basicform.php");
	}


?>


<!doctype html>

<html lang="en" class="no-js">
	
	<head>

		<title>LCHS Track &amp; Field - Login</title>

		<meta charset="utf-8" />
		
		<link rel="stylesheet" type="text/css" href="css/universal.css">
		<link rel="stylesheet" type="text/css" href="css/login.css">
		<link rel="stylesheet" type="text/css" href="fonts/fonts.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/navicon.css">
		<link rel="stylesheet" type="text/css" href="sass/style.scss">
		<link rel="stylesheet" type="text/css" href="css/codrops/normalize.css">
		<link rel="stylesheet" type="text/css" href="css/codrops/creativeLinkEffects.css">
		<link rel="stylesheet" type="text/css" href="css/codrops/slidePushMenus.css">
		<link rel="stylesheet" type="text/css" href="css/codrops/minimalForm.css">

	</head>

	<body class="navy cbp-spmenu-push">

	<?php require_once "header.php"; ?>

		<header class="codrops-header">
			<h1>Login - Coaches Only</h1>
		</header>

		<div id="login-div2">

			<?php

	
	if($functions->login == false && isset($_POST["password"])) {
    	print('<div class="incorrect">Username or Password incorrect</div>');   
	}

?>

			<form id="theForm" name="theForm" class="simform" autocomplete="off" method="post" action="login2.php">

				<div class="simform-inner">

					<ol class="questions">
						<li>
							<span><label for="q1">Username</label></span>
							<input id="q1" name="username" type="text"/>
						</li>
						<li>
							<span><label for="q2">Password</label></span>
							<input id="q2" name="password" type="password"/>
						</li>
					</ol><!-- /questions -->

					<div class="controls">

						<button class="next"></button>
						<div class="progress"></div>
						<span class="number">
							<span class="number-current"></span>
							<span class="number-total"></span>
						</span>
						<span class="error-message"></span>

					</div><!-- / controls -->

				</div><!-- /simform-inner -->

				<span class="final-message"></span>

			</form><!-- /simform -->

		</div>

		<script src="js/modernizr.custom.js"></script>
		<script src="js/classie.js"></script>
		<script src="js/stepsForm.js"></script>
		<script>
			var theForm = document.getElementById( 'theForm' );

			new stepsForm( theForm, {
				onSubmit : function( form ) {
					// hide form
					classie.addClass( theForm.querySelector( '.simform-inner' ), 'hide' );

					/*
					form.submit()
					or
					AJAX request (maybe show loading indicator while we don't have an answer..)
					*/

					// let's just simulate something...
					var messageEl = theForm.querySelector( '.final-message' );
					messageEl.innerHTML = 'Logging in...';
					classie.addClass( messageEl, 'show' );
				}
			} );
		</script>
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

	</body>
</html>