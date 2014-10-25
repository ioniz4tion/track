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
	$tbAthlete = new Database("tb_athlete","ID");
	
	if (isset($_POST['delete'])) {
		$tbAthlete->deleteAll();
				
	}

	for ($i=1; $i < $tbAthlete->rowNumber + 1; $i++) { 
		if (isset($_POST["delete" . $i])) {
			$tbAthlete->delete($i);
		}
	}

?>

<?php if ($functions->login) { ?>

<html style="height:100%; background-color: #777; background-size: 0; vertical-size: 100%">
	  	
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
		<link rel="stylesheet" type="text/css" href="css/infoview.css">
		
	    <script language="javascript" src="js/switch.js"></script>
	    <script language="javascript" src="js/sort.js"></script>
	    
	</head>

	<body class="cbp-spmenu-push">

    <?php require_once "header.php"; ?>

    <br/>
       
    <div class="heading-view">Athlete Data</div>
    <form method="post" action="infoview.php">

		<table class="view-table sortable">

            <tr>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Cell-Phone Number</th>
              <th>Email</th>
              <th>Sex</th>
              <th>Shirt Size</th>
              <th>Sweatshirt Size</th>
              <th>Grade</th>
              <th class="sorttable_nosort">Delete</th>
            </tr>

		<?php for ($i=0; $i < $tbAthlete->rowNumber; $i++) { ?>

			<tr>
				<td><?= $tbAthlete->first[$i] ?></td>
				<td><?= $tbAthlete->last[$i] ?></td>			
				<td><?= $tbAthlete->phone[$i] ?></td>			
				<td><?= $tbAthlete->email[$i] ?></td>
				<td><?= $tbAthlete->sex[$i] ?></td>
				<td><?= $tbAthlete->shirt[$i] ?></td>
				<td><?= $tbAthlete->sweatshirt[$i] ?></td>

				<td sorttable_customkey=

				<?php switch ($tbAthlete->grade[$i]) {
					case '9th':
						print '"0" >';
						break;

					case '10th':
						print '"1" >';
						break;

					case '11th':
						print '"2" >';
						break;
					
					default:
						print '"3" >';
						break;
				} ?>

				<?= $tbAthlete->grade[$i] ?></td>
			
				<td><input Type = "submit" class="athleteDelete" name = "delete<?= $tbAthlete->ID[$i] ?>" value = "Delete"></td>
			</tr>

		<?php } ?>
		
		</table>
		</form>

		<form method="post" action="infoview.php"><input Type = "submit" id="delete" name ="delete" value = "Delete All" style="float:left"></form>
		<form method="post" action="download.php"><input Type = "submit" name ="download" value = "Download Data" style="float:right"></form>
		

		<script language="javascript" src="js/libs/jquery-2.1.1.js"></script>
	    <script language="javascript" src="js/libs/modernizr-2.5.3.min.js"></script>
	    <script language="javascript" src="js/bootstrap.js"></script>
	    <!--<script language="javascript" src="js/scripts.js"></script>-->
	    <script language="javascript" src="js/navicon.js"></script>
	    <script language="javascript" src="js/plugins.js"></script>
	    <script language="javascript">      
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

	        $("#delete").click(function(evt){
			    //evt.preventDefault();
			    var result = confirm("Are you sure? This will delete all athlete data.");
			    //alert(result);
			    if (result) {
			    	event.default();
			    	alert("test");
			    } else {
			    	evt.preventDefault();
			    }
			});



			$(".athleteDelete").click(function(evt){
			    //evt.preventDefault();
			    var result = confirm("Are you sure? This will delete this athlete data.");
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
	    </script>
	</body>
</html>

<?php } ?>