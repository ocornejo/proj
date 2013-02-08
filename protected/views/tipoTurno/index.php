<?php
/* @var $this TipoTurnoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tipo Turnos',
);

$this->menu=array(
	array('label'=>'Create TipoTurno', 'url'=>array('create')),
	array('label'=>'Manage TipoTurno', 'url'=>array('admin')),
);
?>

<h1>Tipo Turnos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
