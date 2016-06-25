<?php

namespace Winegram\WinegramAnalisisBundle\Application\Service\LoadData;

use Doctrine\ORM\EntityManager;
use Winegram\WinegramAnalisisBundle\Application\Service\GenderDetection\GenderDetection;
use Winegram\WinegramAnalisisBundle\Application\Service\Keywords\KeywordExtraction;
use Winegram\WinegramAnalisisBundle\Application\Service\LanguageDetection\LanguageDetection;
use Winegram\WinegramAnalisisBundle\Application\Service\SentimentAnalysis\SentimentAnalysis;
use Winegram\WinegramAnalisisBundle\Application\Service\Translation\Translation;
use Winegram\WinegramAnalisisBundle\Domain\Entity\Comment;
use Winegram\WinegramAnalisisBundle\Domain\Entity\KeyWord;
use Winegram\WinegramAnalisisBundle\Domain\Entity\Tone;
use Winegram\WinegramAnalisisBundle\Domain\Entity\ToneCategorie;


class WinegramLoadData implements LoadData
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var KeywordExtraction
     */
    private $util;

    /**
     * @var SentimentAnalysis
     */
    private $proAnalyzer;

    /**
     * @var SentimentAnalysis
     */
    private $lowAnalyzer;

    /**
     * @var SentimentAnalysis
     */
    private $twittAnalyzer;

    /**
     * @var LanguageDetection
     */
    private $langAnalyzer;

    /**
     * @var Translation
     */
    private $translator;

    /**
     * @var GenderDetection
     */
    private $genderAnalyzer;


    function __construct(
        EntityManager $an_EntityManager,
        GenderDetection $genderAnalyzer,
        KeywordExtraction $util,
        LanguageDetection $langAnalyzer,
        SentimentAnalysis $proAnalyzer,
        SentimentAnalysis $lowAnalyzer,
        SentimentAnalysis $twittAnalyzer,
        Translation $translator)
    {
        $this->em = $an_EntityManager;
        $this->genderAnalyzer = $genderAnalyzer;
        $this->util = $util;
        $this->langAnalyzer = $langAnalyzer;
        $this->proAnalyzer = $proAnalyzer;
        $this->lowAnalyzer = $lowAnalyzer;
        $this->twittAnalyzer = $twittAnalyzer;
        $this->translator = $translator;
    }


    public function load($media)
    {

        $the_comment = new Comment($media['text'],
            $media['type'],
            $media['likes_count'],
            $media['username'],
            $media['id']);

        $this->em->persist($the_comment);
        $this->em->flush();

        $lang = $this->langAnalyzer->detect($the_comment->getOriginalText());
        $the_comment->setLang($lang);

        if($lang == "") $lang = "es";

        $this->em->persist($the_comment);
        $this->em->flush();

        $enText = $this->translator->translate($the_comment->getOriginalText(), $lang . "-en");
        $the_comment->setEnglishText($enText);

        $this->em->persist($the_comment);
        $this->em->flush();

        $all_vars = $this->util->get($the_comment->getOriginalText());

        foreach ($all_vars as $var) {
            $the_KeyWord = new KeyWord($var);
            $the_KeyWord->setCommentId($the_comment->getId());
            $this->em->persist($the_KeyWord);
        }

        $this->em->persist($the_comment);
        $this->em->flush();

        $sentiment = $this->lowAnalyzer->analize($the_comment->getEnglishText());
        $the_comment->setTextSentiment($sentiment);

        $this->em->persist($the_comment);
        $this->em->flush();

        $twittSentiment = $this->twittAnalyzer->analize($the_comment->getEnglishText());
        $the_comment->setTextTwittSentiment($twittSentiment);

        $this->em->persist($the_comment);
        $this->em->flush();

        $gender = $this->genderAnalyzer->detect($the_comment->getEnglishText());
        $the_comment->setGender($gender);

        $this->em->persist($the_comment);
        $this->em->flush();

        $tone_categories = $this->proAnalyzer->analize($the_comment->getEnglishText());
        foreach ($tone_categories as $var) {
            $tone_categorie = new ToneCategorie(
                $var['category_id'],
                $var['category_name']
            );
            $tone_categorie->setCommentId($the_comment->getId());
            $tones = $var['tones'];
            foreach ($tones as $tone) {
                $tone_data = new Tone(
                    $tone['score'],
                    $tone['tone_id'],
                    $tone['tone_name']
                );
                $tone_data->setToneCategorieId($tone_categorie->getId());
                $this->em->persist($tone_data);
            }
            $this->em->persist($tone_categorie);
        }

        $this->em->persist($the_comment);
        $this->em->flush();

        return $the_comment->getId();
    }


}