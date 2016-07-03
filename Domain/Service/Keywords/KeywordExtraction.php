<?php

namespace Winegram\WinegramAnalisisBundle\Domain\Service\Keywords;

interface KeywordExtraction
{
    /**
     * @param $text
     * @return array
     */
    public function get($text);
}