<?php
/* @var $this AseoController */
/* @var $data Aseo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_ASEO')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_ASEO), array('view', 'id'=>$data->ID_ASEO)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIPO_ASEO')); ?>:</b>
	<?php echo CHtml::encode($data->TIPO_ASEO); ?>
	<br />


</div>