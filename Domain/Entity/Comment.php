<?php

namespace Winegram\WinegramAnalisisBundle\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\Uuid;

/**
 * Comment
 */
class Comment
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $originalText;

    /**
     * @var string
     */
    private $retweet_count;

    /**
     * @var string
     */
    private $favorite_count;

    /**
     * @var string
     */
    private $lang;

    /**
     * @var ArrayCollection
     */
    private $keywords;

    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $location;

    /**
     * @var string
     */
    private $englishText;

    /**
     * @var string
     */
    private $publishDate;

    /**
     * @var string
     */
    private $textSentiment;

    /**
     * @var string
     */
    private $textTwittSentiment;

    /**
     * @var int
     */
    private $wine_id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $idRedis;

    /**
     * @var string
     */
    private $gender;

    /**
     * @var ArrayCollection
     */
    private $referencedWines;

    function __construct($originalText, $type, $retweet_count, $favorite_count, $username, $wineId, $idRedis)
    {
        $uuid4 = Uuid::uuid4();
        $this->id = $uuid4->toString();
        $this->originalText = $originalText;
        $this->retweet_count = $retweet_count;
        $this->favorite_count = $favorite_count;
        $this->user = $username;
        $this->wine_id = $wineId;
        $this->type = $type;
        $this->idRedis = $idRedis;
        $this->keywords = new ArrayCollection();
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
     * Set originalText
     *
     * @param string $originalText
     *
     * @return Comment
     */
    public function setOriginalText($originalText)
    {
        $this->originalText = $originalText;

        return $this;
    }


    /**
     * @return string
     */
    public function getRetweetCount()
    {
        return $this->retweet_count;
    }

    /**
     * @param string $retweet_count
     */
    public function setRetweetCount($retweet_count)
    {
        $this->retweet_count = $retweet_count;
    }

    /**
     * @return string
     */
    public function getFavoriteCount()
    {
        return $this->favorite_count;
    }

    /**
     * @param string $favorite_count
     */
    public function setFavoriteCount($favorite_count)
    {
        $this->favorite_count = $favorite_count;
    }


    /**
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * @param string $lang
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
    }

    /**
     * Get originalText
     *
     * @return string
     */
    public function getOriginalText()
    {
        return $this->originalText;
    }

    /**
     * @return ArrayCollection
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param ArrayCollection $keywords
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    /**
     * Add users
     *
     * @param KeyWord $a_keyword
     * @return Comment
     */
    public function addKeywords(KeyWord $a_keyword)
    {
        $this->keywords[] = $a_keyword;

        return $this;
    }

    /**
     * Remove users
     *
     * @param KeyWord $a_keyword
     */
    public function removeKeywords(KeyWord $a_keyword)
    {
        $this->keywords->removeElement($a_keyword);
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getEnglishText()
    {
        return $this->englishText;
    }

    /**
     * @param string $englishText
     */
    public function setEnglishText($englishText)
    {
        $this->englishText = $englishText;
    }

    /**
     * @return string
     */
    public function getPublishDate()
    {
        return $this->publishDate;
    }

    /**
     * @param string $publishDate
     */
    public function setPublishDate($publishDate)
    {
        $this->publishDate = $publishDate;
    }

    /**
     * @return int
     */
    public function getWineId()
    {
        return $this->wine_id;
    }

    /**
     * @param int $wine_id
     */
    public function setWineId($wine_id)
    {
        $this->wine_id = $wine_id;
    }


    /**
     * @return ArrayCollection
     */
    public function getReferencedWines()
    {
        return $this->referencedWines;
    }

    /**
     * @param ArrayCollection $referencedWines
     */
    public function setReferencedWines($referencedWines)
    {
        $this->referencedWines = $referencedWines;
    }

    /**
     * @return string
     */
    public function getTextSentiment()
    {
        return $this->textSentiment;
    }

    /**
     * @param string $textSentiment
     */
    public function setTextSentiment($textSentiment)
    {
        $this->textSentiment = $textSentiment;
    }

    /**
     * @return string
     */
    public function getTextTwittSentiment()
    {
        return $this->textTwittSentiment;
    }

    /**
     * @param string $textTwittSentiment
     */
    public function setTextTwittSentiment($textTwittSentiment)
    {
        $this->textTwittSentiment = $textTwittSentiment;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getIdRedis()
    {
        return $this->idRedis;
    }

    /**
     * @param string $idRedis
     */
    public function setIdRedis($idRedis)
    {
        $this->idRedis = $idRedis;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }


}

