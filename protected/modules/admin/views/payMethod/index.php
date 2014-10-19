<?php
/* @var $this PayMethodController */
/* @var $model PayMethod */


$this->breadcrumbs=array(
	'Виды оплаты',
);
?>
<div class="btn-toolbar">
  <?php
  echo TbHtml::linkButton('Добавить вид оплаты', array(
    'color' => TbHtml::BUTTON_COLOR_PRIMARY,
    'url' => '/admin/payMethod/create',
  ));
  ?>
</div>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'pay-method-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name',
		'description',
		array(
      'name'=>'type_id',
      'value' => '$data->type',
      'filter' => PayMethod::getTypes(),
      ),
    array(
      'name'=>'active',
      'value' => '$data->active ? "&#10003;" : ""',
      'type' => 'html',
      'filter' => TbHtml::activeDropDownList($model, 'active', array(0=>'False', 1=>'True'), array('prompt' => '')),
      ),
		/*
		'action_url',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
      'template' => '{update}{delete}',
		),
	),
)); ?>