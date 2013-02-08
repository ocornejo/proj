<?php
/* @var $this TrabajoController */
/* @var $model Trabajo */

$this->breadcrumbs=array(
	'Trabajos'=>array('index'),
	$model->ID_TRABAJO,
);

$this->menu=array(
	array('label'=>'List Trabajo', 'url'=>array('index')),
	array('label'=>'Create Trabajo', 'url'=>array('create')),
	array('label'=>'Update Trabajo', 'url'=>array('update', 'id'=>$model->ID_TRABAJO)),
	array('label'=>'Delete Trabajo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_TRABAJO),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Trabajo', 'url'=>array('admin')),
);
?>

<h1>View Trabajo #<?php echo $model->ID_TRABAJO; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_TRABAJO',
		'OT',
		'AVION_MATRICULA',
		'USUARIO_BP',
		'PLANIFICADO',
		'HORA_INICIO',
		'HORA_TERMINO',
		'COMENTARIO',
		'FECHA',
		'CALIFICACION',
		'ESTADO_ID_ESTADO',
		'LUGAR_ID_LUGAR',
		'ASEO_ID_ASEO',
		'TURNO_ID_TURNO',
                'ARCHIVO',
	),
)); ?>
