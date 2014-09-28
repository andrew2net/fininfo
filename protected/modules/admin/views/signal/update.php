<?php
/* @var $this SignalController */
/* @var $model Signal */
?>

<?php
$this->breadcrumbs=array(
	'Signals'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Signal', 'url'=>array('index')),
	array('label'=>'Create Signal', 'url'=>array('create')),
	array('label'=>'View Signal', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Signal', 'url'=>array('admin')),
);
?>

    <h1>Update Signal <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>