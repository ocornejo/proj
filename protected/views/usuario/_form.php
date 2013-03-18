<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuario-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son necesarios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'BP'); ?>
		<?php echo $form->textField($model,'BP'); ?>
		<?php echo $form->error($model,'BP'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NOMBRE'); ?>
		<?php echo $form->textField($model,'NOMBRE',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'NOMBRE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NIVEL_USUARIO'); ?>
		<?php echo $form->textField($model,'NIVEL_USUARIO'); ?>
		<?php echo $form->error($model,'NIVEL_USUARIO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PASSWORD'); ?>
		<?php echo $form->passwordField($model,'PASSWORD',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'PASSWORD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FILIAL_ID_FILIAL'); ?>
		<?php echo $form->dropDownList($model, 'FILIAL_ID_FILIAL', CHtml::listData(Filial::model()->findAll(), 'ID_FILIAL', 'NOMBRE_FILIAL'), array('empty' => 'Seleccione')); ?>
                <?php //echo $form->textField($model,'FILIAL_ID_FILIAL'); ?>
		<?php echo $form->error($model,'FILIAL_ID_FILIAL'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->