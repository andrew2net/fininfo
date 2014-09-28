<?php
/* @var $this SubscriptionController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Subscriptions',
);

$this->menu=array(
	array('label'=>'Create Subscription','url'=>array('create')),
	array('label'=>'Manage Subscription','url'=>array('admin')),
);
?>

<h1>Subscriptions</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>