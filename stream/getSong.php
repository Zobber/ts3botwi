<?php
error_reporting('E_ERROR');
session_start();
require("../sinusbot.class.php");
require("../config.php");
$sinusbot = new SinusBot($ipport);
$sinusbot->login($user, $pass);
$status = $sinusbot->getStatus($instanceIDS[$_SESSION['inst']]);
function getTrack(){
    global $status;
    try {
        if(array_key_exists("title", $status['currentTrack']) && isset($status['currentTrack']['title'])){
            $track = $status['currentTrack']['title'];
        }else if(array_key_exists("filename", $status['currentTrack']) && isset($status['currentTrack']['filename'])){
            $track = $status['currentTrack']['filename'];
        }else{
            $track = "";
        }
    }catch(Exception $e){
        $track = "Error in getTrack() in getSong.php";
    }
    return $track;
}
function getName(){
    return getTrack();
}
function getArtist(){
    global $status;
    try {
        if(array_key_exists("artist", $status['currentTrack']) && isset($status['currentTrack']['artist'])){
            $artist = $status['currentTrack']['artist'];
        }else{
            $artist = "";
        }
    }catch(Exception $e){
        $artist = "Error in getArtist() in getSong.php";
    }
    return $artist;
}
function checkMetaDataForURL(){
    global $status;
    $checkStrings = array($status['currentTrack']['filename'],
        $status['currentTrack']['album'],
        $status['currentTrack']['artist']
        );
    foreach ($checkStrings as $str) {
        if(validateURL($str) !== false){
            return $str;
        }
    }
    return false;
}
function validateURL($url){
    $url = preg_replace('/\s+/S', "", $url);
    try{
        if($urlParts = parse_url($url)){
            if(!isset($urlParts['scheme'])){
                $url = "http://$url";
                $urlParts = parse_url($url);
            }
            if(!isset($urlParts['host'])){
                return false;
            }
            if(($url = filter_var($url, FILTER_VALIDATE_URL)) === false){
                return false;
            }
        }else{
            return false;
        }
        if(!returns404($url)) {
            return false;
        }
    }catch(Exception $e){
        return false;
    }
    return $url;
}
function returns404($url){
    $file_headers = @get_headers($url);
    if(!$file_headers || $file_headers[0] == 'HTTP/1.0 404 Not Found' || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
        return false;
    }
    return true;
}
function resolveURL($url){
    try{
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_HEADER,true); // Get header information
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,false);
        $header = curl_exec($ch);
        $fields = explode("\r\n", preg_replace('/\x0D\x0A[\x09\x20]+/', ' ', $header)); // Parse information
        for($i=0;$i<count($fields);$i++){
            if(strpos($fields[$i],'Location') !== false){
               $url = str_replace("Location: ","",$fields[$i]);
           }
       }
       return $url;
   }catch(Exception $e){
      return false;   
  }
}
function getYoutubeID($url){
    if($query = parse_url($url, PHP_URL_QUERY)){
        if(($startPos = strpos($query, 'v=')) !== false){
            $startPos += 2;
            return substr($query, $startPos, 11);
        }
    }
    return false;
}
?>