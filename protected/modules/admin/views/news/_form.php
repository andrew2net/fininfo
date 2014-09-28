<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form TbActiveForm */
?>

<div class="form">

  <?php
  $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'news-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
  ));
  ?>

  <p class="help-block">Обязятельные поля <span class="required">*</span></p>

  <?php echo $form->errorSummary($model); ?>

  <?php
  $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'model' => $model,
    'attribute' => 'date',
    'options' => array('dateFormat' => 'yy-mm-dd'),
  ));
  ?>

  <?php echo $form->textFieldControlGroup($model, 'header', array('span' => 5, 'maxlength' => 255)); ?>

  <?php
  $this->widget('ext.tinymce.TinyMce', array(
    'model' => $model,
    'attribute' => 'text',
    'fileManager' => array(
      'class' => 'ext.elFinder.TinyMceElFinder',
      'connectorRoute' => '/admin/elfinder/connector',
    ),
      )
  );
// echo $form->textAreaControlGroup($model, 'text', array('rows' => 6, 'span' => 8)); 
  ?>

  <div class="form-actions">
    <?php
    echo TbHtml::linkButton('Закрыть', array(
      'url' => '/admin/news/index'));
    ?>
    <?php
    echo TbHtml::submitButton('Сохранить', array(
      'color' => TbHtml::BUTTON_COLOR_PRIMARY,
    ));
    ?>
  </div>

  <?php $this->endWidget(); ?>

</div><!-- form -->