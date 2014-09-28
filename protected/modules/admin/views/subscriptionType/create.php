<?php
/* @var $this SubscriptionTypeController */
/* @var $model SubscriptionType */

$this->breadcrumbs=array(
	'Виды подписок'=>array('index'),
	'Новый',
);

$this->menu=array(
	array('label'=>'List SubscriptionType', 'url'=>array('index')),
	array('label'=>'Manage SubscriptionType', 'url'=>array('admin')),
);
?>

<h1>Вид подписки <i>Новый</i></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>