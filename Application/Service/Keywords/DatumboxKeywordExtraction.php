<?php

namespace WinegramAnalisisBundle\Application\Service\Keywords;
use WinegramAnalisisBundle\Domain\Service\Curl\CurlRequest;
use WinegramAnalisisBundle\Domain\Service\Keywords\KeywordExtraction;


/**
 * Performs Keyword Extraction. It extracts the keywords and keywords combinations from a text.
 *
 * @param string $text The clear text (no HTML tags) that we analyze.
 * @param integer $n It is a number from 1 to 5 which denotes the number of Keyword combinations that we want to get.
 *
 * @return array|false It returns an array with the keywords of the document on success and false on fail.
 */
class DatumboxKeywordExtraction implements KeywordExtraction
{
    protected $curl;

    public function __construct(CurlRequest $curl)
    {
        $this->curl = $curl;
    }

    public function get($text)
    {
        $parameters = array(
            'text' => $text,
            'n' => 3,
        );

        $jsonreply = $this->curl->execute('KeywordExtraction', $parameters);

        return $jsonreply;
    }
}