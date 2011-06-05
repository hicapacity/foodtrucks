<?php

/**
 * TwitterHelper provides helper methods to determine if Tweets are RTs, part
 * of the foodtruck circle, etc.
 */
class TwitterHelper
{
    /**
     * Return true if the tweet is trackable, false otherwise
     */
    public static function isTrackable($tweet) {
        try {
            $twitter_id = $tweet->user->id_str;
            $twitter_name = $tweet->user->screen_name;
            $twitterAccts = TwitterAccounts::model()->findAll();
            $ids = array();
            $names = array();
            foreach ($twitterAccts as $acct) {
                $ids[] = $acct->twitter_id;
                $names[] = $acct->twitter_name;
            }
            return in_array($twitter_id, $ids) || in_array($twitter_name,$names);
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Return true if the tweet is geo locatable, false otherwise
     */
    public static function isGeoLocatable($tweet) {
        try {
            return ($tweet->coordinates !== NULL);
        } catch (Exception $e) {
            return false;
        }
    }
}
