<?php


namespace tkouleris\WebWordCounter\WebCrawler;


use ErrorException;
use Symfony\Component\DomCrawler\Crawler;

class WebCrawler
{
    /**
     * @var Crawler
     */
    protected $crawler;

    /**
     * WebCrawler constructor.
     */
    public function __construct()
    {
        $this->crawler = new Crawler();
    }


    /**
     * Gets a url and returns the text of the page
     *
     * @param string $url
     * @return string
     */
    public function getText(string $url):string
    {
        try {
            $html = file_get_contents($url);
        }catch (\ErrorException $e){
            throw new ErrorException("The URL doesn't exist. Please insert existing URL.");
        }


        $this->crawler->add($html);
        $this->removeScriptTag();
        $text = "";
        foreach ($this->crawler as $domElement) {
            $text = $domElement->nodeValue;
        }

        return $text;
    }

    /**
     * Filters out from crawler object the script and style
     * blocks of code
     *
     * @return void
     */
    private function removeScriptTag(): void
    {
        $this->crawler->filter('script')->each(function (Crawler $crawler) {
            foreach ($crawler as $node) {
                $node->parentNode->removeChild($node);
            }
        });
        $this->crawler->filter('style')->each(function (Crawler $crawler) {
            foreach ($crawler as $node) {
                $node->parentNode->removeChild($node);
            }
        });
    }
}
