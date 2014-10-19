<?php
/* @var $this PrivateController */
/* @var $dataCart CArrayDataProvider */

$this->pageTitle = Yii::app()->name . ' - Subscribe';
$this->breadcrumbs = array(
  'Subscribe'
);
?>
<div id="content">
  <?php $this->renderPartial('_leftMenu'); ?>
  <div>
    <h2>Subscriptions</h2>
    <?php
//    $form = $this->beginWidget('CActiveForm');

    $this->widget('ListView', array(
      'dataProvider' => $dataCart,
      'headerView' => '_subscribeHeader',
      'itemView' => '_subscribeItem',
//      'viewData' => array('form' => $form),
      'cssFile' => Yii::app()->theme->baseUrl . '/css/subscribeListView.css',
      'htmlOptions' => array('class' => 'subscribe-list-view'),
      'template' => '{header}{items}'
    ));
    ?>
    <!--<div>-->
      <?php
//      echo CHtml::submitButton('Subscribe', array(
//        'class' => 'button',
//        'style' => 'float:right;margin:30px',
//      ));
      ?>
    <!--</div>-->
    <?php // $this->endWidget(); ?>
  </div>
</div>