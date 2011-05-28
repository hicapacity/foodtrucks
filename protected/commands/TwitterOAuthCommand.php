<?php

/**
 * hicapacity.org, islands, ryankanno implementation of https://github.com/abraham/twitteroauth
 * 2011-05-21 (rapture day!)
 */
Yii::import('application.vendors.*');
require_once('twitteroauth/twitteroauth/twitteroauth.php');

$AUTHENTICATED_USERS = array(9491862);

class TwitterOAuthCommand extends CConsoleCommand
{

    private $connection;
    
    public function __construct($name, $runner) {
        return parent::__construct($name, $runner);
    }
    
    public function run($args) {

        $this->connection = new TwitterOAuth(
            Yii::app()->params['twitter']['consumerKey'],
            Yii::app()->params['twitter']['consumerSecret'],
            Yii::app()->params['twitter']['oauthAccessToken'],
            Yii::app()->params['twitter']['oauthAccessTokenSecret']);

        $mentions = $this->connection->get('statuses/mentions');
        //$mentions = $this->connection->get('statuses/public_timeline');

        var_dump($mentions);

    }
 
    public function getHelp() {
        return 'Usage: how to use this command';
    }    
}
