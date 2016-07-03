<?php

namespace Winegram\WinegramAnalisisBundle\Infrastructure\Curl;


use Psr\Log\LoggerInterface;
use Winegram\WinegramAnalisisBundle\Domain\Service\Curl\CurlRequest;

class PostCurlRequest implements CurlRequest
{
    private $username;

    private $password;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct($username, $password, LoggerInterface $logger)
    {
        $this->username = $username;
        $this->password = $password;
        $this->logger = $logger;
    }

    public function execute($an_url, $data)
    {
        // Get cURL resource
        $curl = curl_init();
        // set post fields
        $data_str = json_encode($data);

        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_URL => $an_url,
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPWD => urlencode($this->username) . ":" . urlencode($this->password),
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data_str,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_str),
                'Accept: application/json'
            )
        ));

//print_r($data_str); exit();

        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);

        // further processing ....
        $decoded = json_decode($resp, true);
        return $this->parse($decoded);
    }

    /**
     * Parses the API Reply
     *
     * @param mixed $jsonreply
     *
     * @return mixed
     */
    private function parse($result)
    {
        if (isset($result['error'])) {
            $this->logger->error($result['error']);
            return false;
        }

        return $result;
    }
}