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
      else
        $this->redirect('/');
    }

    $user = new Registration;
    $profile = new Profile;

    if (isset($_POST['Registration'])) {
      $user->attributes = $_POST['Registration'];
      $user->validate();
    }

    if ($isAjax) {
      echo json_encode(array(
        'result' => 'form',
        'form' => $this->renderPartial('_regform', array('user' => $user, 'profile' => $profile), TRUE),
      ));
      Yii::app()->end();
    }
    else
      $this->render('registr', array('user' => $user, 'profile' => $profile));
  }

}
