<?php
/* @var $this EvaluacionController */
/* @var $model Evaluacion */

$this->breadcrumbs=array(
	'Evaluacions'=>array('index'),
	$model->ID_EVALUACION=>array('view','id'=>$model->ID_EVALUACION),
	'Update',
);

$this->menu=array(
	array('label'=>'List Evaluacion', 'url'=>array('index')),
	array('label'=>'Create Evaluacion', 'url'=>array('create')),
	array('label'=>'View Evaluacion', 'url'=>array('view', 'id'=>$model->ID_EVALUACION)),
	array('label'=>'Manage Evaluacion', 'url'=>array('admin')),
);
?>

<h1>Update Evaluacion <?php echo $model->ID_EVALUACION; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>