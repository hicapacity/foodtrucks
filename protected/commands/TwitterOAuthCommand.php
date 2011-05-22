<?php

/**
 * hicapacity.org, islands, ryankanno implementation of https://github.com/abraham/twitteroauth
 * 2011-05-21 (rapture day!)
 */

class TwitterOAuthCommand extends CConsoleCommand
{

    private $connection;
    
    public function __construct($name, $runner) {
        Yii::import('application.vendors.twitteroauth.twitteroauth.twitteroauth');
        //require_once('vendors/twitteroauth/twitteroauth.php');
//        require_once('config.php');


        return parent::__construct($name, $runner);
    }
    
    public function run($args) {
        // $args gives an array of the command-line arguments for this command
        $this->connection = new twitteroauth(
            Yii::app()->params['twitter']['consumerKey'],
            Yii::app()->params['twitter']['consumerSecret'],
            Yii::app()->params['twitter']['oauthToken'],
            Yii::app()->params['twitter']['oauthTokenSecret']);
        //$mentions = $this->connection->get('statuses/mentions.json');
        $mentions = $this->connection->get('statuses/public_timeline');
        print var_dump($mentions);

    }
 
    public function getHelp() {
        return 'Usage: how to use this command';
    }    
}
