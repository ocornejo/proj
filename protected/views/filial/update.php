<?php
/* @var $this FilialController */
/* @var $model Filial */

$this->breadcrumbs=array(
	'Filials'=>array('index'),
	$model->ID_FILIAL=>array('view','id'=>$model->ID_FILIAL),
	'Update',
);

$this->menu=array(
	array('label'=>'List Filial', 'url'=>array('index')),
	array('label'=>'Create Filial', 'url'=>array('create')),
	array('label'=>'View Filial', 'url'=>array('view', 'id'=>$model->ID_FILIAL)),
	array('label'=>'Manage Filial', 'url'=>array('admin')),
);
?>

<h1>Update Filial <?php echo $model->ID_FILIAL; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>