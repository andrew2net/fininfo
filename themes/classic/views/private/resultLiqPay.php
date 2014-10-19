<?php
/* @var $this PrivateController */

$this->pageTitle = Yii::app()->name . ' - Payment is processed';
$this->breadcrumbs = array(
  'Payment is processed'
);
?>
<div id="content">
  <?php $this->renderPartial('_leftMenu'); ?>
  <div>
    <h2>Paiment is processed</h2>
    <div>Your paiment is processed. It will take a few minutes.<br>
      You can check the status of your order under <?php echo CHtml::link('"Your orders"', '/private/orders'); ?>.</div>
  </div>
  <?php $this->renderPartial('/site/_rightColumn'); ?>
</div>