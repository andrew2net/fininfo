<?php
/* @var $this PrivateController */
/* @var $profile Profile */
/* @var $user User */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Profile';
$this->breadcrumbs = array(
  'Profile'
);
?>
<div id="content">
  <?php $this->renderPartial('_leftMenu'); ?>
  <div>
    <h2>Profile <i><?php echo $user->username; ?></i></h2>
    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'profile-form')); ?>
    <div>
      <?php echo $form->labelEx($profile, 'first_name'); ?>
      <?php echo $form->textField($profile, 'first_name'); ?>
      <div class="errorCont"><?php echo $form->error($profile, 'first_name'); ?></div>
    </div>
    <div>
      <?php echo $form->labelEx($profile, 'last_name'); ?>
      <?php echo $form->textField($profile, 'last_name'); ?>
      <div class="errorCont"><?php echo $form->error($profile, 'last_name'); ?></div>
    </div>
    <div>
      <?php echo $form->labelEx($user, 'email'); ?>
      <?php echo $form->textField($user, 'email'); ?>
      <?php
      if ($user->email && $profile->email_confirm)
        echo CHtml::tag('span', array('class' => 'orange'), 'confirmed');
      elseif ($user->email) 
        echo CHtml::linkButton('confirm', array('class' => 'small-button', 'url' => '#'));
      ?>
      <div class="errorCont"><?php echo $form->error($user, 'email'); ?></div>
    </div>
    <div>
      <?php echo $form->labelEx($profile, 'mobile_phone'); ?>
      <?php echo $form->telField($profile, 'mobile_phone', array('style' => 'width:100px')); ?>
      <?php
      if ($profile->mobile_phone && $profile->phone_confirm)
        echo CHtml::tag('span', array('class' => 'orange'), 'confirmed');
      elseif ($profile->mobile_phone) 
        echo CHtml::linkButton('confirm', array('class' => 'small-button', 'url' => '#'));
      ?>
      <div class="errorCont"><?php echo $form->error($profile, 'mobile_phone'); ?></div>
    </div>
    <div>
      <?php echo $form->labelEx($profile, 'send_sms'); ?>
      <?php echo $form->checkBox($profile, 'send_sms'); ?>
    </div>
    <div style="margin: 10px 0 0 325px">
      <?php echo CHtml::submitButton('Save', array('class' => 'button', 'style'=>'padding:5px 10px')); ?>
    </div>
    <?php $this->endWidget(); ?>
  </div>

  <?php $this->renderPartial('/site/_rightColumn'); ?>
</div>