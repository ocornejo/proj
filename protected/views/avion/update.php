<?php
/* @var $this AvionController */
/* @var $model Avion */

//$this->breadcrumbs=array(
//	'Avions'=>array('index'),
//	$model->MATRICULA=>array('view','id'=>$model->MATRICULA),
//	'Update',
//);

$this->menu=array(
	array('label'=>'List Avion', 'url'=>array('index')),
	array('label'=>'Create Avion', 'url'=>array('create')),
	array('label'=>'View Avion', 'url'=>array('view', 'id'=>$model->MATRICULA)),
	array('label'=>'Manage Avion', 'url'=>array('admin')),
);
?>

<h1>Update Avion <?php echo $model->MATRICULA; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>