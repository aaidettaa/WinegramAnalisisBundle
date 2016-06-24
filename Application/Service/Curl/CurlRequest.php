<?php

namespace Winegram\WinegramAnalisisBundle\Application\Service\Curl;

interface CurlRequest
{
    public function execute($an_url, $data);
}