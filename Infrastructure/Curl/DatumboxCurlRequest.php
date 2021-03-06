<?php


namespace WinegramAnalisisBundle\Infrastructure\Curl;


use Psr\Log\LoggerInterface;
use WinegramAnalisisBundle\Domain\Service\Curl\CurlRequest;

final class DatumboxCurlRequest implements CurlRequest
{

    CONST version = '1.0';

    private $api_key;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct($api_key, LoggerInterface $logger)
    {
        $this->api_key = $api_key;
        $this->logger = $logger;
    }

    public function execute($an_url, $data)
    {
        $data['api_key'] = $this->api_key;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://api.datumbox.com/' . self::version . '/' . $an_url . '.json');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $jsonreply = curl_exec($ch);
        curl_close($ch);
        unset($ch);
        return $this->parse($jsonreply);
    }

    /**
     * Parses the API Reply
     *
     * @param mixed $jsonreply
     *
     * @return mixed
     */
    private function parse($jsonreply)
    {
        $jsonreply = json_decode($jsonreply, true);

        if (isset($jsonreply['output']['status']) && $jsonreply['output']['status'] == 1) {
            return $jsonreply['output']['result'];
        }

        if (isset($jsonreply['error']['ErrorCode']) && isset($jsonreply['error']['ErrorMessage'])) {
            $this->logger->error($jsonreply['error']['ErrorMessage'] . ' (ErrorCode: ' . $jsonreply['error']['ErrorCode'] . ')');
//            echo $jsonreply['error']['ErrorMessage'] . ' (ErrorCode: ' . $jsonreply['error']['ErrorCode'] . ')';
        }

        return false;
    }
}