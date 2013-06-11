<?php echo CHtml::form($this->createUrl('upload'),'post',array('enctype'=>'multipart/form-data')); ?>

<?php $this->widget('CMultiFileUpload',array(
	'name'=>'files',
	'accept'=>'jpg|png',
	'max'=>3,
	'remove'=>Yii::t('ui','Remove'),
	//'denied'=>'', message that is displayed when a file type is not allowed
	//'duplicate'=>'', message that is displayed when a file appears twice
	'htmlOptions'=>array('size'=>25),
)); ?>
<br />
<?php echo CHtml::submitButton(Yii::t('ui', 'Upload')); ?>&nbsp;
<?php echo Yii::t('ui','NB! Access restricted by IP');?>
<?php echo CHtml::endForm(); ?>
