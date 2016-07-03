<?php

namespace WinegramAnalisisBundle\Domain\Entity;

use Ramsey\Uuid\Uuid;

/**
 * Tone
 */
class Tone
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var float
     */
    private $score;

    /**
     * @var string
     */
    private $tone_id;

    /**
     * @var string
     */
    private $tone_name;

    /**
     * @var string
     */
    private $tone_categorie_id;

    function __construct($score, $tone_id, $tone_name)
    {
        $uuid4 = Uuid::uuid4();
        $this->id = $uuid4->toString();
        $this->score = $score;
        $this->tone_id = $tone_id;
        $this->tone_name = $tone_name;
    }

    /**
     * @return string
     */
    public function getToneName()
    {
        return $this->tone_name;
    }

    /**
     * @param string $tone_name
     */
    public function setToneName($tone_name)
    {
        $this->tone_name = $tone_name;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param float $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }

    /**
     * @return string
     */
    public function getToneId()
    {
        return $this->tone_id;
    }

    /**
     * @param string $tone_id
     */
    public function setToneId($tone_id)
    {
        $this->tone_id = $tone_id;
    }

    /**
     * @return string
     */
    public function getToneCategorieId()
    {
        return $this->tone_categorie_id;
    }

    /**
     * @param string $tone_categorie_id
     */
    public function setToneCategorieId($tone_categorie_id)
    {
        $this->tone_categorie_id = $tone_categorie_id;
    }


}

