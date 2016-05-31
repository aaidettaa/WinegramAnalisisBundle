<?php

namespace Winegram\WinegramAnalisisBundle\LoadData;


use Doctrine\ORM\EntityManager;
use Winegram\WinegramAnalisisBundle\Keywords\GetKeyWords;
use Winegram\WinegramUtilitiesBundle\Curl\DoPostCurlRequest;
use Winegram\WinegramUtilitiesBundle\Entity\Comment;
use Winegram\WinegramUtilitiesBundle\Entity\KeyWord;
use Winegram\WinegramUtilitiesBundle\Entity\Tone;
use Winegram\WinegramUtilitiesBundle\Entity\ToneCategorie;
use Winegram\WinegramUtilitiesBundle\Entity\Wine;

class LoadData
{
    /**
     * @var EntityManager
     */
    private $em;

    public function load(EntityManager $an_EntityManager, $all_twitts)
    {
        $this->em = $an_EntityManager;

        $the_wine = new Wine('pruno');

        $util = new GetKeyWords();

        foreach ($all_twitts as $twitt) {
            $the_comment = new Comment($twitt['id_str'],
                $twitt['text'],
                $twitt['geo'],
                $twitt['retweet_count'],
                $twitt['favorite_count'],
                $twitt['favorited'],
                $twitt['retweeted'],
                $twitt['lang']);
            $the_comment->setWineId($the_wine->getId());
            $all_vars = $util->get($twitt['text']);
            foreach ($all_vars as $var) {
                $the_KeyWord = new KeyWord($var);
                $the_KeyWord->setCommentId($the_comment->getId());
                $an_EntityManager->persist($the_KeyWord);
            }
            $this->analize($the_comment);
            $an_EntityManager->persist($the_comment);
        }
        $an_EntityManager->flush();
        print_r('hola');
    }

    private function analize(Comment $the_comment)
    {

        $text = $the_comment->getOriginalText();
        $postRequest = new DoPostCurlRequest();
        $data = array(
            "text" => $text
        );
        $url = '---';
        $username = '--';
        $password = '---';
        $result = $postRequest->__invoke($url, $data, $username, $password);

        $tone_categories = $result['document_tone']['tone_categories'];

        foreach ($tone_categories as $var) {
            $tone_categorie = new ToneCategorie(
                $var['category_id'],
                $var['category_name']
            );
            $tone_categorie->setCommentId($the_comment->getId());
            $tones = $var['tones'];
            foreach ($tones as $tone){
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
    }
}