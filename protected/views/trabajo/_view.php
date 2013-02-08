<?php
/* @var $this TrabajoController */
/* @var $data Trabajo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_TRABAJO')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_TRABAJO), array('view', 'id'=>$data->ID_TRABAJO)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OT')); ?>:</b>
	<?php echo CHtml::encode($data->OT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('AVION_MATRICULA')); ?>:</b>
	<?php echo CHtml::encode($data->AVION_MATRICULA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USUARIO_BP')); ?>:</b>
	<?php echo CHtml::encode($data->USUARIO_BP); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PLANIFICADO')); ?>:</b>
	<?php echo CHtml::encode($data->PLANIFICADO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HORA_INICIO')); ?>:</b>
	<?php echo CHtml::encode($data->HORA_INICIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HORA_TERMINO')); ?>:</b>
	<?php echo CHtml::encode($data->HORA_TERMINO); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('COMENTARIO')); ?>:</b>
	<?php echo CHtml::encode($data->COMENTARIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FECHA')); ?>:</b>
	<?php echo CHtml::encode($data->FECHA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CALIFICACION')); ?>:</b>
	<?php echo CHtml::encode($data->CALIFICACION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ESTADO_ID_ESTADO')); ?>:</b>
	<?php echo CHtml::encode($data->ESTADO_ID_ESTADO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LUGAR_ID_LUGAR')); ?>:</b>
	<?php echo CHtml::encode($data->LUGAR_ID_LUGAR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ASEO_ID_ASEO')); ?>:</b>
	<?php echo CHtml::encode($data->ASEO_ID_ASEO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TURNO_ID_TURNO')); ?>:</b>
	<?php echo CHtml::encode($data->TURNO_ID_TURNO); ?>
	<br />

	*/ ?>

</div>