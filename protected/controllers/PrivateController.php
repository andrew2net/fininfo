<?php

/**
 * Description of PrivateController
 *
 */
class PrivateController extends Controller {

  public function filters() {
    return array(
      array('application.modules.admin.modules.auth.filters.AuthFilter'),
      'postOnly + delete', // we only allow deletion via POST request
    );
  }

  public function actionIndex() {

    $this->render('index');
  }

  public function actionOrder($id) {
    $invoice = Invoice::model()->findByPk($id, 'uid=:uid', array(':uid' => Yii::app()->user->id));
    $payMethod = PayMethod::model()->find('active=1');
    $this->render('invoice', array(
      'invoice' => $invoice,
      'payMethod' => $payMethod,
    ));
  }

  public function actionResult() {
    $this->render('resultLiqPay');
  }

  public function actionOrders() {
    $this->render('invoices');
  }

  public function actionSubscribe() {
    $uid = Yii::app()->user->id;

    $data = SubscriptionType::model()->findAll();
    $newSubscr = array('start' => date('Y-m-d'), 'months' => 0);
    foreach ($data as &$item) {
      /* @var $item SubscriptionType */
      $invSubscr = new InvoiceSubscription;
      $invSubscr->attributes = $newSubscr;
      $subscriptions[$item->id] = array(
        'id' => $item->id,
        'portid' => $item->portid,
        'symid' => $item->symid,
        'description' => $item->description,
        'price' => $item->price,
        'invoiceSubscription' => $invSubscr,
      );
    }

    if (isset($_POST['InvoiceSubscription'])) {

      $valid = true;
      $invSubscription = array();
      foreach ($_POST['InvoiceSubscription'] as $key => $value) {
        $subscriptions[$key]['invoiceSubscription']->attributes = $value;
//        if ($subscriptions[$key]['invoiceSubscription']->months > 0) {
        $invSubscription[$key] = $subscriptions[$key]['invoiceSubscription'];
        $invSubscription[$key]->price = $subscriptions[$key]['price'];
        $valid = $invSubscription[$key]->validate(array('start', 'autorenew', 'price')) && $valid;
//        }
      }
      if ($valid && $invSubscription) {
        $tr = Yii::app()->db->beginTransaction();
        try {
          $invoice = new Invoice;
          $invoice->date = date('Y-m-d H:i:s');
          $invoice->uid = $uid;
          if ($invoice->save()) {
            foreach ($invSubscription as $key => $value) {
              $value->invoice_id = $invoice->id;
              $value->subscription_type_id = $key;
              $value->validate();
              $err = $value->getErrors();
              $value->save();
            }
            $tr->commit();
            $this->redirect($this->createUrl('/private/order', array('id' => $invoice->id)));
          }
        } catch (Exception $ex) {
          $tr->rollback();
          throw $ex;
        }
      }
    }

    $dataCart = new CArrayDataProvider($subscriptions, array('id' => 'id'));
    $this->render('subscribe', array('dataCart' => $dataCart));
  }

  public function actionProfile() {
    $uid = Yii::app()->user->id;
    $profile = Profile::model()->findByPk($uid);
    $user = User::model()->findByPk($uid);
    
    if (isset($_POST['Profile'])) {
      $phoneConfirm = $_POST['Profile']['mobile_phone'] == $profile->mobile_phone && $profile->phone_confirm;
      $profile->attributes = $_POST['Profile'];
      if ($profile->validate()) {
        $profile->phone_confirm = $phoneConfirm;
        $profile->save();
      }
    }
    $this->render('profile', array('profile' => $profile, 'user' => $user));
  }

}
