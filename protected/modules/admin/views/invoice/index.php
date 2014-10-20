<?php

/* @var $this InvoiceController */
/* @var $model Invoice */


$this->breadcrumbs = array(
  'Счета',
);
$this->widget('bootstrap.widgets.TbGridView', array(
  'id' => 'invoice-grid',
  'dataProvider' => $model->search(),
  'filter' => $model,
  'columns' => array(
    'id',
    'date',
    array(
      'name' => 'user.username',
      'value' => '$data->user->username',
      'filter' => CHtml::activeTextField($model, 'subscriber'),
    ),
    array(
      'name' => 'sumMonth',
      'value' => '$data->sumMonth',
      'filter' => FALSE,
    ),
    array(
      'name' => 'paySumm',
      'value' => 'number_format($data->paySumm, 2, ".", " ")',
      'filter' => FALSE,
    ),
    array(
      'class' => 'bootstrap.widgets.TbButtonColumn',
      'template' => '{update}'
    ),
  ),
));
?>