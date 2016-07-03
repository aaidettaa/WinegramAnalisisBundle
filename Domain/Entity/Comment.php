<?php

namespace WinegramAnalisisBundle\Domain\Entity;

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
    private $likes_count;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $idRedis;

//    /**
//     * @var ArrayCollection
//     */
//    private $keywords;
//
//    /**
//     * @var ArrayCollection
//     */
//    private $tags;

    /**
     * @var string
     */
    private $media;

    /**
     * @var string
     */
    private $search_id;

    /**
     * @var string
     */
    private $search_content;

    /**
     * @var string
     */
    private $query;

    /**
     * @var string
     */
    private $lang;

    /**
     * @var string
     */
    private $englishText;

    /**
     * @var string
     */
    private $textSentiment;

    /**
     * @var string
     */
    private $textTwittSentiment;

    /**
     * @var string
     */
    private $gender;


    function __construct(
        $originalText,
        $type,
        $likes_count,
        $username,
        $idRedis,
        $media,
        $search_id,
        $search_content,
        $query)
    {
        $uuid4 = Uuid::uuid4();
        $this->id = $uuid4->toString();
        $this->originalText = $originalText;
        $this->likes_count = $likes_count;
        $this->username = $username;
        $this->type = $type;
        $this->idRedis = $idRedis;
//        $this->keywords = new ArrayCollection();
//        $this->tags = new ArrayCollection();
        $this->media = $media;
        $this->search_id = $search_id;
        $this->search_content = $search_content;
        $this->query = $query;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getOriginalText()
    {
        return $this->originalText;
    }

    /**
     * @param string $originalText
     */
    public function setOriginalText($originalText)
    {
        $this->originalText = $originalText;
    }

    /**
     * @return string
     */
    public function getLikesCount()
    {
        return $this->likes_count;
    }

    /**
     * @param string $likes_count
     */
    public function setLikesCount($likes_count)
    {
        $this->likes_count = $likes_count;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
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

//    /**
//     * @return ArrayCollection
//     */
//    public function getKeywords()
//    {
//        return $this->keywords;
//    }
//
//    /**
//     * @param ArrayCollection $keywords
//     */
//    public function setKeywords($keywords)
//    {
//        $this->keywords = $keywords;
//    }
//
//    /**
//     * Add keywords
//     *
//     * @param KeyWord $a_keyword
//     * @return Comment
//     */
//    public function addKeywords(KeyWord $a_keyword)
//    {
//        $this->keywords[] = $a_keyword;
//
//        return $this;
//    }
//
//    /**
//     * Remove keywords
//     *
//     * @param KeyWord $a_keyword
//     */
//    public function removeKeywords(KeyWord $a_keyword)
//    {
//        $this->keywords->removeElement($a_keyword);
//    }
//
//    /**
//     * @return ArrayCollection
//     */
//    public function getTags()
//    {
//        return $this->tags;
//    }
//
//    /**
//     * @param ArrayCollection $tags
//     */
//    public function setTags($tags)
//    {
//        $this->tags = $tags;
//    }
//
//    /**
//     * Add tags
//     *
//     * @param Tag $a_tag
//     * @return Comment
//     */
//    public function addTags(Tag $a_tag)
//    {
//        $this->tags[] = $a_tag;
//
//        return $this;
//    }
//
//    /**
//     * Remove tags
//     *
//     * @param Tag $a_tag
//     */
//    public function removeTags(Tag $a_tag)
//    {
//        $this->tags->removeElement($a_tag);
//    }

    /**
     * @return string
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @param string $media
     */
    public function setMedia($media)
    {
        $this->media = $media;
    }

    /**
     * @return string
     */
    public function getSearchId()
    {
        return $this->search_id;
    }

    /**
     * @param string $search_id
     */
    public function setSearchId($search_id)
    {
        $this->search_id = $search_id;
    }

    /**
     * @return string
     */
    public function getSearchContent()
    {
        return $this->search_content;
    }

    /**
     * @param string $search_content
     */
    public function setSearchContent($search_content)
    {
        $this->search_content = $search_content;
    }

    /**
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param string $query
     */
    public function setQuery($query)
    {
        $this->query = $query;
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

