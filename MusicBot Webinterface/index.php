<!DOCTYPE html>
<html>

	<head>
	
		<meta http-equiv="refresh" content="900" />
		<meta charset="utf-8"  />
		<title>Ts3 MusikBot Control</title>		
		<link rel="stylesheet" type="text/css" href="styles/style.css" />
		<script type="text/javascript" src="jquery.js"></script>
		
		<!-- START: Cookie Plugin -->
		<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.2/cookieconsent.min.css" />
		<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.2/cookieconsent.min.js" />
		<script>
			window.addEventListener("load", function(){
			window.cookieconsent.initialise({
			  "palette": {
				"popup": {
				  "background": "#252e39"
				},
				"button": {
				  "background": "#14a7d0"
				}
			  },
			  "position": "top"
			})});
		</script>
		<!-- END: Cookie Plugin -->
		
		<!-- START: Loading and Refreshing Clientlist & Channel -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function refreshChannel(){
				$(".botchannel").load('currentChannel.php');
				setInterval(function() {
					$(".botchannel").load('currentChannel.php');
				}, 5000); // refresh every 5 sec. ( 1000 = 1 sec )
			});
			
			$(document).ready(function refreshClients() {
				$(".clist").load('clientList.php');
				setInterval(
					function() {
						$(".clist").fadeOut('slow', function() {
							$(".clist").load('clientList.php');
							setTimeout(function() { $(".clist").fadeIn('slow'); }, 500);
						});
					},
				15000);
			});
		</script>
		<!-- END: Clientlist -->
		
		<!-- START: Change language by dropdown select -->
		<script type="text/javascript">
			function changeLanguage() {
					window.location.search = '?lang=' + $("#setLanguage").val();
				}
		</script>
		<!-- END: Language -->
		
	</head>
	
	
	<body>
	
		<div class="wrapper">
		
			<div class="nav">
				<?php include("nav.php") ?>
				<ul>
					<li class="list"><a class="active" href="<?php echo $navhome; ?>">Home</a></li>
					<li class="list"><a href="<?php echo $navlist; ?>">Musik</a></li>
					<li class="list"><a href="<?php echo $navplaylist; ?>">Playlists</a></li>
					<li class="list"><a href="<?php echo $navstream; ?>">Stream</a></li>
					<li class="list"><a href="<?php echo $navteamspeak; ?>" target="_blank">Ts³</a></li>
					<li class="list">
						<select id="setLanguage" onchange="changeLanguage()">
							<option <?php if (isset($_GET['lang']) && $_GET['lang'] == "de") { echo ' selected'; } ?> value="de">Deutsch</option>
							<option <?php if (isset($_GET['lang']) && $_GET['lang'] == "en") { echo ' selected'; } ?> value="en">English</option>
						</select>
					</li>
				</ul>
			</div>
			
			<div class="main">
			
				<div class="botinfo">
				
					<div class="botname">
						<?php include_once("config.php"); echo $instanceNames[$defaultInstance]; ?>
					</div>
					
					<div class="botchannel">
						<?php include_once("currentChannel.php"); ?>
					</div>
					
				</div>
			
				<div class="curSong">
					<marquee direction="left" behavior="scroll" scrollamount="6" scrolldelay="0" style="color:#fff; font-size:20px; font-family:Comic Sans MS; border-style:outset; border-color:white; background-color:rgba(58, 58, 58, 0.5);" onmouseover="this.stop();" onmouseout="this.start();">
						<?php 
							include_once("currentSong.php");
							if ($status['playing']) {
								echo $playing;
							} else {
								echo $stopped;
							}
						?>
					</marquee>
				</div>
				
				<div class="clientList">
					<?php echo "Channel:"; ?>
					<div class="clist"></div>
				</div>
				
				<div class="controllpad">
				
					<form id="control-buttons" name="control-buttons" action="playFile.php" method="post">
						<button id="backward-btn" type="submit" name="backwardM">
							<p class="button-text"><?php echo $lang[8] ?></p>
							<img id="backward-img" alt="backward-img" src="images/buttons/backward.png" />
						</button>
						<button id="pause-btn" type="submit" name="pauseM">
							<p class="button-text"><?php echo $lang[9] ?></p>
							<img id="pause-img" alt="pause-img" src="images/buttons/pause.png" />
						</button>
						<button id="play-btn" type="submit" name="playM">
							<p class="button-text"><?php echo $lang[10] ?></p>
							<img id="play-img" alt="play-img" src="images/buttons/play.png" />
						</button>
						<button id="forward-btn" type="submit" name="forwardM">
							<p class="button-text"><?php echo $lang[11] ?></p>
							<img id="forward-img" alt="forward-img" src="images/buttons/forward.png" />
						</button>
					</form>
					
				</div>
				
			</div>
			
		</div>
		
		<div class="footer">
		
			<div class="login" style="display:none;">
				<?php
					if(isset($_GET['login'])) {
						$benutzer = $_POST['benutzer'];
						$passwort = $_POST['passwort'];
					}
				?>		
				
				<form action="?login=1" method="post">
					Benutzer:<br>
					<input type="text" size="20" maxlength="250" name="benutzer" /><br><br>
					Passwort:<br>
					<input type="password" size="20"  maxlength="250" name="passwort" /><br>
					<input type="submit" value="Login">
				</form>
			</div>
			
			<div class="displayVersion">
				<?php echo $displayVersion; ?>
			</div>
			
		</div>
		
	</body>
	
</html>