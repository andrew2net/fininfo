<?php
/* @var $this TradeDataController */
/* @var $model TradeData */
?>

<?php
$this->breadcrumbs=array(
	'Trade Datas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TradeData', 'url'=>array('index')),
	array('label'=>'Manage TradeData', 'url'=>array('admin')),
);
?>

<h1>Create TradeData</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>