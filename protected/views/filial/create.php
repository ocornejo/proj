<?php
/* @var $this FilialController */
/* @var $model Filial */

$this->breadcrumbs=array(
	'Filials'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Filial', 'url'=>array('index')),
	array('label'=>'Manage Filial', 'url'=>array('admin')),
);
?>

<h1>Create Filial</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>