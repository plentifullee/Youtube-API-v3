<?php
//YouTube API v3.0
//Examples of sorting videos of a youtube channel
//Created by plentifullee, visit my site at http://plenty.codes

$time_start = microtime(true); //for debugging purposes

$api_key = "replace_me"; //your public access API key from google's developer console, enable youtube data api v3
$maxResults = "5"; //max JSON results
$channel_name = "replace_me"; //browser a channel on youtube and get channel name, eg: GoogleDevelopers
$path = "https://www.googleapis.com/youtube/v3/channels?part=id&forUsername=$channel_name&key=$api_key";
$feed = json_decode(file_get_contents($path));
$channel_id = $feed->{'items'}[0]->{'id'}; //retrieve channel id

//sorting options
$order = "viewCount";
//date -> Resources are sorted in reverse chronological order based on the date they were created
//rating -> Resources are sorted from highest to lowest rating
//relevance -> Resources are sorted based on their relevance to the search query
//title -> Resources are sorted alphabetically by title
//videoCount -> Channels are sorted in descending order of their number of uploaded videos
//viewCount -> Resources are sorted from highest to lowest number of views

$path = "https://www.googleapis.com/youtube/v3/search?part=snippet&channelId=$channel_id&maxResults=$maxResults&order=$order&type=video&key=$api_key";
$feed = json_decode(file_get_contents($path));
echo "<b>Channel name:</b> ".$channel_name."<br>";
echo "<b>Channel id:</b> ".$channel_id."<br>";
echo "<b>Max Results:</b> ".$maxResults."<br>";
echo "<b>Sort by:</b> ".$order."<br>";
echo "<hr>";

//create and embed videos based on sorting
for($i = 0 ; $i < $maxResults; $i++) {
	if(isset($feed->{'items'}[$i])) { //if result exist
		$video_id = $feed->{'items'}[$i]->{'id'}->{'videoId'};
		echo '<iframe width="560" height="315" src="//www.youtube.com/embed/'.$video_id.'?rel=0" frameborder="0" allowfullscreen></iframe><br><br>'; //embed youtube player with video id
	}
}
echo "<hr>";

$time_end = microtime(true); //for debugging purposes
$time = $time_end - $time_start;
echo "<br>Loading time: ".$time;