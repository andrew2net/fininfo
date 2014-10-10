<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle = Yii::app()->name . ' - Error';
$this->breadcrumbs = array(
  'Error',
);
?>
<div id="content">
  <?php $this->renderPartial('_rightColumn'); ?>
  <?php $this->renderPartial('_newsBlock'); ?>
  <div>
    <h1>Error <?php echo $code; ?></h1>
    <div class="error">
      <?php echo CHtml::encode($message); ?>
    </div>
  </div>
</div>