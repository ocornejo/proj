<?php
/* @var $this CRITICOSController */
/* @var $model CRITICOS */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_CRITICOS'); ?>
		<?php echo $form->textField($model,'ID_CRITICOS'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FLOTA_ID_FLOTA'); ?>
		<?php echo $form->textField($model,'FLOTA_ID_FLOTA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ASEO_ID_ASEO'); ?>
		<?php echo $form->textField($model,'ASEO_ID_ASEO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LIMITE1'); ?>
		<?php echo $form->textField($model,'LIMITE1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LIMITE2'); ?>
		<?php echo $form->textField($model,'LIMITE2'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LIMITE3'); ?>
		<?php echo $form->textField($model,'LIMITE3'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->