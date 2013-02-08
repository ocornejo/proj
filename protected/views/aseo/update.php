<?php
/* @var $this AseoController */
/* @var $model Aseo */

$this->breadcrumbs=array(
	'Aseos'=>array('index'),
	$model->ID_ASEO=>array('view','id'=>$model->ID_ASEO),
	'Update',
);

$this->menu=array(
	array('label'=>'List Aseo', 'url'=>array('index')),
	array('label'=>'Create Aseo', 'url'=>array('create')),
	array('label'=>'View Aseo', 'url'=>array('view', 'id'=>$model->ID_ASEO)),
	array('label'=>'Manage Aseo', 'url'=>array('admin')),
);
?>

<h1>Update Aseo <?php echo $model->ID_ASEO; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>