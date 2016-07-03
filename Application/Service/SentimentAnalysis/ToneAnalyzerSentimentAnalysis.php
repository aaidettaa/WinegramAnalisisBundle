<?php

namespace WinegramAnalisisBundle\Application\Service\SentimentAnalysis;



use WinegramAnalisisBundle\Domain\Service\Curl\CurlRequest;
use WinegramAnalisisBundle\Domain\Service\SentimentAnalysis\SentimentAnalysis;

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

        if (isset($tone_categories['error'])) {
            return false;
        }

//        print_r($result);exit();

        $tone_categories = $result['document_tone']['tone_categories'];

//        print_r($tone_categories);exit();

        return $tone_categories;
    }
}