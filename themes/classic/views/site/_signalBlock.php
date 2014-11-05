<?php
/* @var $this Controller */
/* @var $currentSignals array */
?>


<div class="bold" style="margin: 5px; font-size: 12pt">Last signal</div>
<?php
$currentSubscription = Yii::app()->db->createCommand()->select('subscription_type_id')
    ->from('{{invoice_subscription}}')->leftJoin('{{invoice}}', 'id=invoice_id')
    ->where('start<=:date AND end>=:date AND uid=:uid AND months>0')->getText();

$signalMaxData = Yii::app()->db->createCommand()->select('DATE(MAX(sd.sigdate))')
    ->from('{{signal}} sd')
    ->where('sd.subscription_type_id=t.subscription_type_id')->getText();

$signalData = new CActiveDataProvider('Signal', array(
  'criteria' => array(
    'condition' => "DATE(t.sigdate)=($signalMaxData) AND t.subscription_type_id IN ($currentSubscription)",
    'with' => array('subscriptionType'),
    'order' => 'symid, portid',
    'params' => array(
      ':date' => date('Y-m-d'),
      ':uid' => Yii::app()->user->id,
    ),
    )));

$this->widget('zii.widgets.CListView', array(
  'id' => 'signalListView',
  'dataProvider' => $signalData,
  'itemView' => '/site/_signalItem',
  'viewData' => isset($currentSignals) ? array('currentSignals' => $currentSignals) : array(),
  'template' => '{items}',
  'cssFile' => Yii::app()->theme->baseUrl . '/css/signalListView.css',
));
?>
