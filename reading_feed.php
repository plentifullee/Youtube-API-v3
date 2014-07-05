<?php
//YouTube API v3.0
//Examples of retrieving and processing a JSON format youtube feed
//Created by plentifullee, visit my site at http://plenty.codes

$api_key = "replace_me"; //your public access API key from google's developer console
$maxResults = "5"; //max JSON results
$playlist = "replace_me"; //replace with a youtube playlist ID, eg: PLOU2XLYxmsIJQhUeN9S2kQ-3PWzPZVZD0

echo "<b>Playlist id:</b> ".$playlist."<br>";
echo "<b>Max Results:</b> ".$maxResults;
echo "<hr>";

$path = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=$maxResults&playlistId=$playlist&key=$api_key";
$feed = json_decode(file_get_contents($path));

for($i = 0; $i < $maxResults; $i++) {
	if(isset($feed->{'items'}[$i])) { //if result exist
		//retrieve video information
		$video_title = $feed->{'items'}[$i]->{'snippet'}->{'title'};
		$video_description = $feed->{'items'}[$i]->{'snippet'}->{'description'};
		//retrieve thumbnail sizes
		$video_thumbnail_default = $feed->{'items'}[$i]->{'snippet'}->{'thumbnails'}->{'default'}->{'url'};
		$video_thumbnail_medium = $feed->{'items'}[$i]->{'snippet'}->{'thumbnails'}->{'medium'}->{'url'};
		$video_thumbnail_high = $feed->{'items'}[$i]->{'snippet'}->{'thumbnails'}->{'high'}->{'url'};

		//output the results
		echo "<b>Title: </b>".$video_title."<br>";
		echo "<b>Description: </b>".$video_description."<br>";
		echo "<b>Thumbnail sizes: </b><a href='".$video_thumbnail_default."' target='_blank'>Default</a>, ";
		echo "<a href='".$video_thumbnail_medium."' target='_blank'>Medium</a>, ";
		echo "<a href='".$video_thumbnail_high."' target='_blank'>High</a><br><br>";
	}
}

echo "<b>Feed URL:</b> <a href='".$path."' target='_blank'>".$path."</a>"; //output the path used