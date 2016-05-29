<?php

namespace Winegram\WinegramAnalisisBundle\LoadData;


class LoadData {

    public function load(){
        $all_twitts = array(
            0 => array(
                "created_at" => "Sat Apr 16 22:35:39 +0000 2016",
                "id" => 7.2146711584104E+17,
                "id_str" => "721467115841040384",
                "text" => "Así me reciben en casa. #pruno #pruno2013 #riberaDelDuero #Cartu #alfonsoCartu #home #homesweetHome #tempranillo https://t.co/qw6tWKTZTP",
                "truncated" => false,
                "source" => "<a href='http://twitter.com/download/iphone' rel='nofollow''>Twitter for iPhone</a>",
                "in_reply_to_status_id" => null,
                "in_reply_to_status_id_str" => null,
                "in_reply_to_user_id" => null,
                "in_reply_to_user_id_str" => null,
                "in_reply_to_screen_name" => null,
                "geo" => null,
                "coordinates" => null,
                "place" => null,
                "contributors" => null,
                "is_quote_status" => false,
                "retweet_count" => 0,
                "favorite_count" => 0,
                "favorited" => false,
                "retweeted" => false,
                "possibly_sensitive" => false,
                "lang" => "es"
            )
        );

        foreach ($all_twitts as $twitt) {
            print_r($twitt);
        }

    }
}