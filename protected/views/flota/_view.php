<?php
/* @var $this FlotaController */
/* @var $data Flota */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_FLOTA')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_FLOTA), array('view', 'id'=>$data->ID_FLOTA)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_FLOTA')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE_FLOTA); ?>
	<br />


</div>