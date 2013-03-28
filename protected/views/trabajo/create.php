<?php
/* @var $this TrabajoController */
/* @var $model Trabajo */

$this->breadcrumbs=array(
	'Trabajos'=>array('index'),
        'Ingresar',
);


?>
<?php echo $this->renderPartial('_form', array('model'=>$model,'modelT'=>$modelT)); ?>
