<?php

namespace Winegram\WinegramAnalisisBundle\Application\Service\SentimentAnalysis;

use Winegram\WinegramAnalisisBundle\Application\Service\Curl\CurlRequest;
use Winegram\WinegramAnalisisBundle\Datumbox\Datumbox;

/**
 * Performs Sentiment Analysis on Twitter.
 *
 * @param string $text The text of the tweet that we evaluate.
 *
 * @return string|false It returns "positive", "negative" or "neutral" on success and false on fail.
 */
class DatumboxTwitterSentimentAnalysis implements SentimentAnalysis
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

        $jsonreply = $this->curl->execute('TwitterSentimentAnalysis', $parameters);

        return $jsonreply;
    }
}