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
    public static function getTwitterAccount($tweet) {

        Yii::log("Retrieving Twitter Account", 'info', get_called_class());

        try {
            $twitter_id = $tweet->user->id_str;
            $twitter_name = $tweet->user->screen_name;
            $criteria=new CDbCriteria;
            $criteria->select = 'id';
            $criteria->condition = 'twitter_id = :twitter_id OR twitter_name = :twitter_name';
            $criteria->params = array(':twitter_id'=>$twitter_id, 
                                      ':twitter_name'=>$twitter_name);
            $criteria->limit = 1;
			$model = TwitterAccounts::model()->find($criteria);
            return (NULL !== $model) ? $model:false;
        } catch (Exception $e) {
            Yii::log("Exception occurred retrieving Twitter Acount:" . $e, 
                     'error', get_called_class());
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

    /**
     * Returns true if tweet is in valid format (@streetgrindzapp <menu image url> <open time>-<close time>)
     */
    public static function isValidFormat($tweet) {
        return true;
    }
}
