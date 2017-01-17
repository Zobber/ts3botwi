<?php
include("config.php");
include("sinusbot.class.php");

$sinusbot = new SinusBot($ipport);
$sinusbot->login($user, $pass);

// Get Files and UUID of default-song
$files = $sinusbot->getFiles();
$song = $files[1]['uuid'];

// Catch btn-submit
	if (isset($_POST['playM'])) {
		$sinusbot->selectInstance($instanceIDS[0]);
		$sinusbot->playTrack($song);
    } 
	
	if (isset($_POST['pauseM'])) {
		$instanceIDS;
		// Wiedergabe Stoppen // Stop playing
		$sinusbot->stop();
    }

	if (isset($_POST['backwardM'])) {
		$instanceIDS;
		// Vorherige Lied abspielen // Play previous track
		$sinusbot->playPrevious();
    } 

	if (isset($_POST['forwardM'])) {
		$instanceIDS;
		// Naechstes Lied abspielen // Play next track
		$sinusbot->playNext();
    }

	
header('Location: ' . $myurl);
?>