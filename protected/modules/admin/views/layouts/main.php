<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//RU" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    <link rel="icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/img/favicon.png" type="image/png" />

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    <?php Yii::app()->bootstrap->register(); ?>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
  </head>
  <body>

    <div id="topmenu">
      <?php
      $this->widget('bootstrap.widgets.TbNav', array(
        'type' => TbHtml::NAV_TYPE_TABS,
        'items' => array(
          array('label' => 'Сигналы',
            'url' => '/admin/signal',
            'active' => $this instanceof SignalController,
            'visible' => Yii::app()->user->checkAccess('admin.signal.*')
          ),
          array(
            'label' => 'Виды подписок',
            'url' => '/admin/subscriptionType',
            'active' => $this instanceof SubscriptionTypeController,
            'visible' => Yii::app()->user->checkAccess('admin.subscriptionType.*')
          ),
          array('label' => 'Новости',
            'url' => '/admin/news',
            'active' => $this instanceof NewsController,
            'visible' => Yii::app()->user->checkAccess('news.*')
          ),
          array(
            'label' => 'Страницы',
            'url' => '/admin/page',
            'active' => $this instanceof PageController,
            'visible' => Yii::app()->user->checkAccess('admin.page.*')
          ),
//          array('label' => 'Доставка',
//            'url' => '/admin/delivery',
//            'active' => $this->module instanceof DeliveryModule,
//            'visible' => Yii::app()->user->checkAccess('delivery.*') ||
//            Yii::app()->user->checkAccess('delivery.delivery.*') ||
//            Yii::app()->user->checkAccess('delivery.region.*')
//          ),
          array(
            'label' => 'Пользователи',
            'url' => '/admin/user/admin',
            'active' => $this->module instanceof UserModule,
            'visible' => Yii::app()->user->checkAccess('user.*')
          ),
          array(
            'label' => 'Права',
            'url' => '/admin/auth',
            'active' => $this->module instanceof AuthModule,
            'visible' => Yii::app()->user->checkAccess('auth.*')
          ),
          array(
            'label' => 'Выход',
            'url' => '/admin/logout',
            'visible' => !Yii::app()->user->isGuest,
            'htmlOptions' => array('class' => 'pull-right'),
          ),
        )
          )
      );
      ?>
    </div>

    <div style="width: 95%; margin: 0 auto">
      <?php if (isset($this->breadcrumbs)): ?>
        <?php
        $this->widget('bootstrap.widgets.TbBreadcrumb', array(
          'homeUrl' => array('/admin'),
          'links' => $this->breadcrumbs,
        ));
        ?><!-- breadcrumbs -->
      <?php endif ?>
      <?php echo $content; ?>
    </div>

  </body>
</html>
