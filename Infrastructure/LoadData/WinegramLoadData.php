<?php

namespace WinegramAnalisisBundle\Infrastructure\LoadData;

use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;
use WinegramAnalisisBundle\Domain\Entity\Comment;
use WinegramAnalisisBundle\Domain\Entity\KeyWord;
use WinegramAnalisisBundle\Domain\Entity\Tag;
use WinegramAnalisisBundle\Domain\Entity\Tone;
use WinegramAnalisisBundle\Domain\Entity\ToneCategorie;
use WinegramAnalisisBundle\Domain\Service\GenderDetection\GenderDetection;
use WinegramAnalisisBundle\Domain\Service\Keywords\KeywordExtraction;
use WinegramAnalisisBundle\Domain\Service\LanguageDetection\LanguageDetection;
use WinegramAnalisisBundle\Domain\Service\LoadData\LoadData;
use WinegramAnalisisBundle\Domain\Service\SentimentAnalysis\SentimentAnalysis;
use WinegramAnalisisBundle\Domain\Service\Translation\Translation;


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

    /**
     * @var LoggerInterface
     */
    private $logger;


    function __construct(
        EntityManager $an_EntityManager,
        GenderDetection $genderAnalyzer,
        KeywordExtraction $util,
        LanguageDetection $langAnalyzer,
        SentimentAnalysis $proAnalyzer,
        SentimentAnalysis $lowAnalyzer,
        SentimentAnalysis $twittAnalyzer,
        Translation $translator,
        LoggerInterface $logger)
    {
        $this->em = $an_EntityManager;
        $this->genderAnalyzer = $genderAnalyzer;
        $this->util = $util;
        $this->langAnalyzer = $langAnalyzer;
        $this->proAnalyzer = $proAnalyzer;
        $this->lowAnalyzer = $lowAnalyzer;
        $this->twittAnalyzer = $twittAnalyzer;
        $this->translator = $translator;
        $this->logger = $logger;
    }


    public function load($media)
    {

        $the_comment = new Comment(
            $media['text'],
            $media['type'],
            $media['likes_count'],
            $media['username'],
            $media['id'],
            $media['media'],
            $media['search_id'],
            $media['search_content'],
            $media['query']);

        $all_tags = $media['tags'];
        foreach ($all_tags as $tag) {
            $the_tag = new Tag($tag);
            $the_tag->setCommentId($the_comment->getId());
            $this->em->persist($the_tag);
        }

        $this->em->persist($the_comment);
        $this->em->flush();

        $lang = $this->langAnalyzer->detect($the_comment->getOriginalText());

        if ($lang != false) {
            $the_comment->setLang($lang);

            $this->em->persist($the_comment);
            $this->em->flush();
        }else{
            $this->logger->error('Language Detect no procesado: '.$the_comment->getId());
        }

        if ($lang == "") $lang = "es";

        $enText = $this->translator->translate($the_comment->getOriginalText(), $lang . "-en");

        if ($enText != false) {
            $the_comment->setEnglishText($enText);

            $this->em->persist($the_comment);
            $this->em->flush();
        }else{
            $the_comment->setEnglishText($the_comment->getOriginalText());
            $this->logger->error('Translate no procesado: '.$the_comment->getId());
        }


        $all_keys = $this->util->get($the_comment->getOriginalText());

        foreach ($all_keys as $key) {
            $the_KeyWord = new KeyWord($key);
            $the_KeyWord->setCommentId($the_comment->getId());
            $this->em->persist($the_KeyWord);
        }

        $this->em->persist($the_comment);
        $this->em->flush();

        $sentiment = $this->lowAnalyzer->analize($the_comment->getEnglishText());

        if ($sentiment != false) {
            $the_comment->setTextSentiment($sentiment);

            $this->em->persist($the_comment);
            $this->em->flush();
        }else{
            $this->logger->error('Sentiment no procesado: '.$the_comment->getId());
        }

        $twittSentiment = $this->twittAnalyzer->analize($the_comment->getEnglishText());

        if ($twittSentiment != false) {
            $the_comment->setTextTwittSentiment($twittSentiment);

            $this->em->persist($the_comment);
            $this->em->flush();
        }else{
            $this->logger->error('Twitter Sentiment no procesado: '.$the_comment->getId());
        }


        $gender = $this->genderAnalyzer->detect($the_comment->getEnglishText());

        if ($gender != false) {
            $the_comment->setGender($gender);

            $this->em->persist($the_comment);
            $this->em->flush();
        }else{
            $this->logger->error('Gender no procesado: '.$the_comment->getId());
        }


        $tone_categories = $this->proAnalyzer->analize($the_comment->getEnglishText());

        if ($tone_categories != false) {
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
        }else{
            $this->logger->error('Sentiment Tone Analyzer no procesado: '.$the_comment->getId());
        }


//        print_r('final');
//        exit();


        return $the_comment->getId();
    }


}