<?php
/* @var $this LugarController */
/* @var $model Lugar */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lugar-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'LUGAR'); ?>
		<?php echo $form->textField($model,'LUGAR',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'LUGAR'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FILIAL_ID_FILIAL'); ?>
		<?php echo $form->textField($model,'FILIAL_ID_FILIAL'); ?>
		<?php echo $form->error($model,'FILIAL_ID_FILIAL'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->