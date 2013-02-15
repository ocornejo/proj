<?php
/* @var $this TrabajoController */
/* @var $model Trabajo */

$this->breadcrumbs=array(
	'Trabajos'=>array('index'),
	'Ingresar',
);


?>

<h1>Ingresar nuevo aseo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'modelT'=>$modelT)); ?>