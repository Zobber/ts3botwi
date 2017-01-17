<?php
include("../config.php");
include("../sinusbot.class.php");
include("../lang/$language.php");

$sinusbot = new SinusBot($ipport);
$sinusbot->login($user, $pass);

$sinusbot->selectInstance($instanceIDS[$defaultInstance]);

// Get media files
$files = $sinusbot->getFiles();

// list all files and folders(no action possible)
$count = 1;
for ($i = 0; $i < count($files); $i++) {
	if (isset($files[$i]['title'])) {
		$title = $files[$i]['title'];
	} else {
		$title = $files[$i]['filename'];
	}
	$titleID = $files[$i]['uuid'];
	$filetype = $files[$i]['type'];
	
	if ($filetype === 'folder') {
		$type = "[$lang[4]] ";
		$href = "#";
	} else {
		$type = '';
		$href = "./listFiles.php?song=$titleID";
	}
	
    echo "<div id=filenr>" . $count . "</div>" . "<div id=filename><a class=startSong href=$href>" . $type . $title  . "</a></div>";
	
	$count++;
}

// Start Song onClick
if (isset($_GET['song'])) {
	$song = $_GET['song'];
	//$sinusbot->playTrack($song);
	header('Location: ' . "./");
} 



// echo "<pre>";
// print_r($files);

?>
