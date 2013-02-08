<?php
/* @var $this AvionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Avions',
);

$this->menu=array(
	array('label'=>'Create Avion', 'url'=>array('create')),
	array('label'=>'Manage Avion', 'url'=>array('admin')),
);
?>

<h1>Avions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
