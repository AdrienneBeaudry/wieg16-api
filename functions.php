<?php

function get_webpage($url) {
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

function count_words($keywords = [], $content = ''){
    //Transform to lowercase + strip all html tags of corpus
    $content = strtolower(strip_tags($content));
    //Loop through the keyword array, allowing for multiple words to be searched at once
    $amounts = [];
    foreach ($keywords as $word) {
        //Count occurrence of substring within string
        $nr = substr_count($content, $word);
        $amounts[] = $nr;
    }
    $keywords = array_combine($keywords, $amounts);
    return $keywords;
}

function display_search_results($word, $nr){
    echo "<p><strong>$word</strong> appears <strong>$nr</strong> times in the document</p>";
}
