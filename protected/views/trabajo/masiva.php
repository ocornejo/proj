<?php $this->pageTitle=Yii::app()->name . ' - Ingresar aseo';
$this->breadcrumbs=array(
	'Trabajos'=>array('index'),
        'Masiva',
);?>

<?php echo CHtml::form($this->createUrl('trabajo/masiva'),'post',array('enctype'=>'multipart/form-data')); ?>

<?php $this->widget('CMultiFileUpload',array(
	'name'=>'files',
	'accept'=>'xls',
	'max'=>3,
	'remove'=>Yii::t('ui','Remove'),
	//'denied'=>'', message that is displayed when a file type is not allowed
	//'duplicate'=>'', message that is displayed when a file appears twice
	'htmlOptions'=>array('size'=>25),
)); ?>
<br />
<?php echo CHtml::submitButton(Yii::t('ui', 'Cargar')); ?>&nbsp;

<?php echo CHtml::endForm(); ?>

