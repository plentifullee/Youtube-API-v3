<?php
//YouTube API v3.0
//Examples of using fields to restrict JSON results
//Visit my site http://plenty.codes for more info

$playlist = "replace_me"; //replace with a youtube playlist ID
$api_key = "replace_me"; //your public access API key from google's developer console
$maxResults = "5";
$fields = "items/snippet/resourceId/videoId"; //getting only the video ID on the JSON feed

$path = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=$maxResults&playlistId=$playlist&fields=$fields&key=$api_key";
$feed = json_decode(file_get_contents($path));

for($i = 0; $i < $maxResults; $i++) {
	//retrieve video information
	$video_id = $feed->{'items'}[$i]->{'snippet'}->{'resourceId'}->{'videoId'};
	//output the results
	echo "<b>Playlist ID: </b>".$video_id."<br><br>";
}

//output the path used
echo "<b>Feed URL:</b> <a href='".$path."' target='_blank'>".$path."</a><br><br><br>";


$fields = "items/snippet/title"; //getting only the video title on the JSON feed

$path = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=$maxResults&playlistId=$playlist&fields=$fields&key=$api_key";
$feed = json_decode(file_get_contents($path));

for($i = 0; $i < $maxResults; $i++) {
	//retrieve video information
	$video_title = $feed->{'items'}[$i]->{'snippet'}->{'title'};
	//output the results
	echo "<b>Video Title: </b>".$video_title."<br><br>";
}

//output the path used
echo "<b>Feed URL:</b> <a href='".$path."' target='_blank'>".$path."</a>";