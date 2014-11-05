<?php
/* @var $this ParamsController */
/* @var $model Params */
?>

<?php
$this->breadcrumbs=array(
	'Params'=>array('index'),
	$model->name,
);
?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'weight',
		'name',
		'value',
	),
)); ?>