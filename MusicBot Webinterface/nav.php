<?php
include("config.php");
include("version.php");

$navhome			= $myurl . "/?lang=$language";
$navlist				= $myurl . "/list". "/?lang=$language";
$navplaylist			= $myurl . "/playlist". "/?lang=$language";
$navstream			= $myurl . "/stream". "/?lang=$language";
$navteamspeak	= $teamspeakJoinLink;
$displayVersion	= "Ver. " . $version . "<br>" . $releaseDate;

?>