<?php

error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);

$ip			= "120.0.0.1";	// IP Address of the server SinusBot is running on (NOT localhost)
$port		= "8087";		// Port that the web panel is running on (default 8087)
$user		= "admin";		// Username to login to the web panel 
$pass		= "admin";		// Corresponding password

$title					= "SinusBot-Radio"; // Ttitle to display in browser
$defaultInstance = 0;
$instanceIDS		= array(
											"InstanceID #1",
											"InstanceID #2"
										);
$instanceNames	= array(
											"MusicBot #1",
											"MusicBot #2"
										);

$domain	= "www.mydomain.de";
$path		= "/teamspeak/bot";

$useCachedThumbnail			= true; //if stored, should the cached image be used? (quality will vary) (default:true)
$findThumbnailFromMetaData	= true; //should a thumbnail image be extracted from metadata if the cached thumbnail isn't found or is disabled? Currently only works with youtube. (default: true)
$searchForThumbnail				= false; //if no thumbnail can be found based on metadata, should youtube be searched? (CURRENTLY NOT IMPLEMENTED)

$teamspeakhost	= "120.0.0.1"; // IP of the Server where the Bot is running on
$teamspeakport	= "8888"; // Port of the Server where the Bot is running on

$language = "EN"; // Select the default language. Support for additional languages coming soon. (Available DE/EN)





#------Do NOT modify the following:------#

$myurl	= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] && !in_array(strtolower($_SERVER['HTTPS']) , array(
					'off',
					'no'
				))) ? 'https' : 'http';
$myurl	.= '://' . $domain;
$myurl	.= $path;

if (isset($_GET['lang'])) {
	$language = $_GET['lang'];
}

$ipport	= $ip.":".$port;

$teamspeakJoinLink = "ts3server://$teamspeakhost?port=$teamspeakport";

#------------------------------------------------#