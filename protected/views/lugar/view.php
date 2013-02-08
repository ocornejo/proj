<?php
/* @var $this LugarController */
/* @var $model Lugar */

$this->breadcrumbs=array(
	'Lugars'=>array('index'),
	$model->ID_LUGAR,
);

$this->menu=array(
	array('label'=>'List Lugar', 'url'=>array('index')),
	array('label'=>'Create Lugar', 'url'=>array('create')),
	array('label'=>'Update Lugar', 'url'=>array('update', 'id'=>$model->ID_LUGAR)),
	array('label'=>'Delete Lugar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_LUGAR),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Lugar', 'url'=>array('admin')),
);
?>

<h1>View Lugar #<?php echo $model->ID_LUGAR; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_LUGAR',
		'LUGAR',
		'FILIAL_ID_FILIAL',
	),
)); ?>
