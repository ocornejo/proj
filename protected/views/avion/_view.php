<?php
/* @var $this AvionController */
/* @var $data Avion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('MATRICULA')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->MATRICULA), array('view', 'id'=>$data->MATRICULA)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FLOTA_ID_FLOTA')); ?>:</b>
	<?php echo CHtml::encode($data->FLOTA_ID_FLOTA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OPERADOR_ID_OPERADOR')); ?>:</b>
	<?php echo CHtml::encode($data->OPERADOR_ID_OPERADOR); ?>
	<br />


</div>