<?php


use tkouleris\WebWordCounter\WebCrawler\WebCrawler;
use tkouleris\WebWordCounter\WordCounter\WordCounter;

Route::get('wordcounter',function (){

    $webCrawler = new WebCrawler();
    $text = $webCrawler->getText('http://tkouleris.eu/');
    $wordCounter = new WordCounter();
    $stats = $wordCounter->textWordCounter($text);

    dd($stats);
    return 'word counter';
});
