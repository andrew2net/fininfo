<?php
/* @var $this SiteController */
/* @var $model Page */

$cs = Yii::app()->clientScript;
$cs->registerScriptFile('https://www.google.com/jsapi', CClientScript::POS_END);
$cs->registerScriptFile('/js/gchart.js', CClientScript::POS_END);

$this->pageTitle = Yii::app()->name;
?>

<div id="content">
  <?php $this->renderPartial('_newsBlock'); ?>
  <div>
    <div id="chart-cont"></div>
    <div><?php echo $model->content; ?></div>
  </div>
  <?php $this->renderPartial('_rightColumn'); ?>
</div>
