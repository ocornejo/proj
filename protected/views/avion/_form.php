<?php
/* @var $this AvionController */
/* @var $model Avion */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'avion-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'MATRICULA'); ?>
		<?php echo $form->textField($model,'MATRICULA',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'MATRICULA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FLOTA_ID_FLOTA'); ?>
		<?php echo $form->textField($model,'FLOTA_ID_FLOTA'); ?>
		<?php echo $form->error($model,'FLOTA_ID_FLOTA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'OPERADOR_ID_OPERADOR'); ?>
		<?php echo $form->textField($model,'OPERADOR_ID_OPERADOR'); ?>
		<?php echo $form->error($model,'OPERADOR_ID_OPERADOR'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->