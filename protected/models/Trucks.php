<?php

/**
 * This is the model class for table "trucks".
 *
 * The followings are the available columns in table 'trucks':
 * @property integer $id
 * @property string $twitter_id
 * @property string $twitter_username
 * @property string $icon_url
 * @property string $info
 * @property string $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property TrucksTweets[] $trucksTweets
 */
class Trucks extends CreatedModifiedActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Trucks the static model class
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
		return 'trucks';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('twitter_id, twitter_username, name, info, created, modified, icon_url', 'required'),
			array('twitter_id', 'numerical', 'integerOnly'=>true),
			array('twitter_username', 'length', 'max'=>64),
			array('name', 'length', 'max'=>64),
			array('icon_url', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, twitter_id, twitter_username, icon_url, name, info, created, modified', 'safe', 'on'=>'search'),
		);
	}

    // TODO: Insert link to default truck image
    public function beforeValidate() 
    {
        if (!isset($this->icon_url)) {
            $this->icon_url = 'http://google.com/insert_here';
        }
        return parent::beforeValidate();
    }

	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'trucksTweets' => array(self::HAS_MANY, 'TrucksTweets', 'truck_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'twitter_id' => 'Twitter Id',
			'twitter_username' => 'Twitter Username',
			'icon_url'=> 'Icon URL',
			'name'=> 'Truck Name',
			'info'=> 'Truck Info',
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
		$criteria->compare('twitter_id',$this->twitter_id,true);
		$criteria->compare('twitter_username',$this->twitter_username,true);
		$criteria->compare('icon_url',$this->icon_url,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('info',$this->info,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

    /**
     * Get all trucks
	 */
	public static function get_all_trucks(){
		$trucksObj = Trucks::model()->with(array(
           'trucksTweets:coords'=>array('order'=>'trucksTweets.id DESC')))->findAll();

		$ret = array();
		foreach ($trucksObj as $truck){
			$ret[] = Trucks::obj_to_array($truck);
		}
		return $ret;
	}

	/**
	 * Finds all trucks that have tweeted to us and their geo coords
	 */
	public static function get_all_located_trucks(){
		$trucks = Trucks::get_all_trucks();
		$ret = array_filter($trucks, array('Trucks', 'has_geo'));
		return array_values($ret);
	}

	/**
	 * Finds all open trucks that have tweeted to us and their geo coords
	 */
	public static function get_all_open_and_located_trucks(){
		$trucks = Trucks::get_all_located_trucks();
		$ret = array_filter($trucks, array('Trucks', 'is_open'));
		return array_values($ret);
	}

	/**
	 * Find a single truck based on their primary key!
	 */
	public static function get_truck_by_id($id){
		$id = (int)$id;
		$truck = Trucks::model()->with('trucksTweets:coords')->find(array(
				'condition'=>'t.id=:id',
				'params'=>array(':id'=>$id),
			));
		$ret = array();
		if ($truck !== NULL){
			$ret[] = Trucks::obj_to_array($truck);
		}
		return $ret;
	}

	public static function has_geo($truck){
		return isset($truck['lat']);
	}

	public static function is_open($truck){
        $utc = new DateTimeZone('UTC');
        $tweet_starttime = DateTime::createFromFormat('Y-m-d G:i:s', 
            $truck['start'], $utc);

        $tweet_endtime = DateTime::createFromFormat('Y-m-d G:i:s', 
            $truck['end'], $utc);

        $now = time();
        return ($now >= $tweet_starttime->getTimestamp()) && ($tweet_endtime->getTimestamp() >= $now);
	}

	public static function obj_to_array($truck){
		$ret = Array(
			"id" => $truck->id,
			"twitter_username" => $truck->twitter_username,
			"name" => $truck->name,
			"info" => $truck->info,
            "icon_url" => $truck->icon_url,
		);

        // This is only grabbing the last Truck tweet
		if (is_array($truck->trucksTweets) && count($truck->trucksTweets)){
			$tweet = $truck->trucksTweets[0];

            $ret['lat']     = $tweet->geo_lat;
            $ret['lng']     = $tweet->geo_long;
            $ret['start']   = $tweet->start_time;
            $ret['end']     = $tweet->end_time;
            $ret['menu_url'] = $tweet->menu_url;
		}
		return $ret;
	}
}
