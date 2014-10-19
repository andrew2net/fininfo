<?php
/* @var $this PrivateController */

$this->pageTitle = Yii::app()->name . ' - Your subscriptions';
$this->breadcrumbs = array(
  'Your subscriptions'
);
?>
<div id="content">
  <?php $this->renderPartial('_leftMenu'); ?>
  <div>
    <h2>Your subscriptions</h2>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
      'dataProvider' => new CActiveDataProvider('InvoiceSubscription', array(
        'criteria' => array(
          'with' => array('invoice'),
          'condition' => 'uid=:uid AND months>0',
          'params' => array(':uid' => Yii::app()->user->id),
        ))),
      'columns' => array(
        array(
          'name'=>'subscription_type_id',
          'value' => '$data->subscriptionType->portid . " " . $data->subscriptionType->symid',
          ),
        'start',
        'end',
        array(
          'name' => 'autorenew',
          'value' => '$data->autorenew ? "&#10004;" : ""',
          'type' => 'html',
        ),
        array(
          'class'=>'CButtonColumn',
          'template' => '{unsubscribe}',
          'buttons' => array(
            'unsubscribe' => array(
              'label' => 'Unsubscribe',
              'urll' => '/private/unsubscribe',
              'options' => array('class' => 'button'),
              'visible' => '$data->autorenew && (new DateTime) <= (new DateTime($data->end))',
            ),
          ),
        ),
      ),
      'template' => '{items}',
      'emptyText' => "You haven't subscriptions",
      'cssFile' => Yii::app()->theme->baseUrl . '/css/gridView.css',
    ));
    ?>
  </div>
  <?php $this->renderPartial('/site/_rightColumn'); ?>
</div>