<?php

namespace Winegram\WinegramAnalisisBundle\Application\Service\Curl;


class PostCurlRequest implements CurlRequest
{
    private $username;

    private $password;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
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
        return $decoded;
    }
}