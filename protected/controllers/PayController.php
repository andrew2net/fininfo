<?php

/**
 * Description of PayController
 *
 */
class PayController extends Controller {

  public function actionLiqPayNotify() {
//    foreach ($_POST as $key => $value)
//      Yii::trace($key . ' => ' . $value, 'pay_notify');

    $pay = PayMethod::model()->find('active=1');
    /* @var $pay PayMethod */
    $string = $pay->sign_key;

    if (isset($_POST['amount']))
      $string .= $_POST['amount'];
    else
      throw new CHttpException('400');

    if (isset($_POST['currency']))
      $string .= $_POST['currency'];
    else
      throw new CHttpException('400');

    if (isset($_POST['public_key']))
      $string .= $_POST['public_key'];
    else
      throw new CHttpException('400');

    if (isset($_POST['order_id']))
      $string .= $_POST['order_id'];
    else
      throw new CHttpException('400');

    if (isset($_POST['type']))
      $string .= $_POST['type'];
    else
      throw new CHttpException('400');

    if (isset($_POST['description']))
      $string .= $_POST['description'];
    else
      throw new CHttpException('400');

    if (isset($_POST['status']))
      $string .= $_POST['status'];
    else
      throw new CHttpException('400');

    if (isset($_POST['transaction_id']))
      $string .= $_POST['transaction_id'];
    else
      throw new CHttpException('400');

    if (isset($_POST['sender_phone']))
      $string .= $_POST['sender_phone'];
    else
      throw new CHttpException('400');

    if (!isset($_POST['signature']))
      throw new CHttpException('400');

    $sign = base64_encode(sha1($string, 1));

    if ($_POST['signature'] != $sign)
      throw new CHttpException('401');

    $order = Invoice::model()->findByPk($_POST['order_id']);
    /* @var $order Invoice */
    if (!$order)
      throw new CHttpException('404');

    $profile = Profile::model()->findByPk($order->uid);
    if (is_null($profile)) {
      $profile = new Profile;
      $profile->user_id = $order->uid;
    }
    if (empty($profile->mobile_phone)) {
      $profile->mobile_phone = $_POST['sender_phone'];
      $profile->phone_confirm = true;
    }
    $profile->save();

    $payment = Payment::model()->findByAttributes(array('operation_id' => $_POST['transaction_id']));
    if (is_null($payment)) {
      $payment = new Payment;
      $payment->operation_id = $_POST['transaction_id'];
      $payment->time = date('Y-m-d H:i:s');
    }
    $payment->attributes = $_POST;
    $payment->invoice_id = $_POST['order_id'];
    if (!$payment->save())
      throw new CHttpException('501');

    if ($order->sumFuture <= $order->paySumm) {
      foreach ($order->subscriptions as $subscription) {
        $start = new DateTime($subscription->start);
        $currentDate = new DateTime;
        if ($subscription->months == 0 && $start < $currentDate) {
          $start = $currentDate;
          $subscription->start = $start->format('Y-m-d');
        }
        $subscription->months += 1;
        $end = $start;
        $end->add(new DateInterval('P' . $subscription->months . 'M'));
        $end->sub(new DateInterval('P1D'));
        $subscription->end = $end->format('Y-m-d');
        $subscription->save();
      }
    }
    Yii::app()->end();
  }

}
