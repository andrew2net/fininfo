<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/screen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/print.css" media="print" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" />

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
  </head>

  <body>

    <div class="container" id="page">
      <div style="text-align: center; font-size: 22pt">The site is under constraction!</div>
      <div>
        <div id="header">
          <div id="mainmenu">
            <?php
            $pages = Page::model()->findAll(array('condition' => 'menu_show>0 AND url<>"/"', 'order' => 'menu_show'));
            $currentUrl = isset($_GET['url']) ? $_GET['url'] : '';
            $isGuest = Yii::app()->user->isGuest;
            foreach ($pages as $page) {
              $items[] = array(
                'label' => $page->title,
                'url' => Yii::app()->createUrl('site/page', array('url' => $page->url)),
                'active' => $page->url == $currentUrl);
            }

            $this->widget('zii.widgets.CMenu', array(
              'items' => array_merge($items
                  , array(
                array('label' => 'Login', 'url' => array('/site/login'), 'visible' => $isGuest),
                array('label' => 'Logout (' . Yii::app()->user->name . ')'
                  , 'url' => array('/site/logout'), 'visible' => !$isGuest),
                array('label' => 'Private area', 'url' => array('/private'), 'visible' => !$isGuest && !$this instanceof PrivateController),
              )),
            ));
            ?>
          </div><!-- mainmenu -->
          <div class="orange" style="clear: right; float: right; position: relative; font-size: 18pt; margin: 20px">+7 888 999 33 22</div>
          <div id="logo">
            <a href="/"><img src="<?php echo Yii::app()->theme->baseUrl . '/img/logo.png'; ?>" /></a>
            <div><span style="vertical-align: super" class="beige">Financial</span> <span class="orange">information</span></div>
          </div>
        </div><!-- header -->
        <div style="min-height: 600px">
          <?php
          if (isset($this->breadcrumbs) && $this->breadcrumbs)
            $this->widget('zii.widgets.CBreadcrumbs', array(
              'links' => $this->breadcrumbs,
            ));
          else {
            ?>
            <div style="height: 24px"></div>
          <?php } ?><!-- breadcrumbs -->
          <?php echo $content; ?>
        </div>
        <div id="footer">
          <div style="display: table; width: 100%">
            <div style="width: 10%; display: table-cell">
              <a href="/"><img height="51" alt="FinInfo" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/logo.png" /></a>
            </div>
            <div style="width: 30%;display: table-cell; vertical-align: top">
              <div class="bold" style="margin-bottom: 5px">Call us</div>
              <div><span class="orange" style="font-size: 16pt; vertical-align: middle">+7 888 999 33 22</span></div>
            </div>
            <div style="width: 35%;display: table-cell; vertical-align: top">
              <div class="bold" style="margin: 5px 8px; font-size: 12pt">
                FinInfo - Financial information
              </div>
              <div>
                <?php
                $this->widget('zii.widgets.CMenu', array(
                  'items' => $items,
                  'htmlOptions' => array('class' => 'menu'),
                ));
                ?>
              </div>
            </div>
            <div style="display: table-cell; width: 25%; vertical-align: top">
              <p>&copy;2014. All rights reserved.</br>
                Site designed by<br>
                  <a style="text-decoration-line: initial; -moz-text-decoration-line: none" href="mailto:andriano@ngs.ru?subject=Site designe">andriano@ngs.ru</a></p>
            </div>
          </div>    
        </div><!-- footer -->
      </div>
    </div><!-- page -->

  </body>
</html>
