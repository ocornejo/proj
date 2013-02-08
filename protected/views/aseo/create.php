<?php
/* @var $this AseoController */
/* @var $model Aseo */

$this->breadcrumbs=array(
	'Aseos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Aseo', 'url'=>array('index')),
	array('label'=>'Manage Aseo', 'url'=>array('admin')),
);
?>

<h1>Create Aseo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>