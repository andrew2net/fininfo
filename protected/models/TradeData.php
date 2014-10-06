<?php

/**
 * This is the model class for table "{{trade_data}}".
 *
 * The followings are the available columns in table '{{trade_data}}':
 * @property string $subscription_type_id
 * @property string $date
 * @property string $profit
 *
 * The followings are the available model relations:
 * @property SubscriptionType $subscriptionType
 */
class TradeData extends CActiveRecord {

  public $subscriptionTypeName;

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{trade_data}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
      array('subscription_type_id, date, profit', 'required'),
      array('subscription_type_id', 'length', 'max' => 4),
      array('profit', 'length', 'max' => 12),
      // The following rule is used by search().
      // @todo Please remove those attributes that should not be searched.
      array('subscriptionTypeName, subscription_type_id, date, profit', 'safe', 'on' => 'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
      'subscriptionType' => array(self::BELONGS_TO, 'SubscriptionType', 'subscription_type_id'),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
      'subscription_type_id' => 'Subscription Type',
      'date' => 'Date',
      'profit' => 'Profit',
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
  public function search() {
    // @todo Please modify the following code to remove attributes that should not be searched.

    $criteria = new CDbCriteria;

    $criteria->with = array('subscriptionType');

		$criteria->compare('subscriptionTypeName',$this->subscriptionTypeName);
//    $criteria->compare('subscription_type_id', $this->subscription_type_id, true);
    $criteria->compare('date', $this->date, true);
    $criteria->compare('profit', $this->profit, true);

    return new CActiveDataProvider($this, array(
      'criteria' => $criteria,
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
   * @return TradeData the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

}
