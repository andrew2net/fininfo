<?php
/* @var $this InvoiceController */
/* @var $model Invoice */
?>

<?php
$this->breadcrumbs=array(
	'Счета'=>array('index'),
	'Просмотр',
);

$this->menu=array(
	array('label'=>'List Invoice', 'url'=>array('index')),
	array('label'=>'Create Invoice', 'url'=>array('create')),
	array('label'=>'View Invoice', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Invoice', 'url'=>array('admin')),
);
?>

<h1>Просмотр счета <i>#<?php echo $model->id; ?></i></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>