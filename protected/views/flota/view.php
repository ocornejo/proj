<?php
/* @var $this FlotaController */
/* @var $model Flota */

$this->breadcrumbs=array(
	'Flotas'=>array('index'),
	$model->ID_FLOTA,
);

$this->menu=array(
	array('label'=>'List Flota', 'url'=>array('index')),
	array('label'=>'Create Flota', 'url'=>array('create')),
	array('label'=>'Update Flota', 'url'=>array('update', 'id'=>$model->ID_FLOTA)),
	array('label'=>'Delete Flota', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_FLOTA),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Flota', 'url'=>array('admin')),
);
?>

<h1>View Flota #<?php echo $model->ID_FLOTA; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_FLOTA',
		'NOMBRE_FLOTA',
	),
)); ?>
