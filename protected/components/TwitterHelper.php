<?php

/**
 * TwitterHelper provides helper methods to determine if Tweets are RTs, part
 * of the foodtruck circle, etc.
 */
class TwitterHelper
{
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

    /**
     * Returns true if tweet is in valid format (@streetgrindzapp <menu image url> <open time>-<close time>)
     */
    public static function isValidFormat($tweet) {
        try {
            $tweet_text = $tweet->text;
            $matches = TwitterHelper::parseTruckTweet($tweet_text);
            return ($matches) ? true : false;
        } 
        catch (Exception $e) 
        {
            Yii::log("Exception occurred parsing Tweet format:" . $e, 
                     'error', get_called_class());
            return false;
        }
    }

    public static function parseTruckTweet($tweet_text) {
        preg_match('/^@streetgrindzapp\s+(?P<menu_url>http:\/\/.*)?\s*(?P<start>\d+)-(?P<end>\d+)\s*$/', $tweet_text, $matches);
        return $matches;
    }

    /** 
     * Take tweet time -> converts tweet to timezone, sets the hour/min/secs, converts back to UTC for db
     */
    public static function convertTruckTime($tweet_time, $hour, $minutes=0, $seconds=0, $timezone='HST')
    {
        $tweet_datetime = DateTime::createFromFormat('D M j G:i:s +0000 Y', $tweet_time);
        $hst = new DateTimeZone($timezone);
        $tweet_datetime->setTimezone($hst);
        $tweet_datetime->setTime($hour, $minutes, $seconds);

        $utc = new DateTimeZone('UTC');
        $tweet_datetime->setTimezone($utc);
        return $tweet_datetime->format('Y-m-d G:i:s');
    }
}
