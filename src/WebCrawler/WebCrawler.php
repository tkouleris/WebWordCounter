<?php


namespace tkouleris\WebWordCounter\WebCrawler;


use Symfony\Component\DomCrawler\Crawler;

class WebCrawler
{
    protected $crawler;

    /**
     * WebCrawler constructor.
     * @param $crawler
     */
    public function __construct()
    {
        $this->crawler = new Crawler();
    }


    public function getText(string $url):string
    {
        $html = file_get_contents($url);


        $this->crawler->add($html);
        $this->removeScriptTag();
        $text = "";
        foreach ($this->crawler as $domElement) {
            $text = $domElement->nodeValue;
        }
        return $text;
    }

    private function removeScriptTag(): void
    {
        $this->crawler->filter('script')->each(function (Crawler $crawler) {
            foreach ($crawler as $node) {
                $node->parentNode->removeChild($node);
            }
        });
    }
}
