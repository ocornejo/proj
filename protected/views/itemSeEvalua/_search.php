<?php
/* @var $this ItemSeEvaluaController */
/* @var $model ItemSeEvalua */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'FLOTA_ID_FLOTA'); ?>
		<?php echo $form->textField($model,'FLOTA_ID_FLOTA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ASEO_ID_ASEO'); ?>
		<?php echo $form->textField($model,'ASEO_ID_ASEO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ITEM_ID_ITEM'); ?>
		<?php echo $form->textField($model,'ITEM_ID_ITEM'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->