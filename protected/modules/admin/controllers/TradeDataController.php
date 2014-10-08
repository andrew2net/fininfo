<?php

class TradeDataController extends Controller {

  /**
   * @return array action filters
   */
  public function filters() {
    return array(
      array('auth.filters.AuthFilter - postdata'), // perform access control for CRUD operations
//      'postOnly + delete', // we only allow deletion via POST request
    );
  }

  public function actionPostdata() {
    Yii::trace('Start', 'post_data');
    if (!(isset($_POST['portid']) && isset($_POST['symid']) && 
        isset($_POST['date']) && isset($_POST['total_net_profit']))) {
      echo 'Not enough options.';
      Yii::app()->end();
    }

    $subscriptionType = SubscriptionType::model()->findByAttributes(array(
      'portid' => $_POST['portid'],
      'symid' => $_POST['symid'],
    ));
    if (is_null($subscriptionType)) {
      echo 'Invalid options.';
      Yii::app()->end();
    }

    $date = date_create_from_format('Ymd', $_POST['date']);
    /* @var $date DateTime */
    $formatDate = $date->format('Y-m-d');
    $tradeData = TradeData::model()->findByAttributes(array('date' => $formatDate));
    /* @var $tradeData TradeData */
    if ($tradeData) {
      if ($tradeData->profit == $_POST['total_net_profit']) {
        echo 'The data alredy passed.';
        Yii::app()->end();
      }
    }
    else {
      $tradeData = new TradeData;
      $tradeData->subscription_type_id = $subscriptionType->id;
      $tradeData->date = $formatDate;
    }

    $tradeData->profit = $_POST['total_net_profit'];

    if ($tradeData->save())
      echo 'Ok';
    else
      echo 'Data write error';

    Yii::app()->end();
  }

  /**
   * Creates a new model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   */
//	public function actionCreate()
//	{
//		$model=new TradeData;
//
//		// Uncomment the following line if AJAX validation is needed
//		// $this->performAjaxValidation($model);
//
//		if (isset($_POST['TradeData'])) {
//			$model->attributes=$_POST['TradeData'];
//			if ($model->save()) {
//				$this->redirect(array('view','id'=>$model->id));
//			}
//		}
//
//		$this->render('create',array(
//			'model'=>$model,
//		));
//	}
//
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
//		// $this->performAjaxValidation($model);
//
//		if (isset($_POST['TradeData'])) {
//			$model->attributes=$_POST['TradeData'];
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
    $model = new TradeData('search');
    $model->unsetAttributes();  // clear any default values
    if (isset($_GET['TradeData'])) {
      $model->attributes = $_GET['TradeData'];
    }

    $this->render('admin', array(
      'model' => $model,
    ));
  }

  /**
   * Returns the data model based on the primary key given in the GET variable.
   * If the data model is not found, an HTTP exception will be raised.
   * @param integer $id the ID of the model to be loaded
   * @return TradeData the loaded model
   * @throws CHttpException
   */
  public function loadModel($id) {
    $model = TradeData::model()->findByPk($id);
    if ($model === null) {
      throw new CHttpException(404, 'The requested page does not exist.');
    }
    return $model;
  }

  /**
   * Performs the AJAX validation.
   * @param TradeData $model the model to be validated
   */
  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'trade-data-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }

}
