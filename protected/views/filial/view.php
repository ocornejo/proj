<?php
/* @var $this FilialController */
/* @var $model Filial */

$this->breadcrumbs=array(
	'Filials'=>array('index'),
	$model->ID_FILIAL,
);

$this->menu=array(
	array('label'=>'List Filial', 'url'=>array('index')),
	array('label'=>'Create Filial', 'url'=>array('create')),
	array('label'=>'Update Filial', 'url'=>array('update', 'id'=>$model->ID_FILIAL)),
	array('label'=>'Delete Filial', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_FILIAL),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Filial', 'url'=>array('admin')),
);
?>

<h1>View Filial #<?php echo $model->ID_FILIAL; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_FILIAL',
		'NOMBRE_FILIAL',
		'PAIS',
	),
)); ?>
