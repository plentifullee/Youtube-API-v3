<?php
//YouTube API v3.0
//Examples of using tokens to retrieve the next / previous set of feeds
//Visit my site http://plenty.codes for more info

$playlist = "replace_me"; //replace with a youtube playlist ID
$api_key = "replace_me"; //your public access API key from google's developer console
$maxResults = "5";

$path = getPath();
$feed = json_decode(file_get_contents($path));
echoResults($feed);
$nextToken = $feed->{'nextPageToken'}; //get the next token
echo "Next page token: <b>".$nextToken."</b><br><br>";
echo "<b>Feed URL:</b> <a href='".$path."' target='_blank'>".$path."</a><br><br>";

echo "<hr>";

echo "<i>Using the next page token, we can retrieve the next set of results.</i><br><br>";
$path = getPath($nextToken); //use the next token on the path
$feed = json_decode(file_get_contents($path));
echoResults($feed);
$nextToken = $feed->{'nextPageToken'};
$prevToken = $feed->{'prevPageToken'}; //we can retrieve a previous token
echo "Next page token: <b>".$nextToken."</b><br>";
echo "Previous page token: <b>".$prevToken."</b><br><br>";
echo "<b>Feed URL:</b> <a href='".$path."' target='_blank'>".$path."</a><br><br>";

//sets the feed path, if next token exist, append it to the path
function getPath($nextToken = FALSE) {
	if($nextToken === FALSE)
		$nextPageToken = "";
	else
		$nextPageToken = "&pageToken=$nextToken";
	
	global $playlist, $api_key, $maxResults;
	$path = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=$maxResults&playlistId=$playlist".$nextPageToken."&key=$api_key";
	return $path;
}

//gets specific results from the json feed and echo
function echoResults($feed) {
	global $maxResults;
	for($i = 0; $i < $maxResults; $i++) {
		//retrieve video information
		$video_title = $feed->{'items'}[$i]->{'snippet'}->{'title'};
		$video_description = $feed->{'items'}[$i]->{'snippet'}->{'description'};
		//output the results
		echo "<b>Title: </b>".$video_title."<br>";
		echo "<b>Description: </b>".$video_description."<br><br>";
	}	
}