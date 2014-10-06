<?php

/**
 * This is the model class for table "{{signal}}".
 *
 * The followings are the available columns in table '{{signal}}':
 * @property string $id
 * @property string $subscription_type_id
 * @property string $recom
 * @property string $sigdate
 * @property string $price
 *
 * The followings are the available model relations:
 * @property SubscriptionType $subscriptionType
 */
class Signal extends CActiveRecord
{
  
  public $subscriptionTypeName;
  
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{signal}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subscription_type_id, recom, sigdate, price', 'required'),
			array('subscription_type_id', 'length', 'max'=>4),
			array('recom', 'length', 'max'=>25),
			array('price', 'length', 'max'=>12),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('subscription_type_id, recom, sigdate, price, subscriptionTypeName', 'safe', 'on'=>'search'),
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
			'subscriptionType' => array(self::BELONGS_TO, 'SubscriptionType', 'subscription_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'subscription_type_id' => 'Subscription type',
			'recom' => 'Recomendation',
			'sigdate' => 'Date',
			'price' => 'Price',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
    
    $criteria->with = array('subscriptionType');

		$criteria->compare('subscriptionTypeName',$this->subscriptionTypeName);
		$criteria->compare('recom',$this->recom,true);
		$criteria->compare('sigdate',$this->sigdate,true);
		$criteria->compare('price',$this->price,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
      'sort' => array(
        'attributes' => array(
          'subscriptionTypeName' => array(
            'asc' => 'subscriptionType.portid, subscriptionType.symid',
            'desc' => 'subscriptionType.portid DESC, subscriptionType.symid DESC',
          ),
          '*',
        ),
      ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Signal the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
