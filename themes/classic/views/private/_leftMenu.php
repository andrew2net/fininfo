<div id="left-column">
  <?php
  $this->widget('zii.widgets.CMenu', array(
    'items' => array(
      array(
        'label' => 'Your subscriptions',
        'url' => '/private/index',
        'active' => $this->action->id == 'index',
      ),
      array(
        'label' => 'Subscribe',
        'url' => '/private/subscribe',
        'active' => $this->action->id == 'subscribe',
        ),
      array(
        'label' => 'Your orders',
        'url' => '/private/orders',
        'active' => $this->action->id == 'orders',
        ),
      array(
        'label' => 'Profile',
        'url' => '/private/profile',
        'active' => $this->action->id == 'profile',
        ),
    ),
    'htmlOptions' => array('style' => 'list-style-type:none;padding:0;margin:0'),
    'itemCssClass' => 'left-menu-item',
  ));
  ?>
</div>