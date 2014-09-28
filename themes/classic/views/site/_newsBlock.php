<div id="news-block">
  <div class="bold" style="margin: 5px; font-size: 12pt">News</div>
  <?php
  $this->widget('zii.widgets.CListView', array(
    'id' => 'newsListView',
    'dataProvider' => new CActiveDataProvider('News', array('criteria' => array('order' => 'date DESC'))),
    'itemView' => '_newsItem',
    'template' => '{items}{pager}',
    'cssFile' => Yii::app()->theme->baseUrl . '/css/news.css',
  ));
  ?>
</div>
