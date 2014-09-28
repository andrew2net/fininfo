<div class="form">
  <?php
  $form = $this->beginWidget('ext.bootstrap.widgets.TbActiveForm', array(
    'layout' => TbHtml::FORM_LAYOUT_VERTICAL,
    'id' => 'login-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
      'validateOnSubmit' => true,
    ),
  ));
  ?>

  
  <!--<div class="row">-->
  <?php echo $form->textFieldControlGroup($model, 'username'); ?>
  <?php // echo $form->textField($model,'username');  ?>
  <?php // echo $form->error($model,'username');  ?>
  <!--</div>-->

  <!--<div class="row">-->
  <?php echo $form->passwordFieldControlGroup($model, 'password'); ?>
  <?php // echo $form->passwordField($model,'password');  ?>
  <?php // echo $form->error($model,'password');  ?>

  <!--<div class="row rememberMe">-->
  <?php echo $form->checkBoxControlGroup($model, 'rememberMe'); ?>
  <?php // echo $form->label($model,'rememberMe');  ?>
  <?php // echo $form->error($model,'rememberMe');  ?>
  <!--</div>-->

  <div class="row buttons">
    <div class="submit">
      <?php
      // echo TbHtml::formActions(
      echo TbHtml::submitButton('Войти', array('color' => TbHtml::BUTTON_COLOR_PRIMARY))
      ;
      ?>
    </div>
  </div>

  <?php $this->endWidget(); ?>
  <!--	<div class="row">
    </div>-->
</div><!-- form -->
<!--</div>-->
