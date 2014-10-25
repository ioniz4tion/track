<?php	

session_start();

$mainPage = '<html style="height:100%; background-color: #777; background-size:; vertical-size: 100%">

	  	<html>

		  <head>

		    <title>LCHS Track &amp; Field</title>

		    <meta charset="utf-8" />
		    <meta name="description" content="A Greener Home with Alternative Energy Solutions" />
		    <meta name="keywords" content="Green Homes 101, alternate energy, DIY, buying green homes, about us" />

		    <link rel="stylesheet" type="text/css" href="css/universal.css">
		
			<link rel="stylesheet" type="text/css" href="fonts/fonts.css">
    		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
   		 	<link rel="stylesheet" type="text/css" href="css/navicon.css">
    		<link rel="stylesheet" type="text/css" href="sass/style.scss">
			<link rel="stylesheet" type="text/css" href="css/codrops/normalize.css">
   			<link rel="stylesheet" type="text/css" href="css/codrops/creativeLinkEffects.css">
			<link rel="stylesheet" type="text/css" href="css/codrops/slidePushMenus.css">
			<link rel="stylesheet" type="text/css" href="css/codrops/minimalForm.css">
			<link rel="stylesheet" type="text/css" href="css/register.css">
			<link rel="stylesheet" type="text/css" href="css/codrops/creativeLinkEffects.css">
			<link rel="stylesheet" type="text/css" href="css/codrops/slidePushMenus.css">
			<link rel="stylesheet" type="text/css" href="css/codrops/creativeButtons.css">

		    <link rel="shortcut icon" href="images/favicon.png" />

		    <script language="javascript" src="js/switch.js"></script>
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
		</head>

		<body class="cbp-spmenu-push">

    <button type="button" role="button" aria-label="Toggle Navigation" style="margin-top: 11px;" class="lines-button x" id="showLeftPush">
      <span class="lines"></span>
    </button>

    <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left cl-effect-10" id="cbp-spmenu-s1">
      <div id="nav-top"></div>
      <a href="index.html" class="scroll" data-hover="Home"><span>HOME</span></a>
      <a href="index.html#a-track-info"  data-hover="Track"><span>TRACK</span></a>
      <a href="index.html#a-field-info"  data-hover="Field"><span>FIELD</span></a>
      <a href="index.html#a-news"  data-hover="News"><span>NEWS</span></a>
      <a href="index.html#a-schedule"  data-hover="Schedule"><span>SCHEDULE</span></a>
      <a href="index.html#a-records"  data-hover="Records"><span>RECORDS</span></a>
      <a href="index.html#a-coaches"  data-hover="Coaches"><span>COACHES</span></a>
      <div class="divider"></div>
      <a href="infoform.php" data-hover="Register"><span>Register</span></a>
      <a href="login2.html" data-hover="Login"><span>Login</span></a>
      <!--Log-->
    </nav>

		    <article id="field-info" style="height: 100%;">
			    <!--<div>-->
			    <div style="margin-right: 5%; margin-left: 5%; padding-top:3%;padding-bottom:3%; position: relative; top: 50%; -webkit-transform: translateY(-50%); transform: translateY(-50%); -ms-transform: translateY(-50%);">
			    	<p class="heading" Style="color: #fff">LCHS Track Athlete Information Form</p>
		            <div style="background: #aaaaaa; padding: 3%; position: relative;">
		            	<form action="infoform.php" method="post">
		            		First Name:<input type="text" class="input-field" name="fname" required><br>
	  						Last Name:<input type="text" class="input-field" name="lname" required><br>
	  						Cell-Phone Number:<input type="tel" class="input-field" autocomplete="off" pattern="\d{3}[\-]\d{3}[\-]\d{4}" title="Phone Number (Format: 999-999-9999) You must have dashes and the area code." name="phone" onkeyup="checkCarrier()" id="phone" value=""><br>
	  						Carrier: <select name="carrier" class="input-field" id="carrier" disabled required>
	  							<option value=""disabled selected>--Select--</option>
							    <option value="vtext.com">Verizon</option>
							    <option value="tmomail.net">T-Mobile</option>
								<option value="messaging.sprintpcs.com">Sprint</option>
								<option value="txt.att.net">AT&amp;T</option>
								<option value="vmobl.com">Virgin Mobile</option>
								</select><br/>
	  						Email:<input type="email" class="input-field" name="email"><br>
	  						<!--Check to Receive Email Updates<input style="height:1.15em; width:1.15em" type="checkbox" name="Notify" value=""><br>-->
	  						Sex: <div><input type="radio" class="input-field" name="sex" required value="Male">Male<br/>
							<input type="radio" name="sex" required value="Female">Female<br/></div>
	  						Shirt Size:<select required class="input-field" name="shirt">
	  							<option value="" disabled selected>--Select--</option>
	  							<option>Small</option>
								<option>Medium</option>
								<option>Large</option>
							</select>
							<br/>
							Sweatshirt Size:<select class="input-field" name="sweatshirt" required>
								<option value=""disabled selected>--Select--</option>
	  							<option>Small</option>
								<option>Medium</option>
								<option>Large</option>
							</select><br/>
							Grade:<select name="grade" class="input-field" required>
								<option value=""disabled selected>--Select--</option>
	  							<option>9th</option>
								<option>10th</option>
								<option>11th</option>
								<option>12th</option>
							</select><br/>

							<button onclick="submit()" class="btn btn-3 btn-3e upload" name="formSubmit">Submit</button>
							<!--here-->

		            	</form>
		            </div>
		        <!--</div>-->
	          	</div>

	      </article>    

<script language="javascript" src="js/libs/jquery-2.1.1.js"></script>
    <script language="javascript" src="js/libs/modernizr-2.5.3.min.js"></script>
    <script language="javascript" src="js/bootstrap.js"></script>
    <script language="javascript" src="js/scripts.js"></script>
    <script language="javascript" src="js/navicon.js"></script>
    <script language="javascript" src="js/plugins.js"></script>
    <script language="javascript">

      //$("body").scrollspy({ target: "nav" });

      $("#track-records a").click(function (e) {
        e.preventDefault()
        $(this).tab("show")
      });

      $("#relay-records a").click(function (e) {
        e.preventDefault()
        $(this).tab("show")
      });

      $("#field-records a").click(function (e) {
        e.preventDefault()
        $(this).tab("show")
      });

      var anchor = document.querySelectorAll("button");
    
      [].forEach.call(anchor, function(anchor){
        var open = false;
        anchor.onclick = function(event){
          //event.preventDefault();
          if(!open){
            this.classList.add("close");
            open = true;
          }
          else{
            this.classList.remove("close");
            open = false;
          }
        }
      });

    </script>

    <script language="javascript" src="js/classie.js"></script>
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

      /*showLeft.onclick = function() {
        classie.toggle( this, "active" );
        classie.toggle( menuLeft, "cbp-spmenu-open" );
        disableOther( "showLeft" );
      };
      showRight.onclick = function() {
        classie.toggle( this, "active" );
        classie.toggle( menuRight, "cbp-spmenu-open" );
        disableOther( "showRight" );
      };
      showTop.onclick = function() {
        classie.toggle( this, "active" );
        classie.toggle( menuTop, "cbp-spmenu-open" );
        disableOther( "showTop" );
      };
      showBottom.onclick = function() {
        classie.toggle( this, "active" );
        classie.toggle( menuBottom, "cbp-spmenu-open" );
        disableOther( "showBottom" );
      };*/
      showLeftPush.onclick = function() {
        classie.toggle( this, "close" );
        classie.toggle( body, "cbp-spmenu-push-toright" );
        classie.toggle( menuLeft, "cbp-spmenu-open" );
        disableOther( "showLeftPush" );
      };
      /*showRightPush.onclick = function() {
        classie.toggle( this, "active" );
        classie.toggle( body, "cbp-spmenu-push-toleft" );
        classie.toggle( menuRight, "cbp-spmenu-open" );
        disableOther( "showRightPush" );
      };*/

      function disableOther( button ) {
        /*if( button !== "showLeft" ) {
          classie.toggle( showLeft, "disabled" );
        }
        if( button !== "showRight" ) {
          classie.toggle( showRight, "disabled" );
        }
        if( button !== "showTop" ) {
          classie.toggle( showTop, "disabled" );
        }
        if( button !== "showBottom" ) {
          classie.toggle( showBottom, "disabled" );
        }*/
        if( button !== "showLeftPush" ) {
          classie.toggle( showLeftPush, "disabled" );
        }
        /*if( button !== "showRightPush" ) {
          classie.toggle( showRightPush, "disabled" );
        }*/
      }
    </script>
		</body>
	</html>';
	
	if ((isset($_SESSION['login']) && $_SESSION['login'] == 1)) {
		$mainPage = str_replace("Login", "Edit Page", $mainPage);
		$mainPage = str_replace("index.html", "basicform.php", $mainPage);
		$mainPage = str_replace("login2.html", "basicform.php", $mainPage);
		$mainPage = str_replace("<!--Log-->", '<a href="infoview.php" data-hover="Athlete Data"><span>Athlete Data</span></a><a href="logout.php" data-hover="Logout"><span>Logout</span></a>', $mainPage);

	}

	if (isset($_POST["formSubmit"])) {
		$file = fopen("athleteinfo.txt", "a");
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$phone = $_POST['phone'];
		
		$email = $_POST['email'];
		$sex = $_POST['sex'];
		$shirt = $_POST['shirt'];
		$sweatshirt = $_POST['sweatshirt'];
		$grade = $_POST['grade'];
		$checkEmail = file_get_contents("email.txt");
		if ($email == "" or strpos($checkEmail, $email) !== false) {

			} else {

				$emailFile = fopen("email.txt", "a");
				fwrite($emailFile, $email);
				fwrite($emailFile, "\n");
				fclose($emailFile);
			}


		fwrite($file, $fname);
		fwrite($file, "\n");
		fwrite($file, $lname);
		fwrite($file, "\n");
		fwrite($file, $phone);
		fwrite($file, "\n");
		fwrite($file, $email);
		fwrite($file, "\n");
		fwrite($file, $sex);
		fwrite($file, "\n");
		fwrite($file, $shirt);
		fwrite($file, "\n");
		fwrite($file, $sweatshirt);
		fwrite($file, "\n");
		fwrite($file, $grade);
		fwrite($file, "\n");

		fclose($file);

		if ($_POST['phone'] != "") {
			$carrier = $_POST['carrier'];
			$phone = str_replace("-", "", $phone);
			$test = $phone . "\n" . $carrier;

			$check = file_get_contents("phoneinfo.txt");
			if (strpos($check, $test) !== false ) {

			} else {

			$file = fopen("phoneinfo.txt", "a");
			fwrite($file, $phone);
			fwrite($file, "\n");
			fwrite($file, $carrier);
			fwrite($file, "\n");
			fclose($file);

			}
		}




		$postPage = explode("<!--here-->", $mainPage);
		print($postPage[0]);
		print("Information Submitted");
		print($postPage[1]);
	} else {
		printMain($mainPage);
	}



function printMain($mainPage) {

	print($mainPage);
}
?>