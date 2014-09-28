<?php

/**
 * This is the model class for table "{{subscription}}".
 *
 * The followings are the available columns in table '{{subscription}}':
 * @property string $id
 * @property integer $uid
 * @property string $subscription_type_id
 * @property string $start
 * @property string $end
 *
 * The followings are the available model relations:
 * @property Payment[] $payments
 * @property SubscriptionType $subscriptionType
 * @property Users $user
 */
class Subscription extends CActiveRecord {

  public $userName, $subscriptionTypeName;

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{subscription}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
      array('uid, subscription_type_id', 'required'),
      array('uid', 'numerical', 'integerOnly' => true),
      array('subscription_type_id', 'length', 'max' => 4),
      array('start, end', 'safe'),
      // The following rule is used by search().
      // @todo Please remove those attributes that should not be searched.
      array('userName, uid, subscriptionTypeName, start, end', 'safe', 'on' => 'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
      'payments' => array(self::HAS_MANY, 'Payment', 'subscription_id'),
      'subscriptionType' => array(self::BELONGS_TO, 'SubscriptionType', 'subscription_type_id'),
      'user' => array(self::BELONGS_TO, 'User', 'uid'),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
      'id' => 'ID',
      'uid' => 'Subscriber',
      'subscription_type_id' => 'Subscription type',
      'start' => 'Start',
      'end' => 'End',
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

    $criteria->with = array('user', 'subscriptionType');

    $criteria->compare('userName', $this->userName, true);
    $criteria->compare('uid', $this->uid);
    $criteria->compare('subscriptionTypeName', $this->subscriptionTypeName);
    $criteria->compare('start', $this->start, true);
    $criteria->compare('end', $this->end, true);

    return new CActiveDataProvider($this, array(
      'criteria' => $criteria,
      'sort' => array(
        'attributes' => array(
          'userName' => array(
            'asc' => 'user.username',
            'desc' => 'user.username DESC',
          ),
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
   * @return Subscription the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

}
