<?php
/* @var $data SubscriptionType */
/* @var $form CActiveForm */
?>
<div>
  <div><?php echo $data['portid'] . ' ' . $data['symid']; ?></div>
  <div><?php echo $data['description']; ?></div>
  <div><?php echo $data['price']; ?></div>
  <div>
    <?php
    $form = $this->beginWidget('CActiveForm');
    $options = array('class' => 'date');
//  if (!$data['cart']->isNewRecord)
//    $options['readonly'] = true;
    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
      'model' => $data['invoiceSubscription'],
      'attribute' => "[{$data['id']}]start",
      'options' => array('minDate' => 0, 'dateFormat' => 'yy-mm-dd'),
      'htmlOptions' => $options,
    ));
    ?>
  </div>
  <div>
    <?php
    $options = array('class' => 'months', 'min' => 0);
//  if (!$data['cart']->isNewRecord)
//    $options['readonly'] = true;
    echo $form->checkBox($data['invoiceSubscription'], "[{$data['id']}]autorenew", $options);
    ?>
  </div>
  <div>
    <?php
    echo CHtml::submitButton('Subscribe', array(
      'class' => 'button',
//        'style' => 'float:right;margin:30px',
    ));
    ?>
    <?php $this->endWidget(); ?>
  </div>
</div>
