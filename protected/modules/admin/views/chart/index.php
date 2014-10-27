<?php
/* @var $this ChartController */
/* @var $model Chart */


$this->breadcrumbs = array(
  'Графики',
);
?>

<div class="btn-toolbar">
  <?php
  echo TbHtml::linkButton(
      'Добавить график', array(
    'color' => TbHtml::BUTTON_COLOR_PRIMARY,
    'url' => array('create'),
      )
  );
  ?>
</div>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
  'id' => 'chart-grid',
  'dataProvider' => $model->search(),
  'filter' => $model,
  'columns' => array(
    array(
      'name' => 'subscription_type_id',
      'value' => '$data->subscriptionType->portid . " " . $data->subscriptionType->symid',
      'filter' => SubscriptionType::getListOptions(),
    ),
    'start',
    'end',
    array(
      'name' => 'active',
      'value' => '$data->active ? "&#10004;" : ""',
      'type' => 'html',
      'filter' => array(0 => 'Нет', 1 => 'Да'),
    ),
    array(
      'class' => 'bootstrap.widgets.TbButtonColumn',
      'template' => '{update}{delete}',
    ),
  ),
));
?>