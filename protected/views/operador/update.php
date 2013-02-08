<?php
/* @var $this OperadorController */
/* @var $model Operador */

$this->breadcrumbs=array(
	'Operadors'=>array('index'),
	$model->ID_OPERADOR=>array('view','id'=>$model->ID_OPERADOR),
	'Update',
);

$this->menu=array(
	array('label'=>'List Operador', 'url'=>array('index')),
	array('label'=>'Create Operador', 'url'=>array('create')),
	array('label'=>'View Operador', 'url'=>array('view', 'id'=>$model->ID_OPERADOR)),
	array('label'=>'Manage Operador', 'url'=>array('admin')),
);
?>

<h1>Update Operador <?php echo $model->ID_OPERADOR; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>