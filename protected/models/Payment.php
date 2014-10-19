<?php

/**
 * This is the model class for table "{{payment}}".
 *
 * The followings are the available columns in table '{{payment}}':
 * @property string $id
 * @property string $invoice_id
 * @property string $operation_id
 * @property string $amount
 * @property string $currency
 * @property string $pay_system_id
 * @property string $corr_acc
 * @property string $time
 * @property string $description 
 * @property string $type 
 * @property string $status 
 *
 * The followings are the available model relations:
 * @property Invoice $invoice
 */
class Payment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{payment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('invoice_id', 'required'),
			array('invoice_id', 'length', 'max'=>11),
			array('type', 'length', 'max'=>10),
			array('description', 'length', 'max'=>255),
			array('operation_id, pay_system_id, corr_acc', 'length', 'max'=>30),
			array('amount, status', 'length', 'max'=>12),
			array('currency', 'length', 'max'=>3),
			array('time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, invoice_id, operation_id, amount, currency, pay_system_id, corr_acc, time', 'safe', 'on'=>'search'),
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
			'invoice' => array(self::BELONGS_TO, 'Invoice', 'invoice_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'invoice_id' => 'Invoice',
			'operation_id' => 'Operation ID',
			'amount' => 'Amount',
			'currency' => 'Currency',
			'pay_system_id' => 'Pay system',
			'corr_acc' => 'Corr acc',
			'time' => 'Time',
      'description' => 'Description',
      'type' => 'Type',
      'status' => 'Status',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('invoice_id',$this->invoice_id,true);
		$criteria->compare('operation_id',$this->operation_id,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('pay_system_id',$this->pay_system_id,true);
		$criteria->compare('corr_acc',$this->corr_acc,true);
		$criteria->compare('time',$this->time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Payment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
