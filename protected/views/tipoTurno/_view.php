<?php
/* @var $this TipoTurnoController */
/* @var $data TipoTurno */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_TIPO_TURNO')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_TIPO_TURNO), array('view', 'id'=>$data->ID_TIPO_TURNO)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIPO')); ?>:</b>
	<?php echo CHtml::encode($data->TIPO); ?>
	<br />


</div>