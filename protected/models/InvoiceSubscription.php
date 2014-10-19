<?php

/**
 * This is the model class for table "{{invoice_subscription}}".
 *
 * The followings are the available columns in table '{{invoice_subscription}}':
 * @property string $invoice_id
 * @property string $subscription_type_id
 * @property string $start
 * @property integer $months
 * @property string $price
 * @property string $autorenew 
 * @property string $end 
 *
 * The followings are the available model relations:
 * @property SubscriptionType $subscriptionType
 * @property Invoice $invoice 
 */
class InvoiceSubscription extends CActiveRecord {

  public $subscriptionTypeName;

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{invoice_subscription}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
      array('subscription_type_id, price', 'required'),
      array('months', 'default', 'value' => 0),
      array('months', 'numerical', 'integerOnly' => true),
      array('autorenew', 'boolean'),
      array('invoice_id', 'length', 'max' => 11),
      array('subscription_type_id', 'length', 'max' => 4),
      array('price', 'length', 'max' => 10),
      array('start, end', 'date', 'format' => 'yyyy-MM-dd'),
      // The following rule is used by search().
      // @todo Please remove those attributes that should not be searched.
      array('invoice_id, subscription_type_id, start, price', 'safe', 'on' => 'search'),
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
      'invoice' => array(self::BELONGS_TO, 'Invoice', 'invoice_id'),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
      'invoice_id' => 'Invoice',
      'subscription_type_id' => 'Subscription type',
      'start' => 'Start',
      'end' => 'End',
      'months' => 'Months',
      'price' => 'Price $',
      'autorenew' => 'Auto-renewal'
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

    $criteria->compare('invoice_id', $this->invoice_id, true);
    $criteria->compare('subscription_type_id', $this->subscription_type_id, true);
    $criteria->compare('start', $this->start, true);
    $criteria->compare('months', $this->months);
    $criteria->compare('t.price', $this->price, true);

    return new CActiveDataProvider($this, array(
      'criteria' => $criteria,
      'sort' => array(
        'attributes' => array(
          'subscriptionTypeName' => array(
            'asc' => 'subscriptionType.portid, subscriptionType.symid',
            'desc' => 'subscriptionType.portid DESC, subscriptionType.symid DESC',
          ),
          '*',
        )
      )
    ));
  }

  /**
   * Returns the static model of the specified AR class.
   * Please note that you should have this exact method in all your CActiveRecord descendants!
   * @param string $className active record class name.
   * @return InvoiceSubscription the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  protected function afterConstruct() {
    $this->autorenew = TRUE;
    parent::afterConstruct();
  }
  
  public function getStartDate($format = 'Y-m-d H:i:s'){
    $orderDate = new DateTime($this->start);
    $now = new DateTime;
    if ($now > $orderDate)
      return $now->format($format);
    return $orderDate->format($format);
  }

}
