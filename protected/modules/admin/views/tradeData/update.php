<?php
/* @var $this TradeDataController */
/* @var $model TradeData */
?>

<?php
$this->breadcrumbs=array(
	'Trade Datas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TradeData', 'url'=>array('index')),
	array('label'=>'Create TradeData', 'url'=>array('create')),
	array('label'=>'View TradeData', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TradeData', 'url'=>array('admin')),
);
?>

    <h1>Update TradeData <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>