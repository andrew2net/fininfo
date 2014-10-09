<?php

/**
 * Description of newPHPClass
 *
 */
class Registration extends User {

  public $verifyPassword;
  public $verifyCode;

  public function rules() {
    $rules = array(array('username, password, verifyPassword, email', 'required'),
      array('username', 'length', 'max' => 20, 'min' => 3, 'message' => UserModule::t("Incorrect username (length between 3 and 20 characters).")),
      array('password', 'length', 'max' => 128, 'min' => 4, 'message' => UserModule::t("Incorrect password (minimal length 4 symbols).")),
      array('email', 'email'),
      array('username', 'unique', 'message' => UserModule::t("This user's name already exists.")),
      array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u', 'message' => UserModule::t("Incorrect symbols (A-z0-9).")),
      array('email', 'unique', 'message' => UserModule::t("This user's email address already exists.")),
      array('verifyPassword', 'compare', 'compareAttribute' => 'password', 'message' => UserModule::t("Retype Password is incorrect.")),
    );

    if (!Yii::app()->request->isAjaxRequest)
      array_push($rules, array('verifyCode', 'captcha'));

    return $rules;
  }

  public function attributeLabels() {
    return array(
      'verifyCode' => 'Verification Code',
    );
  }

}
