<?php
/* @var $profile Profile */
/* @var $message array */
/* @var $this CController */
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
  </head>
  <body>
    <?php
    echo CHtml::tag('div', array('style' => 'font-size:16pt;font-weight:bold;margin-bottom:1em'), 'Hello, ' . $profile->first_name . ' ' . $profile->last_name . '!');
    echo CHtml::tag('div', array(), 'You have requested the password recovery site '.$message['site_name']);
    echo CHtml::tag('div', array(), 'To receive a new password, go to ', FALSE);
    echo CHtml::tag('a', array('href'=>$message['activation_url']), $message['activation_url']);
    echo CHtml::closeTag('div');
    $this->renderInternal(dirname(__FILE__) . '/_footer.php');
    ?>
  </body>
</html>
