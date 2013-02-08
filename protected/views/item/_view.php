<?php
/* @var $this ItemController */
/* @var $data Item */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_ITEM')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_ITEM), array('view', 'id'=>$data->ID_ITEM)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EVALUACION_ID_EVALUACION')); ?>:</b>
	<?php echo CHtml::encode($data->EVALUACION_ID_EVALUACION); ?>
	<br />


</div>