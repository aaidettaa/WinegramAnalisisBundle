<?php

namespace WinegramAnalisisBundle\Application\Service\SentimentAnalysis;
use WinegramAnalisisBundle\Domain\Service\Curl\CurlRequest;
use WinegramAnalisisBundle\Domain\Service\SentimentAnalysis\SentimentAnalysis;


/**
 * Performs Sentiment Analysis.
 *
 * @param string $text The clear text (no HTML tags) that we evaluate.
 *
 * @return string|false It returns "positive", "negative" or "neutral" on success and false on fail.
 */
class DatumboxSentimentAnalysis implements SentimentAnalysis
{
    private $curl;

    public function __construct(CurlRequest $curl)
    {
        $this->curl = $curl;
    }

    public function analize($text)
    {

        $parameters = array(
            'text' => $text,
        );

        $jsonreply = $this->curl->execute('SentimentAnalysis', $parameters);

        return $jsonreply;

    }
}