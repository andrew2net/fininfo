<?php
/* @var $this SiteController */
/* @var $model News */

$this->pageTitle = Yii::app()->name . ' - ' . $model->header;
$this->breadcrumbs = array(
  $model->header,
);
?>
<div id="content">
  <?php $this->renderPartial('_newsBlock'); ?>
  <div style="padding: 0 20px;">
    <?php echo $model->text; ?>
  </div>
  <?php $this->renderPartial('_rightColumn'); ?>
</div>
