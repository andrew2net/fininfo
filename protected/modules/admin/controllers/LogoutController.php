<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LogoutController
 *
 * @author Greg Bakos <greg@londonfreelancers.co.uk>
 */
class LogoutController extends CController {
  
  public $defaultAction = 'logout';

  public function actionLogout() {
    Yii::app()->user->logout();
    $this->redirect(Yii::app()->createUrl('/admin/login'));
  }

}

?>
