<?php

namespace Winegram\WinegramAnalisisBundle\Keywords;


use Symfony\Component\Filesystem\Filesystem;

class GetKeyWords
{

    /**
     * @param $text
     * @return array
     */
    public function get($text)
    {
        $filename = __DIR__."/stop_words.txt";
        $fs = new Filesystem();
        $stopwords = [];
        if($fs->exists($filename)){
            $stopwords = file($filename, FILE_SKIP_EMPTY_LINES);
        }
        return $this->filter($text, $stopwords);
    }

    private function filter($text, $stopwords)
    {
        // Remove line breaks and spaces from stopwords
        $stopwords = array_map(function ($x) {
            return trim(strtolower($x));
        }, $stopwords);
        // Replace all non-word chars with comma
        $pattern = '/[0-9\W]/';
        $text = preg_replace($pattern, ',', $text);
        // Create an array from $text
        $text_array = explode(",", $text);
        // remove whitespace and lowercase words in $text
        $text_array = array_map(function ($x) {
            return trim(strtolower($x));
        }, $text_array);
        $keywords = [];
        foreach ($text_array as $term) {
            if (!in_array($term, $stopwords)) {
                $keywords[] = $term;
            }
        };
        return array_filter($keywords);
    }
}