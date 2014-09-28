<?php
/* @var $this PageController */
/* @var $model Page */
?>

<?php
$this->breadcrumbs = array(
  'Страницы' => array('/admin/page'),
  $model->title,
);
?>

<?php
echo $model->content;
?>
