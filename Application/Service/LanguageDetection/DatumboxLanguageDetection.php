<?php

namespace Winegram\WinegramAnalisisBundle\Application\Service\LanguageDetection;

use Winegram\WinegramAnalisisBundle\Application\Service\Curl\CurlRequest;

/**
 * Performs Language Detection.
 *
 * @param string $text The clear text (no HTML tags) that we evaluate.
 *
 * @return string|false It returns the ISO639-1 two-letter language code (http://en.wikipedia.org/wiki/List_of_ISO_639-1_codes) on success and false on fail.
 */
class DatumboxLanguageDetection implements LanguageDetection
{
    protected $curl;

    public function __construct(CurlRequest $curl)
    {
        $this->curl = $curl;
    }

    public function detect($text)
    {
        $parameters = array(
            'text' => $text,
        );

        $jsonreply = $this->curl->execute('LanguageDetection', $parameters);

        return $jsonreply;
    }
}