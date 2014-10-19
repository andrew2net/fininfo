<div id="right-column">
  <?php
  if (Yii::app()->user->isGuest) {
    $this->renderPartial('_registrBlock');
  }
  else {
    $subscription = InvoiceSubscription::model()->find( array(
          'with' => array('invoice'),
          'condition'=>'start<=:date AND end>=:date AND uid=:uid AND months>0',
          'params'=>array(
            ':date' => date('Y-m-d'),
            ':uid' => Yii::app()->user->id,
            ),
          ));
    if ($subscription)
      $this->renderPartial('/site/_signalBlock');
    else
      $this->renderPartial('/site/_registrBlock');
  }
  ?>
</div>