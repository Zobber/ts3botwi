<?php
include("../config.php");
include("../sinusbot.class.php");
include("../lang/$language.php");

$sinusbot = new SinusBot($ipport);
$sinusbot->login($user, $pass);

$playlist = $sinusbot->getPlaylists();
for ($a = 0; $a < count($playlist); $a++) {
	$playuuid = $playlist[$a]["uuid"];
}

// Sort Array of playlists alphabetically
$playname = $playlist;

function aasort (&$array, $key) {
    $sorter=array();
    $ret=array();
    reset($array);
    foreach ($array as $ii => $va) {
        $sorter[$ii]=$va[$key];
    }
    asort($sorter);
    foreach ($sorter as $ii => $va) {
        $ret[$ii]=$array[$ii];
    }
    $array=$ret;
}
aasort($playlist,"name");
$playlist = array_values($playlist);

//$startPlaylist = $sinusbot->playPlaylist($playuuid, 0, $instanceIDS[$defaultInstance]);


$divCounter = 1;
for ($a = 0; $a < count($playlist); $a++) {
	
	$playname = $playlist[$a]["name"];
	$playuuid = $playlist[$a]["uuid"];
	$playlistTracks = $sinusbot->getPlaylistTracks($playuuid);
	$playlistTracks = $playlistTracks["entries"];
	$playnamereplaced = str_replace(' ', '+', $playname);
	
	If($a >= 1) {
		echo "<hr/>";
	}
	echo "
			<div class=header>
				<div class=collapse>
					<a class=startPlaylist href=./startPlaylist.php?playlist=$playnamereplaced&uuid=$playuuid >&#10084;</a>
				</div>
				<a class=collapsing href=# onclick=toggle_visibility('plisttracks$divCounter');>
					<h2 class=playname>" . $playname . "</h2>
				</a>
			</div>";
	echo "<div id=plisttracks$divCounter class=plisttracks style=display:none;>";
	
	$divCounter++;
	$trackCounter = 1;
	
	for ($i = 0; $i < count($playlistTracks); $i++) {
		if ($playlistTracks[$i]["title"] == "") {
			$playlistTracks[$i]["title"] = $lang[5];
		}
		
		echo "<div id=filenr>" . $trackCounter . "</div>" . "<div id=filename>" . $playlistTracks[$i]["title"] . '</div>';
		$trackCounter++;
	}
	echo "</div>";
}


/*
		echo "<pre>";
		$playlistTracks = $sinusbot->getPlaylistTracks("eff4477b-cac8-46f9-b920-31702bbe438b");
		print_r($playlistTracks);
		echo "</pre>"
*/

?>




