<?php
/* @var $this TipoTurnoController */
/* @var $model TipoTurno */

$this->breadcrumbs=array(
	'Tipo Turnos'=>array('index'),
	$model->ID_TIPO_TURNO=>array('view','id'=>$model->ID_TIPO_TURNO),
	'Update',
);

$this->menu=array(
	array('label'=>'List TipoTurno', 'url'=>array('index')),
	array('label'=>'Create TipoTurno', 'url'=>array('create')),
	array('label'=>'View TipoTurno', 'url'=>array('view', 'id'=>$model->ID_TIPO_TURNO)),
	array('label'=>'Manage TipoTurno', 'url'=>array('admin')),
);
?>

<h1>Update TipoTurno <?php echo $model->ID_TIPO_TURNO; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>