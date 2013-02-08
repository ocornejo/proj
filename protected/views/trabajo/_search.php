<?php
/* @var $this TrabajoController */
/* @var $model Trabajo */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_TRABAJO'); ?>
		<?php echo $form->textField($model,'ID_TRABAJO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'OT'); ?>
		<?php echo $form->textField($model,'OT'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'AVION_MATRICULA'); ?>
		<?php echo $form->textField($model,'AVION_MATRICULA',array('size'=>7,'maxlength'=>7)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'USUARIO_BP'); ?>
		<?php echo $form->textField($model,'USUARIO_BP'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PLANIFICADO'); ?>
		<?php echo $form->textField($model,'PLANIFICADO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'HORA_INICIO'); ?>
		<?php echo $form->textField($model,'HORA_INICIO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'HORA_TERMINO'); ?>
		<?php echo $form->textField($model,'HORA_TERMINO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'COMENTARIO'); ?>
		<?php echo $form->textField($model,'COMENTARIO',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHA'); ?>
		<?php echo $form->textField($model,'FECHA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CALIFICACION'); ?>
		<?php echo $form->textField($model,'CALIFICACION'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ESTADO_ID_ESTADO'); ?>
		<?php echo $form->textField($model,'ESTADO_ID_ESTADO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LUGAR_ID_LUGAR'); ?>
		<?php echo $form->textField($model,'LUGAR_ID_LUGAR'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ASEO_ID_ASEO'); ?>
		<?php echo $form->textField($model,'ASEO_ID_ASEO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TURNO_ID_TURNO'); ?>
		<?php echo $form->textField($model,'TURNO_ID_TURNO'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->