<?php
/* @var $this ItemController */
/* @var $model Item */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'item-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_ITEM'); ?>
		<?php echo $form->textField($model,'ID_ITEM'); ?>
		<?php echo $form->error($model,'ID_ITEM'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NOMBRE'); ?>
		<?php echo $form->textField($model,'NOMBRE',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'NOMBRE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EVALUACION_ID_EVALUACION'); ?>
		<?php echo $form->textField($model,'EVALUACION_ID_EVALUACION'); ?>
		<?php echo $form->error($model,'EVALUACION_ID_EVALUACION'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->