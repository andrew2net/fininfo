<?php
/* @var $this PrivateController */

$this->pageTitle = Yii::app()->name . ' - Your orders';
$this->breadcrumbs = array(
  'Your orders'
);
?>
<div id="content">
  <?php $this->renderPartial('_leftMenu'); ?>
  <div>
    <h2>Your orders</h2>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
      'dataProvider' => new CActiveDataProvider('Invoice', array(
        'criteria' => array(
          'condition' => 'uid=:uid',
          'params' => array(':uid' => Yii::app()->user->id),
        ))),
      'columns' => array(
        'id',
        'date',
        'sumMonth',
//        array(
//          'name' =>'paySumm',
//          'value' => 'number_format($data->paySumm, 2, ".", " ")',
//          ),
        array(
          'class' => 'CButtonColumn',
          'template' => '{pay}{view}',
          'viewButtonUrl' => 'Yii::app()->createUrl("/private/order", array("id" => $data->id))',
          'buttons' => array(
            'view' => array(
              'visible' => '$data->sumMonth <= $data->paySumm',
            ),
            'pay' => array(
              'label' => 'Pay',
              'url' => 'Yii::app()->createUrl("/private/order", array("id" => $data->id))',
              'visible' => '$data->sumMonth > $data->paySumm',
              'options' => array('class' => 'button'),
            ),
          ),
        ),
      ),
      'template' => '{items}',
      'emptyText' => "You haven't invoices",
      'cssFile' => Yii::app()->theme->baseUrl . '/css/gridView.css',
    ));
    ?>
  </div>
  <?php $this->renderPartial('/site/_rightColumn'); ?>
</div>