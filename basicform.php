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

	$tbAthlete = new Database("tb_athlete","ID");
	$tbParent = new Database("tb_parent","ID");

	if (!$functions->login) {
		header("location: index.php");
	}

	if (isset($_POST["save"])) {
		$tbEvents->save(array("text"));
		$tbNews->save(array("name","text"));
		$tbShoutout->save(array("name","text"));
		$tbSchedule->save(array("date","time","name","location"));
		$tbTrackBoy->save(array("record","name","year"));
		$tbTrackGirl->save(array("record","name","year"));
		$tbRelayBoy->save(array("record","name1","name2","name3","name4","year"));
		$tbRelayGirl->save(array("record","name1","name2","name3","name4","year"));
		$tbFieldBoy->save(array("record","name","year"));
		$tbFieldGirl->save(array("record","name","year"));
		$tbCoach->save(array("title","description","number","email"));

		$tbSchedule->savePattern(array("monthday"),array("date"),"/\d{1,2}-\d{1,2}/");
	}

	if (isset($_POST["upload"])) {
		$tbEvents->saveFile(array("image"),"upload/");
		$tbShoutout->saveFile(array("image"),"upload/");
		$tbCoach->saveFile(array("image"),"upload/");
	}

	if (isset($_POST["news-add"])) {
		$tbNews->add();
	}

	for ($i=1; $i < $tbNews->rowNumber + 1; $i++) { 
		if (isset($_POST["news-delete" . $i])) {
			$tbNews->delete($i);
		}
	}

	for ($i=1; $i < $tbNews->rowNumber + 1; $i++) { 
		if (isset($_POST["email" . $i])) {

			$tbNews->save(array("name","text"));
				
			$headers = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: kreed@cdaschools.org' . "\r\n";

			$subject = $tbNews->name[$i - 1];
			$message = $tbNews->text[$i - 1];

			for ($k=0; $k < $tbAthlete->rowNumber; $k++) { 
				$email = $tbAthlete->email[$k];
				mail($email, $subject, $message, $headers);
			}

			for ($k=0; $k < $tbParent->rowNumber; $k++) { 
				$email = $tbParent->email[$k];
				mail($email, $subject, $message, $headers);
			}
		}
	}

	for ($i=1; $i < $tbNews->rowNumber + 1; $i++) { 
		if (isset($_POST["text" . $i])) {

			$tbNews->save(array("name","text"));
			
			$subject = "";
			$message = $_POST[$tbNews->tb . "name" . $i] . " - " . $_POST[$tbNews->tb . "text" . $i];

			$headers = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: kreed@cdaschools.org' . "\r\n";

			for ($k=0; $k < $tbAthlete->rowNumber; $k++) { 
				if (!($tbAthlete->phone[$k] == "None")) {
					$emailList[] = $tbAthlete->phone[$k] . "@" . $tbAthlete->carrier[$k];
				}
			}

			for ($k=0; $k < $tbParent->rowNumber; $k++) { 
				if (!($tbParent->phone[$k] == "None")) {
					$emailList[] = $tbParent->phone[$k] . "@" . $tbParent->carrier[$k];
				}
			}
			
			$lengthTest = strlen($message);

			if ($lengthTest > 160) {
				$lengthTest = $lengthTest  / 160;
				$lengthTest = ceil($lengthTest);

				for ($k =0; $k < $lengthTest; $k++) {
					$messageMulti[$k] = substr($message,$k*160,159);
				}

				if (isset($emailList)) {
					foreach ($emailList as $email) {
						for($j = 0; $j < $lengthTest; $j++) {
							mail($email, $subject, $messageMulti[$j], $headers);
						}
					}
				}

			} else {
				if(isset($emailList)) {
					foreach ($emailList as $email) {					
						mail($email, $subject, $message, $headers);					
					}
				}
			}			
		}
	}

	for ($i=1; $i < $tbSchedule->rowNumber + 1; $i++) { 
		if (isset($_POST["schedule-delete" . $i])) {
			$tbSchedule->delete($i);
		}
	}

	if (isset($_POST["schedule-add"])) {
		$tbSchedule->add();
	}

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

		<form action="basicform.php" method="post" enctype="multipart/form-data">		
		
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
						<p><textarea name = "<?= $tbEvents->tb ?>text1" class="textarea-large"><?= $tbEvents->text[0] ?></textarea>
						<button class="btn btn-3 btn-3e save" name="save" onclick="position()">Save</button><br/>
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
					<br/>
					<div style="float:right;">			
						<input class="btn btn-3 btn-3e upload" type="file" name="<?= $tbEvents->tb ?>image1" id="file"><br>
					
						<button class="btn btn-3 btn-3e upload" name="upload" onclick="position()">Upload</button>
					</div>

				</div>

			</article>
			
			<article id="field-info" class="silver">

				<a id="a-field-info"></a>

				<div class="stuff">

					<div class="info-right cl-effect-21">

						<p class="heading">Field Events</p>
						<img src="upload/<?= $tbEvents->image[1] ?>" class="info-img-mobile">
						<p><textarea name = "<?= $tbEvents->tb ?>text2" class="textarea-large"><?= $tbEvents->text[1] ?></textarea>
					
						<button class="btn btn-3 btn-3e save" name="save" onclick="position()">Save</button><br>
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
					<br/>
					<div style="float:left;">					
						<input class="btn btn-3 btn-3e upload" type="file" name="<?= $tbEvents->tb ?>image2" id="files"><br>
						
						<button class="btn btn-3 btn-3e upload" name="upload" onclick="position()">Upload</button>
					</div>

				</div>

			</article>

			<article id="news" class="teal">

				<a id="a-news"></a>

				<div class="stuff">

					<p class="heading">News &amp; Announcements</p>					

					<div id="news-list">
					<button class="btn btn-3 btn-3e add" name="news-add" onclick="position()">Add</button>
					<button class="btn btn-3 btn-3e save" name="save" onclick="position()">Save</button>

					<?php for ($i=$tbNews->rowNumber - 1; $i >= 0; $i--) {  ?>
								
						<div class="announcement">
		    				<p class="date"><textarea id= "" name = "<?= $tbNews->tb ?>name<?= $tbNews->ID[$i] ?>" rows="1" cols="15"><?= $tbNews->name[$i] ?></textarea></p>
		                	<p class="announcement-text"><textarea id= "" name = "<?= $tbNews->tb ?>text<?= $tbNews->ID[$i] ?>" class="textarea-large"><?= $tbNews->text[$i] ?></textarea></p>

							<button class="btn btn-3 btn-3e delete" name="news-delete<?= $tbNews->ID[$i] ?>" onclick="position()">Delete</button>
							<button class="btn btn-3 btn-3e send-email" name="email<?= $tbNews->ID[$i] ?>" onclick="position()">Send Email</button>
							<button class="btn btn-3 btn-3e send-text textCheck" id="<?= $tbNews->ID[$i] ?>" name="text<?= $tbNews->ID[$i] ?>" onclick="position()">Send Text</button>
		            	</div>

		            <?php } ?>
					
					</div>					

					<div id="shoutouts-list-desktop">

						<div class="shoutout">
							<p><textarea name = "<?= $tbShoutout->tb ?>name1" class="textarea-shoutout-small"><?= $tbShoutout->name[0] ?></textarea></p>
							<p><textarea name = "<?= $tbShoutout->tb ?>text1" class="textarea-shoutout-large"><?= $tbShoutout->text[0] ?></textarea></p>
							<br/>
							<button class="btn btn-3 btn-3e save" name="save" onclick="position()">Save</button>
							<img src="upload/<?= $tbShoutout->image[0] ?>" class="shoutout-img">
							<br/>
							<div style="float:left;">
							
								<input class="btn btn-3 btn-3e upload"type="file" name="<?= $tbShoutout->tb ?>image1" id="fileShoutout"><br>
							
								<button class="btn btn-3 btn-3e upload" name="upload" onclick="position()">Upload</button>
							</div>
						</div>

					</div>			

				</div>

			</article>

			<article id="schedule" class="navy">

				<a id="a-schedule"></a>

				<div class="stuff">

					<p class="heading">Meet Schedule</p>
					<button class="btn btn-3 btn-3e add" name="schedule-add" onclick="position()">Add</button>
					<button class="btn btn-3 btn-3e save" name="save" onclick="position()">Save</button>					

					<table id="sched-tbl">

						<tr>
							<th>Date</th>
							<th>Time</th>
							<th>Meet</th>
							<th>Location</th>
						</tr>

					<?php for ($i=0; $i < $tbSchedule->rowNumber; $i++) { ?>

						<tr>
							<td><textarea name = "<?= $tbSchedule->tb ?>date<?= $tbSchedule->ID[$i] ?>" rows="1" cols="10"><?= $tbSchedule->date[$i] ?></textarea></td>
	              			<td><textarea name = "<?= $tbSchedule->tb ?>time<?= $tbSchedule->ID[$i] ?>" rows="1" cols="10"><?= $tbSchedule->time[$i] ?></textarea></td>
	              			<td><textarea name = "<?= $tbSchedule->tb ?>name<?= $tbSchedule->ID[$i] ?>" rows="1" cols="25"><?= $tbSchedule->name[$i] ?></textarea></td>
	              			<td><textarea name = "<?= $tbSchedule->tb ?>location<?= $tbSchedule->ID[$i] ?>" rows="1" cols="10"><?= $tbSchedule->location[$i] ?></textarea>
	              				<button class="btn btn-3 btn-3e delete" name="schedule-delete<?= $tbSchedule->ID[$i] ?>" onclick="position()">Delete</button></td>
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
									<td><textarea name = "<?= $tbTrackBoy->tb ?>record<?= $tbTrackBoy->ID[$i] ?>" rows="1" cols="9"><?= $tbTrackBoy->record[$i] ?></textarea></td>
									<td><textarea name = "<?= $tbTrackBoy->tb ?>name<?= $tbTrackBoy->ID[$i] ?>" rows="1" cols="15"><?= $tbTrackBoy->name[$i] ?></textarea></td>
									<td><textarea name = "<?= $tbTrackBoy->tb ?>year<?= $tbTrackBoy->ID[$i] ?>" rows="1" cols="5"><?= $tbTrackBoy->year[$i] ?></textarea></td>
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
									<td><textarea name = "<?= $tbTrackGirl->tb ?>record<?= $tbTrackGirl->ID[$i] ?>" rows="1" cols="9"><?= $tbTrackGirl->record[$i] ?></textarea></td>
									<td><textarea name = "<?= $tbTrackGirl->tb ?>name<?= $tbTrackGirl->ID[$i] ?>" rows="1" cols="15"><?= $tbTrackGirl->name[$i] ?></textarea></td>
									<td><textarea name = "<?= $tbTrackGirl->tb ?>year<?= $tbTrackGirl->ID[$i] ?>" rows="1" cols="5"><?= $tbTrackGirl->year[$i] ?></textarea></td>
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
									<td><textarea name = "<?= $tbRelayBoy->tb ?>record<?= $tbRelayBoy->ID[$i] ?>" rows="1" cols="5"><?= $tbRelayBoy->record[$i] ?></textarea></td>
									<td><textarea name = "<?= $tbRelayBoy->tb ?>name1<?= $tbRelayBoy->ID[$i] ?>" rows="1" cols="15"><?= $tbRelayBoy->name1[$i] ?></textarea><br/>
										<textarea name = "<?= $tbRelayBoy->tb ?>name2<?= $tbRelayBoy->ID[$i] ?>" rows="1" cols="15"><?= $tbRelayBoy->name2[$i] ?></textarea><br/>
										<textarea name = "<?= $tbRelayBoy->tb ?>name3<?= $tbRelayBoy->ID[$i] ?>" rows="1" cols="15"><?= $tbRelayBoy->name3[$i] ?></textarea><br/>
										<textarea name = "<?= $tbRelayBoy->tb ?>name4<?= $tbRelayBoy->ID[$i] ?>" rows="1" cols="15"><?= $tbRelayBoy->name4[$i] ?></textarea></td>
									<td><textarea name = "<?= $tbRelayBoy->tb ?>year<?= $tbRelayBoy->ID[$i] ?>" rows="1" cols="3"><?= $tbRelayBoy->year[$i] ?></textarea></td>
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
									<td><textarea name = "<?= $tbRelayGirl->tb ?>record<?= $tbRelayGirl->ID[$i] ?>" rows="1" cols="5"><?= $tbRelayGirl->record[$i] ?></textarea></td>
									<td><textarea name = "<?= $tbRelayGirl->tb ?>name1<?= $tbRelayGirl->ID[$i] ?>" rows="1" cols="15"><?= $tbRelayGirl->name1[$i] ?></textarea><br/>
										<textarea name = "<?= $tbRelayGirl->tb ?>name2<?= $tbRelayGirl->ID[$i] ?>" rows="1" cols="15"><?= $tbRelayGirl->name2[$i] ?></textarea><br/>
										<textarea name = "<?= $tbRelayGirl->tb ?>name3<?= $tbRelayGirl->ID[$i] ?>" rows="1" cols="15"><?= $tbRelayGirl->name3[$i] ?></textarea><br/>
										<textarea name = "<?= $tbRelayGirl->tb ?>name4<?= $tbRelayGirl->ID[$i] ?>" rows="1" cols="15"><?= $tbRelayGirl->name4[$i] ?></textarea></td>
									<td><textarea name = "<?= $tbRelayGirl->tb ?>year<?= $tbRelayGirl->ID[$i] ?>" rows="1" cols="3"><?= $tbRelayGirl->year[$i] ?></textarea></td>
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
									<td><textarea name = "<?= $tbFieldBoy->tb ?>record<?= $tbFieldBoy->ID[$i] ?>" rows="1" cols="9"><?= $tbFieldBoy->record[$i] ?></textarea></td>
									<td><textarea name = "<?= $tbFieldBoy->tb ?>name<?= $tbFieldBoy->ID[$i] ?>" rows="1" cols="15"><?= $tbFieldBoy->name[$i] ?></textarea></td>
									<td><textarea name = "<?= $tbFieldBoy->tb ?>year<?= $tbFieldBoy->ID[$i] ?>" rows="1" cols="5"><?= $tbFieldBoy->year[$i] ?></textarea></td>
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
									<td><textarea name = "<?= $tbFieldGirl->tb ?>record<?= $tbFieldGirl->ID[$i] ?>" rows="1" cols="9"><?= $tbFieldGirl->record[$i] ?></textarea></td>
									<td><textarea name = "<?= $tbFieldGirl->tb ?>name<?= $tbFieldGirl->ID[$i] ?>" rows="1" cols="15"><?= $tbFieldGirl->name[$i] ?></textarea></td>
									<td><textarea name = "<?= $tbFieldGirl->tb ?>year<?= $tbFieldGirl->ID[$i] ?>" rows="1" cols="5"><?= $tbFieldGirl->year[$i] ?></textarea></td>
								</tr>

							<?php } ?>

							</table>

						</div>

					</div>

					<button class="btn btn-3 btn-3e save" name="save" onclick="position()">Save</button>

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

							<p><textarea name = "<?= $tbCoach->tb ?>title<?= $tbCoach->ID[$i] ?>" rows="1" cols="35" ><?= $tbCoach->title[$i] ?></textarea>
								<button class="btn btn-3 btn-3e save" name="save" onclick="position()">Save</button>
							</p>

							<p><textarea name = "<?= $tbCoach->tb ?>description<?= $tbCoach->ID[$i] ?>" class="textarea-large" ><?= $tbCoach->description[$i] ?></textarea></p>

							<div class="contact">

								<div class="phone">

									<span class="glyphicon glyphicon-phone"></span>
									<textarea name = "<?= $tbCoach->tb ?>number<?= $tbCoach->ID[$i] ?>" rows="1" cols="18" ><?= $tbCoach->number[$i] ?></textarea>

								</div>

								<div class="cl-effect-21">
									
									<span class="glyphicon glyphicon-envelope"></span>
									<textarea name = "<?= $tbCoach->tb ?>email<?= $tbCoach->ID[$i] ?>" rows="1" cols="28" ><?= $tbCoach->email[$i] ?></textarea>									

								</div>

							</div>

						</div>

						<img src="upload/<?= $tbCoach->image[$i] ?>" <?php if ($i % 2 === 0) { ?> class="coach-img-desktop right" <?php } else { ?> class="coach-img-desktop left" <?php } ?> >

						<br/>

						<div <?php if ($i % 2 === 0) { ?> style="float:right;" <?php } else { ?> style="float:left;" <?php } ?>>
						
							<input type="file" class="btn btn-3 btn-3e upload" name="<?= $tbCoach->tb ?>image<?= $tbCoach->ID[$i] ?>" id="fileCoach"><br>							
							
							<button  class="btn btn-3 btn-3e upload" name="upload" onclick="position()">Upload</button>

						</div>

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
		<!--<script language="javascript" src="js/libs/modernizr-2.5.3.min.js"></script>-->
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

		<script language="javascript">

			window.onload = function () {
				check();
			}

			/*$(".textCheck").click(function(event){				
				event.preventDefault();
				alert("test");
			});*/

			$(".textCheck").click(function(event){	
				
			    var check = event.target.id;
			    
			    var box1 = "tb_index_newsname" + check;
			    var box2 = "tb_index_newstext" + check;			    
			    box1 = document.getElementsByName(box1);
			    box2 = document.getElementsByName(box2);
			    var message = box1[0].innerHTML;
			    var message2 = box2[0].innerHTML;

			    var totalMessage = message + " - " + message2;
			    var length = totalMessage.length;



			    if (length > 160) {
			    
				    var result = confirm("Are you sure you want to send this text? Multiple texts will need to be send becuse of its length. It is greater than 157 characters.");
				    
				    if (result) {
				    	event.default();
				    	alert("test");
				    } else {
				    	event.preventDefault();
				    }
				}
			});

			function check() {					
				var scroll = localStorage.getItem('scroll');
				var check = localStorage.getItem('check');
				if (check == 1) {
					window.scrollTo(0,scroll);
					localStorage.setItem('check',0);
				}
			}

			function position() {
				var scroll = document.body.scrollTop;
				localStorage.setItem('scroll',scroll);
				localStorage.setItem('check',1);				
			}
			
		</script>

	</body>
</html>