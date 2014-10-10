<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<div id="content">
  <?php $this->renderPartial('_newsBlock'); ?>
  <div></div>
  <?php $this->renderPartial('_rightColumn'); ?>
</div>