<?php
require_once("twitteroauth/twitteroauth.php"); 

class TwitterAPIHandler{
    const API_KEY = '自分のをいれてね';
    const API_SECRET = '自分のをいれてね';
    const ACCESS_TOKEN = '自分のをいれてね';
    const ACCESS_TOKEN_SECRET = '自分のをいれてね';
    private $twitterObject;

    function __construct(){
        $this->twitterObject = new TwitterOAuth($this::API_KEY, $this::API_SECRET, $this::ACCESS_TOKEN, $this::ACCESS_TOKEN_SECRET);
    }

    public function getJsonTweets(){
        return $this->twitterObject->OAuthRequest('https://api.twitter.com/1.1/search/tweets.json','GET',
            array('lang' => 'ja',
                'q' => 'ラピュタ+OR+バルス')
        );
    }
    
    public function getTextTweets(){
        $text = "";
        $tweets = json_decode($this->getJsonTweets());
        $tweets = $tweets->statuses;
        foreach ($tweets as $val) {
            $text = $text . $val->text;
        }
        return $text;
    }
}