<?php

namespace Winegram\WinegramAnalisisBundle\Application\Service\GenderDetection;


use Winegram\WinegramAnalisisBundle\Application\Service\Curl\CurlRequest;

class DatumboxGenderDetection implements GenderDetection
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

        $jsonreply = $this->curl->execute('GenderDetection', $parameters);

        return $jsonreply;
    }
}