<?php
/* @var $this NewsController */
/* @var $model News */
?>

<?php
$this->breadcrumbs=array(
	'Новости'=>array('index'),
	'Новая',
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>