<?php
/* @var $this PayMethodController */
/* @var $model PayMethod */
/* @var $form TbActiveForm */
?>

<div class="form">

  <?php
  $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'pay-method-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
  ));
  ?>

  <p class="help-block"><span class="required">*</span> Обязательные поля.</p>

  <?php echo $form->errorSummary($model); ?>

  <?php echo $form->textFieldControlGroup($model, 'name', array('span' => 5, 'maxlength' => 255)); ?>

  <?php echo $form->textAreaControlGroup($model, 'description', array('rows' => 2, 'span' => 6)); ?>

  <?php echo TbHtml::activeDropDownListControlGroup($model, 'type_id', PayMethod::getTypes()); ?>

  <?php // echo $form->textFieldControlGroup($model, 'sign_name', array('span' => 5, 'maxlength' => 255)); ?>

  <?php echo $form->textFieldControlGroup($model, 'shop_id', array('span' => 5, 'maxlength' => 255)); ?>

  <?php echo $form->textFieldControlGroup($model, 'sign_key', array('span' => 5, 'maxlength' => 255)); ?>

  <?php echo TbHtml::activeCheckBoxControlGroup($model, 'active'); ?>

  <div class="form-actions">
    <?php echo TbHtml::linkButton('Закрыть', array('url' => '/admin/payMethod')); ?>
    <?php
    echo TbHtml::submitButton('Сохранить', array(
      'color' => TbHtml::BUTTON_COLOR_PRIMARY,
    ));
    ?>
  </div>

  <?php $this->endWidget(); ?>

</div><!-- form -->