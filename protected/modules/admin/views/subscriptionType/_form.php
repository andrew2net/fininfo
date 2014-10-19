<?php
/* @var $this SubscriptionTypeController */
/* @var $model SubscriptionType */
/* @var $form CActiveForm */
?>

<div class="form">

  <?php
  $form = $this->beginWidget('ext.bootstrap.widgets.TbActiveForm', array(
    'id' => 'subscription-type-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => true,
  ));
  /* @var $form TbActiveForm */
  ?>

  <p class="note">Обязательные поля <span class="required">*</span></p>

  <?php echo $form->errorSummary($model); ?>
  <div style="display: inline-block; vertical-align: top">
    <div class="row">
      <?php echo $form->textFieldControlGroup($model, 'portid', array('size' => 4, 'maxlength' => 4)); ?>
    </div>

    <div class="row">
      <?php echo $form->textFieldControlGroup($model, 'symid', array('size' => 10, 'maxlength' => 10)); ?>
    </div>

    <div class="row">
      <?php echo $form->numberFieldControlGroup($model, 'price', array('size' => 10, 'maxlength' => 10)); ?>
    </div>
  </div>
  <div style="display: inline-block; vertical-align: top; margin-left: 10px">
    <div class="row"><?php echo $form->textAreaControlGroup($model, 'description', array('rows' => 8, 'span' => 7)); ?></div>
  </div>

  <div class="form-actions">
    <?php
    echo TbHtml::linkButton('Закрыть', array(
      'url' => '/admin/subscriptionType'));
    ?>
    <?php
    echo TbHtml::submitButton('Сохранить', array(
      'color' => TbHtml::BUTTON_COLOR_PRIMARY,
    ));
    ?>
  </div>

  <?php $this->endWidget(); ?>

</div><!-- form -->