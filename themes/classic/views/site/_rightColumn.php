<div id="right-column">
  <?php
  if (Yii::app()->user->isGuest) {
    $this->renderPartial('_registrBlock');
  }
  else {
    $subscription = InvoiceSubscription::model()->find(array(
      'with' => array('invoice'),
      'condition' => 'start<=:date AND end>=:date AND uid=:uid AND months>0',
      'params' => array(
        ':date' => date('Y-m-d'),
        ':uid' => Yii::app()->user->id,
      ),
    ));
    if ($subscription) {
      ?>
      <div id="signal-block">
        <?php $this->renderPartial('/site/_signalBlock'); ?>
      </div>
      <script type="text/javascript">
        $(function () {
          var signalBlock = $('#signal-block');

          setInterval(function () {
            var signals = {};
            signalBlock.find('.item').each(function (index, element) {
              var el = $(element);
              signals[el.attr('type')] = el.attr('sid');
            });
            $.post('/private/getLastSignals', {signals: signals}, function (data) {
              signalBlock.html(data);
              setTimeout(function () {
                signalBlock.find('.item').removeClass('back-light-orange');
              }, 500);
            });
          }, 10000);
        });
      </script>      <?php
    }
    else
      $this->renderPartial('/site/_registrBlock');
  }
  ?>
</div>
