<?php

/**
 * Description of CheckPhone
 *
 */
class CheckPhone {

  public static function checkSmsCost($phone, &$smsParams) {
    $ch = curl_init("http://sms.ru/sms/cost");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array(
      "api_id" => $smsParams['api_id'],
      "to" => $phone,
    ));
    $body = curl_exec($ch);
    curl_close($ch);
    $result = explode(chr(10), $body);
    return $result[0] == '100' && !($result[1] > $smsParams['max_price']);
  }

}
