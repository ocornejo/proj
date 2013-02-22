<?php
/* @var $this CRITICOSController */
/* @var $model CRITICOS */

$this->breadcrumbs=array(
	'Criticoses'=>array('index'),
	$model->ID_CRITICOS=>array('view','id'=>$model->ID_CRITICOS),
	'Update',
);

$this->menu=array(
	array('label'=>'List CRITICOS', 'url'=>array('index')),
	array('label'=>'Create CRITICOS', 'url'=>array('create')),
	array('label'=>'View CRITICOS', 'url'=>array('view', 'id'=>$model->ID_CRITICOS)),
	array('label'=>'Manage CRITICOS', 'url'=>array('admin')),
);
?>

<h1>Update CRITICOS <?php echo $model->ID_CRITICOS; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>