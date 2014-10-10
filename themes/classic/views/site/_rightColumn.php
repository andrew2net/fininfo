<div id="right-column">
  <?php if(Yii::app()->user->isGuest) { 
    $this->renderPartial('_registrBlock');
  }else {
    $this->renderPartial('/site/_signalBlock');
  }
?>
</div>