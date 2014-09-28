<?php

/**
 * Description of AdminModule
 *
 */
class AdminModule extends CWebModule {

  public $defaultController = 'subscription';
  
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
    
    Yii::app()->bootstrap->register();
  }

}
