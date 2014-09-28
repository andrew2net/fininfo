<?php
/* @var $this PageController */
/* @var $model Page */


$this->breadcrumbs = array(
  'Страницы',
);
?>

<div class="btn-toolbar">
  <?php
  echo TbHtml::linkButton(
      'Добавить страницу', array(
    'color' => TbHtml::BUTTON_COLOR_PRIMARY,
    'url' => array('create'),
      )
  );
  ?>
</div>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
  'id' => 'page-grid',
  'dataProvider' => $model->search(),
//  'filter' => $model,
  'columns' => array(
    'url',
    'title',
    'menu_show',
    array(
      'class' => 'bootstrap.widgets.TbButtonColumn',
    ),
  ),
));
?>