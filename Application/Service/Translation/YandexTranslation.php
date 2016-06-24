<?php

namespace Winegram\WinegramAnalisisBundle\Application\Service\Translation;


use Winegram\WinegramAnalisisBundle\Application\Service\Curl\CurlRequest;

class YandexTranslation implements Translation
{

    protected $curl;

    public function __construct(CurlRequest $curl)
    {
        $this->curl = $curl;
    }


    public function translate($text, $language, $html = false, $options = 0)
    {
        $parameters = array(
            'text' => $text,
            'lang' => $language,
            'format' => $html ? 'html' : 'plain',
            'options' => $options
        );

        $data = $this->curl->execute('translate', $parameters);
        return $data['text'][0];
    }

}