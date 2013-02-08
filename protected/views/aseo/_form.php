<?php
/* @var $this AseoController */
/* @var $model Aseo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'aseo-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'TIPO_ASEO'); ?>
		<?php echo $form->textField($model,'TIPO_ASEO',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'TIPO_ASEO'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->