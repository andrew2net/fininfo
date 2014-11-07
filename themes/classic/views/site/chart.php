<?php
/* @var $this SiteController */

$cs = Yii::app()->clientScript;
//$cs->packages['jquery'] = array(
//  'baseUrl' => '/js/jquery/',
//  'js' => array('jquery.js'),
//);
//$cs->packages['jquery.ui'] = array(
//  'baseUrl' => '/js/jquery/',
//  'js' => array('jquery-ui.js'),
//);
//$cs->registerCoreScript('jquery.ui');
//$cs->registerCoreScript('jquery');
//$cs->registerCssFile('/js/jquery/jquery-ui.css');
//$cs->registerCssFile('/js/jquery/jquery-ui.structure.css');
//$cs->registerCssFile('/js/jquery/jquery-ui.theme.css');
$cs->registerScriptFile('https://www.google.com/jsapi', CClientScript::POS_END);
$cs->registerScriptFile('/js/userChart.js', CClientScript::POS_END);

$this->pageTitle = Yii::app()->name . ' - Chart';
?>

<div id="content">
  <?php $this->renderPartial('_newsBlock'); ?>
  <div>
    <?php
    echo CHtml::dropDownList('subscription-type', ''
        , CHtml::listData(SubscriptionType::model()->findAll(), 'id', function (SubscriptionType $type) {
          return $type->portid . ' ' . $type->symid;
        }));
    ?>
    <div id="chart-dashboard">
      <div id="chart-user"></div>
      <div style="height: 50px" id="chart-filter"></div>
    </div>
  </div>
<?php $this->renderPartial('_rightColumn'); ?>
</div>
