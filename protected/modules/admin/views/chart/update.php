<?php

/* @var $this ChartController */
/* @var $model Chart */
?>

<?php

$this->breadcrumbs = array(
  'Графики' => array('index'),
  'Изменение',
);

$this->renderPartial('_form', array('model' => $model));
?>