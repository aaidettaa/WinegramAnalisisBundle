<?php

namespace WinegramAnalisisBundle\Application\Service\SentimentAnalysis;


use WinegramAnalisisBundle\Application\Service\Curl\CurlRequest;

class ToneAnalyzerSentimentAnalysis implements SentimentAnalysis
{

    const URL_API = 'https://gateway.watsonplatform.net/tone-analyzer/api/v3/tone?version=2016-05-19';

    private $curl;

    public function __construct(CurlRequest $curl)
    {
        $this->curl = $curl;
    }

    public function analize($text)
    {

        $data = array(
            "text" => $text
        );

        $result = $this->curl->execute(self::URL_API, $data);

        $tone_categories = $result['document_tone']['tone_categories'];

        return $tone_categories;
    }
}