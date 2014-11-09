<?php
$this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Restore password");
$this->breadcrumbs = array(
  UserModule::t("Login") => array('/site/login'),
  UserModule::t("Restore password"),
);
?>

<div id="content">
  <?php $this->renderPartial('//site/_newsBlock'); ?>
  <div style="padding: 0 20px">
    <h1><?php echo UserModule::t("Restore password"); ?></h1>

    <?php if (Yii::app()->user->hasFlash('recoveryMessage')): ?>
      <div class="success">
        <?php echo Yii::app()->user->getFlash('recoveryMessage'); ?>
      </div>
    <?php else: ?>

      <div class="form">
        <?php echo CHtml::beginForm(); ?>

        <?php echo CHtml::errorSummary($form); ?>

        <div class="row">
          <?php echo CHtml::activeLabel($form, 'login_or_email'); ?>
          <?php echo CHtml::activeTextField($form, 'login_or_email') ?>
          <p class="hint"><?php echo UserModule::t("Please enter your login or email addres."); ?></p>
        </div>

        <div class="row submit">
          <?php echo CHtml::submitButton(UserModule::t("Restore")); ?>
        </div>

        <?php echo CHtml::endForm(); ?>
      </div><!-- form -->
    <?php endif; ?>
  </div>
  <?php $this->renderPartial('//site/_rightColumn'); ?>
</div>
