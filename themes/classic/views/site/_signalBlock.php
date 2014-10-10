<div id="signal-block">
  <div class="bold" style="margin: 5px; font-size: 12pt">Last signal</div>
  <?php
  $this->widget('zii.widgets.CListView', array(
    'id' => 'signalListView',
    'dataProvider' => new CActiveDataProvider('Signal', array(
      'criteria' => array('condition' => 'DATE(sigdate)=(SELECT DATE(MAX(sigdate)) FROM {{signal}})'))),
    'itemView' => '/site/_signalItem',
    'template' => '{items}',
    'cssFile' => Yii::app()->theme->baseUrl . '/css/signalListView.css',
  ));
  ?>
</div>