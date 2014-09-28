<?php
/* @var $this PageController */
/* @var $model Page */
?>

<?php
$this->breadcrumbs = array(
  'Страницы' => array('admin'),
//	$model->title=>array('view','id'=>$model->id),
  'Изменение',
);
?>

<h3>Изменение страницы <?php echo $model->title; ?></h3>

<?php $this->renderPartial('_form', array('model' => $model)); ?>
