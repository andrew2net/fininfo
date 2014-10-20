<?php

/**
 * Description of AdminModule
 *
 */
class AdminModule extends CWebModule {

  public $defaultController = 'Invoice';

  public function init() {
    // this method is called when the module is being created
    // you may place code here to customize the module or the application

    $this->layout = 'main';
    
    // import the module-level models and components
    $this->setImport(array(
      'admin.models.*',
      'admin.components.*',
      'admin.modules.user.*',
    ));
    Yii::app()->setComponents(array(
      'user' => array(
        'loginUrl' => Yii::app()->createUrl('/admin/login'),
        'class' => 'application.modules.admin.modules.auth.components.AuthWebUser',
    )));
  }

}
