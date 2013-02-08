<?php
/* @var $this OperadorController */
/* @var $model Operador */

$this->breadcrumbs=array(
	'Operadors'=>array('index'),
	$model->ID_OPERADOR,
);

$this->menu=array(
	array('label'=>'List Operador', 'url'=>array('index')),
	array('label'=>'Create Operador', 'url'=>array('create')),
	array('label'=>'Update Operador', 'url'=>array('update', 'id'=>$model->ID_OPERADOR)),
	array('label'=>'Delete Operador', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_OPERADOR),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Operador', 'url'=>array('admin')),
);
?>

<h1>View Operador #<?php echo $model->ID_OPERADOR; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_OPERADOR',
		'NOMBRE_OPERADOR',
	),
)); ?>
