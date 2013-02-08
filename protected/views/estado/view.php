<?php
/* @var $this EstadoController */
/* @var $model Estado */

$this->breadcrumbs=array(
	'Estados'=>array('index'),
	$model->ID_ESTADO,
);

$this->menu=array(
	array('label'=>'List Estado', 'url'=>array('index')),
	array('label'=>'Create Estado', 'url'=>array('create')),
	array('label'=>'Update Estado', 'url'=>array('update', 'id'=>$model->ID_ESTADO)),
	array('label'=>'Delete Estado', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_ESTADO),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Estado', 'url'=>array('admin')),
);
?>

<h1>View Estado #<?php echo $model->ID_ESTADO; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_ESTADO',
		'NOMBRE_ESTADO',
	),
)); ?>
