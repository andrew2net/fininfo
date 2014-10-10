<?php
/* @var $this PrivateController */

$this->pageTitle = Yii::app()->name . ' - Private';
$this->breadcrumbs = array(
  'Private',
  'Subscription'
);
?>
<div id="content">
  <?php $this->renderPartial('_leftMenu'); ?>
  <div>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
      'dataProvider' => new CActiveDataProvider('Subscription', array(
        'criteria' => array(
          'condition' => 'uid=:uid',
          'params' => array(':uid' => Yii::app()->user->id),
        ))),
      'columns' => array(
        'subscriptionType',
        'start',
        'end',
      ),
      'cssFile' => Yii::app()->theme->baseUrl . '/css/gridView.css',
    ));
    ?>
  </div>
  <?php $this->renderPartial('/site/_rightColumn'); ?>
</div>