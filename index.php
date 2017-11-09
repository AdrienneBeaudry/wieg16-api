<?php
require 'functions.php';
$ch = curl_init("http://www.nicholassolutions.com/tutorials/php/headers.html");
$fileName = "headers.html";
$fp = fopen($fileName, "w");

curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_exec($ch);
curl_close($ch);
fclose($fp);

$keywords = ['header', 'php', 'http'];
$content = file_get_contents($fileName);

$keywords = count_words($keywords, $content);

foreach ($keywords as $keyword => $amount) {
    display_search_results($keyword, $amount);
}