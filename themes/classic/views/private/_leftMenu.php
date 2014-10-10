<div id="left-column">
  <?php
  $this->widget('zii.widgets.CMenu', array(
    'items' => array(
      array(
        'label' => 'Subscriptions',
        'url' => '/private/index',
        'active' => $this->action->id == 'index',
      ),
      array('label' => 'Subscribe', 'url' => '#'),
      array('label' => 'Billing', 'url' => '#'),
      array('label' => 'Profile', 'url' => '#'),
    ),
    'htmlOptions' => array('style' => 'list-style-type:none;padding:0;margin:0'),
    'itemCssClass' => 'left-menu-item',
  ));
  ?>
</div>