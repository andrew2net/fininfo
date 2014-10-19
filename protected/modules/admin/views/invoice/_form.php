<?php
/* @var $this InvoiceController */
/* @var $model Invoice */
/* @var $form TbActiveForm */
?>

<div class="form">

  <?php
  $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'invoice-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
  ));
  ?>

  <!--<p class="help-block">Обязательные поля <span class="required">*</span></p>-->

  <?php echo $form->errorSummary($model); ?>
  <div class="inline-blocks">
    <?php echo $form->textFieldControlGroup($model->user, 'username', array('span' => 3, 'readonly' => true)); ?>

    <?php echo $form->textFieldControlGroup($model, 'date', array('span' => 2, 'readonly' => true)); ?>
    
    <?php echo $form->textFieldControlGroup($model, 'paySumm', array('span' => 2, 'readonly' => true, 'style' => 'text-align:right')); ?>
  </div>
  <?php
  $dataProvider = new CArrayDataProvider($model->subscriptions, array('keyField' => 'subscription_type_id', 'id' => '$subscription_type_id'));
  $this->widget('ext.bootstrap.widgets.TbGridView', array(
    'dataProvider' => $dataProvider,
    'columns' => array(
      array(
        'name' => 'Subscription type',
        'value' => '$data->subscriptionType->portid . " " . $data->subscriptionType->symid'
      ),
      array(
        'name'=>'Start',
        'value' => '$data->start'
        ),
      array(
        'name' => 'Months',
        'value' => '$data->months'
      ),
      array(
        'name' => 'Price $',
        'value' => '$data->price',
      ),
      array(
        'name' => 'Summ $',
        'value' => 'number_format($data->price * $data->months, 2, ".", " ")',
        'footer' => $model->sum,
      ),
    ),
  )); ?>
  <div class="form-actions">
    <?php echo TbHtml::linkButton('Закрыть', array('url' => '/admin/invoice')); ?>
    <?php
//    echo TbHtml::submitButton('Сохранить', array(
//      'color' => TbHtml::BUTTON_COLOR_PRIMARY,
//    ));
    ?>
  </div>

  <?php $this->endWidget(); ?>

</div><!-- form -->