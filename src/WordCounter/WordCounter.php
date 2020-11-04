<?php


namespace tkouleris\WebWordCounter\WordCounter;


class WordCounter
{
    public function textToArray(string $text):array
    {
        $textToArray = explode(" ",$text);

        $clean_up_array = [];
        foreach ($textToArray as $item)
        {
            $item = trim(preg_replace('/\s\s+/', ' ', $item));
            $item = preg_replace('/[^A-Za-z0-9\-]/', '', $item);
            if($item === "" || $item === "-" || is_numeric($item))
            {
                continue;
            }

            $clean_up_array[] = $item;

        }
        return $clean_up_array;
    }

    public function arrayWordCounter( array $words):array
    {
        $stats = [];
        foreach ($words as $word)
        {
            if(isset($stats[$word])){
                $stats[$word]++;
            }else{
                $stats[$word] = 1;
            }

        }
        arsort($stats);

        return $stats;
    }
}
