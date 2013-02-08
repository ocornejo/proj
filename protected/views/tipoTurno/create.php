<?php
/* @var $this TipoTurnoController */
/* @var $model TipoTurno */

$this->breadcrumbs=array(
	'Tipo Turnos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TipoTurno', 'url'=>array('index')),
	array('label'=>'Manage TipoTurno', 'url'=>array('admin')),
);
?>

<h1>Create TipoTurno</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>