<?php
/* @var $this PrivateController */
/* @var $cubscriptions CActiveDataProvider */

$this->pageTitle = Yii::app()->name . ' - Your subscriptions';
$this->breadcrumbs = array(
  'Your subscriptions'
);
?>
<div id="content">
  <?php $this->renderPartial('_leftMenu'); ?>
  <div>
    <?php if ($flash = Yii::app()->user->getFlash('unsubscribe_error')) { ?>
      <p><?php echo $flash; ?></p>
    <?php } ?>
    <h2>Your subscriptions</h2>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
      'dataProvider' => $subscriptions,
      'htmlOptions' => array('id' => 'subscriptions-table'),
      'columns' => array(
        array(
          'value' => '$data->invoice_id',
          'htmlOptions' => array('class' => 'subscription-invoice'),
          'headerHtmlOptions' => array('style' => 'display:none'),
        ),
        array(
          'value' => '$data->subscription_type_id',
          'htmlOptions' => array('class' => 'subscription-type'),
          'headerHtmlOptions' => array('style' => 'display:none'),
        ),
        array(
          'name' => 'subscription_type_id',
          'value' => '$data->subscriptionType->portid . " " . $data->subscriptionType->symid',
          'htmlOptions' => array('class' => 'subscription-name'),
        ),
        'start',
        'end',
        array(
          'name' => 'autorenew',
          'value' => '$data->autorenew ? "&#10004;" : ""',
          'type' => 'html',
        ),
        array(
          'class' => 'CButtonColumn',
          'template' => '{unsubscribe}',
          'buttons' => array(
            'unsubscribe' => array(
              'label' => 'Unsubscribe',
              'urll' => '/private/unsubscribe',
              'options' => array('class' => 'button unsubscribe'),
              'visible' => '$data->autorenew && (new DateTime) <= (new DateTime($data->end))',
            ),
          ),
        ),
      ),
      'template' => '{items}',
      'emptyText' => "You haven't subscriptions",
      'cssFile' => Yii::app()->theme->baseUrl . '/css/gridView.css',
    ));
    ?>
  </div>
  <?php $this->renderPartial('/site/_rightColumn'); ?>
</div>
<div id="unsubscribe-dialog" class="dialog">
  <div>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
      'htmlOptions' => array(
        'id' => 'unsubscribe-form',
        'style' => 'margin:0 20px',),
    ));
    /* @var $form CActiveForm */
//    if (Yii::app()->request->isAjaxRequest):
    ?>
    <div class="dialog-close" style="position: absolute; top: 0; right: 0; cursor: pointer;
         background: url(<?php echo Yii::app()->theme->baseUrl; ?>/img/cross.png);
         width: 16px;height: 16px">
    </div>
    <?php // endif ?>
    <h1>Unsubscription</h1>
    <p style="font-size: 11pt">Do you really want to unsubscribe <span id="subscription-name"></span> ?</p>
    <div style="text-align: center">
      <?php
      echo CHtml::hiddenField('inv_id');
      echo CHtml::hiddenField('type_id');
      echo CHtml::submitButton('Yes', array('class' => 'button dialog-yes',));
      echo CHtml::submitButton('No', array('class' => 'button dialog-no',));
      ?>
    </div>
    <?php $this->endWidget(); ?>
  </div>
</div>
<script type="text/javascript">
  $(function () {
    var unsubscribeDialog = $('#unsubscribe-dialog');
    var unsubscribeCon = $('#unsubscribe-dialog > div');
    var name = $('#subscription-name');
    var inv_id = $('#inv_id');
    var type_id = $('#type_id')

    $('#subscriptions-table').on('click', '.unsubscribe', function (event) {
      event.preventDefault();
      var tr = $(this).parents('tr');
      name.html(tr.find('.subscription-name').html());
      inv_id.val(tr.find('.subscription-invoice').html());
      type_id.val(tr.find('.subscription-type').html());
      unsubscribeDialog.show();
    });

    unsubscribeCon.on('click', '.dialog-close, .dialog-no', function (event) {
      event.preventDefault();
      unsubscribeDialog.hide();
    });

    unsubscribeCon.on('click', '.dialog-yes', function () {
      unsubscribeDialog.hide();
      $('#loading').show();
    });
  });
</script>