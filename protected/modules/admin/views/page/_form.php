<?php
/* @var $this PageController */
/* @var $model Page */
/* @var $form TbActiveForm */
?>

<div class="form">

  <?php
  $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'page-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
  ));
  ?>

  <p class="help-block">Обязательные поля <span class="required">*</span></p>

  <?php echo $form->errorSummary($model); ?>

  <div class="inline-blocks">
    <div>
      <?php echo $form->textFieldControlGroup($model, 'url', array('span' => 5, 'maxlength' => 255)); ?>
    </div>
    <div class="table-cell">
      <?php echo $form->textFieldControlGroup($model, 'menu_show', array('span' => 1, 'maxlength' => 3)); ?>
    </div>
  </div>

  <?php echo $form->textFieldControlGroup($model, 'title', array('span' => 5, 'maxlength' => 255)); ?>

  <?php echo CHtml::activeLabel($model, 'content')// echo $form->textAreaControlGroup($model,'content',array('rows'=>6,'span'=>8)); ?>
  <?php
  $this->widget('ext.tinymce.TinyMce', array(
//                  'name'=>'Page_content',
    'model' => $model,
    'attribute' => 'content',
    'fileManager' => array(
      'class' => 'ext.elFinder.TinyMceElFinder',
      'connectorRoute' => '/admin/elfinder/connector',
    ),
//                   'editorTemplate'=>'full',
//                   'htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'tinymce'),
      )
  );
  ?>

  <div class="form-actions">
    <?php
    echo TbHtml::linkButton('Закрыть', array(
      'url' => '/admin/page'));
    ?>
    <?php
    echo TbHtml::submitButton('Сохранить', array(
      'color' => TbHtml::BUTTON_COLOR_PRIMARY,
    ));
    ?>
  </div>

  <?php $this->endWidget(); ?>

</div><!-- form -->