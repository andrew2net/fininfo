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
    if (isset($_POST['inv_id']) && isset($_POST['type_id'])) {
      /* @var $subscription InvoiceSubscription */
      $subscription = InvoiceSubscription::model()->findByAttributes(array(
        'invoice_id' => $_POST['inv_id'],
        'subscription_type_id' => $_POST['type_id'],
      ));
      if ($subscription) {
        Yii::import('ext.LiqPay');
        /* @var $payMethod PayMethod */
        $payMethod = PayMethod::model()->findByAttributes(array('active' => 1, 'type_id' => 1));
        $liqpay = new LiqPay($payMethod->shop_id, $payMethod->sign_key);
        $res = $liqpay->api('payment/unsubscribe', array('order_id' => $_POST['inv_id']));

        if ($res->result == 'ok') {
          $subscription->autorenew = FALSE;
          $subscription->save();
        }
        elseif ($res->result == 'error') {
          Yii::app()->user->setFlash('unsubscribe_error', 'An error occurred during the operation: ' . $res->description);
        }

        $this->redirect('/private/index');
      }
    }

    $subscriptions = new CActiveDataProvider('InvoiceSubscription', array(
      'criteria' => array(
        'with' => array('invoice'),
        'condition' => 'uid=:uid AND months>0',
        'params' => array(':uid' => Yii::app()->user->id),
    )));
    $this->render('index', array('subscriptions' => $subscriptions));
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
    
    $autorenewSubscriptionSql = Yii::app()->db->createCommand()->select('subscription_type_id')
        ->from('{{invoice_subscription}}')->leftJoin('{{invoice}}', 'id=invoice_id')
        ->where('uid=:uid AND autorenew=1')->getText();
    
    $data = SubscriptionType::model()->findAll("id NOT IN($autorenewSubscriptionSql)", array(':uid'=>$uid));
    foreach ($data as &$item) {
      /* @var $item SubscriptionType */
      /* @var $currentSubscription InvoiceSubscription */
      $currentSubscription = InvoiceSubscription::model()->find(array(
        'select' => 'MAX(end) as lastDate',
        'with' => array('invoice'),
        'condition' => 'uid=:uid',
        'params' => array(':uid' => $uid),
      ));
      $lastDate = new DateTime($currentSubscription->lastDate);
      $lastDate->add(new DateInterval('P1D'));
      $date = new DateTime;
      $invSubscr = new InvoiceSubscription;
      $invSubscr->start = $lastDate > $date ? $lastDate->format('Y-m-d') : $date->format('Y-m-d');
      $invSubscr->months = 0;
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
    
    $smsParams = array(
      'api_id' => Params::getValue('SmsGateApiId'),
      'max_price' => Params::getValue('SmsMaxPrice'),
    );
    $smsAvailable = CheckPhone::checkSmsCost($profile->mobile_phone, $smsParams);

    $this->render('profile', array('profile' => $profile, 'user' => $user, 'smsAvailable' => $smsAvailable));
  }

  public function actionGetLastSignals(){
    if (isset($_POST['signals']))
      $currentSignals = $_POST['signals'];
    else 
      $currentSignals = array();
    
    $this->renderPartial('/site/_signalBlock', array('currentSignals' => $currentSignals));
  }
}
