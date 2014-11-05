<?php

class ParamsController extends Controller {

  /**
   * @return array action filters
   */
  public function filters() {
    return array(
      array('auth.filters.AuthFilter'),
      'postOnly + delete', // we only allow deletion via POST request
    );
  }

  /**
   * Updates a particular model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id the ID of the model to be updated
   */
  public function actionIndex() {
    $models = Params::model()->findAll(array('order' => 'weight'));

    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);

    if (isset($_POST['Params'])) {
      $valid = TRUE;
      foreach ($_POST['Params'] as $key => $param) {
        $models[$key]->attributes = $param;
        $valid = $models[$key]->save() && $valid;
      }
      if ($valid) {
        $this->redirect(array('index'));
      }
    }

    $this->render('update', array(
      'models' => $models,
    ));
  }

  /**
   * Returns the data model based on the primary key given in the GET variable.
   * If the data model is not found, an HTTP exception will be raised.
   * @param integer $id the ID of the model to be loaded
   * @return Params the loaded model
   * @throws CHttpException
   */
  public function loadModel($id) {
    $model = Params::model()->findByPk($id);
    if ($model === null) {
      throw new CHttpException(404, 'The requested page does not exist.');
    }
    return $model;
  }

  /**
   * Performs the AJAX validation.
   * @param Params $model the model to be validated
   */
  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'params-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }

}
