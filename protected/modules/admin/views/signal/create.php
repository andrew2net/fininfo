<?php
/* @var $this SignalController */
/* @var $model Signal */
?>

<?php
$this->breadcrumbs=array(
	'Signals'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Signal', 'url'=>array('index')),
	array('label'=>'Manage Signal', 'url'=>array('admin')),
);
?>

<h1>Create Signal</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>