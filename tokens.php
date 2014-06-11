<?php
//YouTube API v3.0
//This example will use the next page token to retrieve a next set of results
//For the in depth tutorial, go to http://plenty.codes

$playlist 	= "replace_me"; //replace with a youtube playlist ID
$api_key 	= "replace_me"; //your public access API key from google's developer console
$maxResults = "5"; 

$path = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=$maxResults&playlistId=$playlist&key=$api_key";
$feed = json_decode(file_get_contents($path));

for($i = 0; $i < $maxResults; $i++) {
	//retrieve video information
	$video_title 		= $feed->{'items'}[$i]->{'snippet'}->{'title'};
	$video_description 	= $feed->{'items'}[$i]->{'snippet'}->{'description'};

	//output the results
	echo "<b>Title: </b>".$video_title."<br>";
	echo "<b>Description: </b>".$video_description."<br><br>";
}

$nextToken = $feed->{'nextPageToken'};

echo "<b>Feed URL:</b> <a href='".$path."' target='_blank'>".$path."</a><br><br>";
echo "Next page token: <b>".$nextToken."</b><br><br>";

echo "<hr>";

echo "Using the next page token, we can retrieve the next set of results.<br><br>";
$path = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=$maxResults&playlistId=$playlist&pageToken=$nextToken&key=$api_key";
$feed = json_decode(file_get_contents($path));

for($i = 0; $i < $maxResults; $i++) {
	//retrieve video information
	$video_title 		= $feed->{'items'}[$i]->{'snippet'}->{'title'};
	$video_description 	= $feed->{'items'}[$i]->{'snippet'}->{'description'};

	//output the results
	echo "<b>Title: </b>".$video_title."<br>";
	echo "<b>Description: </b>".$video_description."<br><br>";
}

$nextToken = $feed->{'nextPageToken'};
$prevToken = $feed->{'prevPageToken'};

echo "<b>Feed URL:</b> <a href='".$path."' target='_blank'>".$path."</a><br><br>";
echo "Next page token: <b>".$nextToken."</b><br>";
echo "Previous page token: <b>".$prevToken."</b><br>";

?>