<?php
/* @var $this TrabajoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ingreso de Trabajos',
);

$this->menu=array(
	array('label'=>'Create Trabajo', 'url'=>array('create')),
	array('label'=>'Manage Trabajo', 'url'=>array('admin')),
);
?>

<h1>Trabajos</h1>


<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>


