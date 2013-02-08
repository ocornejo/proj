<?php
/* @var $this EstadoController */
/* @var $model Estado */

$this->breadcrumbs=array(
	'Estados'=>array('index'),
	$model->ID_ESTADO=>array('view','id'=>$model->ID_ESTADO),
	'Update',
);

$this->menu=array(
	array('label'=>'List Estado', 'url'=>array('index')),
	array('label'=>'Create Estado', 'url'=>array('create')),
	array('label'=>'View Estado', 'url'=>array('view', 'id'=>$model->ID_ESTADO)),
	array('label'=>'Manage Estado', 'url'=>array('admin')),
);
?>

<h1>Update Estado <?php echo $model->ID_ESTADO; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>