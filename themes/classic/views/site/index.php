<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<div id="content">
  <?php $this->renderPartial('_signalBlock'); ?>
  <?php $this->renderPartial('_newsBlock'); ?>
</div>