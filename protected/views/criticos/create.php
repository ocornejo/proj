<?php
/* @var $this CRITICOSController */
/* @var $model CRITICOS */

$this->breadcrumbs=array(
	'Criticoses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CRITICOS', 'url'=>array('index')),
	array('label'=>'Manage CRITICOS', 'url'=>array('admin')),
);
?>

<h1>Create CRITICOS</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>