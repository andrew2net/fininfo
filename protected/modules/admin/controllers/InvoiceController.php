<?php

class InvoiceController extends Controller {

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
  public function actionUpdate($id) {
    $model = $this->loadModel($id);

    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);

    if (isset($_POST['Invoice'])) {
      $model->attributes = $_POST['Invoice'];
      if ($model->save()) {
        $this->redirect(array('index'));
      }
    }

    $this->render('update', array(
      'model' => $model,
    ));
  }

  /**
   * Deletes a particular model.
   * If deletion is successful, the browser will be redirected to the 'admin' page.
   * @param integer $id the ID of the model to be deleted
   */
//  public function actionDelete($id) {
//    if (Yii::app()->request->isPostRequest) {
//      // we only allow deletion via POST request
//      $this->loadModel($id)->delete();
//
//      // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//      if (!isset($_GET['ajax'])) {
//        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
//      }
//    }
//    else {
//      throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
//    }
//  }

  /**
   * Manages all models.
   */
  public function actionIndex() {
    $model = new Invoice('search');
    $model->unsetAttributes();  // clear any default values
    if (isset($_GET['Invoice'])) {
      $model->attributes = $_GET['Invoice'];
    }

    $this->render('index', array(
      'model' => $model,
    ));
  }

  /**
   * Returns the data model based on the primary key given in the GET variable.
   * If the data model is not found, an HTTP exception will be raised.
   * @param integer $id the ID of the model to be loaded
   * @return Invoice the loaded model
   * @throws CHttpException
   */
  public function loadModel($id) {
    $model = Invoice::model()->findByPk($id);
    if ($model === null) {
      throw new CHttpException(404, 'The requested page does not exist.');
    }
    return $model;
  }

  /**
   * Performs the AJAX validation.
   * @param Invoice $model the model to be validated
   */
  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'invoice-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }

}
