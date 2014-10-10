<?php
/* @var $this SignupController */
/* @var $user Registration */
/* @var $profile Profile */

$this->pageTitle = Yii::app()->name . ' - Registration';
?>
<div id="content">
  <?php $this->renderPartial('/site/_newsBlock'); ?>
  <?php $this->renderPartial('_regform', array('user' => $user, 'profile' => $profile)); ?>
  <div style="width: 19%"></div>
</div>