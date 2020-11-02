<?php


use Symfony\Component\DomCrawler\Crawler;

Route::get('wordcounter',function (){
    $html = file_get_contents('http://tkouleris.eu/');
    $crawler = new Crawler($html);

    foreach ($crawler as $domElement) {
        var_dump($domElement->nodeName);
    }
    return 'word counter';
});
