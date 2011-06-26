<?php

/**
 * This is the model class for table "trucks".
 *
 * The followings are the available columns in table 'trucks':
 * @property integer $id
 * @property string $twitter_id
 * @property string $twitter_username
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
			array('twitter_id, twitter_account_id, twitter_username, created, modified, icon_url', 'required'),
			array('twitter_id, twitter_account_id', 'numerical', 'integerOnly'=>true),
			array('twitter_username', 'length', 'max'=>64),
			array('icon_url', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, twitter_id, twitter_account_id, twitter_username, icon_url, created, modified', 'safe', 'on'=>'search'),
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
			'twitterAccount' => array(self::BELONGS_TO, 'TwitterAccounts', 'twitter_account_id'),
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
			'twitter_id' => 'Twitter',
			'twitter_account_id' => 'Twitter Account ID',
			'twitter_username' => 'Twitter Username',
			'icon_url'=> 'Icon URL',
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
		$criteria->compare('twitter_account_id',$this->twitter_account_id,true);
		$criteria->compare('twitter_username',$this->twitter_username,true);
		$criteria->compare('icon_url',$this->icon_url,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

    # TODO: I don't like this, should raise exception, but just getting to work now.
    public static function get_or_insert_truck($account, $mention)
    {
        if ($account and $mention)
        {
            $truck = Trucks::model()->findByAttributes(
                array('twitter_id' => $mention->user->id_str));

            return (NULL === $truck) ?
                Trucks::model()->insert_truck_from_tweet($account, $mention) :
                $truck;
        }
        return false;
    }

    # TODO: I don't like this either, should probably come from twitteraccounts, but just getting to work now.
    protected static function insert_truck_from_tweet($account, $mention)
    {
        if ($account and $mention)
        {
            $truck = new Trucks;
            $truck->twitter_id = $mention->user->id;
            $truck->twitter_username = $mention->user->screen_name;
            $truck->twitter_account_id = $account->id;
            $truck->icon_url = $mention->user->profile_image_url;
            if ($truck->validate()) 
            {
                if ($truck->save()) 
                {
                    return $truck;
                }
            } 
        }
        return false;
    }

    /**
     * Get all trucks
	 */
	public static function get_all_trucks(){
		$trucksObj = Trucks::model()->with('trucksTweets:coords',
				'twitterAccount')->findAll();

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
		return array_filter($trucks, array('Trucks', 'has_geo'));
	}

	/**
	 * Find a single truck based on their primary key!
	 */
	public static function get_truck_by_id($id){
		$id = (int)$id;
		$truck = Trucks::model()->with('trucksTweets:coords',
			'twitterAccount')->find(array(
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

	public static function obj_to_array($truck){
		$ret = Array(
			"id" => $truck->id,
			"name" => $truck->twitter_username,
			"info" => $truck->twitterAccount->truck_info,
            "icon_url" => $truck->icon_url,
		);
		if (is_array($truck->trucksTweets) && count($truck->trucksTweets)){
			$tweet = $truck->trucksTweets[0];
			$ret['lat']     = $tweet->geo_lat;
			$ret['lng']     = $tweet->geo_long;
			$ret['start']   = $tweet->start_time;
			$ret['end']     = $tweet->end_time;
			$ret['img_url'] = $tweet->photo_url;
		}
		return $ret;
	}
}
