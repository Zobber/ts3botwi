<?php

error_reporting('E_ERROR');
session_start();
require("../config.php");
require("../sinusbot.class.php");
require("header.php");

if(isset($_GET['id'])){
	$id = $_GET['id'];
	if(!is_numeric((int)$id)){
		echo "Error: Invalid value for \"id\".";
		return;
	}
	if($id > count($instanceIDS) - 1){
		echo "Error: There are only " . count($instanceIDS) . " instances. Chose a number between 0 and " . (count($instanceIDS) -1) . ".";
		return;
	}
	$inst = $instanceIDS[$id];
	$_SESSION['inst'] = $id;
	setcookie("inst", $id, time() + (86400*30), "/");
}else if(isset($_SESSION['inst'])){
	$inst = $instanceIDS[$_SESSION['inst']];
	setcookie("inst", $_SESSION['inst'], time() + (86400*30), "/");
}else if(isset($_COOKIE['inst'])){
	$_SESSION['inst'] = $_COOKIE['inst'];
	$inst = $instanceIDS[$_COOKIE['inst']];
}else{
	$inst = $instanceIDS[$defaultInstance];
	$_SESSION['inst'] = $defaultInstance;
	setcookie("inst", $defaultInstance, time() + (86400*30), "/");
}

$sinusbot = new SinusBot($ipport);
$sinusbot->login($user, $pass);
$sinusbot->selectInstance($inst);
$token = $sinusbot->getWebStreamToken($inst);

?>

<!DOCTYPE html>
<html>

	<head>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://bootswatch.com/darkly/bootstrap.min.css">
		<link rel="stylesheet" href="../styles/icon-font.css"></head>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<link href="http://vjs.zencdn.net/4.3/video-js.css" rel="stylesheet">
		<link href="../styles/videojs-custom.css" rel="stylesheet">
		<script src="http://vjs.zencdn.net/4.3/video.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script> 
		<title><?php echo $title; ?></title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="../styles/style.css" />
		<style type="text/css">
			.songlink{
				color: rgb(255, 255, 255);
			}

		</style>

		<script type="text/javascript">
			function loadImg() {
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (xhttp.readyState == 4 && xhttp.status == 200) {
						var videoposter = xhttp.responseText;
						$('.vjs-poster').css({
							'background-image': 'url('+videoposter+')',
							'display': 'block',
							'background-size': 'cover'

						});
					}
				};
				xhttp.open("GET", "getImg.php", true);
				xhttp.send();
			}
			/*
			function loadSearch() {
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (xhttp.readyState == 4 && xhttp.status == 200) {
						document.getElementById("#songname").innerHTML = xhttp.responseText;
					}
				};
				xhttp.open("GET", "getSongURL.php", true);
				xhttp.send();
			}
			*/
			
            $(document).ready(function getSong(){
				setInterval(function() {
				$("#songtitle").load("currentSong.php?lang=<? echo $language; ?>");
			}, 2000);
			});

			setInterval(function() {
				loadImg();
				loadSearch();
			}, 3500); 
		</script>
		
		<!-- START: Change language by dropdown select -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script type="text/javascript">
			function changeLanguage() {
					window.location.search = '?lang=' + $("#setLanguage").val();
				}
		</script>
		
		
	</head>
	
	<body>
		<div class="wrapper">
			<div class="nav">
			<?php include("../nav.php") ?>
				<ul>
					<li class="list"><a href="<?php echo $navhome; ?>">Home</a></li>
					<li class="list"><a href="<?php echo $navlist; ?>">Musik</a></li>
					<li class="list"><a href="<?php echo $navplaylist; ?>">Playlists</a></li>
					<li class="list"><a class="active" href="<?php echo $navstream; ?>">Stream</a></li>
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
			
				<div class="embed-responsive embed-responsive-16by9">
					<video id="player" class="video-js vjs-default-skin vjs-big-play-centered embed-responsive-item" onloadstart="this.volume=0.4"
					controls preload="none" autoplay
					data-setup='{
					"height": "100%",
					"width": "100%",
					"loadingSpinner": true,
					"children": {
						"controlBar": {
							"children": {
								"liveDisplay": false,
								"fullscreenToggle": true,
								"durationDisplay": false,
								"currentTimeDisplay": false,
								"timeDisplay": false,
								"timeDivider": false,
								"progressControl" : false
						}}}}'>No Support.
					<!-- <source src="test.mp3" type="audio/mp3"> -->
					<source src="http://<?php echo $ipport; ?>/api/v1/bot/i/<?php echo $inst; ?>/stream/<?php echo $sinusbot->getWebStreamToken($inst); ?>" type="audio/mp3">
					</video>

					<script type="text/javascript">
						var video = document.getElementById('player');
						
						if(getCookie("volume") != "" && getCookie("volume") != null){
							video.volume = getCookie("volume");
						}else{
							video.volume = 0.1;
						}

						video.addEventListener("volumechange", function() {
							var d = new Date();
							d.setTime(d.getTime() + (30*24*60*60*1000));
							var expires = "expires="+ d.toUTCString();
							document.cookie = "volume=" + video.volume + "; " + expires + "; path=/";
						}, true);

						function getCookie(name) {
							var value = "; " + document.cookie;
							var parts = value.split("; " + name + "=");
							if (parts.length == 2) return parts.pop().split(";").shift();
						}
					</script>

				</div>
				
				<!--iframe class="displayLiveSong" src="currentSong.php" ></iframe-->
				
				<div class="displayLiveSong" id="songtitle">
					<!--a style='font-size:15px; font-family:Comic Sans MS; border-style:outset; border-color:white; background-color:rgba(58, 58, 58, 0.5); text-decoration: none; color: white;' target='_blank' href="https://www.youtube.com/results?search_query=?include("currentSong.php"); echo $ytrack;?>"></a-->
				</div>
				
				<div class="songname"></div>
				
				<div class="ccopyright">
					<a class="copyright" href="https://forum.sinusbot.com/threads/sinusbot-webstream.2859/" target="_blank">&copy; Made by Zahzi - SinusBot Webstream</a>
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
			
		</div>
		
	</body>
	
</html>