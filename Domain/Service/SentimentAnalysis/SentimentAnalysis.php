<?php

namespace Winegram\WinegramAnalisisBundle\Domain\Service\SentimentAnalysis;


/**
 * Performs Sentiment Analysis.
 *
 * @param string $text The clear text (no HTML tags) that we evaluate.
 *
 * @return string|false It returns "positive", "negative" or "neutral" on success and false on fail.
 */
interface SentimentAnalysis
{
    public function analize($text);
}