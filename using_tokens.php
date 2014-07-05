<?php
//YouTube API v3.0
//Examples of using tokens to retrieve the next / previous set of feeds
//Created by plentifullee, visit my site at http://plenty.codes

$api_key = "replace_me"; //your public access API key from google's developer console
$maxResults = "5"; //max JSON results
$playlist = "replace_me"; //replace with a youtube playlist ID, eg: PLOU2XLYxmsIJQhUeN9S2kQ-3PWzPZVZD0

echo "<b>Playlist id:</b> ".$playlist."<br>";
echo "<b>Max Results:</b> ".$maxResults;
echo "<hr>";

$path = getPath();
$feed = json_decode(file_get_contents($path));
echoResults($feed);
if(isset($feed->{'nextPageToken'})) {
	$nextToken = $feed->{'nextPageToken'}; //get the next token
	echo "Next page token: <b>".$nextToken."</b><br><br>";
	echo "<b>Feed URL:</b> <a href='".$path."' target='_blank'>".$path."</a><br><br>"; //output the path used
	echo "<hr>";
	echo "<i>Using the next page token, we can retrieve the next set of results.</i><br><br>";
	$path = getPath($nextToken); //use the next token on the path
	$feed = json_decode(file_get_contents($path));
	echoResults($feed);

	if(isset($feed->{'nextPageToken'})) { //check for last page
		$nextToken = $feed->{'nextPageToken'};
		echo "Next page token: <b>".$nextToken."</b><br>";
	} else {
		echo "No more next page token!<br>";
	}
	$prevToken = $feed->{'prevPageToken'}; //we can also retrieve a previous token
	echo "Previous page token: <b>".$prevToken."</b><br><br>";
	echo "<b>Feed URL:</b> <a href='".$path."' target='_blank'>".$path."</a><br><br>"; //output the path used
} else { //if playlist is shorter than max results
	echo "<b>Next page token doesn't exist because playlist is too short!<br>Please choose a playlist longer than your max results: </b>".$maxResults;
}

//sets the feed path, if next token exist, append it to the path
function getPath($nextToken = FALSE) {
	if($nextToken === FALSE) { //check for next page token
		$nextPageToken = "";
	} else {
		$nextPageToken = "&pageToken=$nextToken";
	}
	global $playlist, $api_key, $maxResults, $fields;
	$path = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=$maxResults&playlistId=$playlist".$nextPageToken."&key=$api_key";
	return $path;
}

//gets specific results from the json feed and echo
function echoResults($feed) {
	global $maxResults;
	for($i = 0; $i < $maxResults; $i++) {
		if(isset($feed->{'items'}[$i])) { //if result exist
			//retrieve video information
			$video_title = $feed->{'items'}[$i]->{'snippet'}->{'title'};
			$video_description = $feed->{'items'}[$i]->{'snippet'}->{'description'};
			//output the results
			echo "<b>Title: </b>".$video_title."<br>";
			echo "<b>Description: </b>".$video_description."<br><br>";
		}
	}
}