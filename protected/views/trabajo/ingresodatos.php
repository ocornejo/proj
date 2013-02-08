<?php
/* @var $this TrabajoController */
/* @var $model Trabajo */

$this->breadcrumbs=array(
	'Trabajos'=>array('index'),
	'Ingresodatos',
);


?>

<h1>Ingreso de trabajos</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>