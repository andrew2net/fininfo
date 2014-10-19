<?php

/**
 * This is the model class for table "{{invoice}}".
 *
 * The followings are the available columns in table '{{invoice}}':
 * @property string $id
 * @property integer $uid
 * @property string $date
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property float $sum 
 * @property float $sumFuture
 * @property float $sumMonth
 * @property InvoiceSubscription[] $subscriptions 
 * @property Payment[] $payments
 * @property float $paySumm 
 */
class Invoice extends CActiveRecord {

  public $subscriber, $searshSum;

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{invoice}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
      array('uid, date', 'required'),
      array('uid', 'numerical', 'integerOnly' => true),
      // The following rule is used by search().
      // @todo Please remove those attributes that should not be searched.
      array('id, subscriber, date, searshSum', 'safe', 'on' => 'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
      'user' => array(self::BELONGS_TO, 'User', 'uid'),
      'sumMonth' => array(self::STAT, 'InvoiceSubscription', 'invoice_id', 'select' => 'SUM(price)'),
      'sum' => array(self::STAT, 'InvoiceSubscription', 'invoice_id', 'select' => 'SUM(price*months)'),
      'sumFuture' => array(self::STAT, 'InvoiceSubscription', 'invoice_id', 'select' => 'SUM(price*(months+1))'),
      'subscriptions' => array(self::HAS_MANY, 'InvoiceSubscription', 'invoice_id'),
      'payments' => array(self::HAS_MANY, 'Payment', 'invoice_id'),
      'paySumm' => array(self::STAT, 'Payment', 'invoice_id', 'select' => 'SUM(amount)', 'condition' => "status IN ('success', 'sandbox')"),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
      'id' => '#',
      'uid' => 'Subscriber',
      'date' => 'Date',
      'sum' => 'Summ $',
      'sumMonth' => 'Summ $',
      'paySumm' => 'Paid $',
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

    $criteria->with = array('user', 'sum');

    $criteria->compare('t.id', $this->id, true);
    $criteria->compare('user.username', $this->subscriber, true);
    $criteria->compare('date', $this->date, true);
//    $criteria->compare('sum', $this->searshSum);

    return new CActiveDataProvider($this, array(
      'criteria' => $criteria,
      'sort' => array(
        'attributes' => array(
          'user.username' => array(
            'asc' => 'user.username',
            'desc' => 'user.username DESC',
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
   * @return Invoice the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

}
