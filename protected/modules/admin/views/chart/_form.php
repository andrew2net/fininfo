<?php
/* @var $this ChartController */
/* @var $model Chart */
/* @var $form TbActiveForm */
?>

<div class="form">

  <?php
  $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'chart-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
  ));
  ?>

  <p class="help-block"><span class="required">*</span> обязятельные поля.</p>

  <?php echo $form->errorSummary($model); ?>

  <?php echo $form->dropDownListControlGroup($model, 'subscription_type_id', SubscriptionType::getListOptions(), array('span' => 3)); ?>

  <?php
  echo $form->labelEx($model, 'start');
  $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'model' => $model,
    'attribute' => 'start',
    'options' => array('dateFormat' => 'yy-mm-dd'),
  ));
  ?>

  <?php 
  echo $form->labelEx($model, 'end');
  $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'model' => $model,
    'attribute' => 'end',
    'options' => array('dateFormat' => 'yy-mm-dd'),
  ));
  ?>

<?php echo $form->checkBoxControlGroup($model, 'active', array('span' => 5)); ?>

  <div class="form-actions">
    <?php
    echo TbHtml::linkButton('Закрыть', array(
      'url' => '/admin/chart/index'));
    ?>
    <?php
    echo TbHtml::submitButton('Сохранить', array(
      'color' => TbHtml::BUTTON_COLOR_PRIMARY,
    ));
    ?>
  </div>

<?php $this->endWidget(); ?>

</div><!-- form -->