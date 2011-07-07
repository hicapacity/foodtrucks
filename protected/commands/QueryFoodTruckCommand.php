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

        for ($i = 0; $i < $num_mentions; $i++)
        {
            $mention = $mentions[$i];
            $twitterAccount = TwitterHelper::getTwitterAccount($mention);
            if (false !== $twitterAccount &&
                TwitterHelper::isGeoLocatable($mention)) {

                $truck = Trucks::model()->get_or_insert_truck(
                    $twitterAccount, $mention);

                if (!$truck)
                {
                    echo 'New Truck Twitter Count Insertion Failed: '.$mention->user->name."\n";
                }
                
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
                    }
                    else
                    {
                        $message = 'Tweet (id=' . $mention->id_str . ") already exists. Skipping.\n";
                        Yii::log($message, 'info', get_called_class());
                        echo $message;
                    }
                }
                else
                {
                    $message = 'Tweet (text=' . $mention->text . ") invalid format. Skipping.\n";
                    Yii::log($message, 'info', get_called_class());
                    echo $message;
                }
            } else {
                echo 'Bad Tweeter: '.$mention->user->screen_name.' '.$mention->text."\n";                
            }
        }
    }
 
    public function getHelp() {
        return 'Usage: how to use this command';
    }    
}
