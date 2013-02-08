<?php
/* @var $this TrabajoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ingreso de Trabajos',
);
?>

<h1>Trabajos</h1>


<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php echo $this->renderPartial('_form', array('model'=>$model));  ?>
