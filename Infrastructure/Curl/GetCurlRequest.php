<?php

namespace WinegramAnalisisBundle\Infrastructure\Curl;


use Psr\Log\LoggerInterface;
use WinegramAnalisisBundle\Domain\Service\Curl\CurlRequest;

class GetCurlRequest implements CurlRequest
{

    /**
     * @var LoggerInterface
     */
    private $logger;

    function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }


    public function execute($an_url, $data)
    {
        // Get cURL resource
        $curl = curl_init();
        // set get fields
        $data_str = http_build_query($data);
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $an_url . '?' . $data_str,
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPWD => "USERNAME:PASSWORD",
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json'
            )
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
        // further processing ....
        $decoded = json_decode($resp, true);
        return $decoded;
    }
}