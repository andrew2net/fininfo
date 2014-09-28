<?php
/* @var $this NewsController */
/* @var $model News */
?>

<?php
$this->breadcrumbs=array(
	'Новости'=>array('index'),
	'Изменение',
);

?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>