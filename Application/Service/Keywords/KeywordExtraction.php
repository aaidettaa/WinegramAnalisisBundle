<?php

namespace WinegramAnalisisBundle\Application\Service\Keywords;

interface KeywordExtraction
{
    /**
     * @param $text
     * @return array
     */
    public function get($text);
}