<?php

/**
 * This is the model class for table "contact_us".
 *
 * The followings are the available columns in table 'contact_us':
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $email_address
 * @property string $message
 */
class ContactUs extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ContactUs the static model class
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
		return 'contact_us';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email_address, message', 'required'),
			array('name, email_address', 'length', 'max'=>128),
			array('email_address', 'email', 'checkMX' => true),
			array('phone', 'length', 'max'=>16),
			array('message', 'length', 'max'=>4096),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, phone, email_address, message', 'safe', 'on'=>'search'),
		);
	}


	public function beforeSave() {
		if ($this->isNewRecord) {
			$this->date_created = date('Y-m-d H:i:s');
		}
	 
		return parent::beforeSave();
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
			'name' => 'Name',
			'phone' => 'Phone',
			'email_address' => 'Email Address',
			'message' => 'Message',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email_address',$this->email_address,true);
		$criteria->compare('message',$this->message,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}