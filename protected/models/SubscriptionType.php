<?php

/**
 * This is the model class for table "{{subscription_type}}".
 *
 * The followings are the available columns in table '{{subscription_type}}':
 * @property string $id
 * @property string $portid
 * @property string $symid
 * @property string $price
 * @property string $description 
 *
 * The followings are the available model relations:
 * @property Signal[] $signals
 * @property Subscription[] $subscriptions
 * @property InvoiceSubscription $invoices 
 */
class SubscriptionType extends CActiveRecord {

  public $typeName;

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{subscription_type}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
      array('portid, symid, price', 'required'),
      array('portid', 'length', 'max' => 4),
      array('symid, price', 'length', 'max' => 10),
      array('description', 'safe'),
      // The following rule is used by search().
      // @todo Please remove those attributes that should not be searched.
      array('id, portid, symid, price', 'safe', 'on' => 'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
      'signals' => array(self::HAS_MANY, 'Signal', 'subscription_type_id'),
      'subscriptions' => array(self::HAS_MANY, 'Subscription', 'subscription_type_id'),
      'invoices' => array(self::HAS_MANY, 'InvoiceSubscription', 'subscription_type_id'),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
      'id' => 'ID',
      'portid' => 'Strategy',
      'symid' => 'Trading tool',
      'price' => 'Price $',
      'description' => 'Description',
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
    $criteria->compare('portid', $this->portid, true);
    $criteria->compare('symid', $this->symid, true);
    $criteria->compare('price', $this->price, true);

    return new CActiveDataProvider($this, array(
      'criteria' => $criteria,
    ));
  }

  /**
   * Returns the static model of the specified AR class.
   * Please note that you should have this exact method in all your CActiveRecord descendants!
   * @param string $className active record class name.
   * @return SubscriptionType the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  public static function getListOptions() {
    return CHtml::listData(self::model()
                ->findAll(array(
                  'select' => "id, CONCAT(portid, ' ', symid) AS typeName",
                  )), 'id', 'typeName');
  }

}
