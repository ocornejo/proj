<?php
/* @var $this AvionController */
/* @var $model Avion */

$this->breadcrumbs=array(
	'Avions'=>array('index'),
	$model->MATRICULA,
);

$this->menu=array(
	array('label'=>'List Avion', 'url'=>array('index')),
	array('label'=>'Create Avion', 'url'=>array('create')),
	array('label'=>'Update Avion', 'url'=>array('update', 'id'=>$model->MATRICULA)),
	array('label'=>'Delete Avion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->MATRICULA),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Avion', 'url'=>array('admin')),
);
?>

<h1>View Avion #<?php echo $model->MATRICULA; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'MATRICULA',
		'FLOTA_ID_FLOTA',
		'OPERADOR_ID_OPERADOR',
	),
)); ?>
