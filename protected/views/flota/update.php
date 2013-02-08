<?php
/* @var $this FlotaController */
/* @var $model Flota */

$this->breadcrumbs=array(
	'Flotas'=>array('index'),
	$model->ID_FLOTA=>array('view','id'=>$model->ID_FLOTA),
	'Update',
);

$this->menu=array(
	array('label'=>'List Flota', 'url'=>array('index')),
	array('label'=>'Create Flota', 'url'=>array('create')),
	array('label'=>'View Flota', 'url'=>array('view', 'id'=>$model->ID_FLOTA)),
	array('label'=>'Manage Flota', 'url'=>array('admin')),
);
?>

<h1>Update Flota <?php echo $model->ID_FLOTA; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>