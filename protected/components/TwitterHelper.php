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
	public static function isTrackable($tweet)
	{
        try {
            $twitter_id = $tweet->user->id_str;
            $trackable_twitter_ids = Yii::app()->params['trucks']['twitter']['foodtrucks'];
            return in_array($twitter_id, $trackable_twitter_ids);
        } 
        catch (Exception $e)
        {
            return false;
        }
	}

    /**
     * Return true if the tweet is geo locatable, false otherwise
     */
    public static function isGeoLocatable($tweet)
    {
        try {
            return ($tweet->coordinates !== NULL);
        } 
        catch (Exception $e)
        {
            return false;
        }
    }
}
