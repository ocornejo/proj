<?php
/* @var $this FlotaController */
/* @var $model Flota */

$this->breadcrumbs=array(
	'Flotas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Flota', 'url'=>array('index')),
	array('label'=>'Manage Flota', 'url'=>array('admin')),
);
?>

<h1>Create Flota</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>