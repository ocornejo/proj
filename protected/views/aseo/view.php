<?php
/* @var $this AseoController */
/* @var $model Aseo */

$this->breadcrumbs=array(
	'Aseos'=>array('index'),
	$model->ID_ASEO,
);

$this->menu=array(
	array('label'=>'List Aseo', 'url'=>array('index')),
	array('label'=>'Create Aseo', 'url'=>array('create')),
	array('label'=>'Update Aseo', 'url'=>array('update', 'id'=>$model->ID_ASEO)),
	array('label'=>'Delete Aseo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_ASEO),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Aseo', 'url'=>array('admin')),
);
?>

<h1>View Aseo #<?php echo $model->ID_ASEO; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_ASEO',
		'TIPO_ASEO',
	),
)); ?>
