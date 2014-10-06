<?php
/* @var $this TradeDataController */
/* @var $model TradeData */


$this->breadcrumbs=array(
	'Результаты торгов',
);
?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'trade-data-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
    array(
      'name' => 'subscription_type_id',
      'value' => '$data->subscriptionType->portid . " " . $data->subscriptionType->symid',
      'filter' => SubscriptionType::getListOptions(),
    ),
		'date',
		'profit',
//		array(
//			'class'=>'bootstrap.widgets.TbButtonColumn',
//		),
	),
)); ?>