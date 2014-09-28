<?php
/* @var $this PageController */
/* @var $model Page */
?>

<?php
$this->breadcrumbs=array(
	'Страницы'=>array('admin'),
	'Новая',
);
?>

<h3>Новая страница</h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
