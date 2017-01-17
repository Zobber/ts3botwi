<!DOCTYPE html>
<html>

	<head>
	
		<meta charset="utf-8" />
		<title>Ts3 MusikBot Control</title>		
		<link rel="stylesheet" type="text/css" href="../styles/style.css" />
		
		<!-- START: Cookie Plugin -->
		<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.2/cookieconsent.min.css" />
		<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.2/cookieconsent.min.js"></script>
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
		
		<!-- START: Toggle display-style onclick -->
		<script language='javascript' type='text/javascript'>
		
			function toggle_visibility(id) {
				var e = document.getElementById(id);
				if(e.style.display == 'block')
					e.style.display = 'none';
				else
					e.style.display = 'block';
			};
		</script>
		<!-- END: toggle display-style -->
		
		<!-- START: Change language by dropdown select -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
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
			<?php include("../nav.php") ?>
				<ul>
					<li class="list"><a href="<?php echo $navhome; ?>">Home</a></li>
					<li class="list"><a href="<?php echo $navlist; ?>">Musik</a></li>
					<li class="list"><a class="active" href="<?php echo $navplaylist; ?>">Playlists</a></li>
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
			</div>
			
			<div class="main">
			
				<div class="listFiles">
					<?php include("getPlaylistWithTracks.php")?>
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