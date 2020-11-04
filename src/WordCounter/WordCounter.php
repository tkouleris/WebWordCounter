<?php


namespace tkouleris\WebWordCounter\WordCounter;


class WordCounter
{
    private function textToArray(string $text):array
    {
        $textToArray = explode(" ",$text);

        $clean_up_array = [];
        foreach ($textToArray as $item)
        {
            $item = $this->removeTabsAndNewline($item);
//            $item = preg_replace('/[^A-Za-z0-9\-]/', '', $item);
            if($item === "" || $item === "-" || is_numeric($item))
            {
                continue;
            }

            $clean_up_array[] = $item;

        }
        return $clean_up_array;
    }

    public function textWordCounter($text):array
    {
        $words = $this->textToArray($text);
        $stats = [];
        foreach ($words as $word)
        {
            if(isset($stats[$word])){
                $stats[$word]++;
            }else{
                $stats[$word] = 1;
            }

        }
        $stats['total_words'] = count($words);
        arsort($stats);

        return $stats;
    }

    /**
     * @param string $item
     * @return string
     */
    private function removeTabsAndNewline(string $item): string
    {
        return trim(preg_replace('/\s\s+/', ' ', $item));
    }
}
