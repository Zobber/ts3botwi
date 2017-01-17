<?php

require("config.php");
require_once("sinusbot.class.php");

$sinusbot = new SinusBot($ipport);
$sinusbot->login($user, $pass);

$BotSettings = $sinusbot->getSettings($instanceIDS[$defaultInstance]);
$BotNick = $BotSettings['nick'];
$getChannels = $sinusbot->getChannels($instanceIDS[$defaultInstance]);

//get current Channel Name where bot is playing at
for ($a = 0; $a < count($getChannels); $a++) {
	//echo "[" . $getChannels[$a]["name"] . "]<br>";
	$client = $getChannels[$a]['clients'];
	for ($b = 0; $b < count($client); $b++) {
		//echo "=> " . $client[$b]["nick"] . "<br>";
		if ($client[$b]["nick"] === $BotNick) {
			$curBotChName = $getChannels[$a]["name"];
			$curBotChID = $getChannels[$a]["id"];
		}
	}
}

// get clients of channel
for ($c = 0; $c < count($getChannels); $c++) {
	If ($getChannels[$c]["id"] === $curBotChID ) {
		$clientNames = $getChannels[$c]["clients"];
	}
}

// get clients nickname of channel
for ($d = 0; $d < count($clientNames); $d++) {
	$clientNick = $clientNames[$d]["nick"];
	echo "&sdot; " . $clientNick . "<br>";
}
?>