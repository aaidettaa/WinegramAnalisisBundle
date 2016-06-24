<?php

namespace Winegram\WinegramAnalisisBundle\Application\Service\GenderDetection;


/**
 * Performs Gender Detection.
 *
 * @param string $text The clear text (no HTML tags) that we evaluate.
 *
 * @return string|false It returns "male" or "female" on success and false on fail.
 */
interface GenderDetection
{
    public function detect($text);
}