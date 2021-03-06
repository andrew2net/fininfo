<?php
/* @var $this Controller */
?>

<div>
  <?php
  $form = $this->beginWidget('CActiveForm', array(
    'htmlOptions' => array(
      'id' => 'registr-form',
      'style' => 'margin:0 20px',),
  ));
  /* @var $form CActiveForm */
  ?>
  <?php if (Yii::app()->request->isAjaxRequest): ?>
    <div id="reg-close" style="position: absolute; top: 0; right: 0; cursor: pointer;
         background: url(<?php echo Yii::app()->theme->baseUrl; ?>/img/cross.png);
         width: 16px;height: 16px"></div>
       <?php endif ?>
  <h1>Registration</h1>
  <div>
    <div><?php echo $form->labelEx($user, 'username'); ?></div>
    <div><?php echo $form->textField($user, 'username', array('style' => 'width: 284px')); ?></div>
    <div style="height: 16px"><?php echo $form->error($user, 'username'); ?></div>
  </div>
  <div>
    <div><?php echo $form->labelEx($user, 'email'); ?></div>
    <div><?php echo $form->textField($user, 'email', array('style' => 'width: 284px')); ?></div>
    <div style="height: 16px"><?php echo $form->error($user, 'email'); ?></div>
  </div>
  <div>
    <div><?php echo $form->labelEx($user, 'password'); ?></div>
    <div><?php echo $form->passwordField($user, 'password', array('style' => 'width: 284px')); ?></div>
    <div style="height: 16px"><?php echo $form->error($user, 'password'); ?></div>
  </div>
  <div>
    <div><?php echo $form->labelEx($user, 'verifyPassword'); ?></div>
    <div><?php echo $form->passwordField($user, 'verifyPassword', array('style' => 'width: 284px')); ?></div>
    <div style="height: 16px; margin-bottom: 10px"><?php echo $form->error($user, 'verifyPassword'); ?></div>
  </div>
  <?php if (!Yii::app()->request->isAjaxRequest) : ?>
    <div>
      <div><?php echo $form->labelEx($user, 'verifyCode'); ?></div>
      <div><?php
        $this->widget('CCaptcha', array('buttonOptions' => array(
            'style' => 'margin:0 10px;vertical-align:bottom;line-height:50px',
        )));
        ?>
      </div>
      <div style="margin-top: 5px"><?php echo $form->textField($user, 'verifyCode'); ?></div>
      <div class="hint">Please enter the letters as they are shown in the image above.
        <br/>Letters are not case-sensitive.</div>
      <div style="height: 16px"><?php echo $form->error($user, 'verifyCode'); ?></div>
    </div>
  <?php endif; ?>
  <div>
    <?php
    echo CHtml::submitButton('Sign up', //'', array('update' => '#registr-dialog > div'),
        array(
      'id' => 'reg-submit',
      'class' => 'button',
      'style' => 'margin-left:220px',
    ));
    ?>
  </div>
  <?php $this->endWidget(); ?>

</div>