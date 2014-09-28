<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />

    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php // echo Yii::app()->request->baseUrl;  ?>/css/ie.css" media="screen, projection" />
    <![endif]-->

    <?php
    Yii::app()->clientScript->registerCssFile(
        Yii::app()->assetManager->publish(
            Yii::getPathOfAlias('admin.assets.css') . '/login.css'
        )
    );
    ?>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
  </head>
  <body>
<?php echo $content; ?>
  </body>
