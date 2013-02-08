<?php
/* @var $this LugarController */
/* @var $model Lugar */

$this->breadcrumbs=array(
	'Lugars'=>array('index'),
	$model->ID_LUGAR=>array('view','id'=>$model->ID_LUGAR),
	'Update',
);

$this->menu=array(
	array('label'=>'List Lugar', 'url'=>array('index')),
	array('label'=>'Create Lugar', 'url'=>array('create')),
	array('label'=>'View Lugar', 'url'=>array('view', 'id'=>$model->ID_LUGAR)),
	array('label'=>'Manage Lugar', 'url'=>array('admin')),
);
?>

<h1>Update Lugar <?php echo $model->ID_LUGAR; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>