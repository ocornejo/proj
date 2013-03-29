<?php
/* @var $this TrabajoController */
/* @var $model Trabajo */

$this->breadcrumbs=array(
	'Trabajo'=>array('index'),
	$model->ID_TRABAJO=>array('view','id'=>$model->ID_TRABAJO),
	'Actualizar',
);

//$this->menu=array(
//	array('label'=>'List Trabajo', 'url'=>array('index')),
//	array('label'=>'Create Trabajo', 'url'=>array('create')),
//	array('label'=>'View Trabajo', 'url'=>array('view', 'id'=>$model->ID_TRABAJO)),
//	array('label'=>'Manage Trabajo', 'url'=>array('admin')),
//);
?>
<?php  echo $this->renderPartial('_form', array('model'=>$model,
                                                'modelT'=>$modelT
        )); ?>