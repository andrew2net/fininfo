<?php

/**
 * Description of minuteCommand
 *
 */
class MinutelyCommand extends CConsoleCommand {

  public function run($args) {
//    global $argv;
    Yii::import('ext.yii-mail.YiiMailMessage');
    Yii::import('application.modules.admin.modules.user.models.User');
    Yii::import('application.modules.admin.modules.user.models.Profile');
    Yii::import('application.modules.admin.models.Params');
    Yii::import('application.models.Invoice');
    Yii::import('application.models.InvoiceSubscription');
    Yii::import('application.models.SubscriptionType');
    Yii::import('application.models.Signal');
    Yii::import('application.models.Message');
    Yii::import('application.models.MessageSignal');
    Yii::import('application.components.CheckPhone');

    $smsParams = array(
      'api_id' => Params::getValue('SmsGateApiId'),
      'max_price' => Params::getValue('SmsMaxPrice'),
    );

    self::createMessages($smsParams);
//    self::sendMessages($smsParams);
//    $res = self::checkSmsCost('79537658885', $smsParams);
  }

  private static function createMessages(&$smsParams) {
    /* @var $users User[] */
    $users = User::model()->findAll(array(
      'with' => array(
        'profile',
        'invoices' => array(
          'with' => array(
            'subscriptions' => array(
              'with' => array(
                'subscriptionType' => array(
                  'with' => array(
                    'signals' => array(
                      'with' => 'messages',
                      'on' => 'DATE(signals.sigdate)>=start AND DATE(signals.sigdate)<=end',
                    ),
                  ),
                ),
              ),
            ),
          ),
        ),
      ),
      'condition' => 'start<=:date AND end>=:date AND months>0 AND messages.id IS NULL',
      'params' => array(':date' => date('Y-m-d'),
      ),
    ));

    foreach ($users as $user) {
      self::createMessage($user);
      if ($user->profile->send_sms && $user->profile->mobile_phone &&
          CheckPhone::checkSmsCost($user->profile->mobile_phone, $smsParams))
        self::createMessage($user, Message::TRANSPORT_SMS);
    }
  }

  private static function createMessage(User &$user, $transport = Message::TRANSPORT_EMAIL) {
    $tr = Yii::app()->db->beginTransaction();
    try {
      $message = new Message;
      $message->transport_id = $transport;
      $message->type_id = Message::TYPE_SEND_SIGNAL;
      $message->uid = $user->id;
      if ($message->save()) {
        Yii::trace('Save message', 'cron_minutely');
        /* @var $invoice Invoice */
        foreach ($user->invoices as $invoice) {
          Yii::trace('Invoice ' . $invoice->id, 'cron_minutely');
          foreach ($invoice->subscriptions as $subscription) {
            Yii::trace('Subscription ' . $subscription->subscription_type_id . ' signals ' .count($subscription->subscriptionType->signals), 'cron_minutely');
            foreach ($subscription->subscriptionType->signals as $signal) {
              Yii::trace('Signal ' . $signal->id, 'cron_minutely');
              $messageSignal = new MessageSignal;
              $messageSignal->message_id = $message->id;
              $messageSignal->signal_id = $signal->id;
              $res = $messageSignal->save();
              Yii::trace('Signal ' . $signal->id . ' save ' . $res, 'cron_minutely');
            }
          }
        }
      }
      $tr->commit();
    } catch (Exception $ex) {
      Yii::log($ex->getMessage(), CLogger::LEVEL_ERROR, 'cron');
      $tr->rollback();
    }
  }

  private static function sendMessages(&$smsParams) {
//    Yii::trace('Start minutely ' . $conn[1], 'cron');

    $users = User::model()->findAll(array(
      'with' => array(
        'messages' => array(
          'with' => array(
            'signals' => array(
              'with' => array(
                'subscriptionType'),
            ),
          ),
        ),
      ),
      'condition' => 'messages.status_id=1',
      'order' => 'portid, symid',
    ));
    /* @var $users User[] */
    foreach ($users as $user) {
      /* @var $msg Message */
      foreach ($user->messages as $msg) {
        switch ($msg->type_id) {
          case Message::TYPE_SEND_SIGNAL:
            switch ($msg->transport_id) {
              case Message::TRANSPORT_EMAIL:
                $message = new YiiMailMessage;
                $message->setFrom(Yii::app()->params['infoEmail']);
                $message->setTo(array($user->email => $user->profile->first_name . ' ' . $user->profile->last_name));
                $message->view = 'signal';
                $params['message'] = $msg;
                $message->setSubject("Fin-Info signal notification");
                $message->setBody($params, 'text/html');
                $n = Yii::app()->mail->send($message);
                if ($n) {
                  self::saveMsg($msg);
                }
                break;
              case Message::TRANSPORT_SMS:
                if ($user->profile->send_sms && $user->profile->mobile_phone &&
                    CheckPhone::checkSmsCost($user->profile->mobile_phone, $smsParams)) {
                  self::sendSms($msg, $smsParams);
                }
                else {
                  self::saveMsg($msg);
                }
                break;
            }
            break;
        }
      }
    }
  }

  private static function saveMsg($msg) {
    $msg->status_id = 2;
    $msg->sent_time = date('Y-m-d H:i:s');
    if (!$msg->validate()) {
      $result = $msg->getErrors();
      foreach ($result as $item) {
        foreach ($item as $err) {
          Yii::log($err, CLogger::LEVEL_INFO, 'cron');
        }
      }
    }
    else
      $msg->save();
  }

  private static function sendSms(Message &$msg, &$smsParams) {
    $text = array();
    foreach ($msg->signals as $signal)
      $text[] = $signal->subscriptionType->portid . ' '
          . $signal->subscriptionType->symid . ' ' . $signal->sigdate
          . ' ' . $signal->recom . ' ' . $signal->price;
    if ($text) {
      $ch = curl_init('http://sms.ru/sms/send');
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_TIMEOUT, 30);
      curl_setopt($ch, CURLOPT_POSTFIELDS, array(
        "api_id" => $smsParams['api_id'],
        "to" => $msg->user->profile->mobile_phone,
        "text" => implode('\n', $text),
        'partner_id' => '80114',
//        'test' => 1,
      ));
      $body = curl_exec($ch);
      curl_close($ch);
      $res = explode(chr(10), $body);
      if ($res[0] == '100') {
        self::saveMsg($msg);
      }
      else {
        Yii::log("SMS not sent to {$msg->user->profile->mobile_phone} ({$msg->user->username}). Responce code {$res[0]}"
            , CLogger::LEVEL_WARNING, 'sms_send');
      }
    }
  }

}
