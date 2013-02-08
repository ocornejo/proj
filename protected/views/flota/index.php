<?php
/* @var $this FlotaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Flotas',
);

$this->menu=array(
	array('label'=>'Create Flota', 'url'=>array('create')),
	array('label'=>'Manage Flota', 'url'=>array('admin')),
);
?>

<h1>Flotas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
