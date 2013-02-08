<?php
/* @var $this ItemSeEvaluaController */
/* @var $model ItemSeEvalua */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'item-se-evalua-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'FLOTA_ID_FLOTA'); ?>
		<?php echo $form->textField($model,'FLOTA_ID_FLOTA'); ?>
		<?php echo $form->error($model,'FLOTA_ID_FLOTA'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'ASEO_ID_ASEO'); ?>
		<?php echo $form->textField($model,'ASEO_ID_ASEO'); ?>
		<?php echo $form->error($model,'ASEO_ID_ASEO'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'ITEM_ID_ITEM'); ?>
		<?php echo $form->textField($model,'ITEM_ID_ITEM'); ?>
		<?php echo $form->error($model,'ITEM_ID_ITEM'); ?>
	</div>



	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->