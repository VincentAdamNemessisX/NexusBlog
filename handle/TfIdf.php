<?php

use NlpTools\Similarity\CosineSimilarity;

require_once('vendor/autoload.php');

class TFIDF {
    private $documents;
    private $idf;

    public function __construct($documents) {
        $this->documents = $documents;
        $this->idf = $this->idf();
    }

    private function tf($document) {
        $tokens = explode(" ", $document);
        $tf = array_count_values($tokens);
        $n = count($tokens);
        foreach ($tf as &$value) {
            $value /= $n;
        }
        return $tf;
    }

    private function idf() {
        $tokens = array();
        foreach ($this->documents as $document) {
            $tokens = array_merge($tokens, array_unique(explode(" ", $document)));
        }
        $idf = array();
        $n = count($this->documents);
        foreach ($tokens as $token) {
            $count = 0;
            foreach ($this->documents as $document) {
                if (strpos($document, $token) !== false) {
                    $count++;
                }
            }
            $idf[$token] = log($n / ($count + 1)) + 1;
        }
        return $idf;
    }

    public function tfidf($document) {
        $tf = $this->tf($document);
        $tfidf = array();
        foreach ($tf as $token => $value) {
            if (isset($this->idf[$token])) {
                $tfidf[$token] = $value * $this->idf[$token];
            }
        }
        arsort($tfidf);
        return $tfidf;
    }

    public function similarity($doc1, $doc2) {
        $tfidf1 = $this->tfidf($doc1);
        $tfidf2 = $this->tfidf($doc2);
        $tokens = array_unique(array_merge(array_keys($tfidf1), array_keys($tfidf2)));
        $v1 = array();
        $v2 = array();
        foreach ($tokens as $token) {
            $v1[] = isset($tfidf1[$token]) ? $tfidf1[$token] : 0;
            $v2[] = isset($tfidf2[$token]) ? $tfidf2[$token] : 0;
        }
        $similarity = (new NlpTools\Similarity\CosineSimilarity)->similarity($v1, $v2);
        return $similarity;
    }

    public function apply($tokens) {
        $tfidf = $this->tfidf(implode(" ", $tokens));
        return array_keys($tfidf);
    }
}

