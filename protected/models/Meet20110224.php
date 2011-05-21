<?php

/**
 * This is the model class for table "meet20110224".
 *
 * The followings are the available columns in table 'meet20110224':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $date_created
 */
class Meet20110224 extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Meet20110224 the static model class
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
		return 'meet20110224';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, email', 'required'),
			array('name, email', 'length', 'max'=>128),
			array('name, email','unique'),
			array('email', 'email', 'checkMX' => true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, date_created', 'safe', 'on'=>'search'),
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
			'email' => 'Email',
			'date_created' => 'Date Created',
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('date_created',$this->date_created,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}