<?php
/* @var $this ParamsController */
/* @var $models Params */
/* @var $form TbActiveForm */
?>

<div class="form">

  <?php
  $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'params-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
  ));
  ?>

  <?php echo $form->errorSummary($models); ?>

  <?php foreach ($models as $key => $model) { ?>
    <div class="inline-blocks">
      <div>
        <?php echo TbHtml::label($model->name, "Params_{$key}_value", array('style' => 'width:300px')); ?>
      </div>
      <div>
        <?php echo $form->textField($model, "[$key]value", array('span' => 5, 'maxlength' => 255)); ?>
      </div>
    </div>
  <?php } ?>

  <div class="form-actions">
    <?php
    echo TbHtml::submitButton('Сохранить', array(
      'color' => TbHtml::BUTTON_COLOR_PRIMARY,
    ));
    ?>
  </div>

  <?php $this->endWidget(); ?>

</div><!-- form -->