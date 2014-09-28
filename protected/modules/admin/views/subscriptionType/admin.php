<?php
/* @var $this SubscriptionTypeController */
/* @var $model SubscriptionType */

$this->breadcrumbs=array(	'Виды подписок');
?>

<div class="btn-toolbar">
  <?php
  echo TbHtml::linkButton(
      'Добавить вид подписки', array(
    'color' => TbHtml::BUTTON_COLOR_PRIMARY,
    'url' => array('create'),
      )
  );
  ?>
</div>

  <?php $this->widget('ext.bootstrap.widgets.TbGridView', array(
	'id'=>'subscription-type-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'portid',
		'symid',
		'price',
		array(
			'class'=>'ext.bootstrap.widgets.TbButtonColumn',
      'template' => '{update}{delete}',
		),
	),
)); ?>
