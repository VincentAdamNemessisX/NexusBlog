<?php
// 加载数据
use NlpTools\Tokenizers\WhitespaceTokenizer;
require_once "TfIdf.php";
require_once "../database/databaseHandle.php";
function recommendBlogs($blogid, $length) {
    $blogrst = queryData('blog', '*', 'blogid=$blogid');
    while ($blog = $blogrst) {
        $data[] = $blog;
    }

    $data = queryData('blog', '*');

// 提取关键词和元数据
    $corpus = array();
    foreach ($data as $row) {
        $row = str_getcsv($row);
        $corpus[] = $row[1];
    }
    $vectorizer = new WhitespaceTokenizer();
    $tfidf = new TFIDF($corpus);
    $corpus = array_map(function ($text) use ($vectorizer, $tfidf) {
        $tokens = $vectorizer->tokenize($text);
        return $tfidf->apply($tokens);
    }, $corpus);

// 计算相似度矩阵
    $similarity_matrix = array();
    foreach ($corpus as $i => $doc_i) {
        $row = array();
        foreach ($corpus as $j => $doc_j) {
            $similarity = $tfidf->similarity($doc_i, $doc_j);
            $row[] = $similarity;
        }
        $similarity_matrix[] = $row;
    }

// 用户浏览记录
    $user_history = array(3, 5, 7, 10);

// 计算用户与每篇文章的相似度
    $user_similarity = array();
    foreach ($corpus as $i => $doc_i) {
        $similarity = 0;
        foreach ($user_history as $j) {
            $doc_j = $corpus[$j];
            $similarity += $tfidf->similarity($doc_i, $doc_j);
        }
        $user_similarity[] = $similarity / count($user_history);
    }

// 推荐与用户兴趣相关的文章
    $recommendations = array_keys($user_similarity, max($user_similarity));
    $recommendations = array_slice($recommendations, 0, $length);
    return $recommendations;
}