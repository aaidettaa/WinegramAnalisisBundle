<?php

namespace Winegram\WinegramAnalisisBundle\Domain\Entity;

use Ramsey\Uuid\Uuid;

/**
 * Tag
 */
class Tag
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $comment_id;


    function __construct($text)
    {
        $uuid4 = Uuid::uuid4();
        $this->id = $uuid4->toString();
        $this->text = $text;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Tag
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
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

