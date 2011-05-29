<?php

/**
 * This is the model class for table "trucks_tweets".
 *
 * The followings are the available columns in table 'trucks_tweets':
 * @property integer $id
 * @property integer $truck_id
 * @property string $tweet
 * @property double $geo_lat
 * @property double $geo_long
 * @property string $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property Trucks $truck
 */
class TrucksTweets extends CreatedModifiedActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return TrucksTweets the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'trucks_tweets';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('truck_id, tweet_id, tweet, geo_lat, geo_long, created, modified', 'required'),
			array('truck_id, tweet_id', 'numerical', 'integerOnly'=>true),
			array('geo_lat, geo_long', 'numerical'),
			array('tweet', 'length', 'max'=>160),
			array('photo_url', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, truck_id, tweet_id, tweet, photo_url, geo_lat, geo_long, created, modified', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'truck' => array(self::BELONGS_TO, 'Trucks', 'truck_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'truck_id' => 'Truck',
			'tweet_id' => 'Tweet Id',
			'tweet' => 'Tweet',
			'photo_url' => 'Photo URL',
			'geo_lat' => 'Geo Lat',
			'geo_long' => 'Geo Long',
			'created' => 'Created',
			'modified' => 'Modified',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('truck_id',$this->truck_id);
		$criteria->compare('tweet_id',$this->tweet_id,true);
		$criteria->compare('tweet',$this->tweet,true);
		$criteria->compare('photo_url',$this->photo_url,true);
		$criteria->compare('geo_lat',$this->geo_lat);
		$criteria->compare('geo_long',$this->geo_long);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
