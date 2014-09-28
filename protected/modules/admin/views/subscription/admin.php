<?php

/* @var $this SubscriptionController */
/* @var $model Subscription */


$this->breadcrumbs = array(
  'Подписки',
);
?>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
  'id' => 'subscription-grid',
  'dataProvider' => $model->search(),
  'filter' => $model,
  'columns' => array(
    array(
      'name' => 'uid',
      'value' => '$data->user->username',
    ),
    array(
      'name' => 'subscription_type_id',
      'value' => '$data->subscriptionType->portid . " " . $data->subscriptionType->symid',
      'filter' => SubscriptionType::getListOptions(),
    ),
    'start',
    'end',
//    array(
//      'class' => 'bootstrap.widgets.TbButtonColumn',
//    ),
  ),
));
?>