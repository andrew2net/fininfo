<?php
/* @var $this PageController */
/* @var $model Page */
?>

<?php
$this->breadcrumbs = array(
  $model->title,
);
?>

<div id="content">
  <?php $this->renderPartial('_rightColumn'); ?>
  <?php $this->renderPartial('_newsBlock'); ?>
  <div style="padding: 0 20px;">
    <?php echo $model->content; ?>
  </div>
</div>
