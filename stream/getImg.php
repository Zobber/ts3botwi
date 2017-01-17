<?php
error_reporting('E_ERROR');
require("getSong.php");

$unknownimg = "../images/unknownimg.png";
$finalURL = $unknownimg;

if($useCachedThumbnail && $finalURL == $unknownimg){
	if(array_key_exists('thumbnail', $status['currentTrack'])){
		$thumbnailURL = "http://" . $ipport . "/cache/" . $status['currentTrack']['thumbnail'];
		$finalURL = $thumbnailURL;
	}
}

if($findThumbnailFromMetaData && $finalURL == $unknownimg){
	if(($urlFromMD = checkMetaDataForURL()) !== false){ //metdata contains a link
		if(($urlFull = resolveURL($urlFromMD)) !== false){ //it is a valid url and has been resolved to a full URL
	        if(($ytID = getYoutubeID($urlFull)) !== false){ //it's a youtube link
	        $finalURL = "https://i.ytimg.com/vi/". $ytID ."/sddefault.jpg";
	        	if(!returns404($finalURL)) {
	        		$finalURL = "https://i.ytimg.com/vi/". $ytID ."/hqdefault.jpg";
	       		 }
	 	   	}
		}
	}
}
if($searchForThumbnail && $finalURL == $unknownimg){
// implement at some point
}

if(!returns404($finalURL)){
	$finalURL = $unknownimg;
}

echo $finalURL;

?>