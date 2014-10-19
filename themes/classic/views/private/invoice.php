<?php
/* @var $this PrivateController */
/* @var $invoice Invoice */
/* @var $payMethod PayMethod */

$this->pageTitle = Yii::app()->name . ' - Order #' . $invoice->id;
$this->breadcrumbs = array(
  'You orders' => array('/private/orders'),
  'Order #' . $invoice->id,
);
?>
<div id="content">
  <?php $this->renderPartial('_leftMenu'); ?>
  <div>
    <h2>Order <i>#<?php echo $invoice->id; ?></i></h2>
    <div style="margin-bottom: 15px">
      <div>Date: <?php echo $invoice->date; ?></div>
      <!--<div>Paid $: <?php // echo number_format($invoice->paySumm, 2, '.', ' ');   ?></div>-->
    </div>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
      'dataProvider' => new CActiveDataProvider('InvoiceSubscription', array(
        'criteria' => array(
          'condition' => 'invoice_id=:id',
          'with' => array('subscriptionType'),
          'params' => array(':id' => $invoice->id),
        ),
          )),
      'columns' => array(
        array(
          'name' => 'subscription_type_id',
          'value' => '$data->subscriptionType->portid . " " . $data->subscriptionType->symid',
        ),
        array(
          'name' => 'start',
          'value' => '$data->getStartDate("Y-m-d")'
        ),
//        'months',
        array(
          'header' => 'Price $<br><span style="font-size:8pt;font-weight:normal">(per month)</span>',
          'value' => '$data->price',
          'footer' => $invoice->sumMonth,
        ),
        array(
          'name' => 'autorenew',
          'value' => '$data->autorenew ? "&#10004;" : ""',
          'type' => 'html',
        ),
//        array(
//          'name' => 'Summ $',
//          'value' => 'number_format($data->price*$data->months, 2, ".", " ")',
//          'footer' => $invoice->sum,
//        ),
      ),
      'template' => '{items}',
      'cssFile' => Yii::app()->theme->baseUrl . '/css/gridView.css',
    ));

    if ($invoice->paySumm > 0) {
      ?>
    <h2>Payments for the order</h2>
    <?php
      $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => new CArrayDataProvider($invoice->payments),
        'columns' => array(
          array(
            'header' => 'Date',
            'value' => '$data->time',
          ),
          array(
            'header' => 'Operation ID',
            'value' => '$data->operation_id',
          ),
          array(
            'header' => 'Amount $',
            'value' => '$data->amount',
            'footer' => $invoice->paySumm,
          ),
          array(
            'header' => 'Status',
            'value' => '$data->status',
          ),
        ),
      'template' => '{items}',
       'cssFile' => Yii::app()->theme->baseUrl . '/css/gridView.css',
     ));
    }

    $toPay = $invoice->sumMonth - $invoice->paySumm;
    if ($toPay > 0) {
      $this->beginWidget('CActiveForm', array('action' => $payMethod->actionUrl));
      $params = $payMethod->getPayParams($invoice);
      foreach ($params as $key => $value) {
        echo CHtml::hiddenField($key, $value);
      }
      echo CHtml::hiddenField($payMethod->getSignName(), $payMethod->getSing($params));
      echo CHtml::submitButton('Pay for order', array('class' => 'button', 'style' => 'float:right'));
      $this->endWidget();
    }
    ?>

  </div>
  <?php // $this->renderPartial('/site/_rightColumn'); ?>
</div>