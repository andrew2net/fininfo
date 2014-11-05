<?php
/* @var $this SiteController */
/* @var $data News */
?>
<div>
  <a href="<?php echo Yii::app()->createUrl('site/news', array('id' => $data->id)); ?>">
    <div>
      <div><?php echo $data->date; ?></div>
      <div><?php echo $data->header; ?></div>
    </div>
  </a>
</div>