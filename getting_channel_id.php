<?php
//YouTube API v3.0
//Examples of retrieving a youtube channel ID from a youtube channel name
//Created by plentifullee, visit my site at http://plenty.codes

$time_start = microtime(true); //for debugging purposes

$api_key = "replace_me"; //your public access API key from google's developer console, enable youtube data api v3
$channel_name = "replace_me"; //browser a channel on youtube and get channel name, eg: GoogleDevelopers

$path = "https://www.googleapis.com/youtube/v3/channels?part=id&forUsername=$channel_name&key=$api_key";
$feed = json_decode(file_get_contents($path));

//retrieve channel id
$channel_id = $feed->{'items'}[0]->{'id'};
echo "<b>Channel name:</b> ".$channel_name."<br>";
echo "<b>Channel id:</b> ".$channel_id."<br>";
echo "<hr>";

$time_end = microtime(true); //for debugging purposes
$time = $time_end - $time_start;
echo "<br>Loading time: ".$time;