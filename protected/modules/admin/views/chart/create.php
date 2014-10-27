<?php

/* @var $this ChartController */
/* @var $model Chart */
?>

<?php

$this->breadcrumbs = array(
  'Графики' => array('index'),
  'Новый',
);

$this->renderPartial('_form', array('model' => $model));
?>