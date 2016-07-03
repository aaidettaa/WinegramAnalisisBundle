<?php

namespace WinegramAnalisisBundle\Domain\Service\Keywords;

interface KeywordExtraction
{
    /**
     * @param $text
     * @return array
     */
    public function get($text);
}