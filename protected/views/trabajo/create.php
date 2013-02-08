<?php
/* @var $this TrabajoController */
/* @var $model Trabajo */

$this->breadcrumbs=array(
	'Trabajos'=>array('index'),
	'Create',
);


?>

<h1>Create Trabajo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>