<?php
/* @var $this PayMethodController */
/* @var $model PayMethod */
?>

<?php
$this->breadcrumbs=array(
	'Виды оплаты'=>array('index'),
	'Новый',
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>