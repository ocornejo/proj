<?php
/* @var $this TrabajoController */
/* @var $model Trabajo */

$this->breadcrumbs=array(
	'Trabajos'=>array('index'),
	$model->ID_TRABAJO=>array('view','id'=>$model->ID_TRABAJO),
	'Update',
);

$this->menu=array(
	array('label'=>'List Trabajo', 'url'=>array('index')),
	array('label'=>'Create Trabajo', 'url'=>array('create')),
	array('label'=>'View Trabajo', 'url'=>array('view', 'id'=>$model->ID_TRABAJO)),
	array('label'=>'Manage Trabajo', 'url'=>array('admin')),
);
?>

<h1>Update Trabajo <?php echo $model->ID_TRABAJO; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>