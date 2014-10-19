<?php

/**
 * This is the model class for table "{{pay_method}}".
 *
 * The followings are the available columns in table '{{pay_method}}':
 * @property string $id
 * @property string $name
 * @property string $description
 * @property integer $type_id
 * @property string $shop_id
 * @property string $sign_key
 * @property string $active 
 *
 * The followings are the available model relations:
 * @property string $type 
 */
class PayMethod extends CActiveRecord {

  public $typeName;
  private static $types = array(1 => 'LiqPay',),
      $actionUrl = array(1 => 'https://www.liqpay.com/api/pay'),
      $signName = array(1 => 'signature'),
      $params = array(1 => array(
          'public_key' => '$this->shop_id',
          'amount' => '$invoice->sumMonth',
          'currency' => '"USD"',
          'description' => '"Payment of subscription FinInfo"',
          'order_id' => '$invoice->id',
          'type' => '$invoice->subscriptions[0]->autorenew ? "subscribe" : "buy"',
          'subscribe_date_start' => '$invoice->subscriptions[0]->autorenew ? $invoice->subscriptions[0]->getStartDate() : ""',
          'subscribe_periodicity' => '$invoice->subscriptions[0]->autorenew ? "month" : ""',
          'server_url' => 'Yii::app()->createAbsoluteUrl("/pay/liqPayNotify")',
          'result_url' => 'Yii::app()->createAbsoluteUrl("/private/result")',
          'pay_way' => '"card"',
          'language' => '"en"',
          'sandbox' => '"1"',
  ));

  public function getPayParams(Invoice $invoice) {
    ob_start();
    foreach (self::$params[$this->type_id] as $key => $param) {
      eval('echo ' . $param . ';');
      $value = ob_get_contents();
      ob_clean();
      if ($value)
        $params[$key] = $value;
    }
    ob_end_clean();
    return $params;
  }

  public function getSing($params) {
    $sign = '';
    switch ($this->type_id) {
      case 1:
        Yii::import('ext.LiqPay');
        $liqPay = new LiqPay($this->shop_id, $this->sign_key);
        $sign = $liqPay->cnb_signature($params);
        break;
    }
    return $sign;
  }

  public static function getTypes() {
    return self::$types;
  }

  public function getType() {
    return self::$types[$this->type_id];
  }

  public function getSignName() {
    return self::$signName[$this->type_id];
  }

  public function getActionUrl() {
    return self::$actionUrl[$this->type_id];
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{pay_method}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
      array('name, type_id', 'required'),
      array('type_id', 'numerical', 'integerOnly' => true),
      array('name, sign_key, shop_id', 'length', 'max' => 255),
      array('description', 'safe'),
      array('active', 'boolean'),
      // The following rule is used by search().
      // @todo Please remove those attributes that should not be searched.
      array('id, name, description, typeName, sign_key, active', 'safe', 'on' => 'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
      'payParams' => array(self::HAS_MANY, 'PayParams', 'pay_method_id'),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
      'id' => 'ID',
      'name' => 'Name',
      'description' => 'Description',
      'type_id' => 'Type',
      'sign_key' => 'Sign Key',
      'active' => 'Active',
      'shop_id' => 'Shop ID'
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

    $criteria->compare('id', $this->id, true);
    $criteria->compare('name', $this->name, true);
    $criteria->compare('description', $this->description, true);
    $criteria->compare('type_id', $this->typeName);
    $criteria->compare('active', $this->active);
    $criteria->compare('sign_key', $this->sign_key, true);

    return new CActiveDataProvider($this, array(
      'criteria' => $criteria,
    ));
  }

  /**
   * Returns the static model of the specified AR class.
   * Please note that you should have this exact method in all your CActiveRecord descendants!
   * @param string $className active record class name.
   * @return PayMethod the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

}
