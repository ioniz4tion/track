<?php
namespace WebDesign;
	//spl_autoload_extensions(".class.php");
	//spl_autoload_register();
	//require_once "functions.class.php";

	spl_autoload_register(function ($class){   		
   		$class .= ".class.php";
   		$class = str_ireplace('\\', "/", $class);   		
        if(is_file($class)&&!class_exists($class)) require_once $class;
    });	

	$functions = New Functions();
	$tbEvents = New Database("tb_index_events","ID");
	$tbNews = New Database("tb_index_news","ID");
	$tbShoutout = New Database("tb_index_shoutout","ID");
	$tbSchedule = New Database("tb_index_schedule","monthday");
	$tbTrackBoy = New Database("tb_index_track_boy","ID");
	$tbTrackGirl = New Database("tb_index_track_girl","ID");
	$tbRelayBoy = New Database("tb_index_relay_boy","ID");
	$tbRelayGirl = New Database("tb_index_relay_girl","ID");
	$tbFieldBoy = New Database("tb_index_field_boy","ID");
	$tbFieldGirl = New Database("tb_index_field_girl","ID");
	$tbCoach = New Database("tb_index_coach","ID");


	
?>



<!doctype html>

<html>

	<head>

		<title>LCHS Track &amp; Field</title>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" type="text/css" href="css/universal.css">
		<link rel="stylesheet" type="text/css" href="css/index.css">
		<link rel="stylesheet" type="text/css" href="fonts/fonts.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/navicon.css">
		<link rel="stylesheet" type="text/css" href="sass/style.scss">
		<link rel="stylesheet" type="text/css" href="css/codrops/creativeLinkEffects.css">
		<link rel="stylesheet" type="text/css" href="css/codrops/slidePushMenus.css">
		<link rel="stylesheet" type="text/css" href="css/codrops/creativeButtons.css">
		<link rel="stylesheet" type="text/css" href="css/basicform.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>		

	</head>

	<body class="cbp-spmenu-push">

		<?php require_once "header.php"; ?>

		<a id="top"></a>
		
		<section class="everything">

			<header>

				<div id="header-stuff">

					<img src="images/t-wolf.png" id="t-wolf">
					<p class="header-big">LCHS Track &amp; Field</p>
					<p class="header-small">Home of the Timberwolves</p>

					<img src="images/scroll-down.png" id="scroll-down">
					<p id="scroll-down-text">Scroll Down</p>
					
				</div>

			</header>

			<article id="track-info" class="navy">

				<a id="a-track-info"></a>

				<div class="stuff">

					<div class="info-left cl-effect-21">

						<p class="heading">Track Events</p>
						<img src="upload/<?= $tbEvents->image[0] ?>" class="info-img-mobile">
						<p><?= $tbEvents->text[0] ?><br/>
						<a href="http://www.athletic.net/TrackAndField/Division/Top.aspx?DivID=50511" target="_blank">View Standings on Athletic.net</a></p>

						<p>Events:</p>
						<ul class="events">
							<li>100m</li>
							<li>200m</li>
							<li>400m</li>
							<li>800m</li>
							<li>1600m</li>
							<li>3200m</li>
							<li>110m Hurdles</li>
							<li>300m Hurdles</li>
							<li>4 &times; 100m Relay</li>
							<li>4 &times; 200m Relay</li>
							<li>4 &times; 400m Relay</li>
							<li>4 &times; 800m Relay</li>
							<li>Medley Relay</li>
							<li>Distance Medley Relay</li>
						</ul>

					</div>

					<img src="upload/<?= $tbEvents->image[0] ?>" class="info-img-desktop">

				</div>

			</article>
			
			<article id="field-info" class="silver">

				<a id="a-field-info"></a>

				<div class="stuff">

					<div class="info-right cl-effect-21">

						<p class="heading">Field Events</p>
						<img src="upload/<?= $tbEvents->image[1] ?>" class="info-img-mobile">
						<p><?= $tbEvents->text[1] ?><br>
						<a href="http://www.athletic.net/TrackAndField/Division/Top.aspx?DivID=50511" target="_blank">View Standings on Athletic.net</a></p>

						<p>Events:</p>
						<ul class="events">
							<li>Shotput</li>
							<li>Discus</li>
							<li>Long Jump</li>
							<li>Triple Jump</li>
							<li>High Jump</li>
							<li>Pole Vault</li>
						</ul>

					</div>

					<img src="upload/<?= $tbEvents->image[1] ?>" class="info-img-desktop">

				</div>

			</article>

			<article id="news" class="teal">

				<a id="a-news"></a>

				<div class="stuff">

					<p class="heading">News &amp; Announcements</p>					

					<div id="news-list">

					<?php for ($i=0; $i < $tbNews->rowNumber; $i++) {  ?>
								
						<div class="announcement">
		    				<p class="date"><?= $tbNews->name[$i] ?></p>
		                	<p class="announcement-text"><?= $tbNews->text[$i] ?></p>
		            	</div>

		            <?php } ?>
					
					</div>					

					<div id="shoutouts-list-desktop">

						<div class="shoutout">
							<p><?= $tbShoutout->name[0] ?></p>
							<p><?= $tbShoutout->text[0] ?></p>
							<img src="upload/<?= $tbShoutout->image[0] ?>" class="shoutout-img">
						</div>

					</div>

				</div>

			</article>

			<article id="schedule" class="navy">

				<a id="a-schedule"></a>

				<div class="stuff">

					<p class="heading">Meet Schedule</p>

					<table id="sched-tbl">

						<tr>
							<th>Date</th>
							<th>Time</th>
							<th>Meet</th>
							<th>Location</th>
						</tr>

					<?php for ($i=0; $i < $tbSchedule->rowNumber; $i++) { ?>

						<tr>
							<td><?= $tbSchedule->date[$i] ?></td>
	              			<td><?= $tbSchedule->time[$i] ?></td>
	              			<td><?= $tbSchedule->name[$i] ?></td>
	              			<td><?= $tbSchedule->location[$i] ?></td>
	              		</tr>

	              	<?php } ?>

           			</table>

				</div>

			</article>

			<article id="records" class="silver">

				<a id="a-records"></a>

				<div class="stuff">

					<p class="heading">School Records</p>

					<ul class="cl-effect-21 nav nav-pills">
						<li class="active"><a href="#track-records" data-toggle="pill">TRACK</a></li>
						<li><a href="#relay-records" data-toggle="pill">RELAY</a></li>
						<li><a href="#field-records" data-toggle="pill">FIELD</a></li>
					</ul>

					<div class="tab-content">

						<div class="tab-pane fade in active" id="track-records">

							<table class="boys-records">
		 
								<tr>
									<th colspan="4">Track Events - Boys</th>
								</tr>
		 
								<tr>
									<th>Event</th>
									<th>Record</th>
									<th>Name</th>
									<th>Year</th>
								</tr>

							<?php for ($i=0; $i < $tbTrackBoy->rowNumber; $i++) { ?>

								<tr>
									<td><?= $tbTrackBoy->event[$i] ?></td>
									<td><?= $tbTrackBoy->record[$i] ?></td>
									<td><?= $tbTrackBoy->name[$i] ?></td>
									<td><?= $tbTrackBoy->year[$i] ?></td>
								</tr>

							<?php } ?>
		 
							</table>
		 
							<table class="girls-records">
		 
								<tr>
									<th colspan="4">Track Events - Girls</th>
								</tr>
		 
								<tr>
									<th>Event</th>
									<th>Record</th>
									<th>Name</th>
									<th>Year</th>
								</tr>

							<?php for ($i=0; $i < $tbTrackGirl->rowNumber; $i++) { ?>

								<tr>
									<td><?= $tbTrackGirl->event[$i] ?></td>
									<td><?= $tbTrackGirl->record[$i] ?></td>
									<td><?= $tbTrackGirl->name[$i] ?></td>
									<td><?= $tbTrackGirl->year[$i] ?></td>
								</tr>

							<?php } ?>
		 
							</table>

						</div>

						<div class="tab-pane fade" id="relay-records">

							<table class="boys-records">
		 
								<tr>
									<th colspan="4">Relay Events - Boys</th>
								</tr>
		 
								<tr>
									<th>Event</th>
									<th>Record</th>
									<th>Name</th>
									<th>Year</th>
								</tr>

							<?php for ($i=0; $i < $tbRelayBoy->rowNumber; $i++) { ?>

								<tr>
									<td><?= $tbRelayBoy->event[$i] ?></td>
									<td><?= $tbRelayBoy->record[$i] ?></td>
									<td><?= $tbRelayBoy->name1[$i] ?><br/>
										<?= $tbRelayBoy->name2[$i] ?><br/>
										<?= $tbRelayBoy->name3[$i] ?><br/>
										<?= $tbRelayBoy->name4[$i] ?></td>
									<td><?= $tbRelayBoy->year[$i] ?></td>
								</tr>

							<?php } ?>
		 
							</table>

							<table class="girls-records">

								<tr>
									<th colspan="4">Relay Events - Girls</th>
								</tr>
		 
								<tr>
									<th>Event</th>
									<th>Record</th>
									<th>Name</th>
									<th>Year</th>
								</tr>

							<?php for ($i=0; $i < $tbRelayGirl->rowNumber; $i++) { ?>

								<tr>
									<td><?= $tbRelayGirl->event[$i] ?></td>
									<td><?= $tbRelayGirl->record[$i] ?></td>
									<td><?= $tbRelayGirl->name1[$i] ?><br/>
										<?= $tbRelayGirl->name2[$i] ?><br/>
										<?= $tbRelayGirl->name3[$i] ?><br/>
										<?= $tbRelayGirl->name4[$i] ?></td>
									<td><?= $tbRelayGirl->year[$i] ?></td>
								</tr>

							<?php } ?>

							</table>

						</div>

						<div class="tab-pane fade" id="field-records">

							<table class="boys-records">

								<tr>
									<th colspan="4">Field Events - Boys</th>
								</tr>

								<tr>
									<th>Event</th>
									<th>Record</th>
									<th>Name</th>
									<th>Year</th>
								</tr>

							<?php for ($i=0; $i < $tbFieldBoy->rowNumber; $i++) { ?>

								<tr>
									<td><?= $tbFieldBoy->event[$i] ?></td>
									<td><?= $tbFieldBoy->record[$i] ?></td>
									<td><?= $tbFieldBoy->name[$i] ?></td>
									<td><?= $tbFieldBoy->year[$i] ?></td>
								</tr>

							<?php } ?>

							</table>

							<table class="girls-records">

								<tr>
									<th colspan="4">Field Events - Girls</th>
								</tr>

								<tr>
									<th>Event</th>
									<th>Record</th>
									<th>Name</th>
									<th>Year</th>
								</tr>

							<?php for ($i=0; $i < $tbFieldGirl->rowNumber; $i++) { ?>

								<tr>
									<td><?= $tbFieldGirl->event[$i] ?></td>
									<td><?= $tbFieldGirl->record[$i] ?></td>
									<td><?= $tbFieldGirl->name[$i] ?></td>
									<td><?= $tbFieldGirl->year[$i] ?></td>
								</tr>

							<?php } ?>

							</table>

						</div>

					</div>

				</div>

			</article>

			<article id="coaches" class="teal">

				<a id="a-coaches"></a>

				<div class="stuff">

					<p class="heading">The Coaches</p>

					

					<?php for ($i=0; $i < $tbCoach->rowNumber; $i++) { ?>

					<div class="coach-info">

					  <?php if($i % 2 === 0) { ?>
						<div class="left">
					  <?php } else { ?>
					    <div class="right">
					  <?php } ?>

							<p class="name"><?= $tbCoach->name[$i] ?></p>
							<img src="upload/<?= $tbCoach->image[$i] ?>" class="coach-img-mobile">
							<p><?= $tbCoach->title[$i] ?></p>
							<p><?= $tbCoach->description[$i] ?></p>
							<div class="contact">
								<div class="phone"><span class="glyphicon glyphicon-phone"></span><?= $tbCoach->number[$i] ?></div>
								<div class="cl-effect-21"><a href="mailto:<?= $tbCoach->email[$i] ?>" target="_blank"><span class="glyphicon glyphicon-envelope"></span><?= $tbCoach->email[$i] ?></a></div>
							</div>
						</div>

						<img src="upload/<?= $tbCoach->image[$i] ?>" <?php if ($i % 2 === 0) { ?> class="coach-img-desktop right" <?php } else { ?> class="coach-img-desktop left" <?php } ?> >

					</div>

					<?php if ($i < $tbCoach->rowNumber - 1) { ?>

					<div class="hr-teal"></div>

					<?php } ?>

					<?php } ?>

				</div>

			</article>

			<footer class="navy">

				<div class="stuff">

					<p>&copy; Lake City High School. All Rights Reserved.</p>

				</div>

			</footer>

		</section>
		
		<script language="javascript" src="js/libs/jquery-2.1.1.js"></script>
		<script language="javascript" src="js/libs/modernizr-2.5.3.min.js"></script>
		<script language="javascript" src="js/bootstrap.js"></script>
		<script language="javascript" src="js/scripts.js"></script>
		<script language="javascript" src="js/navicon.js"></script>
		<script language="javascript" src="js/plugins.js"></script>
		<script language="javascript">			

			$('#track-records a').click(function (e) {
				e.preventDefault()
				$(this).tab('show')
			});

			$('#relay-records a').click(function (e) {
				e.preventDefault()
				$(this).tab('show')
			});

			$('#field-records a').click(function (e) {
				e.preventDefault()
				$(this).tab('show')
			});

			var anchor = document.querySelectorAll('button');

		</script>

		<script language="javascript" src="js/classie.js"></script>
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