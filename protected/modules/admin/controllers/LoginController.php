<?php

class LoginController extends Controller {

  public $defaultAction = 'login';
  public $layout = 'login';

  /**
   * Displays the login page
   */
  public function actionLogin() {
    if (Yii::app()->user->isGuest) {
      Yii::import('application.modules.user.*');
      $model = new UserLogin;
      // collect user input data
      if (isset($_POST['UserLogin'])) {
        $model->attributes = $_POST['UserLogin'];
        // validate user input and redirect to previous page if valid
        if ($model->validate()) {
          $this->lastViset();
          $this->redirect($this->createUrl('/admin'));
        }
      }
      // display the login form
      $this->render('/admin/login', array('model' => $model));
    }
    else
      $this->redirect($this->createUrl('/admin'));
  }

  private function lastViset() {
    $lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
    $lastVisit->lastvisit = time();
    $lastVisit->save();
  }

}