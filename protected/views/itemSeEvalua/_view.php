<?php
/* @var $this UsuarioController */
/* @var $data Usuario */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('FLOTA_ID_FLOTA')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->BP), array('view', 'id'=>$data->FLOTA_ID_FLOTA)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ASEO_ID_ASEO')); ?>:</b>
	<?php echo CHtml::encode($data->ASEO_ID_ASEO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ITEM_ID_ITEM')); ?>:</b>
	<?php echo CHtml::encode($data->ITEM_ID_ITEM); ?>
	<br />



</div>