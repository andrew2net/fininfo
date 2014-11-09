<p><a href="<?php echo Yii::app()->createAbsoluteUrl('profile'); ?>">Go to your private area</a></p>
<p>Thank you for choosing us!</p>
<?php
echo CHtml::tag('p', array(), 'This letter is generated automatically. Please do not reply to it.');
echo CHtml::tag('a', array('href' => Yii::app()->createAbsoluteUrl('')), Yii::app()->createAbsoluteUrl(''));
?>
