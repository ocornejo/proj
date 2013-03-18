<?php
/* @var $this TrabajoController */
/* @var $model Trabajo */

$this->breadcrumbs=array(
	'Trabajos'=>array('index'),
	$model->ID_TRABAJO,
);

$this->menu=array(
	array('label'=>'Listar aseos', 'url'=>array('index')),
	array('label'=>'Crear aseo', 'url'=>array('create')),
	array('label'=>'Actualizar aseo', 'url'=>array('update', 'id'=>$model->ID_TRABAJO)),
	array('label'=>'Borrar aseo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_TRABAJO),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar aseos', 'url'=>array('admin')),
);
?>

<h1>Vista Aseo #<?php echo $model->ID_TRABAJO; ?></h1>

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
                'ARCHIVO1',
                'ARCHIVO2',
                'ARCHIVO3',
	),
)); ?>
