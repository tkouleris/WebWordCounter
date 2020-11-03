<?php


use Symfony\Component\DomCrawler\Crawler;

Route::get('wordcounter',function (){
    $html = file_get_contents('http://tkouleris.eu/');

    $crawler = new Crawler($html);
    $crawler->filter('script')->each(function (Crawler $crawler) {
        foreach ($crawler as $node) {
            $node->parentNode->removeChild($node);
        }
    });
    $text = "";
    foreach ($crawler as $domElement) {
        $text = $domElement->nodeValue;
    }

    $new_array = explode(" ",$text);

    $clean_up_array = [];
    foreach ($new_array as $item)
    {
        $item = trim(preg_replace('/\s\s+/', ' ', $item));
        $item = preg_replace('/[^A-Za-z0-9\-]/', '', $item);
        if($item === "") continue;
        if($item === "-") continue;

        $clean_up_array[] = $item;

    }
    $stats = [];
    foreach ($clean_up_array as $word)
    {
        if(isset($stats[$word])){
            $stats[$word]++;
        }else{
            $stats[$word] = 1;
        }

    }
    arsort($stats);
    dd($stats);
    return 'word counter';
});
