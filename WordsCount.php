<?php
require_once('TwitterAPIHandler.php');
require_once('MeCabHandler.php');

$mecab = new MeCabHandler();
$twitter = new TwitterAPIHandler();
echo json_encode(
    $mecab->countWords(
        $twitter->getTextTweets()
    )
);