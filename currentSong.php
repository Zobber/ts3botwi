<?php
include("config.php");
include("sinusbot.class.php");
include("lang/$language.php");

$sinusbot = new SinusBot($ipport);
$sinusbot->login($user, $pass);

$instances	= $sinusbot->selectInstance($instanceIDS[$defaultInstance]); // Alle Instanzen
$status		= $sinusbot->getStatus($instanceIDS[$defaultInstance]);

If (($status["currentTrack"]["type"] == "url")) {
	$artist = $status["currentTrack"]["tempArtist"];
} else {
	$artist = isset($status["currentTrack"]["artist"]);
}
If (($status["currentTrack"]["type"] == "ytdl")) {
	$artist = $status["currentTrack"]["album"];
} else {
	$artist = $lang[1];
}

$playing = (($status["currentTrack"]["type"] == "url") ? $status["currentTrack"]["tempTitle"] : $status["currentTrack"]["title"]) . ' ' . $lang[2] . ' ' . $artist . '<br>';
preg_replace( "<br>", "", $playing );

$stopped = $instanceNames[$defaultInstance] . ' ' . $lang[3];



/*
	echo "<pre>";
	print_r($lang);
	echo "</pre>";
*/
?>