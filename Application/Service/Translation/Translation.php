<?php

namespace Winegram\WinegramAnalisisBundle\Application\Service\Translation;

interface Translation
{
    /**
     * Translates the text.
     *
     * @param string|array $text The text to be translated.
     * @param string $language Translation direction (for example, "en-ru" or "ru").
     * @param bool $html Text format, if true - html, otherwise plain.
     * @param int $options Translation options.
     *
     * @return array
     */
    public function translate($text, $language, $html = false, $options = 0);
}