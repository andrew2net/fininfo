<?php
/* @var $this NewsController */
/* @var $model News */


$this->breadcrumbs=array(
	'Новости',
);
?>

<div class="btn-toolbar">
  <?php
  echo TbHtml::linkButton(
      'Добавить новость', array(
    'color' => TbHtml::BUTTON_COLOR_PRIMARY,
    'url' => array('create'),
      )
  );
  ?>
</div>

<?php

$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'news-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'date',
		'header',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
      'template' => '{update}{delete}',
		),
	),
)); ?>