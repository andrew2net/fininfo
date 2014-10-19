<?php

/**
 * Description of RegistrationController
 *
 */
class SignupController extends Controller {

  /**
   * Declares class-based actions.
   */
  public function actions() {
    return array(
      // captcha action renders the CAPTCHA image displayed on the contact page
      'captcha' => array(
        'class' => 'CCaptchaAction',
        'backColor' => 0xFFFFFF,
      ),
    );
  }

  public function actionIndex() {
    $isAjax = Yii::app()->request->isAjaxRequest;

    if (!Yii::app()->user->isGuest) {
      if ($isAjax) {
        echo json_encode(array('result' => 'close'));
        Yii::app()->end();
      }
      $this->redirect('/');
    }

    $model = new Registration;
    $profile = new Profile;
    $profile->regMode = true;

    if (isset($_POST['Registration'])) {
      $model->attributes = $_POST['Registration'];
      if ($model->validate()) {
        $soucePassword = $model->password;
        $model->activkey = UserModule::encrypting(microtime() . $model->password);
        $model->password = UserModule::encrypting($model->password);
        $model->verifyPassword = UserModule::encrypting($model->verifyPassword);
        $model->superuser = 0;
        $model->status = User::STATUS_ACTIVE;
        $model->lastvisit = time();
        if ($model->save()) {
          Yii::app()->getAuthManager()->assign('Authenticated', $model->id);
          
          $profile->user_id = $model->id;
          $profile->save();
          $identity = new UserIdentity($model->username, $soucePassword);
          if ($identity->authenticate())
            Yii::app()->user->login($identity);

          $message = new Message;
          $message->uid = $model->id;
          $message->type_id = Message::TYPE_REGISTRATION;
          $message->transport_id = Message::TRANSPORT_EMAIL;
          $message->save();

          $message = new Message;
          $message->uid = $model->id;
          $message->type_id = Message::TYPE_CONFIRM_EMAIL_PHONE;
          $message->transport_id = Message::TRANSPORT_EMAIL;
          $message->save();

          if ($isAjax) {
            echo json_encode(array(
              'result' => 'redirect',
              'url' => $this->createAbsoluteUrl('/private/subscribe'),
            ));
            Yii::app()->end();
          }
          $this->redirect('/private/subscribe');
        }
      }
    }

    if ($isAjax) {
      echo json_encode(array(
        'result' => 'form',
        'form' => $this->renderPartial('_regform', array('user' => $model, 'profile' => $profile), TRUE),
      ));
      Yii::app()->end();
    }
    $this->render('registr', array('user' => $model, 'profile' => $profile));
  }

}
