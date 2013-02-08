<?php
/* @var $this EvaluacionController */
/* @var $data Evaluacion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_EVALUACION')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_EVALUACION), array('view', 'id'=>$data->ID_EVALUACION)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE); ?>
	<br />


</div>