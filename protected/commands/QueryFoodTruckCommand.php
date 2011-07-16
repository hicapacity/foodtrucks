<?php

/**
 * hicapacity.org, islands, ryankanno implementation of https://github.com/abraham/twitteroauth
 * 2011-05-21 (rapture day!)
 */
Yii::import('application.vendors.*');
require_once('twitteroauth/twitteroauth/twitteroauth.php');

class QueryFoodTruckCommand extends CConsoleCommand
{

    private $connection;
    
    public function __construct($name, $runner) {
        return parent::__construct($name, $runner);
    }
    
    public function run($args) {

        $this->connection = new TwitterOAuth(
            Yii::app()->params['trucks']['twitter']['consumerKey'],
            Yii::app()->params['trucks']['twitter']['consumerSecret'],
            Yii::app()->params['trucks']['twitter']['oauthAccessToken'],
            Yii::app()->params['trucks']['twitter']['oauthAccessTokenSecret']);

        $mentions = $this->connection->get('statuses/mentions');

        $num_mentions = count($mentions);

        for ($i = $num_mentions - 1; $i >= 0; $i--)
        {
            $mention = $mentions[$i];

            $truck = Trucks::model()->findByAttributes(
                array('twitter_id' => $mention->user->id_str)
            );

            if (NULL === $truck)
            {

                $message = 'SKIPPED: Tweet (id=' . $mention->id_str . ') is from an unauthorized Tweeter (@' . $mention->user->screen_name .").\n";
                Yii::log($message, 'info', get_called_class());
                echo $message;
                continue;
            }
            elseif (TwitterHelper::isGeoLocatable($mention)) 
            {
                if (TwitterHelper::isValidFormat($mention))
                {
                    Yii::log("Tweet is valid. Checking for db insertion", 'info', get_called_class());

                    $truck_tweet = TrucksTweets::model()->findByAttributes(
                        array('tweet_id' => $mention->id_str));

                    if (NULL === $truck_tweet)
                    {

                        $parsed_tweet = TwitterHelper::parseTruckTweet($mention->text);

                        $truck_tweet = new TrucksTweets;
                        $truck_tweet->truck_id   = $truck->id;
                        $truck_tweet->tweet      = $mention->text;
                        $truck_tweet->tweet_id   = $mention->id_str;
                        $truck_tweet->menu_url   = $parsed_tweet['menu_url'];
                        $truck_tweet->start_time = TwitterHelper::convertTruckTime($mention->created_at, 
                            $parsed_tweet['start']);
                        $truck_tweet->end_time   =  TwitterHelper::convertTruckTime($mention->created_at, 
                            $parsed_tweet['end']);
                        $truck_tweet->geo_lat    = $mention->coordinates->coordinates[1];
                        $truck_tweet->geo_long   = $mention->coordinates->coordinates[0];
                        $truck_tweet->save();

                        $message = 'INSERTED: Tweet (text=' . $mention->text .  ') from @' . $mention->user->screen_name . " successfully saved.\n";
                        Yii::log($message, 'info', get_called_class());
                        echo $message;
                    }
                    else
                    {
                        $message = 'SKIPPED: Tweet (id=' . $mention->id_str . ") already exists.\n";
                        Yii::log($message, 'info', get_called_class());
                        // Eating this output to save on cron tasks
                        // echo $message;
                        continue;
                    }
                }
                else
                {
                    $message = 'SKIPPED: Tweet (text=' . $mention->text . ") is an invalid format.\n";
                    Yii::log($message, 'info', get_called_class());
                    echo $message;
                    continue;
                }
            } 
            else 
            {
                $message = 'SKIPPED: Tweet (text=' . $mention->text . ') from ' .  $mention->user->screen_name . " is not geo-locatable.\n";
                Yii::log($message, 'info', get_called_class());
                echo $message;
                continue;
            }
        }
    }
 
    public function getHelp() {
        return 'Usage: how to use this command';
    }    
}
