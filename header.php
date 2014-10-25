
		<button type="button" role="button" aria-label="Toggle Navigation" class="lines-button x" id="showLeftPush">
			<span class="lines"></span>
		</button>

		<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left cl-effect-10" id="cbp-spmenu-s1">
			<div id="nav-top"></div>
			
			<?php if ($functions->login) { ?>
				<a href="basicform.php#top" class="scroll" data-hover="Home"><span>HOME</span></a>
				<a href="basicform.php#a-track-info" class="scroll" data-hover="Track"><span>TRACK</span></a>
				<a href="basicform.php#a-field-info" class="scroll" data-hover="Field"><span>FIELD</span></a>
				<a href="basicform.php#a-news" class="scroll" data-hover="News"><span>NEWS</span></a>
				<a href="basicform.php#a-schedule" class="scroll" data-hover="Schedule"><span>SCHEDULE</span></a>
				<a href="basicform.php#a-records" class="scroll" data-hover="Records"><span>RECORDS</span></a>
				<a href="basicform.php#a-coaches" class="scroll" data-hover="Coaches"><span>COACHES</span></a>
			<?php } else { ?>
				<a href="index.php#top" class="scroll" data-hover="Home"><span>HOME</span></a>
				<a href="index.php#a-track-info" class="scroll" data-hover="Track"><span>TRACK</span></a>
				<a href="index.php#a-field-info" class="scroll" data-hover="Field"><span>FIELD</span></a>
				<a href="index.php#a-news" class="scroll" data-hover="News"><span>NEWS</span></a>
				<a href="index.php#a-schedule" class="scroll" data-hover="Schedule"><span>SCHEDULE</span></a>
				<a href="index.php#a-records" class="scroll" data-hover="Records"><span>RECORDS</span></a>
				<a href="index.php#a-coaches" class="scroll" data-hover="Coaches"><span>COACHES</span></a>
			<?php } ?>

			<div class="divider"></div>
			<a href="gallery.php" data-hover="Image Gallery"><span>Image Gallery</span></a>
			<a href="champions.php" data-hover="State Champions"><span>State Champions</span></a>
			<a href="register3.php" data-hover="Athlete Register"><span>Athlete Register</span></a>
			<a href="parentregister.php" data-hover="Parent Register"><span>Parent Register</span></a>
			<?php if ($functions->login) { ?>
				<a href="infoview.php" data-hover="Athlete Data"><span>Athlete Data</span></a>
				<a href="parentinfo.php" data-hover="Parent Data"><span>Parent Data</span></a>			
				<a href="logout.php" data-hover="Logout"><span>Logout</span></a>
			<?php } else { ?>
				<a href="login2.php" data-hover="Login"><span>Login</span></a>
			<?php } ?>
			
		</nav>

		<style type="text/css">

			.lines-button {
				overflow: visible;
			}

		</style>