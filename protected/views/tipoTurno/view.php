<?php
/* @var $this TipoTurnoController */
/* @var $model TipoTurno */

$this->breadcrumbs=array(
	'Tipo Turnos'=>array('index'),
	$model->ID_TIPO_TURNO,
);

$this->menu=array(
	array('label'=>'List TipoTurno', 'url'=>array('index')),
	array('label'=>'Create TipoTurno', 'url'=>array('create')),
	array('label'=>'Update TipoTurno', 'url'=>array('update', 'id'=>$model->ID_TIPO_TURNO)),
	array('label'=>'Delete TipoTurno', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_TIPO_TURNO),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TipoTurno', 'url'=>array('admin')),
);
?>

<h1>View TipoTurno #<?php echo $model->ID_TIPO_TURNO; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_TIPO_TURNO',
		'TIPO',
	),
)); ?>
