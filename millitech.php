<?php


function get_webpage($url) {
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

/*$keywords = ['header', 'http', 'php'];

$fileName = "customers.json";
$fp = fopen($fileName, "w");
fclose($fp);


$content = file_get_contents($fileName);
$content = strip_tags($content);
$content = strtolower($content);

foreach ($keywords as $word) {
    $nr = substr_count($content, $word);
    echo "<p><strong>$word</strong> appears <strong>$nr</strong> times in the document</p>";
}*/
