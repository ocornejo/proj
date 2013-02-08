<?php
/* @var $this TipoTurnoController */
/* @var $model TipoTurno */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_TIPO_TURNO'); ?>
		<?php echo $form->textField($model,'ID_TIPO_TURNO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TIPO'); ?>
		<?php echo $form->textField($model,'TIPO',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->