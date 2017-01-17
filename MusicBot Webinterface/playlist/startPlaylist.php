<?php
require("../config.php");
include("../nav.php");
include("../lang/$language.php");

// redirect back-to-home
$newURL = $navplaylist;

// get playlist name
if (isset($_GET['playlist'])) {
		$playlistname = $_GET['playlist'];
    } 

// get playlist uuid and start playlist
if (isset($_GET['uuid'])) {
		$playuuid = $_GET['uuid'];
		$playMyPlaylist = $sinusbot->playPlaylist($playuuid, 0, $instanceIDS[$defaultInstance]);
    } 

// output msg and exit script
if (isset($_GET['dev'])) {
	$playMyPlaylist = $playMyPlaylist["success"];
		If ( $playMyPlaylist == 1 ) {
			$playMyPlaylist = 'Playlist ' . $playlistname . ' ' . $lang[6]. '<br>';
		} else {
			$playMyPlaylist =  'Playlist ' . $playlistname . ' ' . $lang[7] . '<br>';
		}
		echo $playMyPlaylist;
		exit("#DEV End");
} 

	
// only redirect if &dev isn't set
if (!isset($_GET['dev'])) {
	header('Location: '. $newURL);
}

?>