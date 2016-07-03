<?php

namespace WinegramAnalisisBundle\Application\Service\GenderDetection;



use WinegramAnalisisBundle\Domain\Service\Curl\CurlRequest;
use WinegramAnalisisBundle\Domain\Service\GenderDetection\GenderDetection;

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