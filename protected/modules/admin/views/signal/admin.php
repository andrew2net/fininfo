<?php

/* @var $this SignalController */
/* @var $model Signal */


$this->breadcrumbs = array(
  'Сигналы',
);
?>

<?php

$this->widget('bootstrap.widgets.TbGridView', array(
  'id' => 'signal-grid',
  'dataProvider' => $model->search(),
  'filter' => $model,
  'columns' => array(
    array(
      'name' => 'subscription_type_id',
      'value' => '$data->subscriptionType->portid . " " . $data->subscriptionType->symid',
      'filter' => SubscriptionType::getListOptions(),
    ),
    'recom',
    'sigdate',
    'price',
  ),
));
?>