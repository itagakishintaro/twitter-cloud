<?php
class MeCabHandler{
    private $mecab;
    // 品詞ID:http://mecab.googlecode.com/svn/trunk/mecab/doc/posid.html
    private $VALID_POSID = array(2, 10, 31, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 59, 60, 61);
    private $INVALID_WORD = array("RT", ".co", "co", "bot", "http", "www", "する");

    function __construct(){
        $this->mecab = new MeCab_Tagger();
    }

    public function countWords($text){
        $wordsCount = array();
        $nodes = $this->mecab->parseToNode($text);
        foreach($nodes as $node) {
            if( $this->isValidWord($node) ){
                $wordsCount = $this->count($wordsCount, $node);
            }
        }
        return $wordsCount;
    }

    private function isValidWord($node){
        mb_regex_encoding("utf-8"); 
        return in_array($node->posid, $this->VALID_POSID)
            && !in_array($node->surface, $this->INVALID_WORD)
            && 1 < strlen($node->surface)
            && !mb_ereg_match("[ぁ-ん]", $node->surface, "utf-8");
    }

    private function count($wordsCount, $node){
        if(isset($wordsCount[$node->surface])) {
            $wordsCount[$node->surface]++;
        } else{
            $wordsCount[$node->surface] = 1;
        }
        return $wordsCount;
    }
}
