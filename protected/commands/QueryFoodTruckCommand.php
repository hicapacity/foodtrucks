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

            if (TwitterHelper::isTrackable($mention) &&
                TwitterHelper::isGeoLocatable($mention)) {
                echo "Should store this tweet:";
                var_dump($mention);
            }
        }
    }
 
    public function getHelp() {
        return 'Usage: how to use this command';
    }    
}
