<?php

/**
 * This is the model class for table "twitter_accounts".
 *
 * The followings are the available columns in table 'twitter_accounts':
 * @property integer $id
 * @property string $twitter_name
 * @property string $truck_info
 * @property string $twitter_id
 * @property string $created
 * @property string $modified
 */
class TwitterAccounts extends CreatedModifiedActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return TwitterAccounts the static model class
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
		return 'twitter_accounts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('twitter_id, twitter_name', 'mustHaveNameOrID'),
			array('created, modified', 'required'),
			array('twitter_id', 'numerical', 'integerOnly'=>true),
			array('twitter_id', 'length', 'max'=>20),
			array('twitter_name', 'length', 'max'=>64),
			array('truck_info', 'length', 'max'=>65536),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, twitter_id, twitter_name, truck_info, created, modified', 'safe', 'on'=>'search'),
		);
	}

    public function mustHaveNameOrID($attribute, $params) {
		if (trim($this->twitter_id)=='' && trim($this->twitter_name)=='') {
			$this->addError($attribute,'Must have Twitter ID or Name');
			return false;
		}
		return true;
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'twitter_id' => 'Twitter ID',
			'twitter_name' => 'Twitter Name',
			'truck_info' => 'Truck Info',
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

		//$criteria->compare('id',$this->id);
		$criteria->compare('twitter_name',$this->twitter_name,true);
		$criteria->compare('twitter_id',$this->twitter_id,true);
		$criteria->compare('twitter_name',$this->twitter_name,true);
		$criteria->compare('truck_info',$this->truck_info,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}