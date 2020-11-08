<?php


namespace tkouleris\WebWordCounter\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use tkouleris\WebWordCounter\WebCrawler\WebCrawler;
use tkouleris\WebWordCounter\WordCounter\WordCounter;
use ErrorException;

class WebWordCounterController extends Controller
{
    public function index(Request $request)
    {
        $stats = [];
        $errors = [];
        if(!empty($request->url))
        {
            if(!(strpos($request->url, "http://") === 0)
                && !(strpos($request->url, "https://") === 0)
            ){
                $request->merge([
                    'url' => "http://".$request->url
                ]);
            }

            $webCrawler = new WebCrawler();
            try{
                $text = $webCrawler->getText($request->url);
                $wordCounter = new WordCounter();
                $stats = $wordCounter->textWordCounter($text);
            }catch(ErrorException $e){
                $errors[] = $e->getMessage();
            }
        }
        return view('WebWordCounter::web_word_counter',compact(['stats','errors']));
    }
}
