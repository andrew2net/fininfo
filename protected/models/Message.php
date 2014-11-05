<?php

/**
 * This is the model class for table "{{message}}".
 *
 * The followings are the available columns in table '{{message}}':
 * @property string $id
 * @property integer $uid
 * @property string $type_id
 * @property string $transport_id
 * @property string $status_id
 * @property string $made_time
 * @property string $sent_time
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property Signal $signals 
 */
class Message extends CActiveRecord {

  const TYPE_REGISTRATION = 1, TYPE_CONFIRM_EMAIL_PHONE = 2, TYPE_RECOVERY_PASSWORD = 3,
      TYPE_CONFIRM_SUBSCRIPTION = 4, TYPE_END_SUBSCRIPTION_NOTIFY = 5, TYPE_SEND_SIGNAL = 6,
      TYPE_NEW_ORDER_NOTIFY = 7, 
      TRANSPORT_EMAIL = 1, TRANSPORT_SMS = 2,
      STATUS_NOT_SENT = 1, STATUS_SENT = 2;

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{message}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
      array('status_id', 'default', 'value' => 1),
      array('made_time', 'default', 'value' => date('Y-m-d H:i:s')),
      array('uid, type_id, transport_id, status_id, made_time', 'required'),
      array('uid', 'numerical', 'integerOnly' => true),
      array('type_id, transport_id, status_id', 'length', 'max' => 1),
      array('sent_time', 'safe'),
      // The following rule is used by search().
      // @todo Please remove those attributes that should not be searched.
      array('id, uid, type_id, transport_id, status_id, made_time, sent_time', 'safe', 'on' => 'search'),
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
      'signals' => array(self::MANY_MANY, 'Signal', '{{message_signal}}(message_id, signal_id)'),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
      'id' => 'ID',
      'uid' => 'Uid',
      'type_id' => 'Type',
      'transport_id' => 'Transport',
      'status_id' => 'Status',
      'made_time' => 'Made Time',
      'sent_time' => 'Sent Time',
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
    $criteria->compare('uid', $this->uid);
    $criteria->compare('type_id', $this->type_id, true);
    $criteria->compare('transport_id', $this->transport_id, true);
    $criteria->compare('status_id', $this->status_id, true);
    $criteria->compare('made_time', $this->made_time, true);
    $criteria->compare('sent_time', $this->sent_time, true);

    return new CActiveDataProvider($this, array(
      'criteria' => $criteria,
    ));
  }

  /**
   * Returns the static model of the specified AR class.
   * Please note that you should have this exact method in all your CActiveRecord descendants!
   * @param string $className active record class name.
   * @return Message the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

}
