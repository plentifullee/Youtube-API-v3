<?php
//YouTube API v3.0
//Examples of retrieving a youtube channel ID from a youtube channel name
//Visit my site http://plenty.codes for more info

$api_key = "replace_me"; //your public access API key from google's developer console
$channel_name = "replace_me"; //browser a channel on youtube and get channel name, eg: GoogleDevelopers

$path = "https://www.googleapis.com/youtube/v3/channels?part=id&forUsername=$channel_name&key=$api_key";
$feed = json_decode(file_get_contents($path));

//retrieve channel id
$channel_id = $feed->{'items'}[0]->{'id'};
echo $channel_id;