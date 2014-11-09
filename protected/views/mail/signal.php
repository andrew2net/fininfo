<html>
  <head>
    <title>Fin-Info signal notification</title>
  </head>
  <body>
    <?php
    /* @var $message Message */
    ?>
    <h3>Hi, <?php $message->user->profile->first_name . ' ' . $message->user->profile->last_name ?></h3>
    <p>Signals your subscriptions:</p>
    <?php foreach ($message->signals as $signal) { ?>
      <p><?php
        echo $signal->subscriptionType->portid . " " . $signal->subscriptionType->symid .
        " " . $signal->sigdate . ' ' . $signal->recom . ' ' . number_format($signal->price, 2, '.', ' ');
        ?></p>
    <?php } ?>
    $this->renderInternal(dirname(__FILE__) . '/_footer.php');
  </body>
</html>
