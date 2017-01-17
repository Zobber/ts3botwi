<?php

error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);

$ip			= "212.227.8.80"; //IP Address of the server SinusBot is running on (NOT localhost)
$port		= "8087"; //Port that the web panel is running on (default 8087)
$user		= "admin"; //username to login to the web panel 
$pass		= "admin"; //corresponding password

$title					= "SinusBot-Radio"; //title to display
$instanceIDS		= array("77227ffc-a191-46dd-8cda-7e12f4a0b5d3");
$instanceNames	= array("Puuhb&auml;r | Winnie");
$defaultInstance = 0;

$domain	= "www.xKamikaze.de";
$path		= "/tsbot/versions/v0.0.3";

$useCachedThumbnail = true; //if stored, should the cached image be used? (quality will vary) (default:true)
$findThumbnailFromMetaData = true; //should a thumbnail image be extracted from metadata if the cached thumbnail isn't found or is disabled? Currently only works with youtube. (default: true)
$searchForThumbnail = false; //if no thumbnail can be found based on metadata, should youtube be searched? (CURRENTLY NOT IMPLEMENTED)

$teamspeakhost = "213.165.89.6"; // IP of the Server where the Bot is running on
$teamspeakport = "8888"; // Port of the Server where the Bot is running on

$language = "DE"; //output language



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