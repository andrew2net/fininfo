<?php
/* @var $this Controller */
/* @var $data Signal */
/* @var $currentSignals array */

$itemClass = '';
if (isset($currentSignals)) {
  if (isset($currentSignals[$data->subscription_type_id])) {
    if ($currentSignals[$data->subscription_type_id] != $data->id)
      $itemClass = ' back-light-orange';
  }else {
    $itemClass = ' back-light-orange';
  }
}
?>
<div class="item<?php echo $itemClass; ?>" type="<?php echo $data->subscription_type_id; ?>" sid="<?php echo $data->id; ?>">
  <div class="bold"><?php echo $data->subscriptionType->portid . ' ' . $data->subscriptionType->symid; ?></div>
  <div><?php echo $data->sigdate; ?></div>
  <div><?php echo $data->recom; ?></div>
  <div><?php echo number_format($data->price, 2, '.', ' '); ?></div>
</div>