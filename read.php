<?php

$playlist 	= "replace_me"; //replace with a youtube playlist ID
$api_key 	= "replace_me"; //your public access API key from google's developer console
$maxResults = "5";

$path = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=$maxResults&playlistId=$playlist&key=$api_key";
$feed = json_decode(file_get_contents($path));

for($i = 0; $i < $maxResults; $i++) {
	//retrieve video information
	$video_title 				= $feed->{'items'}[$i]->{'snippet'}->{'title'};
	$video_description 			= $feed->{'items'}[$i]->{'snippet'}->{'description'};
	//retrieve thumbnail sizes
	$video_thumbnail_default 	= $feed->{'items'}[$i]->{'snippet'}->{'thumbnails'}->{'default'}->{'url'};
	$video_thumbnail_medium 	= $feed->{'items'}[$i]->{'snippet'}->{'thumbnails'}->{'medium'}->{'url'};
	$video_thumbnail_high 		= $feed->{'items'}[$i]->{'snippet'}->{'thumbnails'}->{'high'}->{'url'};
	$video_thumbnail_standard 	= $feed->{'items'}[$i]->{'snippet'}->{'thumbnails'}->{'standard'}->{'url'};
	$video_thumbnail_maxres 	= $feed->{'items'}[$i]->{'snippet'}->{'thumbnails'}->{'maxres'}->{'url'};

	//output the results
	echo "<b>Title: </b>".$video_title."<br>";
	echo "<b>Description: </b>".$video_description."<br>";
	echo "<b>Thumbnail sizes: </b><a href='".$video_thumbnail_default."' target='_blank'>Default</a>, ";
	echo "<a href='".$video_thumbnail_medium."' target='_blank'>Medium</a>, ";
	echo "<a href='".$video_thumbnail_high."' target='_blank'>High</a>, ";
	echo "<a href='".$video_thumbnail_standard."' target='_blank'>Standard</a>, ";
	echo "<a href='".$video_thumbnail_maxres."' target='_blank'>Hi-Res</a><br><br>";
}

//output the path used
echo "<br>This is the feed URL: <br><a href='".$path."' target='_blank'>".$path."</a>";

?>