<?php

namespace Winegram\WinegramAnalisisBundle\Infrastructure\Curl;


use Exception;
use Psr\Log\LoggerInterface;
use Winegram\WinegramAnalisisBundle\Domain\Service\Curl\CurlRequest;

class YandexCurlRequest implements CurlRequest
{

    const BASE_URL = 'https://translate.yandex.net/api/v1.5/tr.json/';
    const MESSAGE_UNKNOWN_ERROR = 'Unknown error';
    const MESSAGE_JSON_ERROR = 'JSON parse error';
    const MESSAGE_INVALID_RESPONSE = 'Invalid response from service';

    private $api_key;

    /**
     * @var resource
     */
    protected $handler;

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
        $data['key'] = $this->api_key;

        $this->handler = curl_init();
        curl_setopt($this->handler, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->handler, CURLOPT_URL, static::BASE_URL . $an_url);
        curl_setopt($this->handler, CURLOPT_POST, true);
        curl_setopt($this->handler, CURLOPT_POSTFIELDS, http_build_query($data));

        $remoteResult = curl_exec($this->handler);

        if ($remoteResult === false) {
            throw new Exception(curl_error($this->handler), curl_errno($this->handler));
        }
        $result = json_decode($remoteResult, true);

        return $this->parse($result);
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
        if (!$result) {
            $errorMessage = self::MESSAGE_UNKNOWN_ERROR;
            if (version_compare(PHP_VERSION, '5.3', '>=')) {
                if (json_last_error() !== JSON_ERROR_NONE) {
                    if (version_compare(PHP_VERSION, '5.5', '>=')) {
                        $errorMessage = json_last_error_msg();
                    } else {
                        $errorMessage = self::MESSAGE_JSON_ERROR;
                    }
                }
            }
            $this->logger->error(sprintf('%s: %s', self::MESSAGE_INVALID_RESPONSE, $errorMessage));
            return false;
//            throw new Exception(sprintf('%s: %s', self::MESSAGE_INVALID_RESPONSE, $errorMessage));
        } elseif (isset($result['code']) && $result['code'] > 200) {
            $this->logger->error($result['message']);
//            throw new Exception($result['message'], $result['code']);
            return false;
        }

        return $result;
    }
}