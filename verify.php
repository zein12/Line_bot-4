<?php

$access_token = 'SgzRYItJH9a9DBXajfmSOPP2LalYt4wgIx1fVmy5QVquT5GHhyDk4pZsG2sORBFd+gIQJxELmgnW17qUVVo2ss1CRAWU/kGHPCBUypto+RF9pVGJ8wrAl4XVXcrB0PQKCQnb4aqN6YRK0gmHlg6Q8QdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;