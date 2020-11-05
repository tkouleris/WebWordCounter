<?php


namespace tkouleris\WebWordCounter\WordCounter;


class WordCounter
{

    /**
     * Given a text it returns the unique words that are found and
     * the number of times that occur in the text. The first element
     * of the array is the total words found in the given text.
     *
     * @param $text
     * @return array
     */
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
     * Gets a text and returns an array with all
     * the words of the given text
     *
     * @param string $text
     * @return array
     */
    private function textToArray(string $text):array
    {
        $textToArray = explode(" ",$text);

        $clean_up_array = [];
        foreach ($textToArray as $item)
        {
            $item = $this->removeTabsAndNewline($item);
            if($item === "" || $item === "-" || is_numeric($item))
            {
                continue;
            }
            $clean_up_array[] = $item;
        }
        return $clean_up_array;
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
