<?php

namespace WinegramAnalisisBundle\Domain\Service\LanguageDetection;


/**
 * Performs Language Detection.
 *
 * @param string $text The clear text (no HTML tags) that we evaluate.
 *
 * @return string|false It returns the ISO639-1 two-letter language code (http://en.wikipedia.org/wiki/List_of_ISO_639-1_codes) on success and false on fail.
 */
interface LanguageDetection
{
    public function detect($text);
}