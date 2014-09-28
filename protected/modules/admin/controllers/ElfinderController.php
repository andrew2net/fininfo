<?php

class ElfinderController extends CController {

  public function filters() {
    return array(array('auth.filters.AuthFilter'));
  }

  public function actions() {
    $img_storage = '/images/';
    return array(
      'connector' => array(
        'class' => 'ext.elFinder.ElFinderConnectorAction',
        'settings' => array(
          'root' => Yii::getPathOfAlias('webroot') . $img_storage,
          'URL' => Yii::app()->baseUrl . $img_storage,
          'rootAlias' => 'Home',
          'mimeDetect' => 'none'
        )
      ),
    );
  }

}