<?php

namespace WinegramAnalisisBundle\Domain\Service\Curl;

interface CurlRequest
{
    public function execute($an_url, $data);
}