<?php
//YouTube API v3.0
//Examples of using fields to return specific JSON results
//Created by plentifullee, visit my site at http://plenty.codes

$api_key = "replace_me"; //your public access API key from google's developer console
$maxResults = "5"; //max JSON results
$playlist = "replace_me"; //replace with a youtube playlist ID, eg: PLOU2XLYxmsIJQhUeN9S2kQ-3PWzPZVZD0

echo "<b>Playlist id:</b> ".$playlist."<br>";
echo "<b>Max Results:</b> ".$maxResults;
echo "<hr>";

$path = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=$maxResults&playlistId=$playlist&key=$api_key";
echo "<b>Original Feed URL:</b> <a href='".$path."' target='_blank'>".$path."</a><br><br>";

$fields = urlencode("items/snippet/resourceId/videoId"); //getting only the video ID on the JSON feed
$path = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=$maxResults&playlistId=$playlist&fields=$fields&key=$api_key";
echo "Restrict results to only: <b>".urldecode($fields)."</b>";
echo "<br><b>Feed URL:</b> <a href='".$path."' target='_blank'>".$path."</a><br><br>"; //output the path used

$fields = urlencode("items/snippet/title"); //getting only the video title on the JSON feed
$path = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=$maxResults&playlistId=$playlist&fields=$fields&key=$api_key";
echo "Restrict results to only: <b>".urldecode($fields)."</b>";
echo "<br><b>Feed URL:</b> <a href='".$path."' target='_blank'>".$path."</a><br><br>";

$fields = urlencode("items/snippet(resourceId/videoId,title)"); //getting only the video ID and video title on the JSON feed
$path = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=$maxResults&playlistId=$playlist&fields=$fields&key=$api_key";
echo "Restrict results to only: <b>".urldecode($fields)."</b>";
echo "<br><b>Feed URL:</b> <a href='".$path."' target='_blank'>".$path."</a>";