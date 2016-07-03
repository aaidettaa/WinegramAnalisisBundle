<?php

namespace WinegramAnalisisBundle\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\Uuid;

/**
 * ToneCategorie
 */
class ToneCategorie
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var ArrayCollection
     */
    private $tones;

    /**
     * @var string
     */
    private $category_id;

    /**
     * @var string
     */
    private $category_name;

    /**
     * @var string
     */
    private $comment_id;

    function __construct($category_id, $category_name)
    {
        $uuid4 = Uuid::uuid4();
        $this->id = $uuid4->toString();
        $this->category_name = $category_name;
        $this->category_id = $category_id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ArrayCollection
     */
    public function getTones()
    {
        return $this->tones;
    }

    /**
     * @param ArrayCollection $tones
     */
    public function setTones($tones)
    {
        $this->tones = $tones;
    }

    /**
     * @return string
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * @param string $category_id
     */
    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }

    /**
     * @return string
     */
    public function getCategoryName()
    {
        return $this->category_name;
    }

    /**
     * @param string $category_name
     */
    public function setCategoryName($category_name)
    {
        $this->category_name = $category_name;
    }

    /**
     * @return string
     */
    public function getCommentId()
    {
        return $this->comment_id;
    }

    /**
     * @param string $comment_id
     */
    public function setCommentId($comment_id)
    {
        $this->comment_id = $comment_id;
    }


}

