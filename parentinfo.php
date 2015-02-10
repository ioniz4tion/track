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
	
	if (isset($_POST['delete'])) {
		$tbParent->deleteAll();
				
	}

	for ($i=1; $i < $tbParent->rowNumber + 1; $i++) { 
		if (isset($_POST["delete" . $i])) {
			$tbParent->delete($i);
		}
	}

?>

<?php if ($functions->login) { ?>

<html style="height:100%; background-color: #777; background-size: 0; vertical-size: 100%">
	  	
	<head>

	    <title>LCHS Track &amp; Field</title>

	    <meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

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
       
    <div class="heading-view">Parent Data</div>
    <form method="post" action="parentinfo.php">

		<table class="view-table sortable">

            <tr>
              <th>Name of Kid</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Phone</th>              
              <th class="sorttable_nosort">Delete</th>
            </tr>
		
		
		<?php for ($i=0; $i < $tbParent->rowNumber; $i++) { ?>

			<tr>
				<td><?= $tbParent->kid[$i] ?></td>
				<td><?= $tbParent->first[$i] ?></td>
				<td><?= $tbParent->last[$i] ?></td>
				<td><?= $tbParent->email[$i] ?></td>
				<td><?= $tbParent->phone[$i] ?></td>
							
				<td><input Type = "submit" class="parentDelete" name = "delete<?= $tbParent->ID[$i] ?>" value = "Delete"></td>
			</tr>

		<?php } ?>

		</table>
		</form>

		<form method="post" action="parentinfo.php"><input Type = "submit" id="delete" name ="delete" value = "Delete All" style="float:left"></form>
		<form method="post" action="downloadParent.php"><input Type = "submit" name ="download" value = "Download Data" style="float:right"></form>


	<script language="javascript" src="js/libs/jquery-2.1.1.js"></script>
    <script language="javascript" src="js/libs/modernizr-2.5.3.min.js"></script>
    <script language="javascript" src="js/bootstrap.js"></script>
    <!--<script language="javascript" src="js/scripts.js"></script>-->
    <script language="javascript" src="js/navicon.js"></script>
    <script language="javascript" src="js/plugins.js"></script>
    

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
		    var result = confirm("Are you sure? This will delete all parent data.");
		    //alert(result);
		    if (result) {
		    	event.default();
		    	alert("test");
		    } else {
		    	evt.preventDefault();
		    }
		});

		$(".parentDelete").click(function(evt){
		    //evt.preventDefault();
		    var result = confirm("Are you sure? This will delete this parent data.");
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