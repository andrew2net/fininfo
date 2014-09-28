<?php

class SignalController extends Controller {

  /**
   * @return array action filters
   */
  public function filters() {
    return array(
      array('auth.filters.AuthFilter - postsignal'), // perform access control for CRUD operations
//			'postOnly + delete', // we only allow deletion via POST request
    );
  }

  public function actionPostsignal() {
    if (!(isset($_GET['portid']) || isset($_GET['symid']) || isset($_GET['recom']) ||
        isset($_GET['sigdate']) || isset($_GET['price']))) {
      echo 'Not enough options.';
      Yii::app()->end();
    }

    $subscriptionType = SubscriptionType::model()->findByAttributes(array(
      'portid' => $_GET['portid'],
      'symid' => $_GET['symid'],
    ));
    if (is_null($subscriptionType)) {
      echo 'Invalid options.';
      Yii::app()->end();
    }

    $sigdate = Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss', $_GET['sigdate']);
    $signal = Signal::model()->findByAttributes(array('sigdate' => $sigdate));
    if ($signal) {
      if ($signal->price == $_GET['price']) {
        echo 'The signal alredy passed.';
        Yii::app()->end();
      }
      else {
        $signal = new Signal;
        $signal->subscription_type_id = $subscriptionType->id;
        $signal->recom = $_GET['recom'];
        $signal->sigdate = $sigdate;
      }
    }

    $signal->price = $_GET['price'];

    if ($signal->save())
      echo 'Ok';
    else
      echo 'Signal wite error';

    Yii::app()->end();
  }

  /**
   * Creates a new model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   */
//	public function actionCreate()
//	{
//		$model=new Signal;
//
//		// Uncomment the following line if AJAX validation is needed
//		 $this->performAjaxValidation($model);
//
//		if (isset($_POST['Signal'])) {
//			$model->attributes=$_POST['Signal'];
//			if ($model->save()) {
//				$this->redirect(array('view','id'=>$model->id));
//			}
//		}
//
//		$this->render('create',array(
//			'model'=>$model,
//		));
//	}

  /**
   * Updates a particular model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id the ID of the model to be updated
   */
//	public function actionUpdate($id)
//	{
//		$model=$this->loadModel($id);
//
//		// Uncomment the following line if AJAX validation is needed
//		 $this->performAjaxValidation($model);
//
//		if (isset($_POST['Signal'])) {
//			$model->attributes=$_POST['Signal'];
//			if ($model->save()) {
//				$this->redirect(array('view','id'=>$model->id));
//			}
//		}
//
//		$this->render('update',array(
//			'model'=>$model,
//		));
//	}

  /**
   * Deletes a particular model.
   * If deletion is successful, the browser will be redirected to the 'admin' page.
   * @param integer $id the ID of the model to be deleted
   */
//	public function actionDelete($id)
//	{
//		if (Yii::app()->request->isPostRequest) {
//			// we only allow deletion via POST request
//			$this->loadModel($id)->delete();
//
//			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//			if (!isset($_GET['ajax'])) {
//				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
//			}
//		} else {
//			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
//		}
//	}

  /**
   * Manages all models.
   */
  public function actionIndex() {
    $model = new Signal('search');
    $model->unsetAttributes();  // clear any default values
    if (isset($_GET['Signal'])) {
      $model->attributes = $_GET['Signal'];
    }

    $this->render('admin', array(
      'model' => $model,
    ));
  }

  /**
   * Returns the data model based on the primary key given in the GET variable.
   * If the data model is not found, an HTTP exception will be raised.
   * @param integer $id the ID of the model to be loaded
   * @return Signal the loaded model
   * @throws CHttpException
   */
//	public function loadModel($id)
//	{
//		$model=Signal::model()->findByPk($id);
//		if ($model===null) {
//			throw new CHttpException(404,'The requested page does not exist.');
//		}
//		return $model;
//	}

  /**
   * Performs the AJAX validation.
   * @param Signal $model the model to be validated
   */
//	protected function performAjaxValidation($model)
//	{
//		if (isset($_POST['ajax']) && $_POST['ajax']==='signal-form') {
//			echo CActiveForm::validate($model);
//			Yii::app()->end();
//		}
//	}
}
