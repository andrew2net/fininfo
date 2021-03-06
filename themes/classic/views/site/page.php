<?php
/* @var $this PageController */
/* @var $model Page */

$this->pageTitle = Yii::app()->name . ' - ' . $model->title;

$this->breadcrumbs = array(
  $model->title,
);
?>

<div id="content">
  <?php $this->renderPartial('_newsBlock'); ?>
  <div style="padding: 0 20px;">
    <?php echo $model->content; ?>
  </div>
  <?php $this->renderPartial('_rightColumn'); ?>
</div>
