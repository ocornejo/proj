<?php
/* @var $this AvionController */
/* @var $model Avion */

$this->breadcrumbs=array(
	'Avions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Avion', 'url'=>array('index')),
	array('label'=>'Manage Avion', 'url'=>array('admin')),
);
?>

<h1>Create Avion</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>