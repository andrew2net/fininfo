<?php
/* @var $this SubscriptionTypeController */
/* @var $model SubscriptionType */

$this->breadcrumbs=array(
	'Виды подписок'=>array('index'),
	'Изменение',
);

$this->menu=array(
	array('label'=>'List SubscriptionType', 'url'=>array('index')),
	array('label'=>'Create SubscriptionType', 'url'=>array('create')),
	array('label'=>'View SubscriptionType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SubscriptionType', 'url'=>array('admin')),
);
?>

<h1>Изменение вида подписки <i><?php echo $model->portid. ' ' . $model->symid; ?></i></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>