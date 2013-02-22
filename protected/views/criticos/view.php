<?php
/* @var $this CRITICOSController */
/* @var $model CRITICOS */

$this->breadcrumbs=array(
	'Criticoses'=>array('index'),
	$model->ID_CRITICOS,
);

$this->menu=array(
	array('label'=>'List CRITICOS', 'url'=>array('index')),
	array('label'=>'Create CRITICOS', 'url'=>array('create')),
	array('label'=>'Update CRITICOS', 'url'=>array('update', 'id'=>$model->ID_CRITICOS)),
	array('label'=>'Delete CRITICOS', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_CRITICOS),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CRITICOS', 'url'=>array('admin')),
);
?>

<h1>View CRITICOS #<?php echo $model->ID_CRITICOS; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_CRITICOS',
		'FLOTA_ID_FLOTA',
		'ASEO_ID_ASEO',
		'LIMITE1',
		'LIMITE2',
		'LIMITE3',
	),
)); ?>
